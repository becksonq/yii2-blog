<?php

/* @var $this yii\web\View
 * @var $dataProvider yii\data\DataProviderInterface
 * @var $tag \becksonq\blog\models\tags\Tag
 * @deprecated
 */

use yii\helpers\Html;

$this->title = 'Posts with tag ' . $tag->name;

$this->params['breadcrumbs'][] = ['label' => 'Blog', 'url' => ['index']];
$this->params['breadcrumbs'][] = $tag->name;
?>
<!-- TODO: заголовок -->
<h1>Posts with tag &laquo;<?= Html::encode($tag->name) ?>&raquo;</h1>

<?= $this->render('_list', [
    'dataProvider' => $dataProvider
]) ?>