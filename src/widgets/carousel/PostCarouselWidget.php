<?php

namespace blog\widgets\carousel;


use blog\models\post\PostReadRepository;
use frontend\assets\AppAsset;
use yii\base\Widget;

/**
 * Class PostCarouselWidget
 * @package blog\widgets\carousel
 *
 * Usage:
 * ------------------------------------
 * <?= PostCarouselWidget::widget([]) ?>
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
            'posts' => $this->_repository->getAll(),
            'bundle' => $this->bundle,
        ]);
    }
}