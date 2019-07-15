<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Aticle */

$this->title = 'Update Aticle: ' . $model->a_id;
$this->params['breadcrumbs'][] = ['label' => 'Aticles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->a_id, 'url' => ['view', 'id' => $model->a_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="aticle-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'cate_arr'=>$cate_arr
    ]) ?>

</div>
