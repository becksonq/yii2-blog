<?php

namespace becksonq\blog\models\category;

use shop\models\behaviors\MetaBehavior;
use shop\models\meta\Meta;
use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $title
 * @property string $description
 * @property int $sort
 * @property int $count
 *
 * @property Meta $meta
 */
class Category extends ActiveRecord
{
    /**
     * @var
     */
    public $meta;
    
    /**
     * @param $name
     * @param $slug
     * @param $title
     * @param $description
     * @param $sort
     * @param Meta $meta
     * @return Category
     */
    public static function create($name, $slug, $title, $description, $sort, Meta $meta): self
    {
        $category = new static();
        $category->name = $name;
        $category->slug = $slug;
        $category->title = $title;
        $category->description = $description;
        $category->sort = $sort;
        $category->meta = $meta;
        return $category;
    }
    
    /**
     * @param $name
     * @param $slug
     * @param $title
     * @param $description
     * @param $sort
     * @param Meta $meta
     */
    public function edit($name, $slug, $title, $description, $sort, Meta $meta): void
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->title = $title;
        $this->description = $description;
        $this->sort = $sort;
        $this->meta = $meta;
    }
    
    /**
     * @return string
     */
    public function getSeoTitle(): string
    {
        return $this->meta->title ?: $this->getHeadingTile();
    }
    
    /**
     * @return string
     */
    public function getHeadingTile(): string
    {
        return $this->title ?: $this->name;
    }
    
    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%blog_categories}}';
    }
    
    /**
     * @return array
     */
    public function behaviors(): array
    {
        return [
            MetaBehavior::className(),
            'slug' => [
                'class'                => 'Zelenin\yii\behaviors\Slug',
                'slugAttribute'        => 'slug',
                'attribute'            => 'name',
                // optional params
                'ensureUnique'         => true,
                'replacement'          => '-',
                'lowercase'            => true,
                'immutable'            => false,
                // If intl extension is enabled, see http://userguide.icu-project.org/transforms/general.
                'transliterateOptions' => 'Russian-Latin/BGN; Any-Latin; Latin-ASCII; NFD; [:Nonspacing Mark:] Remove; NFC;'
            ]
        ];
    }
}