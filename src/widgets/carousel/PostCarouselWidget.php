<?php

namespace becksonq\blog\widgets\carousel;


use becksonq\blog\models\post\PostReadRepository;
use frontend\assets\AppAsset;
use yii\base\Widget;

/**
 * Карусель на главной странице блога
 *
 * Class PostCarouselWidget
 * @package blog\widgets\carousel
 *
 * Usage:
 * ------------------------------------
 * <?= \becksonq\blog\widgets\carousel\PostCarouselWidget::widget([]) ?>
 */
class PostCarouselWidget extends Widget
{
    /**
     * @var PostReadRepository
     */
    private $_repository;
    /**
     * @var AppAsset
     */
    public $bundle;

    /**
     * PostCarouselWidget constructor.
     * @param PostReadRepository $repository
     * @param array $config
     */
    public function __construct(PostReadRepository $repository, $config = [])
    {
        parent::__construct($config);
        $this->_repository = $repository;
    }

    /**
     * @return string
     */
    public function run()
    {
        return $this->render('index', [
            'posts'  => $this->_repository->getAll(),
            'bundle' => $this->bundle,
        ]);
    }
}