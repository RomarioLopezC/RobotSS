<?php
use yii\bootstrap\Nav;
use yii\helpers\Url;
/**
 * Created by PhpStorm.
 * User: David Cocom
 * Date: 27/01/2016
 * Time: 03:43 AM
 */
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-left'],
    'items' => [
        [
            'label' => 'Usuarios',
            'items' => [
                ['label' => 'Eliminar cuentas', 'url' => '#'],
                ['label' => 'Aprobación de solicitudes', 'url' => '#'],
                ['label' => 'Aprobación de proyectos', 'url' => '#'],
                ['label' => 'Registrar encargado de servicio social', 'url' => Url::to(['/admin/social-service-manager/create'])],
            ],
        ],
        [
            'label' => 'Cuenta',
            'items' => [
                ['label' => 'Modificar cuenta', 'url' => Url::to(['/user/settings/profile'])],
            ],
        ],
    ]
]);