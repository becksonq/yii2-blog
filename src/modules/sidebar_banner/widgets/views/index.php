<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View
 * @var $bundle \becksonq\blog\AppAsset
 */
?>

<!-- Promo banner-->
<div class="bg-size-cover bg-position-center rounded-lg py-5"
     style="background-image: url(<?= $bundle->baseUrl . '/img/blog/banner-bg.jpg' ?> );">

    <?php if (!empty($model)): ?>
        <div class="text-center">
            <?= $model['script'] ?>
        </div>
    <?php else: ?>
        <div class="py-5 px-4 text-center">
            <?= Html::tag('h5', Yii::t('app', 'Ваш баннер здесь', ['class' => 'mb-2'])) ?>
            <p class="font-size-sm text-muted"><?= Yii::t('app', 'Спешите зарезервировать место') ?></p>
            <?= Html::a('Contact us', Url::to(['#']), ['class' => 'btn btn-primary btn-shadow btn-sm']) ?>
        </div>
    <?php endif; ?>
</div>
