<?php
return array(
    'doctrine' => array(
        'driver' => array(
            'libra_user_annotation_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/LibraUser/Entity'),
            ),
            'orm_default' => array(
                'drivers' => array(
                    'LibraUser\Entity' => 'libra_user_annotation_driver',
                ),
            ),
        ),
    ),
);
