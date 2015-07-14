<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=dictionary',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
    'attributes' => [
        'MYSQL_ATTR_LOCAL_INFILE' => 1
    ],
];
