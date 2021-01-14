<?php

/* @var $this yii\web\View
 * @var $model \blog\models\post\Post
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;

$url = Url::to(['post', 'id' =>$model->id]);
?>

<article class="blog-list border-bottom py-5 mb-5">
    
    <div class="left-column">
        <div class="d-flex align-items-center font-size-sm pb-2 mb-1">
            
            <!-- TODO: avatar, post author -->
            <?php if (isset($model->author)) {
                echo Html::a('<i class="far fa-user-circle fa-lg"></i>' . $model->author,
                    Url::to(['#']), ['class' => 'blog-entry-meta-link',]); ?>
                <span class="blog-entry-meta-divider"></span>
            <?php } ?>
            <!--  <img src="img/blog/meta/02.jpg" alt="Cynthia Gomez">-->
            
            <?= Html::a(Yii::$app->formatter->asDate($model->created_at, 'php:M d'), Url::to(['#']), ['class' => 'blog-entry-meta-link',]) ?>
        </div>
        <h2 class="h5 blog-entry-title"><?= Html::a(Html::encode($model->title), Html::encode($url), []) ?></h2>
    </div>
    
    <div class="right-column">
<!--        --><?//= Html::a(Html::img(Html::encode($model->getThumbFileUrl('image', 'blog_list')), ['alt' => $model->title]),
//            Html::encode($url), [
//                    'class' => 'blog-entry-thumb mb-3',
//            ]) ?>
        <div class="d-flex justify-content-between mb-1">
            <div class="font-size-sm text-muted pr-2 mb-2"><?= Yii::t('app', 'в') ?>
                <?= Html::a($model->category->name, Url::to(['#']), ['class' => 'blog-entry-meta-link']) ?>
            </div>
            <div class="font-size-sm mb-2">
                <?= Html::a('<i class="far fa-comment-alt"></i>' . $model->comments_count, Url::to(['#']), [
                    'class' => 'blog-entry-meta-link text-nowrap',
                ]) ?>
            </div>
        </div>
        
        <p class="font-size-sm"><?= StringHelper::truncate(Yii::$app->formatter->asNtext($model->description),174,'...') ?>
            <?= Html::a('[' . Yii::t('app', 'Читать...') . ']', Html::encode($url), [
                    'class' => 'blog-entry-meta-link font-weight-medium',
            ]) ?>
        </p>
    </div>
</article>
