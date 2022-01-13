<?php

/* @var $this yii\web\View
 * @var $model becksonq\blog\models\post\Post
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;

$url = Html::encode(Url::to(['single-post', 'id' => $model->id]));
?>


<article class="blog-list border-bottom pb-4 mb-5">
    <div class="left-column">
        <div class="d-flex align-items-center font-size-sm pb-2 mb-1">

            <?= Html::beginTag('a', ['class' => 'blog-entry-meta-link', 'href' => Url::to(['##'])]) ?>
            <div class="blog-entry-author-ava">
                <?= Html::img(
                    Html::encode($model->user->avatar) ?: (Yii::getAlias('@web') . '/uploads/img/no-person.webp'),
                    ['alt' => $model->user->username]) ?>
            </div>
            <?= $model->user->username ?>
            <?= Html::endTag('a') ?>

            <span class="blog-entry-meta-divider"></span>

            <?= Html::a(Yii::$app->formatter->asDate($model->created_at, 'php:M d. Y'), Url::to(['##']),
                ['class' => 'blog-entry-meta-link',]) ?>
        </div>
        <?= Html::tag('h2', Html::a(Html::encode($model->title), $url, []),
            ['class' => 'h5 blog-entry-title']) ?>
    </div>

    <div class="right-column">
        <!-- Image -->
        <?php foreach ($model->images as $image):
            if ($image->type == \becksonq\blog\models\post\PostImages::TYPE_CAROUSEL): ?>
                <?= Html::a(Html::img(Html::encode($image->getThumbFileUrl('file', 'blog_list')),
                    ['alt' => $model->title]), $url, [
                        'class' => 'blog-entry-thumb mb-3',
                    ]) ?>
            <?php endif; endforeach; ?>

        <div class="d-flex justify-content-between mb-1">
            <div class="font-size-sm text-muted pr-2 mb-2">#
                <!-- @todo: здесь вывести массив тегов -->
                <?= Html::a($model->category->name, Url::to(['##']), ['class' => 'blog-entry-meta-link']) ?>
            </div>
            <div class="font-size-sm mb-2">
                <?= Html::a('<i class="czi-message"></i>' . $model->comments_count, Url::to(['##']), [
                    'class' => 'blog-entry-meta-link text-nowrap',
                ]) ?>
            </div>
        </div>

        <p class="font-size-sm"><?= StringHelper::truncate(Yii::$app->formatter->asNtext($model->description), 174,
                '...') ?>
            <?= Html::a('[' . Yii::t('app', 'Читать...') . ']', $url, [
                'class' => 'blog-entry-meta-link font-weight-medium',
            ]) ?>
        </p>
    </div>
</article>
