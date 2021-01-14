<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View
 * @var $tags array
 * @var $tag \blog\models\tags\Tag
 */
?>

<div class="widget mb-grid-gutter">
    <h3 class="widget-title">Popular tags</h3>
    <?php
    foreach ($tags as $tag):
       echo Html::a($tag->name, Url::to(['/blog/post/tag', 'id' => $tag->id]), ['class' => 'btn-tag mr-2 mb-2']);
    endforeach; ?>
</div>
