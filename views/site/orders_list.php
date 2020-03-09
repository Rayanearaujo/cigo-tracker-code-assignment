<?php

use app\models\Orders;
use app\models\OrderStatus;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <i class="far fa-check-square pull-right"></i>
        <h3 class="panel-title">Existing Orders</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12 grid-view-container">
                <?php Pjax::begin([
                    'id' => 'orders-list',
                    'timeout' => false,
                    'enablePushState' => false,
                    'clientOptions' => ['method' => 'POST']
                ]) ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        [
                            'attribute' => 'first_name',
                            'contentOptions' => ['class' => 'order-row'],
                        ],
                        [
                            'attribute' => 'last_name',
                            'contentOptions' => ['class' => 'order-row'],
                        ],
                        [
                            'attribute' => 'scheduled_date',
                            'label' => 'Date',
                            'format' => 'date',
                            'contentOptions' => ['class' => 'order-row'],
                        ],
                        [
                            "label" => "",
                            "format" => 'raw',
                            "value" => function (Orders $data) {
                                $btnClasses = [
                                    OrderStatus::PENDING => 'btn-default',
                                    OrderStatus::ASSIGNED => 'btn-primary',
                                    OrderStatus::ON_ROUTE => 'btn-warning',
                                    OrderStatus::DONE => 'btn-success',
                                    OrderStatus::CANCELLED => 'btn-danger',
                                ];

                                $buttonClass = $btnClasses[$data->order_status] ?? "btn-default";

                                $disableButton = "";
                                if($data->order_status != 'assigned' && $data->order_status != 'pending'){
                                    $disableButton = "disabled";
                                }

                                $optionsHtml = '';

                                foreach (OrderStatus::attributeLabels() as $attribute => $label) {
                                    $optionsHtml .= "<option value=\"{$attribute}\" ".($data->order_status == $attribute ? 'selected' : '')." >{$label}</option>";
                                }

                                return '<div class="text-center">'.
                                    '<select class="form-control btn '.$buttonClass.' orders-btn">'.
                                    $optionsHtml.
                                    '</select>'.
                                    '<button type="button" class="btn btn-danger orders-delete-btn" ' . $disableButton  . '>X</button>'.
                                    '</div>';
                            }
                        ]
                    ],
                ]); ?>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>