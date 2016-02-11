<?php
/**
 * Created by PhpStorm.
 * User: David Cocom
 * Date: 27/01/2016
 * Time: 03:45 AM
 */
use yii\bootstrap\Nav;
use yii\helpers\Url;
/*
 *
•	Cuenta
    o	Modificar cuenta
•	Proyectos
    o	Registrar proyecto
    o	Editar proyecto
    o	Eliminar proyecto
    o	Búsqueda
•	Avances

 */
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-left'],
    'items' => [
        [
            'label' => 'Cuenta',
            'items' => [
                ['label' => 'Modificar cuenta', 'url' => Url::to(['/user/settings/profile'])],
            ],
        ],
        [
            'label' => 'Proyectos',
            'items' => [
                ['label' => 'Registrar proyecto', 'url' => '#'],
                ['label' => 'Editar proyecto', 'url' => '#'],
                ['label' => 'Eliminar proyecto', 'url' => '#'],
                ['label' => 'Busqueda', 'url' => Url::to(['/admin/social-service-manager/create'])],
            ],
        ],
        [
            'label'=>'Avances',
            'url'=>Url::to('')
        ],
    ]
]);