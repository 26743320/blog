<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_salt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_pwd')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_gender')->textInput() ?>

    <?= $form->field($model, 'user_avatar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_avatar_path')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_desc')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
