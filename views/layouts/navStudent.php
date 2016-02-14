<?php
/**
 * Created by PhpStorm.
 * User: David Cocom
 * Date: 27/01/2016
 * Time: 03:44 AM
 */
use yii\bootstrap\Nav;
use yii\helpers\Url;

/*
 *
•	Cuenta
    o	Modificar cuenta
•	Proyectos
    o	Búsqueda
•	Avances
•	Documentos

 */
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-left'],
    'items' => [
        [
            'label' => 'Cuenta',
            'items' => [
                ['label' => 'Modificar cuenta',
                    'url' => Url::to(['/person/update', 'id' => Yii::$app->user->id])
                ],
            ],
        ],
        [
            'label' => 'Proyectos',
            'items' => [
                ['label' => 'Busqueda', 'url' => Url::to(['/project'])],
            ],
        ],
        [
            'label' => 'Avances',
            'url' => Url::to('')
        ],
        [
<<<<<<< HEAD
            'label'=>'Documentos',
            'items'=>[
                [
                    'label'=>'Preregistro',
                    'url'=>Url::to(['/student/default/print-preregistration-p-d-f'])
                ]
            ]
=======
            'label' => 'Documentos',
            'url' => Url::to('')
>>>>>>> 2fe3f3e42a1e4c407ed18b218edcaae8da4788fb
        ],
    ]
]);