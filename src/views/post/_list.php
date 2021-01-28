<?php

/* @var $this yii\web\View
 * @var $dataProvider yii\data\DataProviderInterface
 * @var $bundle \frontend\themes\createx_grocery_store\assets\AppAsset
 */

?>

<?= \yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'layout'       => "{items}\n{pager}",
    'itemView'     => '_post',
    'viewParams'  => [
        'bundle' => $bundle,
    ]
]) ?>
