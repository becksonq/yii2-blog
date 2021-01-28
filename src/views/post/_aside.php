<?php

use yii\helpers\Html;

/** @var $bundle */
?>

<aside class="col-lg-4">
    <!-- Sidebar-->
    <div class="cz-sidebar border-left ml-lg-auto" id="blog-sidebar">
        <div class="cz-sidebar-header box-shadow-sm">
            <div class="cz-sidebar-header box-shadow-sm">
                <?= Html::beginTag('button', [
                    'class'        => 'close ml-auto',
                    'type'         => 'button',
                    'data-dismiss' => 'sidebar',
                    'aria-label'   => Yii::t('app', 'Закрыть'),
                ]) ?>
                <span class="d-inline-block font-size-xs font-weight-normal align-middle"><?= Yii::t('app',
                        'Закрыть сайдбар') ?></span>
                <span class="d-inline-block align-middle ml-2" aria-hidden="true">&times;</span>
                <?= Html::endTag('button') ?>
            </div>
        </div>
        <div class="cz-sidebar-body py-lg-1" data-simplebar data-simplebar-auto-hide="true">

            <?= \becksonq\blog\widgets\categories\CategoriesWidget::widget([]) ?>

            <?= \becksonq\blog\widgets\trending_posts\TrendingPostsWidget::widget([]) ?>

            <?= \becksonq\blog\widgets\popular_tags\PopularTagsWidget::widget([]) ?>

            <?= \becksonq\blog\modules\sidebar_banner\widgets\SideBannerWidget::widget(['bundle' => $bundle]) ?>
        </div>
    </div>
</aside>
