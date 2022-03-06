<?php
/**
* data_search.php
*/
require_once(__DIR__.'/../class/database_connect.php');
/**
 * update_form_data_output_class
 */
class update_form_data_output extends database_connect{
	/**
   * genders_data_update_form
   * argument|parameter:void
   * return:$genders
   */
  public function genders_data_update_form(){
  	try{
      $pdo = $this->database_connect();
      $sql = 'SELECT * FROM genders';
      $row = $pdo->query($sql);
      $genders = $row->fetch(\PDO::FETCH_ASSOC);
		}catch(\PDOException $exception){
      error_log($exception,3,'./error_log');
      exit;
    }
    return $genders;
  }
  /**
   * ages_data_update_form
   * argument|parameter:void
   * return:$ages
   */
  public function ages_data_update_form(){
  	try{
      $pdo = $this->database_connect();
      $sql = 'SELECT * FROM ages';
      $row = $pdo->query($sql);
		  $ages = $row->fetch(\PDO::FETCH_ASSOC);
		}catch(\PDOException $exception){
      error_log($exception,3,'./error_log');
      exit;
    }
    return $ages;
  }
  /**
   * prefectures_data_update_form
   * argument|parameter:void
   * return:$prefectures
   */
  public function prefectures_data_update_form(){
  	try{
      $pdo = $this->database_connect();
      $sql = 'SELECT * FROM prefectures';
      $row = $pdo->query($sql);
		  $prefectures = $row->fetch(\PDO::FETCH_ASSOC);
    }catch(\PDOException $exception){
      error_log($exception,3,'./error_log');
      exit;
    }
    return $prefectures;
  }
}
?>