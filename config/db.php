<?php
$dbHost = getenv('DB_HOST');
$dbName = getenv('DB_NAME');
$dbUsername = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');

return [
    'class' => 'yii\db\Connection',
    'dsn' => "mysql:host={$dbHost};dbname={$dbName}",
    'username' => $dbUsername,
    'password' => $dbPassword,
    'charset' => 'utf8mb4',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
