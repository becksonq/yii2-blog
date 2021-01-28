<?php


namespace becksonq\blog\controllers\crud;


use becksonq\blog\models\post\Post;
use becksonq\blog\models\post\PostImages;
use becksonq\blog\models\post\PostImagesForm;
use becksonq\blog\models\post\PostImagesService;
use yii\filters\VerbFilter;
use Yii;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;

class PostImagesController extends \yii\web\Controller
{
    private $_service;

    /**
     * PostController constructor.
     * @param $id
     * @param $module
     * @param PostImagesService $service
     * @param array $config
     */
    public function __construct($id, $module, PostImagesService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->_service = $service;
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
                    'delete-image'    => ['post'],
                    'move-photo-up'   => ['post'],
                    'move-photo-down' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Добавляем изображения 628x494 для тела поста на странице его просмотра
     * @param int $postId
     * @param int $type
     * @return string|\yii\web\Response
     */
    public function actionAddImages(int $postId, int $type)
    {
        $form = new PostImagesForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->_service->addImages($postId, $form);
                return $this->redirect(['crud/post/view', 'id' => $postId, '#' => 'images']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
            }
        }

        return $this->render('add-image', [
            'model' => $form,
            'id'    => $postId,
            'type'  => PostImages::type()[$type],
        ]);
    }

    /**
     * Добавляем изображения 628x494 для тела поста на странице его просмотра
     * @param int $postId
     * @param int $type
     * @return string|\yii\web\Response
     */
    public function actionAddFullImages(int $postId, int $type)
    {
        $form = new PostImagesForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->_service->addFullImages($postId, $form);
                return $this->redirect(['crud/post/view', 'id' => $postId, '#' => 'images']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
            }
        }

        return $this->render('add-image', [
            'model' => $form,
            'id'    => $postId,
            'type'  => PostImages::type()[$type],
        ]);
    }

    /**
     * Добавляем изображение 600х350 для карусели на главной странице постов
     * @param int $postId
     * @param int $type
     * @return string|\yii\web\Response
     */
    public function actionAddCarouselImage(int $postId, int $type)
    {
        $form = new PostImagesForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->_service->addCarouselImage($postId, $form);
                return $this->redirect(['crud/post/view', 'id' => $postId, '#' => 'images']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
            }
        }
        return $this->render('add-image', [
            'model' => $form,
            'id'    => $postId,
            'type'  => PostImages::type()[$type],
        ]);
    }

    /**
     * Добавляем изображение 100х667 для слайдера на странице поста
     * @param int $postId
     * @return string|\yii\web\Response
     */
    public function actionAddFullImage(int $postId)
    {
        $form = new PostImagesForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->_service->addFullImage($postId, $form);
                return $this->redirect(['crud/post/view', 'id' => $postId, '#' => 'images']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
            }
        }
        return $this->render('add-image', [
            'model' => $form,
            'id'    => $postId,
        ]);
    }

    /**
     * @param integer $postId
     * @param int $type
     * @return mixed
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDeleteImage(int $postId, int $type = null, int $imageId = null)
    {
        try {
            $this->_service->removeImage($postId, $type, $imageId);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['crud/post/view', 'id' => $postId, '#' => 'images']);
    }

    /**
     * @param integer $postId
     * @param $imageId
     * @return mixed
     */
    public function actionMoveImageUp(int $postId, int $imageId)
    {
        $this->_service->moveImageUp($postId, $imageId);
        return $this->redirect(['crud/post/view', 'id' => $postId, '#' => 'images']);
    }

    /**
     * @param integer $id
     * @param $imageId
     * @return mixed
     */
    public function actionMoveImageDown($postId, $imageId)
    {
        $this->_service->moveImageDown($postId, $imageId);
        return $this->redirect(['crud/post/view', 'id' => $postId, '#' => 'images']);
    }

    /**
     * @param integer $postId
     * @param $imageId
     * @return mixed
     */
    public function actionMoveFullImageUp(int $postId, int $imageId)
    {
        $this->_service->moveFullImageUp($postId, $imageId);
        return $this->redirect(['crud/post/view', 'id' => $postId, '#' => 'images']);
    }

    /**
     * @param integer $id
     * @param $imageId
     * @return mixed
     */
    public function actionMoveFullImageDown($postId, $imageId)
    {
        $this->_service->moveFullImageDown($postId, $imageId);
        return $this->redirect(['crud/post/view', 'id' => $postId, '#' => 'images']);
    }

    /**
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id): Post
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}