<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View
 * @var $posts \yii\data\ActiveDataProvider
 * @var $post \blog\models\post\Post
 */

?>

<div class="featured-posts-carousel cz-carousel pt-5">
    <div class="cz-carousel-inner"
         data-carousel-options='{"items": 2, "nav": false, "autoHeight": true, "responsive": {"0":{"items":1}, "750":{"items":2, "gutter": 20}, "991":{"items":2, "gutter": 30}}}'>
        <?php
        foreach ($posts->getModels() as $post): ?>
            <article>
                <?= Html::a('<span class="blog-entry-meta-label font-size-sm"><i class="far fa-clock"></i>'
                    . Yii::$app->formatter->asDate($post->created_at, 'php:M d') . '</span>'
                    . Html::img(Html::encode($post->getThumbFileUrl('image', 'carousel')), [
                        'alt' => $post->title,
                    ]), Url::to(['post', 'id' => $post->id]), [
                    'class' => 'blog-entry-thumb mb-3',
                ]) ?>

                <div class="d-flex justify-content-between mb-2 pt-1">
                    <h2 class="h5 blog-entry-title mb-0">
                        <?= Html::a($post->title, Url::to(['#']), []) ?></h2>
                    <?= Html::a('<i class="far fa-comment-alt"></i>' . $post->comments_count,
                        Url::to(['post', 'id' => $post->id, '#' => 'comments']), [
                            'class' => 'blog-entry-meta-link font-size-sm text-nowrap ml-3 pt-1',
                        ]) ?>
                </div>

                <div class="d-flex align-items-center font-size-sm">
                    <!-- TODO: avatar -->
                    <?= Html::a('<div class="blog-entry-author-ava">'
                        . Html::img('https://demo.createx.studio/cartzilla/img/blog/meta/03.jpg',
                            ['alt' => $post->author]) .
                        '</div>' . $post->author, Url::to(['#']), [
                        'class' => 'blog-entry-meta-link',
                    ]) ?>
                    <span class="blog-entry-meta-divider"></span>
                    <div class="font-size-sm text-muted"><?= Yii::t('app', 'в') ?>&nbsp;
                        <?= Html::a(Html::a($post->category->name, Url::to(['#']), ['class' => 'blog-entry-meta-link']),
                            Url::to(['#']), ['class' => 'blog-entry-meta-link']) ?>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</div>