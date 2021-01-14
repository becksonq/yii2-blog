<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View
 * @var $bundle frontend\themes\createx\assets\AppAsset
 */
?>

<div class="bg-size-cover bg-position-center rounded-lg py-5" style="background-image: url(<?= $bundle->baseUrl . '/img/blog/banner-bg.jpg' ?> );">
    <div class="py-5 px-4 text-center">
        <h5 class="mb-2">Your Add Banner Here</h5>
        <p class="font-size-sm text-muted">Hurry up to reserve your spot</p>
        <?= Html::a('Contact us', Url::to(['#']), ['class' => 'btn btn-primary btn-shadow btn-sm']) ?>
    </div>
</div>
