<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-form">
    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
    	<label class="control-label" for="user-password">原密码</label>
        <?= $form->field($model, 'password')->passwordInput([ 'class'=> 'inputSelf'])->label("") ?>
        <label class="control-label" for="new_password">新密码</label>
        <div class="form-group">
        	<?= Html::passwordInput('new_password','',['class'=>'inputSelf','id'=>'new_password']) ?>
			<p class="help-block help-block-error"></p>
		</div>
		<label class="control-label">重复新密码</label>
        <div class="form-group field-user-password">
	        <?= Html::passwordInput('new_password_repeat','',['class'=>'inputSelf']) ?>
	    </div>
        <div class="form-group">
            <?= Html::submitButton('保存', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>

    <?php ActiveForm::end(); ?> 
</div>