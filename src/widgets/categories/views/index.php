<?php

use yii\helpers\Html;

/* @var $this \yii\web\View
 * @var $categories array
 * @var $category \becksonq\blog\models\category\Category
 */
?>

<!-- Categories-->
<div class="widget widget-links mb-grid-gutter pb-grid-gutter border-bottom">
    <?= Html::tag('h3', Yii::t('app', 'Категории'), ['class' => 'widget-title']) ?>
    <ul class="widget-list">
        <?php
        foreach ($categories as $category) :
            if ($category->count == 0) {
                continue;
            } ?>
            <?= Html::beginTag('li', ['class' => 'widget-list-item']) ?>
            <!-- TODO: count постов -->
            <?= Html::a(Html::encode($category->name) . '<span class="font-size-xs text-muted ml-3">' . $category->count . '</span>',
                ['/blog/post/category', 'id' => $category->id], [
                    'class' => 'widget-list-link d-flex justify-content-between align-items-center',
                ]) ?>
            <?= Html::endTag('li') ?>
        <?php endforeach; ?>
    </ul>
</div>

