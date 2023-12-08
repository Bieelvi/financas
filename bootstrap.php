<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require_once "vendor/autoload.php";

// Create a simple "default" Doctrine ORM configuration for Attributes
$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: array(__DIR__."/src/Entity"),
    isDevMode: true,
);

// or if you prefer annotation, YAML or XML
// $config = ORMSetup::createAnnotationMetadataConfiguration(
//    paths: array(__DIR__."/src"),
//    isDevMode: true,
// );
// $config = ORMSetup::createXMLMetadataConfiguration(
//    paths: array(__DIR__."/config/xml"),
//    isDevMode: true,
//);
// $config = ORMSetup::createYAMLMetadataConfiguration(
//    paths: array(__DIR__."/config/yaml"),
//    isDevMode: true,
// );

// database params
$connectionParams = [
    'dbname' => 'financas',
    'user' => 'root',
    'password' => '1234',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
];

// configuring the database connection
$connection = DriverManager::getConnection($connectionParams, $config);
$connection->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');

// obtaining the entity manager
$entityManager = new EntityManager($connection, $config);