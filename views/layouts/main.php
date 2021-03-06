<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use app\models\Notification;
use app\models\Person;
use app\models\User;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

AppAsset::register ($this);
?>
<?php $this->beginPage () ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <?php
    $notifications = Notification::find ()->where (['user_id' => Yii::$app->user->id]);
    $this->title = $notifications->count () == 0 ? $this->title : '(' . $notifications->count () . ') ' . $this->title;
    ?>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags () ?>
    <title><?= Html::encode ($this->title) ?></title>
    <?php $this->head () ?>
</head>
<body>
<?php $this->beginBody () ?>

<div class="wrap">
    <?php
    NavBar::begin ([
        'brandLabel' => 'Servicio Social UADY',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    if (!Yii::$app->user->isGuest) {
        if (Yii::$app->user->can ('admin')) {
            echo $this->render ('navAdmin');
        } else if (Yii::$app->user->can ('projectManager')) {
            echo $this->render ('navProjectManager');
        } else if (Yii::$app->user->can ('socialServiceManager')) {
            echo $this->render ('navSocialServiceManager');
        } else if (Yii::$app->user->can ('student')) {
            echo $this->render ('navStudent');
        }
    }

    $navItems = [
        !Yii::$app->user->isGuest ?
            ['label' => "Bienvenido: " . Person::findOne (User::findOne (Yii::$app->user->id)->person_id)->name,
                'url' => Url::to (['site/index'])] :
            ['label' => '', 'url' => ['site/index']],
    ];


    if (Yii::$app->user->can ('student') or Yii::$app->user->can ('projectManager')) {

        $arrayNotifications = [];
        if ($notifications->count () == 0) {
            array_push ($arrayNotifications,
                [
                    'label' => 'No tienes nuevas notificaciones',
                    'options' => [
                        'class' => 'content'
                    ]
                ]
            );
        } else {
            foreach ($notifications->all () as $notification) {
                array_push ($arrayNotifications,
                    [
                        'label' => $notification->description,
                        'url' => Url::to (['/site/view-notification', 'id' => $notification->id])
                    ]
                );
            }
        }
        array_push ($navItems,
            [
                'label' => $notifications->count () == 0 ?
                    'Notificaciones' :
                    'Notificaciones <span class="badge">' . $notifications->count () . '</span>',
                'encode' => false,
                'items' => $arrayNotifications
            ]
        );
    }

    array_push ($navItems,
        Yii::$app->user->isGuest ?
            ['label' => 'Iniciar sesión', 'url' => ['/user/security/login']] :
            ['label' => 'Cerrar sesión (' . Yii::$app->user->identity->username . ')',
                'url' => ['/user/security/logout'],
                'linkOptions' => ['data-method' => 'post']]
    );


    echo Nav::widget ([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $navItems
    ]);
    NavBar::end ();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget ([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $this->render ('modalChooseDate') ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Universidad Autónoma de Yucatán <?= date ('Y') ?></p>
    </div>
</footer>

<?php $this->endBody () ?>
</body>
</html>
<?php $this->endPage () ?>
