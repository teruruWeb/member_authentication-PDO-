<?php
/**
 * database_connect.php
 */
require_once(__DIR__.'/../config/env.php');
/**
 * database_connect_class
 * protected(tableName)
 */
class database_connect{
  protected $tableName;
  /**
  * database_connect
  * argument|parameter:void
  * return:$pdo
  */
  public function database_connect(){
    $databaseUser = DATABASE_USER;
    $databasePassword = DATABASE_PASSWORD;
    $databaseHost = DATABASE_HOST;
    $databaseName = DATABASE_NAME;
    $databaseType = DATABASE_TYPE;
    $dsn = "$databaseType:host=$databaseHost;dbname=$databaseName;charset=utf8mb4";
    try{
      $pdo = new \PDO($dsn,$databaseUser,$databasePassword);
      $pdo->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
      $pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES,false);
      //$pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE,\PDO::FETCH_ASSOC);
    }catch(\PDOException $exception){
      error_log($exception,3,'./error_log');
      exit;
    }
    return $pdo;
  }
}
?>