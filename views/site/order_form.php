<?php

use app\models\OrderStatus;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\jui\DatePicker;

?>

<?php $form = ActiveForm::begin(['id' => 'addOrderForm']); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="far fa-address-card pull-right"></i>
            <h3 class="panel-title">Add an Order</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'first_name')
                        ->label('First Name')
                        ->textInput(['placeholder' => 'First Name'])
                    ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'last_name')
                        ->label('Last Name')
                        ->textInput(['placeholder' => 'Last Name']) ?>
                </div>

                <div class="col-sm-6">
                    <?=
                    $form->field($model, 'email')->label('Email')
                        ->input('email', ['placeholder' => 'you@sample.com'])
                    ?>
                </div>

                <div class="col-sm-6">
                    <?= $form->field($model, 'phone_number')
                        ->label('Phone Number')
                        ->textInput(['placeholder' => '+1 (888) 123-4567'])
                    ?>
                </div>

                <div class="col-sm-6">
                    <?= $form->field($model, 'order_type')
                        ->dropDownList([
                            'delivery' => 'Delivery',
                            'servicing' => 'Servicing',
                            'installation' => 'Installation'
                        ]) ?>
                </div>

                <div class="col-sm-6">
                    <?= $form->field($model, 'order_value', [
                        'addon' => ['prepend' => ['content' => '<i class="fas fa-dollar-sign"></i>']]
                    ])->textInput(['placeholder' => 'Amount'])
                    ?>
                </div>

                <div class="col-sm-6">
                    <?= $form->field($model, 'scheduled_date', [
                        'addon' => ['prepend' => ['content' => '<i class="far fa-calendar-alt"></i>']]
                    ])->label('Scheduled Date')
                        ->textInput(['placeholder' => 'Scheduled Date'])
                        ->widget(DatePicker::class, [
                            'dateFormat' => 'php:Y-m-d',
                            'options' => ['class' => 'form-control', 'placeholder' => 'yyyy-mm-dd'],
                            'clientOptions' => [
                                'minDate' => date('Y-m-d')
                            ],
                        ])
                    ?>
                </div>

                <div class="col-sm-12">
                    <?= $form->field($model, 'street_address')->label('Street Address') ?>
                </div>

                <div class="col-sm-6">
                    <?= $form->field($model, 'city')->label('City') ?>
                </div>

                <div class="col-sm-6">
                    <?= $form->field($model, 'state')->label('State/Province') ?>
                </div>

                <div class="col-sm-6">
                    <?= $form->field($model, 'zip_code')->label('Postal / Zip Code') ?>
                </div>

                <div class="col-sm-6">
                    <?= $form->field($model, 'country')
                        ->dropDownList(['canada' => 'Canada', 'united states' => 'United States', 'mexico' => 'Mexico'])
                        ->label('Country') ?>
                </div>

                <?= Html::hiddenInput('order_status', OrderStatus::PENDING)
                ?>

                <div class="col-md-6 preview-order-form-group">
                    <?= Html::button('Preview Location',
                        ['id' => 'preview-location', 'class' => 'btn btn-default']) ?>
                </div>

                <div class="col-md-6 add-order-form-group">
                    <?= Html::button('Cancel', ['id' => 'reset-add-button', 'class' => 'btn btn-danger']) ?>
                    <?= Html::submitButton('Submit', ['id' => 'addOrderFormBtn', 'class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
    </div>

<?php ActiveForm::end(); ?>