<?php


namespace becksonq\blog\modules\sidebar_banner\widgets;


use becksonq\blog\modules\sidebar_banner\models\SidebarBanners;
use yii\base\Widget;

/**
 * Class SideBannerWidget
 * @package becksonq\blog\modules\sidebar_banner\widgets
 *
 * Usage
 * -------------------------------------
 * <?= \becksonq\blog\modules\sidebar_banner\widgets\SideBannerWidget::widget(['bundle' => $bundle]) ?>
 */
class SideBannerWidget extends Widget
{
    public $bundle;

    /**
     * @return string
     */
    public function run(): string
    {
        return $this->render('index', [
            'model'  => $this->getModels(),
            'bundle' => $this->bundle,
        ]);
    }

    protected function getModels()
    {
        $query = SidebarBanners::find()->where(['status' => SidebarBanners::STATUS_ACTIVE])->cache(3600 * 6)->asArray()->all();
        $index = array_rand($query);
        return $query[$index];
    }
}