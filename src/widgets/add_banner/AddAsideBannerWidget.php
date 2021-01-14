<?php


namespace blog\widgets\add_banner;


use yii\base\Widget;

/**
 * Class AddAsideBannerWidget
 * @package blog\widgets\add_banner
 *
 * Usage
 * -------------------------------------
 * <?= AddAsideBannerWidget::widget(['bundle' => $bundle]) ?>
 */
class AddAsideBannerWidget extends Widget
{
    public $bundle;

    /**
     * @return string
     */
    public function run(): string
    {
        return $this->render('index', ['bundle' => $this->bundle]);
    }
}