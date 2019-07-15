<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
.radio{display: inline-flex;}
</style>

<div class="user-form">
    <?php $form = ActiveForm::begin(['action' => ['user/index']]); ?>
        <?= $form->field($model, 'username')->textInput(['maxlength' => 20,'readonly'=>'readonly']) ?>
        <?= $form->field($model, 'email')->textInput() ?>
        <?= $form->field($model, 'gender')->radioList(['0'=>'未知','1'=>'男','2'=>'女'])?>
        <?= $form->field($model, 'created_address')->textInput()?>
        <?= $form->field($model, 'birthday')->widget(DatePicker::className(), [
            'language' => 'zh-CN',
            'readonly'=>'input',
            //'value' => '2019-06-26',
            'removeButton' => false,
            'options' => ['placeholder' => '请选择日期 ...'],
            'type'=>DatePicker::TYPE_COMPONENT_APPEND,
            //'size'=>'md',
            //'disabled'=>true,
            //'pickerIcon' => '<i class="fas fa-calendar-alt text-primary"></i>',
            //'removeIcon' => '<i class="fas fa-trash text-danger"></i>',
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'todayHighlight' => true,
                'todayHighlight' => true,
                //'todayBtn' => true,
                'autoclose'=>true
    ]
    ]);?>
        <div class="form-group">
            <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
        </div>

    <?php ActiveForm::end(); ?>  
</div>