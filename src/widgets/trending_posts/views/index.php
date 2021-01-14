<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View
 * @var $posts array
 * @var $post \blog\models\post\Post
 */
?>

<div class="widget mb-grid-gutter pb-grid-gutter border-bottom">
    <h3 class="widget-title"><?= Yii::t('app', 'Популярные посты') ?></h3>

    <?php
    foreach ($posts as $post) : ?>
        <div class="media align-items-center mb-3">
            <!-- TODO: image & alt -->
            <?= Html::a(Html::img('img/blog/widget/01.jpg',
                ['class' => 'rounded', 'width' => '64', 'alt' => 'Post image']), Url::to(['/blog/post/post', 'id' => $post->id]), []) ?>
            <div class="media-body pl-3">
                <h6 class="blog-entry-title font-size-sm mb-0">
                    <?= Html::a($post->title, Url::to(['/blog/post/post', 'id' => $post->id]), []) ?>
                </h6>
                <span class="font-size-ms text-muted">by
                    <?= Html::a($post->author, ['#'], ['class' => 'blog-entry-meta-link']) ?>
                </span>
            </div>
        </div>
    <?php endforeach;
    ?>
</div>
