<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $item \becksonq\blog\widgets\comments\CommentView
 * @var $postId integer
 */
?>

<!-- comment-->
<div class="media py-4 comment-item" data-id="<?= $item->comment->id ?>">
    <?php if ($item->comment->isActive()): ?>
        <?= Html::a('', null, ['name' => 'comment_' . $item->comment->id]) ?>
        <?= Html::img(
                Html::encode($item->comment->user->avatar) ?: (Yii::getAlias('@web') . '/uploads/img/no-person.webp'),
            ['class' => 'rounded-circle', 'width' => '50', 'alt' => '']) ?>
        <div class="media-body pl-3">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <?= Html::tag('h6', $item->comment->user->username, ['class' => 'font-size-md mb-0']) ?>
                <?= Html::a('<i class="czi-reply mr-2"></i>' . Yii::t('app', 'Ответить'), null, [
                    'href'          => 'javascript:void(0);',
                    'class'         => 'btn-link nav-link-style font-size-sm font-weight-medium comment-reply',
                    'tabindex'      => '-1',
                    'role'          => 'button',
                    'aria-disabled' => 'true',
                    'title'         => Yii::t('app', 'Комментарии доступны авторизованным пользователям'),
                ]) ?>
            </div>
            <p class="font-size-md mb-1"><?= Html::encode($item->comment->text) ?></p>
            <span class="font-size-ms text-muted reply-date"><i class="czi-time align-middle mr-2"></i>
            <?= Yii::$app->formatter->asDate($item->comment->created_at, 'php:M d, Y') ?></span>
            <!-- Удаление комментария -->
            <p class="text-right"><?php if (Yii::$app->user->identity->isAdmin): ?>
                    <?= Html::a('<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg>',
                        Url::to(['/blog/crud/comment/delete', 'post_id' => $postId, 'id' => $item->comment->id]),
                        [
                            'class' => 'btn btn-primary btn-sm',
                            'data'  => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                'method'  => 'post',
                            ],
                        ]) ?>
                <?php endif; ?></p>

            <!--comment reply-->
            <?php foreach ($item->children as $children): ?>
                <div class="media border-top pt-4 mt-4 reply-block">
                    <?= Html::a('', null, ['name' => 'comment_' . $children->comment->id]) ?>
                    <?= Html::img(Html::encode($children->comment->user->avatar) ?: (Yii::getAlias('@web') . '/uploads/img/no-person.webp'),
                        ['class' => 'rounded-circle', 'width' => '50', 'alt' => $children->comment->user->username]) ?>
                    <div class="media-body pl-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <?= Html::tag('h6', $children->comment->user->username, ['class' => 'font-size-md mb-0']) ?>
                        </div>
                        <p class="font-size-md mb-1"><?= Html::encode($children->comment->text) ?></p>
                        <span class="font-size-ms text-muted"><i class="czi-time align-middle mr-2"></i>
                        <?= Yii::$app->formatter->asDate($children->comment->created_at, 'php:M d, Y') ?></span>
                    </div>
                    <!-- Удаление комментария -->
                    <?php if (Yii::$app->user->identity->isAdmin): ?>
                        <?= Html::a('<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg>',
                            Url::to([
                                '/blog/crud/comment/delete',
                                'post_id' => $postId,
                                'id'      => $children->comment->id
                            ]),
                            [
                                'class' => 'btn btn-primary btn-sm pull-right',
                                'data'  => [
                                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                    'method'  => 'post',
                                ],
                            ]) ?>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>

        </div>
    <?php else: ?>
    <!-- @todo: комментарий удален, но текст не выводится-->
        <i><?= Yii::t('app', 'Комментарий удален') ?></i>
    <?php endif; ?>
</div>

 