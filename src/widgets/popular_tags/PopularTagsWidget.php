<?php


namespace becksonq\blog\widgets\popular_tags;


use becksonq\blog\models\tags\TagRepository;
use yii\base\Widget;

/**
 * Class PopularTagsWidget
 * @package blog\widgets\popular_tags
 *
 * Usage
 * ----------------------------------
 * <?= \becksonq\blog\widgets\popular_tags\PopularTagsWidget::widget([]) ?>
 */
class PopularTagsWidget extends Widget
{
    private $_tags;

    public function __construct(TagRepository $tags, $config = [])
    {
        parent::__construct($config);
        $this->_tags = $tags;
    }

    public function run()
    {
        return $this->render('index', [
            'tags' => $this->_tags->getPopular(10),
        ]);
    }
}