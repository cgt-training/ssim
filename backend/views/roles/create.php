<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

$this->title = "User Roles";
?>

<div class="person-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

     <div class="row">
        <div class="col-sm-6">
            <?= $form->field($modelAuthItem, 'name')->textInput(['placeholder' => 'Name']) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($modelAuthItem, 'description')->textInput(['placeholder' => 'Description']) ?>
        </div>
    </div>

    <div class="padding-v-md">
        <div class="line line-dashed"></div>
    </div>

    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper',
        'widgetBody' => '.container-items',
        'widgetItem' => '.auth-item-child',
        'limit' => 10,
        'min' => 1,
        'insertButton' => '.add-auth-item-child',
        'deleteButton' => '.remove-auth-item-child',
        'model' => $modelAuthItemChild[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'description',
        ],
    ]); ?>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th colspan="2">Permissions</th>
                <th class="text-center" style="width: 90px;">
                    <button type="button" class="add-auth-item-child btn btn-success btn-xs"><span class="fa fa-plus"></span></button>
                </th>
            </tr>
        </thead>
        <tbody class="container-items">
        <?php 
        foreach ($modelAuthItemChild as $indexItemChild => $each): ?>
            <tr class="auth-item-child">
             <td class="vcenter" width="50%">
                    <?php
                        // necessary for update action.
                        // if (! $each->isNewRecord) {
                        //     echo Html::activeHiddenInput($each, "[{$indexItemChild}]name");
                        // }
                    ?>
                    <?= $form->field($each, "[{$indexItemChild}]permission_name")->label(false)->textInput(['placeholder' => 'Permission Name']) ?>
                </td>
                <td class="vcenter">
                    <?php
                        // necessary for update action.
                        if (! $each->isNewRecord) {
                            echo Html::activeHiddenInput($each, "[{$indexItemChild}]name");
                        }
                    ?>
                    <?= $form->field($each, "[{$indexItemChild}]permission_desc")->label(false)->textInput(['placeholder' => 'Description']) ?>
                </td>

                <td class="text-center vcenter" style="width: 90px; verti">
                    <button type="button" class="remove-auth-item-child btn btn-danger btn-xs"><span class="fa fa-minus"></span></button>
                </td>
            </tr>
         <?php endforeach; ?>
        </tbody>
    </table>
    <?php DynamicFormWidget::end(); ?>
    
    <div class="form-group">
        <?= Html::submitButton($modelAuthItem->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>