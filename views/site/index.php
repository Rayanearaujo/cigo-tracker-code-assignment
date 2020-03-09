<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

$this->title = 'Cigo';

use app\models\Orders;
use app\models\OrdersSearch; ?>

<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12 card">
                        <?php $model = new Orders(); ?>
                        <?= $this->render('order_form', [
                            'model' => $model
                        ]) ?>
                    </div>
                    <div class="col-md-12 card">
                        <?php
                            $model = new Orders();
                            $searchModel = new OrdersSearch();
                            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                        ?>
                        <?= $this->render('orders_list', [
                            'model' => $model,
                            'dataProvider' => $dataProvider
                        ]) ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12 card">
                        <?= $this->render('map') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
