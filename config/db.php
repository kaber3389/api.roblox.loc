<?php
$dbHost = $_ENV['DB_HOST'];
$dbName = $_ENV['DB_NAME'];
$dbUsername = $_ENV['DB_USER'];
$dbPassword = $_ENV['DB_PASSWORD'];

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
