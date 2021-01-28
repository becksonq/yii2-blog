<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model becksonq\blog\modules\sidebar_banner\models\SidebarBanners */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sidebar-banners-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'script')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->dropDownList([
                1 => 'Yes',
                0 => 'No',
            ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
