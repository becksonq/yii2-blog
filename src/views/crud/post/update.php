<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $post \becksonq\blog\models\post\Post */
/* @var $model \becksonq\blog\models\post\PostForm */

$this->title = 'Update Post: ' . $post->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $post->title, 'url' => ['view', 'id' => $post->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="post-update mb-5 pb-5">

    <?= $this->render('_form', [
        'model' => $model,
        'post'  => $post,
    ]) ?>

</div>
