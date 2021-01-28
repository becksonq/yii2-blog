<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel becksonq\blog\modules\sidebar_banner\models\SidebarBannersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sidebar Banners');
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="sidebar-banners-index">
        <p>
            <?= Html::a(Yii::t('app', 'Create Sidebar Banners'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?php Pjax::begin(); ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel'  => $searchModel,
            'columns'      => [
                [
                    'attribute' => 'id',
                    'options'   => ['width' => '10']
                ],
                'title',
                'script:ntext',
                [
                    'attribute' => 'status',
                    'format'    => 'raw',

                    'value'   => function ($data) {
                        return \kartik\widgets\SwitchInput::widget(
                            [
                                'name'          => 'status',
                                'pluginEvents'  => [
                                    'switchChange.bootstrapSwitch' => "function(e){sendRequest(e.currentTarget.checked, $data->id);}"
                                ],
                                'pluginOptions' => [
                                    'size'     => 'mini',
                                    'onColor'  => 'success',
                                    'offColor' => 'danger',
                                    'onText'   => 'Active',
                                    'offText'  => 'Inactive'
                                ],
                                'value'         => $data->status
                            ]
                        );
                    },
                    'options' => ['width' => '10']
                ],
                [
                    'class'    => 'yii\grid\ActionColumn',
                    'template' => "{view}\n{update}\n{delete}",
                    'buttons'  => [
                        'view'   => function ($url, $model) {
                            return Html::a('<svg width="1.25em" height="1.25em" viewBox="0 0 16 16" class="bi bi-eye" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 0 0 1.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0 0 14.828 8a13.133 13.133 0 0 0-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 0 0 1.172 8z"/>
  <path fill-rule="evenodd" d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
</svg>', $url, ['title' => 'Update',]);
                        },
                        'update' => function ($url, $model) {
                            return Html::a('<svg width="1.25em" height="1.25em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg>', $url, ['title' => 'Update',]);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a('<svg width="1.25em" height="1.25em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg>', $url, [
                                'title' => 'Delete',
                                'data'  => [
                                    'method'  => 'post',
                                    'confirm' => 'Are you sure you want to delete this item?',
                                ]
                            ]);
                        },
                    ],
                ],
            ],
        ]); ?>

        <?php Pjax::end(); ?>

    </div>
<?php
$js = <<< JS
function sendRequest(status, id) {
    $.ajax({
        url: '/sidebar_banners/default/change-status',
        method: 'post',
        data: {status: status, id: id},
        dataType: 'json',
        success: function (data) {
            // console.log(data);
            /*if (data.status === true) {
                $.pjax({container: '#pjax-container'})
            }*/
        },
        error: function (jqXhr, status, error) {
            console.log(error);
        }
    });
}
JS;

$this->registerJs($js, \yii\web\View::POS_READY);
?>