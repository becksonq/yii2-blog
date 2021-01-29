<?php

/* @var $this yii\web\View
 * @var $dataProvider yii\data\DataProviderInterface
 * @var $bundle \becksonq\blog\AppAsset
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
