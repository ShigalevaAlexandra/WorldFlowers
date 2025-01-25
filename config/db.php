<?php

require('secret.php');

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname='.DBNAME,
    'username' => USERNAME,
    'password' => PASSWORD,
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
