<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model becksonq\blog\modules\sidebar_banner\models\SidebarBanners */

$this->title = Yii::t('app', 'Create Sidebar Banners');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sidebar Banners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sidebar-banners-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
