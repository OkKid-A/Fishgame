<?php

include __DIR__ . '/dbconfig.php';

function connectDB() : PDO
{
  static $pdo;
  if (!$pdo) {
    $dsn = "mysql:host=".HOST.";dbname=".DB_NAME.";charset=utf8";
      $pdo = new PDO($dsn, USERNAME, PASSWORD,
      [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
  }
  return $pdo;
}

