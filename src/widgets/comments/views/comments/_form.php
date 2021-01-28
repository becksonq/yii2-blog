<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View
 * @var $post \becksonq\blog\models\post\Post
 * @var $count integer
 * @var $commentForm \becksonq\blog\models\comment\CommentForm
 */

?>

<!-- Post comment form-->
<div id="reply-block" class="card border-0 box-shadow my-2">
    <div class="card-body">
        <div class="media">
            <?= Html::img(
                Html::encode(Yii::$app->user->identity->avatar) ?: (Yii::getAlias('@web') . '/uploads/img/no-person.webp'),
                [
                    'class' => 'rounded-circle ' . (Yii::$app->user->identity->avatar ?? 'border'),
                    'width' => '50',
                    'alt'   => Yii::$app->user->identity->username
                ]) ?>
            <?php $form = ActiveForm::begin([
                'action'  => ['comment', 'id' => $post->id],
                'options' => [
                    'class' => 'media-body needs-validation ml-3',
                ]
            ]); ?>

            <?= Html::activeHiddenInput($commentForm, 'parentId') ?>
            <?= $form->field($commentForm, 'text')->textarea([
                'rows'        => '4',
                'placeholder' => Yii::t('app', 'Напишите комментарий...')
            ])->label(false) ?>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Отправить'), [
                    'class'    => 'btn btn-primary btn-sm',
                    'disabled' => Yii::$app->user->isGuest ? true : false
                ]) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<?php $this->registerJs("
    jQuery(document).on('click', '#comments .comment-reply', function () {
        var link = jQuery(this);
        var form = jQuery('#reply-block');
        var comment = link.parent().closest('.comment-item');
        jQuery('#commentform-parentid').val(comment.data('id'));
        form.detach().fadeIn('slow').appendTo(comment.find('.reply-date:first'));
        return false;
    });
"); ?>


 