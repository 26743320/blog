<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\redactor\widgets\Redactor;

/* @var $this yii\web\View */
/* @var $model common\models\Aticle */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aticle-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'c_id')->dropDownList($cate_arr) ?>

    <?= $form->field($model, 'a_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'a_content')->widget(Redactor::className(), [
        'clientOptions' => [ 
            'imageManagerJson' => ['/redactor/upload/image-json'], 
            'imageUpload' => ['/redactor/upload/image'], 
            'fileUpload' => ['/redactor/upload/file'], 
            'lang' => 'zh_cn', 
            'plugins' => ['clips', 'fontcolor','imagemanager','fontfamily', 'fontsize', 'fullscreen','limiter', 'table', 'textdirection', 'textexpander', 'video','counter', 'definedlinks', 'filemanager'] 
    ]])  ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>