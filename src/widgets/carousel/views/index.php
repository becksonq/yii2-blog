<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View
 * @var $posts \yii\data\ActiveDataProvider
 * @var $post \becksonq\blog\models\post\Post
 */

?>

<div class="featured-posts-carousel cz-carousel pt-5">
    <div class="cz-carousel-inner"
         data-carousel-options='{"items": 2, "nav": false, "autoHeight": true, "responsive": {"0":{"items":1}, "750":{"items":2, "gutter": 20}, "991":{"items":2, "gutter": 30}}}'>
        <?php
        foreach ($posts->getModels() as $post): ?>
            <article>
                <?= Html::beginTag('a',
                    ['class' => 'blog-entry-thumb mb-3', 'href' => Url::to(['single-post', 'id' => $post->id])]) ?>
                <?= Html::tag('span',
                    '<i class="czi-time"></i>' . Yii::$app->formatter->asDate($post->created_at, 'php:M d. Y'),
                    ['class' => 'blog-entry-meta-label font-size-sm']) ?>
                <?php foreach ($post->images as $image) {
                    if ($image->type == \becksonq\blog\models\post\PostImages::TYPE_CAROUSEL) {
                        echo Html::img(Html::encode($image->getThumbFileUrl('file', 'carousel')),
                            ['alt' => $post->title]);
                    }
                }; ?>
                <?= Html::endTag('a') ?>

                <div class="d-flex justify-content-between mb-2 pt-1">
                    <?= Html::tag('h2', Html::a($post->title, Url::to(['single-post', 'id' => $post->id])),
                        ['class' => 'h5 blog-entry-title mb-0']) ?>

                    <?= Html::a('<i class="far fa-comment-alt"></i>' . $post->comments_count,
                        Url::to(['single-post', 'id' => $post->id, '#' => 'comments']), [
                            'class' => 'blog-entry-meta-link font-size-sm text-nowrap ml-3 pt-1',
                        ]) ?>
                </div>

                <div class="d-flex align-items-center font-size-sm">
                    <?= Html::a('<div class="blog-entry-author-ava">'
                        . Html::img(Html::encode($post->user->avatar) ?: (Yii::getAlias('@web') . '/uploads/img/no-person.webp'),
                            ['alt' => $post->user->username]) .
                        '</div>' . $post->user->username, Url::to(['##']), [
                        'class' => 'blog-entry-meta-link',
                    ]) ?>
                    <span class="blog-entry-meta-divider"></span>
                    <div class="font-size-sm text-muted">
                        <?= Html::a($post->category->name, Url::to(['##']), ['class' => 'blog-entry-meta-link']) ?>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</div>