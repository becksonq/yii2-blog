<?php

namespace becksonq\blog\controllers;

use becksonq\blog\BlogAssetBundle;
use becksonq\blog\models\comment\CommentForm;
use becksonq\blog\models\category\CategoryReadRepository;
use becksonq\blog\models\post\PostManageService;
use becksonq\blog\models\post\PostReadRepository;
use becksonq\blog\models\tags\TagRepository;
use becksonq\blog\models\comment\CommentService;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Class PostController
 * @package frontend\controllers\blog
 */
class PostController extends Controller
{
    private $_service;
    private $_posts;
    private $_categories;
    private $_tags;

    public function __construct(
        $id,
        $module,
        CommentService $service,
        PostReadRepository $posts,
        CategoryReadRepository $categories,
        TagRepository $tags,
        $config = []
    ) {
        parent::__construct($id, $module, $config);
        $this->_service = $service;
        $this->_posts = $posts;
        $this->_categories = $categories;
        $this->_tags = $tags;
    }

    /**
     * @return array
     */
    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete'          => ['post'],
                ],
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        BlogAssetBundle::register($this->view);

        $dataProvider = $this->_posts->getAll();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param int $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionCategory(int $id): string
    {
        if (!$category = $this->_categories->find($id)) {
            throw new NotFoundHttpException('The requested blog category does not exist.');
        }

        $dataProvider = $this->_posts->getAllByCategory($category);

        return $this->render('category', [
            'category'     => $category,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     * @deprecated
     */
    public function actionTag($id)
    {
        if (!$tag = $this->_tags->find($id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $dataProvider = $this->_posts->getAllByTag($tag);

        return $this->render('tag', [
            'tag'          => $tag,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionSinglePost($id)
    {
        BlogAssetBundle::register($this->view);

        if (!$post = $this->_posts->find($id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $this->render('single-post', [
            'post' => $post,
            'prev' => $this->_posts->prev($id),
            'next' => $this->_posts->next($id),
        ]);
    }

    /**
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionComment($id)
    {
        if (!$post = $this->_posts->find($id)) {
            throw new NotFoundHttpException('The requested post does not exist.');
        }

        $form = new CommentForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $comment = $this->_service->create($post->id, Yii::$app->user->id, $form);
                return $this->redirect(['single-post', 'id' => $post->id, '#' => 'comment_' . $comment->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('comment', [
            'post'  => $post,
            'model' => $form,
        ]);
    }
}