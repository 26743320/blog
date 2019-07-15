<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Aticle */

$this->title = '写博客';
$this->params['breadcrumbs'][] = ['label' => 'Aticles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aticle-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'cate_arr'=>$cate_arr
    ]) ?>

</div>
