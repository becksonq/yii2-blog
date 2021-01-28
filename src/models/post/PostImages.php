<?php


namespace becksonq\blog\models\post;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * Class PostImaes
 * @package becksonq\blog\models\post
 *
 * @property int $id
 * @property int $post_id
 * @property string $file
 * @property int $type
 * @property int $sort
 */
class PostImages extends \yii\db\ActiveRecord
{
    /**
     * @var int image 1000x667  Большое изображение для вывода в слайдшоу на странице поста
     */
    const TYPE_FULL = 1;

    /** @var int image 600x350 Изображение в карусели на странице постов */
    const TYPE_CAROUSEL = 2;

    /** @var int image 628x494 3 изображения на странице поста */
    const TYPE_POST_SINGLE = 3;

    /** @var string Путь к изображениям в папке исходников */
    const ORIGIN_PATH = '/origin/posts/';

    /** @var string Путь к изображениям в папке изображений для показа */
    const CACHE_PATH = '/cache/posts/';

    public static function type()
    {
        return [
            self::TYPE_FULL        => '1000x667',
            self::TYPE_CAROUSEL    => '600x350',
            self::TYPE_POST_SINGLE => '628x494',
        ];
    }

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%blog_post_images}}';
    }

    public function behaviors(): array
    {
        return [
            [
                'class'                 => ImageUploadBehavior::className(),
                'attribute'             => 'file',
                'createThumbsOnRequest' => true,
                'filePath'              => '@staticRoot/origin/posts/[[attribute_post_id]]/[[id]].[[extension]]',
                'fileUrl'               => '@static/origin/posts/[[attribute_post_id]]/[[id]].[[extension]]',
                'thumbPath'             => '@staticRoot/cache/posts/[[attribute_post_id]]/[[profile]]_[[id]].[[extension]]',
                'thumbUrl'              => '@static/cache/posts/[[attribute_post_id]]/[[profile]]_[[id]].[[extension]]',
                'thumbs'                => [
                    'carousel'      => ['width' => 600, 'height' => 350],
                    'navigation'    => ['width' => 100, 'height' => 100],
                    'admin'         => ['width' => 100, 'height' => 70],
                    'trending_post' => ['width' => 128, 'height' => 128],

                    'blog_list'      => ['width' => 600, 'height' => 333],
                    'blog_single'    => ['width' => 628, 'height' => 494],
                    'blog_single_th' => ['width' => 382, 'height' => 296],
                    'preview'        => ['width' => 250, 'height' => 166],
                    'full'           => ['width' => 1000, 'height' => 667]
                ],
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost(): ActiveQuery
    {
        return $this->hasOne(Post::class, ['id' => 'post_id']);
    }

    /**
     * @param int $postId
     * @param UploadedFile $file
     * @param int $type
     * @return static
     */
    public static function create(int $postId, UploadedFile $file, int $type): self
    {
        $model = new static();
        $model->post_id = $postId;
        $model->file = $file;
        $model->type = $type;
        return $model;
    }

    public function edit(int $postId, UploadedFile $file, int $type)
    {
        $this->post_id = $postId;
        $this->file = $file;
        $this->type = $type;
        return $this;
    }

    /**
     * @param int $postId
     * @param UploadedFile $file
     * @param int $type
     */
    public function addImage(int $postId, UploadedFile $file, int $type): void
    {
        $images[] = self::create($postId, $file, $type);
        $this->_updateImages($images);
    }

    /**
     * @param int $postId
     * @param UploadedFile $file
     * @param int $type
     */
    public function updateImage(int $postId, UploadedFile $file, int $type)
    {
        $image = self::find()->where(['post_id' => $postId, 'type' => $type])->one();
        $images[] = $image->edit($postId, $file, $type);
        $this->_updateImages($images);
    }

    /**
     * @param array $images
     */
    private function _updateImages(array $images): void
    {
        foreach ($images as $i => $image) {
            $image->setSort($i);
            $image->save();
        }
    }

    /**
     * @param int $id
     * @todo: метод нужно править. Сейчас это просто копипаст метода из Post
     * @deprecated
     */
    public function removeImage(int $id): void
    {
        $images = $this->images;
        foreach ($images as $i => $image) {
            if ($image->isIdEqualTo($id)) {
                unset($images[$i]);
                $this->_updateImages($images);
                return;
            }
        }
        throw new \DomainException('Image is not found.');
    }

    /**
     * @param $sort
     */
    public function setSort($sort): void
    {
        $this->sort = $sort;
    }

    /**
     * @param $id
     * @return bool
     */
    public function isIdEqualTo($id): bool
    {
        return $this->id == $id;
    }
}