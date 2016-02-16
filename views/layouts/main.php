<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\Person;
use app\models\User;
use yii\helpers\Url;
use yii\bootstrap\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Servicio Social UADY',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    if (!Yii::$app->user->isGuest) {
        if (Yii::$app->user->can('admin')) {
            echo $this->render('navAdmin');
        } else if (Yii::$app->user->can('projectManager')) {
            echo $this->render('navProjectManager');
        } else if (Yii::$app->user->can('socialServiceManager')) {
            echo $this->render('navSocialServiceManager');
        } else if (Yii::$app->user->can('student')) {
            echo $this->render('navStudent');
        }
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            !Yii::$app->user->isGuest ?
                ['label' => "Bienvenido: " . Person::findOne(User::findOne(Yii::$app->user->id)->person_id)->name,
                    'url' => Yii::$app->user->can('admin') ? Url::to(['user/profile']) : Url::to(['/person/view', 'id' => User::findOne(Yii::$app->user->id)->person_id])] :
                ['label' => 'About', 'url' => ['/site/about']],
            Yii::$app->user->isGuest ?
                ['label' => 'Iniciar sesión', 'url' => ['/user/security/login']] :
                ['label' => 'Cerrar sesión (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/user/security/logout'],
                    'linkOptions' => ['data-method' => 'post']],
            ['label' => 'Registrarse', 'url' => ['/user/registration/register'], 'visible' => Yii::$app->user->isGuest]
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $this->render('modalChooseDate')?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Universidad Autónoma de Yucatán <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
