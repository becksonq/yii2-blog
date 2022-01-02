<?php

use yii\helpers\Html;
use yii\helpers\Url;
use becksonq\blog\models\post\PostImages;

/** @var $post \becksonq\blog\models\post\Post */
?>

<div class="cz-gallery row pb-2">
    <?php
    $postImages = [];
    $fullImage = [];
    foreach ($post->images as $image) {
        if ($image->type == PostImages::TYPE_POST_SINGLE) {
            $postImages[] = $image;
        }
        if ($image->type == PostImages::TYPE_FULL) {
            $fullImage[] = $image;
        }
    } ?>

    <?php foreach ($postImages as $key => $image): ?>
        <?php if ($key == 0): ?>
            <div class="col-sm-8">
                <?= Html::beginTag('a', [
                    'class'         => 'gallery-item rounded-lg mb-grid-gutter',
                    'href'          => $fullImage[$key]->getUploadedFileUrl('file'),
                    'data-sub-html' => '<h6 class="font-size-sm text-light">' . $post->caption . '</h6>'
                ]) ?>
                <?= Html::img(Html::encode($image->getThumbFileUrl('file', 'blog_single')),
                    ['alt' => $post->caption]) ?>
                <?= Html::tag('span', $post->caption, ['class' => 'gallery-item-caption']) ?>
                <?= Html::endTag('a') ?>
            </div>
        <?php endif; ?>

        <?php if ($key == 1): ?>
            <div class="col-sm-4">

            <?= Html::beginTag('a', [
                'class'         => 'gallery-item rounded-lg mb-grid-gutter',
                'href'          => $fullImage[$key]->getUploadedFileUrl('file'),
                'data-sub-html' => '<h6 class="font-size-sm text-light">' . $post->caption . '</h6>',
            ]) ?>
            <?= Html::img(Html::encode($image->getThumbFileUrl('file', 'blog_single_th')), ['alt' => $post->caption]) ?>
            <?= Html::tag('span', $post->caption, ['class' => 'gallery-item-caption']) ?>
            <?= Html::endTag('a') ?>
        <?php endif; ?>

        <?php if ($key == 2): ?>
            <?= Html::beginTag('a', [
                'class'         => 'gallery-item rounded-lg mb-grid-gutter',
                'href'          => $fullImage[$key]->getUploadedFileUrl('file'),
                'data-sub-html' => '<h6 class="font-size-sm text-light">' . $post->caption . '</h6>',
            ]) ?>
            <?= Html::img(Html::encode($image->getThumbFileUrl('file', 'blog_single_th')), ['alt' => $post->caption]) ?>
            <?= Html::tag('span', $post->caption, ['class' => 'gallery-item-caption']) ?>
            <?= Html::endTag('a') ?>

            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>
