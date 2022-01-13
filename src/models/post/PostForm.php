<?php

namespace becksonq\blog\models\post;

use becksonq\blog\models\tags\TagsForm;
use becksonq\blog\models\category\Category;
use shop\models\forms\CompositeForm;
use shop\models\meta\MetaForm;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * @property MetaForm $meta
 * @property TagsForm $tags
 */
class PostForm extends CompositeForm
{
    public $categoryId;
    public $title;
    public $slug;
    public $description;
    public $content;
    public $image;
    public $caption;

    /**
     * PostForm constructor.
     * @param Post|null $post
     * @param array $config
     */
    public function __construct(Post $post = null, $config = [])
    {
        if ($post) {
            $this->categoryId = $post->category_id;
            $this->title = $post->title;
            $this->description = $post->description;
            $this->content = $post->content;
            $this->caption = $post->caption;
            $this->meta = new MetaForm($post->meta);
            $this->tags = new TagsForm($post);
        } else {
            $this->meta = new MetaForm();
            $this->tags = new TagsForm();
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            ['slug', 'unique', 'targetClass' => self::class, 'message' => 'Post with the slug is exists'],
            [['categoryId', 'title'], 'required'],
            [['title', 'caption'], 'string', 'max' => 255],
            [['categoryId'], 'integer'],
            [['description', 'content'], 'string'],
            [['image'], 'image'],
        ];
    }

    /**
     * @return array
     */
    public function categoriesList(): array
    {
        return ArrayHelper::map(Category::find()->orderBy('sort')->asArray()->all(), 'id', 'name');
    }

    /**
     * @return array
     */
    protected function internalForms(): array
    {
        return ['meta', 'tags',];
    }

    /**
     * @return bool
     */
    public function beforeValidate(): bool
    {
        if (parent::beforeValidate()) {
            $this->image = UploadedFile::getInstance($this, 'image');
            return true;
        }
        return false;
    }
}