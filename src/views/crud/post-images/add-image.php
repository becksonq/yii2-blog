<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use kartik\file\FileInput;

/** @var $model \becksonq\blog\models\post\PostImagesForm
 * @var $type string
 * @var $id integer
 */
$this->title = 'Add Image';
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['crud/post/index']];
$this->params['breadcrumbs'][] = ['label' => $id, 'url' => ['crud/post/view', 'id' => $id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="add-images mt-5">

    <h4><?= Yii::t('app', 'Добавление изображений ') . $type ?></h4>

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => true,
    ]); ?>

    <?= $form->field($model, 'files[]')->label(false)->widget(FileInput::class, [
        'options' => [
            'accept'   => 'image/*',
            'multiple' => true,
        ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Upload', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>