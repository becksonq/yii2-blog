<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View
 * @var $posts array
 * @var $post \becksonq\blog\models\post\Post
 */
?>

<div class="widget mb-grid-gutter pb-grid-gutter border-bottom">
    <?= Html::tag('h3', Yii::t('app', 'Популярные посты'), ['class' => 'widget-title']) ?>

    <?php foreach ($posts as $post) : ?>
        <div class="media align-items-center mb-3">
            <?php foreach ($post->images as $image):
                if ($image->type == \becksonq\blog\models\post\PostImages::TYPE_CAROUSEL): ?>
                    <?= Html::a(Html::img(Html::encode($image->getThumbFileUrl('file', 'trending_post')),
                        ['class' => 'rounded', 'width' => '64', 'alt' => Html::encode($post->title)]),
                        Url::to(['single-post', 'id' => $post->id]), []) ?>
                <?php endif; endforeach; ?>
            <div class="media-body pl-3">
                <?= Html::tag('h6', Html::a(Html::encode($post->title), Url::to(['single-post', 'id' => $post->id])), [
                    'class' => 'blog-entry-title font-size-sm mb-0',
                ]) ?>
                <?= Html::tag('span', Html::a(Html::encode($post->user->username), null, [
                    'class' => 'blog-entry-meta-link'
                ]), ['class' => 'font-size-ms text-muted']) ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
