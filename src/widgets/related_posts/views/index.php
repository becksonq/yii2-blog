<?php

use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var $posts array
 * @var $post \becksonq\blog\models\post\Post
 */
?>

<!-- Related posts-->
<div class="bg-secondary py-5">
    <div class="container py-3">
        <?= Html::tag('h2', Yii::t('app', 'Вам может понравиться'), ['class' => 'h4 text-center pb-4']) ?>
        <div class="cz-carousel">
            <div class="cz-carousel-inner"
                 data-carousel-options='{"items": 2, "controls": false, "autoHeight": true, "responsive": {"0":{"items":1},"740":{"items":2, "gutter":
            20},"900":{"items":3, "gutter": 20}, "1100":{"items":3, "gutter": 30}}}'>

                <?php foreach ($posts as $post): ?>
                    <!-- article-->
                    <article>
                        <?php foreach ($post->images as $image):
                            if ($image->type == \becksonq\blog\models\post\PostImages::TYPE_CAROUSEL): ?>
                                <?= Html::a(Html::img(Html::encode($image->getThumbFileUrl('file', 'blog_list')),
                                    ['class' => 'rounded', 'alt' => '']),
                                    Url::to(['single-post', 'id' => $post->id,]), [
                                        'class' => 'blog-entry-thumb mb-3',
                                    ]) ?>
                            <?php endif; endforeach; ?>
                        <div class="d-flex align-items-center font-size-sm mb-2">
                            <?= Html::a($post->user->username, null, ['class' => 'blog-entry-meta-link']) ?>
                            <span class="blog-entry-meta-divider"></span>
                            <?= Html::a(Yii::$app->formatter->asDate($post->created_at, 'php:M d. Y'), null,
                                ['class' => 'blog-entry-meta-link']) ?>
                        </div>
                        <?= Html::tag('h3', Html::a(Html::encode($post->title), Url::to(['single-post', 'id' => $post->id])), [
                            'class' => 'h6 blog-entry-title'
                        ]) ?>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
