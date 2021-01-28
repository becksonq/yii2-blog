<?php

namespace becksonq\blog\widgets\categories;

use becksonq\blog\models\category\Category;
use becksonq\blog\models\category\CategoryReadRepository;
use yii\base\Widget;

/**
 * Class CategoriesWidget
 * @package blog\widgets\categories
 *
 * Usage
 * <?= \becksonq\blog\widgets\categories\CategoriesWidget::widget([]) ?>
 */
class CategoriesWidget extends Widget
{
    /** @var Category|null */
    public $active;

    private $_categories;

    /**
     * CategoriesWidget constructor.
     * @param CategoryReadRepository $categories
     * @param array $config
     */
    public function __construct(CategoryReadRepository $categories, $config = [])
    {
        parent::__construct($config);
        $this->_categories = $categories;
    }

    /**
     * @return string
     */
    public function run(): string
    {
        return $this->render('index', [
            'categories' => $this->_categories->getAll(),
        ]);
    }
}