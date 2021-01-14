<?php

namespace becksonq\blog\controllers;

use becksonq\blog\models\comment\CommentForm;
use becksonq\blog\models\category\CategoryReadRepository;
use becksonq\blog\models\post\PostReadRepository;
use becksonq\blog\models\tags\TagRepository;
use becksonq\blog\models\comment\CommentService;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Class PostController
 * @package frontend\controllers\blog
 */
class PostController extends Controller
{
    public $layout = 'blog';

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
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'grocery-store';

        $dataProvider = $this->_posts->getAll();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $slug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionCategory($slug)
    {
        if (!$category = $this->_categories->findBySlug($slug)) {
            throw new NotFoundHttpException('The requested page does not exist.');
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
    public function actionPost($id)
    {
        if (!$post = $this->_posts->find($id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $this->render('post', [
            'post' => $post,
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
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $form = new CommentForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $comment = $this->_service->create($post->id, Yii::$app->user->id, $form);
                return $this->redirect(['post', 'id' => $post->id, '#' => 'comment_' . $comment->id]);
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