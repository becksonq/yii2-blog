<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;
use becksonq\blog\models\helpers\PostHelper;
use becksonq\blog\models\post\PostImages;
use yii\helpers\Url;

/* @var $this yii\web\View
 * @var $post \becksonq\blog\models\post\Post
 * @var $modificationsProvider yii\data\ActiveDataProvider
 * @var $imagesForm \becksonq\blog\models\post\PostImagesForm
 * @var $images array
 * @var $fullImages array
 */

$this->title = $post->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view mb-5 pb-5">

    <?php if ($post->isActive()): ?>
        <?= Html::a('Draft', ['draft', 'id' => $post->id],
            ['class' => 'btn btn-primary', 'data-method' => 'post']) ?>
    <?php else: ?>
        <?= Html::a('Activate', ['activate', 'id' => $post->id],
            ['class' => 'btn btn-success', 'data-method' => 'post']) ?>
    <?php endif; ?>
    <?= Html::a('Update', ['update', 'id' => $post->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Delete', ['delete', 'id' => $post->id], [
        'class' => 'btn btn-danger',
        'data'  => [
            'confirm' => 'Are you sure you want to delete this item?',
            'method'  => 'post',
        ],
    ]) ?>

    <div class="row mt-3">
        <div class="col-6">
            <h5>Common</h5>
            <?= DetailView::widget([
                'model'      => $post,
                'attributes' => [
                    'id',
                    [
                        'attribute' => 'status',
                        'value'     => PostHelper::statusLabel($post->status),
                        'format'    => 'raw',
                    ],
                    'title',
                    [
                        'attribute' => 'category_id',
                        'value'     => ArrayHelper::getValue($post, 'category.name'),
                    ],
                    [
                        'label' => 'Tags',
                        'value' => implode(', ', ArrayHelper::getColumn($post->tags, 'name')),
                    ],
                ],
            ]) ?>
        </div>
        <div class="col-6">
            <h5>SEO</h5>
            <?= DetailView::widget([
                'model'      => $post,
                'attributes' => [
                    [
                        'attribute' => 'meta.title',
                        'value'     => $post->meta->title,
                    ],
                    [
                        'attribute' => 'meta.description',
                        'value'     => $post->meta->description,
                    ],
                    [
                        'attribute' => 'meta.keywords',
                        'value'     => $post->meta->keywords,
                    ],
                ],
            ]) ?>
        </div>
    </div>

    <h5>Description</h5>
    <?= Yii::$app->formatter->asNtext($post->description) ?>
    <hr>
    <h5>Content</h5>
    <?= Yii::$app->formatter->asHtml($post->content, [
        'Attr.AllowedRel'      => array('nofollow'),
        'HTML.SafeObject'      => true,
        'Output.FlashCompat'   => true,
        'HTML.SafeIframe'      => true,
        'URI.SafeIframeRegexp' => '%^(https?:)?//(www\.youtube(?:-nocookie)?\.com/embed/|player\.vimeo\.com/video/)%',
    ]) ?>
    <hr>
    <div id="images">
        <div class="row border-bottom pb-3">
            <div class="col-6">
                <div class="w-100">
                    <!-- @todo: сделать подсказку если нет изображения  -->
                    <?php foreach ($post->images as $image):
                        if ($image->type == PostImages::TYPE_CAROUSEL): $carouselImageId = $image->id; ?>
                            <figure class="figure">
                                <?= Html::img($image->getThumbFileUrl('file', 'carousel'),
                                    ['class' => 'figure-img img-fluid', 'width' => '400']) ?>
                                <figcaption class="figure-caption">600x350</figcaption>
                            </figure>
                        <?php endif; endforeach; ?>
                </div>
                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <?= Html::a(Yii::t('app', 'Добавить'),
                        Url::to([
                            'crud/post-images/add-carousel-image',
                            'postId' => $post->id,
                            'type'   => PostImages::TYPE_CAROUSEL
                        ]), [
                            'class' => 'btn btn-primary px-4',
                            'type'  => 'button',
                        ]) ?>
                </div>
            </div>
            <div class="col-6">

            </div>
        </div>

        <div class="row mb-3 pt-3">
            <?php foreach ($images as $image): ?>
                <div class="col-md-2 col-xs-3" style="text-align: center">
                    <div class="btn-group">
                        <?= Html::a('<i class="fas fa-angle-left"></i>',
                            ['crud/post-images/move-image-up', 'postId' => $post->id, 'imageId' => $image->id], [
                                'class'       => 'btn btn-default',
                                'data-method' => 'post',
                            ]); ?>
                        <?= Html::a('<i class="far fa-trash-alt"></i>',
                            [
                                'crud/post-images/delete-image',
                                'postId'  => $post->id,
                                'type'    => PostImages::TYPE_POST_SINGLE,
                                'imageId' => $image->id
                            ], [
                                'class'        => 'btn btn-default',
                                'data-method'  => 'post',
                                'data-confirm' => 'Remove image?',
                            ]); ?>
                        <?= Html::a('<i class="fas fa-angle-right"></i>',
                            ['crud/post-images/move-image-down', 'postId' => $post->id, 'imageId' => $image->id], [
                                'class'       => 'btn btn-default',
                                'data-method' => 'post',
                            ]); ?>
                    </div>
                    <div class="text-left">
                        <figure class="figure">
                            <?= Html::img($image->getThumbFileUrl('file', 'preview'),
                                ['class' => 'figure-img img-fluid']) ?>
                            <figcaption class="figure-caption">628x494</figcaption>
                        </figure>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="col-sm-12">
                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <?= Html::a(Yii::t('app', 'Добавить'), Url::to([
                        'crud/post-images/add-images',
                        'postId' => $post->id,
                        'type'   => PostImages::TYPE_POST_SINGLE
                    ]),
                        [
                            'class' => 'btn btn-primary px-4',
                            'type'  => 'button',
                        ]) ?>
                </div>
            </div>
        </div>

        <div class="row mb-3 pt-3">
            <?php foreach ($fullImages as $image): ?>
                <div class="col-md-2 col-xs-3" style="text-align: center">
                    <div class="btn-group">
                        <?= Html::a('<i class="fas fa-angle-left"></i>',
                            ['crud/post-images/move-full-image-up', 'postId' => $post->id, 'imageId' => $image->id], [
                                'class'       => 'btn btn-default',
                                'data-method' => 'post',
                            ]); ?>
                        <?= Html::a('<i class="far fa-trash-alt"></i>',
                            [
                                'crud/post-images/delete-image',
                                'postId'  => $post->id,
                                'type'    => PostImages::TYPE_FULL,
                                'imageId' => $image->id
                            ], [
                                'class'        => 'btn btn-default',
                                'data-method'  => 'post',
                                'data-confirm' => 'Remove image?',
                            ]); ?>
                        <?= Html::a('<i class="fas fa-angle-right"></i>',
                            ['crud/post-images/move-full-image-down', 'postId' => $post->id, 'imageId' => $image->id], [
                                'class'       => 'btn btn-default',
                                'data-method' => 'post',
                            ]); ?>
                    </div>
                    <div class="text-left">
                        <figure class="figure">
                            <?= Html::img($image->getThumbFileUrl('file', 'preview'),
                                ['class' => 'figure-img img-fluid']) ?>
                            <figcaption class="figure-caption">1000x667</figcaption>
                        </figure>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="col-sm-12">
                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <?= Html::a(Yii::t('app', 'Добавить'), Url::to([
                        'crud/post-images/add-full-images',
                        'postId' => $post->id,
                        'type'   => PostImages::TYPE_FULL
                    ]),
                        [
                            'class' => 'btn btn-primary px-4',
                            'type'  => 'button',
                        ]) ?>
                </div>
            </div>
        </div>
    </div>

</div>
