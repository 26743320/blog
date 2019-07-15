<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?=$this->registerCssFile("@web/css/all.css"); ?>
<style>
    .page-header {
        padding-bottom: 0px;
        margin: 0px 0 20px;
        border-bottom: 1px solid #dee2e6;
    }
</style>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => '首页', 'url' => ['/site/index']],
        ['label' => '文章列表', 'url' => ['/article/index']],
        ['label' => '关于Emily', 'url' => ['/site/about']],
        ['label' => '留言板', 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => '注册', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => '登录', 'url' => ['/site/login']];
    } else {
        $menuItems[] = ['label' => '设置', 'url' => ['/user/index']];
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                '退出 (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <div class="col-lg-12">  
            <div class="page-header">
                <h1>帐户设置</h1>
                <ul id="w0" class="nav nav-tabs d-none d-md-flex">
                    <?php $select = $this->params['select'];?>
                    <?php if($select == 'index'){?>
                        <li class="nav-item active"><a class="active nav-link" href="/user/index">个人信息</a></li>
                    <?php }else{?>
                        <li class="nav-item"><a class="nav-link" href="/user/index">个人信息</a></li>
                    <?php } ?>
                    <?php if($select == 'avatar'){?>
                        <li class="nav-item active"><a class="active nav-link" href="/user/avatar">修改头像</a></li>
                    <?php }else{?>
                        <li class="nav-item"><a class="nav-link" href="/user/avatar">修改头像</a></li>
                    <?php } ?>
                    <?php if($select == 'password'){?>
                        <li class="nav-item active"><a class="active nav-link" href="/user/password">修改密码</a></li>
                    <?php }else{?>
                        <li class="nav-item"><a class="nav-link" href="/user/password">修改密码</a></li>
                    <?php } ?>
                </ul>
            </div>
        <?= $content ?>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
