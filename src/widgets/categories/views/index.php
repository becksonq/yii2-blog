<?php

use yii\helpers\Html;

/* @var $this \yii\web\View
 * @var $categories \blog\models\category\Category
 */
?>

<div class="widget widget-links mb-grid-gutter pb-grid-gutter border-bottom">
    <h3 class="widget-title"><?= Yii::t('app', 'Категории') ?></h3>
    <ul class="widget-list">
        <?php
        foreach ($categories as $category) : ?>
            <li class="widget-list-item">
                <!-- TODO: count постов -->
                <?= Html::a(Html::encode($category->name) . '<span class="font-size-xs text-muted ml-3">18</span>',
                    ['/blog/post/category', 'slug' => $category->slug], [
                        'class' => 'widget-list-link d-flex justify-content-between align-items-center',
                    ]) ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
