<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View
 * @var $model \becksonq\blog\models\post\PostForm
 * @var $form yii\widgets\ActiveForm
 * @var $post \becksonq\blog\models\post\Post
 */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin([]); ?>

    <div class="row">
        <div class="col">
            <?= $form->field($model, 'categoryId')->dropDownList($model->categoriesList(), ['prompt' => 'Выберите категорию...']) ?>
        </div>
        <div class="col">
            <?= $form->field($model->tags, 'existing')->checkboxList($model->tags->tagsList()) ?>
            <?= $form->field($model->tags, 'textNew')->textInput(['placeholder' => 'New tag'])->label(false) ?>
        </div>
    </div>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'placeholder' => 'Title'])->label(false) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true, 'placeholder' => 'Slug'])->label(false) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 5, 'placeholder' => 'Description'])->label(false) ?>

    <?= $form->field($model, 'content')->widget(\mihaildev\ckeditor\CKEditor::className()) ?>

    <?= $form->field($model, 'image')->label('Image 600x333')->widget(FileInput::class, [
        'options' => [
            'accept' => 'image/*',
        ]
    ]) ?>

    <?= $form->field($model, 'caption')->textInput([
        'maxlength'   => true,
        'placeholder' => Yii::t('app', 'Подпись к изображениям (caption)')
    ])->label(false) ?>

    <h5>SEO</h5>
    <?= $form->field($model->meta, 'title')->textInput(['placeholder' => 'Title'])->label(false) ?>
    <?= $form->field($model->meta, 'description')->textarea(['rows'        => 2,
                                                             'placeholder' => 'Description'
    ])->label(false) ?>
    <?= $form->field($model->meta, 'keywords')->textInput(['placeholder' => 'Keywords'])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
