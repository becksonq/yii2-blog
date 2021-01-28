<?php

use yii\bootstrap4\Html;

/**
 * @var $this \yii\web\View
 * @var $items \becksonq\blog\widgets\comments\CommentView[]
 * @var $commentForm \becksonq\blog\models\comment\CommentForm
 * @var $post \becksonq\blog\models\post\Post
 */
?>

<div class="pt-2 mt-5" id="comments">
    <?= Html::beginTag('h2', ['class' => 'h4']) ?>
    <?= Yii::t('app', 'Комментарии') ?>
    <?= Html::tag('span', count($post->comments),
        ['class' => 'badge badge-secondary font-size-sm text-body align-middle ml-2']) ?>
    <?= Html::endTag('h2') ?>

    <?php foreach ($items as $item): ?>
        <?= $this->render('_comment', ['item' => $item, 'postId' => $post->id,]) ?>
    <?php endforeach; ?>

    <?= $this->render('_form', ['commentForm' => $commentForm, 'post' => $post,]) ?>
</div>
