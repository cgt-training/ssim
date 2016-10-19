<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

?>

<div class="person-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

     <div class="row">
        <div class="col-sm-6">
            <?= $form->field($modelPo, 'po_no')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($modelPo, 'description')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="padding-v-md">
        <div class="line line-dashed"></div>
    </div>

    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper',
        'widgetBody' => '.container-items',
        'widgetItem' => '.house-item',
        'limit' => 10,
        'min' => 1,
        'insertButton' => '.add-house',
        'deleteButton' => '.remove-house',
        'model' => $modelPoItem[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'description',
        ],
    ]); ?>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th colspan="2">Po Items</th>
                <th class="text-center" style="width: 90px;">
                    <button type="button" class="add-house btn btn-success btn-xs"><span class="fa fa-plus"></span></button>
                </th>
            </tr>
        </thead>
        <tbody class="container-items">
        <?php 
        foreach ($modelPoItem as $indexHouse => $each): ?>
            <tr class="house-item">
             <td class="vcenter" width="50%">
                    <?php
                        // necessary for update action.
                        if (! $each->isNewRecord) {
                            echo Html::activeHiddenInput($each, "[{$indexHouse}]id");
                        }
                    ?>
                    <?= $form->field($each, "[{$indexHouse}]po_item_no")->label(false)->textInput(['maxlength' => true,'placeholder' => 'Po Item No']) ?>
                </td>
                <td class="vcenter">
                    <?php
                        // necessary for update action.
                        if (! $each->isNewRecord) {
                            echo Html::activeHiddenInput($each, "[{$indexHouse}]id");
                        }
                    ?>
                    <?= $form->field($each, "[{$indexHouse}]quantity")->label(false)->textInput(['maxlength' => true,'placeholder' => 'Quantity']) ?>
                </td>

                <td class="text-center vcenter" style="width: 90px; verti">
                    <button type="button" class="remove-house btn btn-danger btn-xs"><span class="fa fa-minus"></span></button>
                </td>
            </tr>
         <?php endforeach; ?>
        </tbody>
    </table>
    <?php DynamicFormWidget::end(); ?>
    
    <div class="form-group">
        <?= Html::submitButton($modelPo->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>