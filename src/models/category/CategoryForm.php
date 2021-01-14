<?php

namespace becksonq\blog\models\category;

use shop\models\forms\CompositeForm;
use shop\models\meta\MetaForm;

/**
 * @property MetaForm $meta;
 */
class CategoryForm extends CompositeForm
{
    /**
     * @var string $name
     */
    public $name;
    /**
     * @var string $slug
     */
    public $slug;
    /**
     * @var string $title
     */
    public $title;
    /**
     * @var string $description
     */
    public $description;
    /**
     * @var int|mixed $sort
     */
    public $sort;

    private $_category;
    
    /**
     * CategoryForm constructor.
     * @param Category|null $category
     * @param array $config
     */
    public function __construct(Category $category = null, $config = [])
    {
        if ($category) {
            $this->name = $category->name;
            $this->slug = $category->slug;
            $this->title = $category->title;
            $this->description = $category->description;
            $this->sort = $category->sort;
            $this->meta = new MetaForm($category->meta);
            $this->_category = $category;
        } else {
            $this->meta = new MetaForm();
            $this->sort = Category::find()->max('sort') + 1;
        }
        parent::__construct($config);
    }
    
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['name',], 'required'],
            [['name', 'slug', 'title'], 'string', 'max' => 255],
            [['description'], 'string'],
            [['name',],
                'unique',
                'targetClass' => Category::class,
                'filter'      => $this->_category ? ['<>', 'id', $this->_category->id] : null
            ]
        ];
    }
    
    /**
     * @return array
     */
    public function internalForms(): array
    {
        return ['meta'];
    }
}