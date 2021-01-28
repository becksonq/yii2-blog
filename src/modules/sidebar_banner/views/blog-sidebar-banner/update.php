<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model becksonq\blog\modules\sidebar_banner\models\SidebarBanners */

$this->title = Yii::t('app', 'Update Sidebar Banners: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sidebar Banners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="sidebar-banners-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
