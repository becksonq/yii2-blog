<?php

/* @var $this yii\web\View
 * @var $dataProvider yii\data\DataProviderInterface
 * @var $tag \becksonq\blog\models\tags\Tag
 * @deprecated
 */

use yii\helpers\Html;

$this->title = 'Посты с тегом "' . $tag->name . '"';

$this->params['breadcrumbs'][] = ['label' => 'Blog', 'url' => ['index']];
$this->params['breadcrumbs'][] = $tag->name;
?>

<div class="bg-secondary py-4">
    <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
            <?= \becksonq\breadcrumbs\Breadcrumbs::widget([
                'links'      => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                'navOptions' => ['aria-label' => 'breadcrumb',],
                'homeLink'   => [
                    'label'  => '<i class="czi-home mr-1"></i>' . Yii::t('yii', 'Home'),
                    'url'    => Yii::$app->homeUrl,
                    'encode' => false
                ],
                'options'    => [
                    'class' => 'breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-start',
                ],
            ]) ?>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
            <?= Html::tag('h1', Html::encode($this->title), ['class' => 'h3 mb-0']) ?>
        </div>
    </div>
</div>

<!-- Page Content-->
<div class="container pb-5 mb-2 mb-md-4">
    <!-- Featured posts carousel-->
    <?= \becksonq\blog\widgets\carousel\PostCarouselWidget::widget([]) ?>

    <hr class="mt-5">

    <div class="row justify-content-center pt-5 mt-2">
        <!-- Entries list-->
        <section class="col-lg-9">

            <?= $this->render('_list', [
                'dataProvider' => $dataProvider,
            ]) ?>

            <!-- Pagination-->
            <?= \becksonq\blog\widgets\link_pager\LinkPager::widget([
                'pagination' => $dataProvider->getPagination(),
                'options'    => [
                    'class'      => 'd-flex justify-content-between pt-2',
                    'aria-label' => 'Page navigation',
                ],
            ]) ?>
        </section>
    </div>
</div>
