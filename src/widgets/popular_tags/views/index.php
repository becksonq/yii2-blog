<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View
 * @var $tags array
 * @var $tag \becksonq\blog\models\tags\Tag
 */
?>

<!-- Popular tags-->
<div class="widget mb-grid-gutter">
    <?= Html::tag('h3', Yii::t('app', 'Популярные теги', ['class' => 'widget-title'])) ?>
    <?php
    foreach ($tags as $tag):
        echo Html::a('#' . $tag->name, Url::to(['/blog/post/tag', 'id' => $tag->id]), ['class' => 'btn-tag mr-2 mb-2']);
    endforeach; ?>
</div>
