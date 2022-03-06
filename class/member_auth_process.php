<?php
/**
* member_auth_process.php
*/
require_once(__DIR__.'/../class/database_connect.php');
require_once(__DIR__.'/../functions/define.php');
require_once(__DIR__.'/../functions/redirect.php');
require_once(__DIR__.'/../functions/init.php');
require_once(__DIR__.'/../functions/send_mail.php');
require_once(__DIR__.'/../config/env.php');
/**
 * member_auth_process_class
 * protected($table_name)
 */
class member_auth_process extends database_connect{
  protected $tableName = 'members';
  /**
   * member_regist
   * argument|parameter:
     $sessionData = $_SESSION,
     $genders,
     $ages,
     $prefectures,
     $complete = false
   * return:$complete = true
   *
   * $_SESSION → $sessionData
   * regist
     (
       user_name,
       read_name,
       email,
       password,
       gender,
       age,
       birthday,
       prefecture
     )
   */
  public function member_regist($sessionData,$genders,$ages,$prefectures,$complete){
    $sessionData = array();
    $sessionData['user_name'] = $_SESSION['user_name'];
    $sessionData['read_name'] = $_SESSION['read_name'];
    $sessionData['email'] = $_SESSION['email'];
    $sessionData['password'] = password_hash($_SESSION['password'],PASSWORD_DEFAULT);
    if(isset($_SESSION['gender'])){$sessionData['gender'] = $genders[$_SESSION['gender']];};
    $sessionData['age'] = $ages[$_SESSION['age']];
    $sessionData['birthday'] = $_SESSION['birthday'];
    $sessionData['prefecture'] = $prefectures[$_SESSION['prefecture']];
    try{
      $pdo = $this->database_connect();
      $pdo->beginTransaction();
      $sql = "INSERT INTO $this->tableName(user_name,read_name,email,password,gender,age,birthday,prefecture) VALUES(?,?,?,?,?,?,?,?)";
      $statementhandler = $pdo->prepare($sql);
      $statementhandler->bindValue(1,$sessionData['user_name'],\PDO::PARAM_STR);
      $statementhandler->bindValue(2,$sessionData['read_name'],\PDO::PARAM_STR);
      $statementhandler->bindValue(3,$sessionData['email'],\PDO::PARAM_STR);
      $statementhandler->bindValue(4,$sessionData['password'],\PDO::PARAM_STR);
      $statementhandler->bindValue(5,$sessionData['gender'],\PDO::PARAM_STR);
      $statementhandler->bindValue(6,$sessionData['age'],\PDO::PARAM_STR);
      $statementhandler->bindValue(7,$sessionData['birthday'],\PDO::PARAM_STR);
      $statementhandler->bindValue(8,$sessionData['prefecture'],\PDO::PARAM_STR);
      $statementhandler->execute();
      $pdo->commit();
    }catch(\PDOException $exception){
      $pdo->rollBack();
      error_log($exception,3,'./error_log');
      exit;
    }
    send_mail_regist($sessionData,$_SESSION);
    $complete = true;
    return $complete;
  }
  /**
   * member_search
   * argument|parameter:$postData = $_POST
   * return:$row
   *
   * $_POST['email']['password'] → $postData['email']['password']
   * $row = 1record
   */
  public function member_search($postData){
    $postData = array();
    $postData['email'] = $_POST['email'];
    $postData['password'] = $_POST['password'];
    try{
      $pdo = $this->database_connect();
      $sql = "SELECT * FROM $this->tableName WHERE email = ? LIMIT 1";
      $statementhandler = $pdo->prepare($sql);
      $statementhandler->bindValue(1,$postData['email'],\PDO::PARAM_STR);
      $statementhandler->execute();
      $row = $statementhandler->fetch(\PDO::FETCH_ASSOC);
    }catch(\PDOException $exception){
      error_log($exception,3,'./error_log');
      exit;
    }
    return $row;
  }
  /**
   * member_authentication
   * argument|parameter:$row,$postData = $_POST,$complete = fales
   * return:$complete
   *
   * $_POST['email']['password'] → $postData['email']['password']
   * $postData['email'] = $row['email'],
     $postData['password'] = $row['password']
   * $row → $_SESSION
   * session_regenerate_id(true)
   * redirect(member.php)
   * $complete = true
   */
  public function member_authentication($row,$postData,$complete){
    $postData = array();
    $postData['email'] = $_POST['email'];
    $postData['password'] = $_POST['password'];
    if(isset($postData['email']) == isset($row['email'])){
      if(password_verify($postData['password'],$row['password'])){
        if($row['login_lock_time']){
          $currentLockTime = strtotime('now') - strtotime($row['login_lock_time']);
          if($currentLockTime < LOGIN_LOCK_TIME){
            redirect_login();
          }else{
            $this->unlock_login_account($postData);
            session_regenerate_id(true);
            $_SESSION = define_login($row);
            redirect_member();
            $complete = true;
            return $complete;
          }
        }else{
          session_regenerate_id(true);
          $_SESSION = define_login($row);
          redirect_member();
          $complete = true;
        }
      }else{
        $errorMessage['password'] = 'パスワードが一致しませんでした。';
      }
    }else{
      $errorMessage['email'] = 'メールアドレスが確認できません。';
    }
    if(isset($complete) || isset($errorMessage)){
      return [$complete,$errorMessage];
    }
  }
  /*
  * unlock_login_account($postData)
  * argument|parameter:$postData = $_POST['email']
  * return:void
  */
  public function unlock_login_account($postData){
    $postData = array();
    $postData['email'] = $_POST['email'];
    try{
      $pdo = $this->database_connect();
      $pdo->beginTransaction();
      $sql = "UPDATE $this->tableName SET login_failed_count = 0,login_lock_time = NULL WHERE email = ?";
      $statementhandler = $pdo->prepare($sql);
      $statementhandler->bindValue(1,$postData['email'],PDO::PARAM_STR);
      $statementhandler->execute();
      $pdo->commit();
    }catch(\PDOException $exception){
      $pdo->rollBack();
      error_log($exception,3,'./error_log');
      exit;
    }
  }
  /*
  * login_failed_count_up($row,$postData)
  * argument|parameter:$row,$postData = $_POST['email']
  * return:void
  */
  public function login_failed_count_up($row,$postData){
    $postData = array();
    $postData['email'] = $_POST['email'];
    $postData['password'] = $_POST['password'];
    try{
      $pdo = $this->database_connect();
      $pdo->beginTransaction();
      $sql = "UPDATE $this->tableName SET login_failed_count = login_failed_count + 1 WHERE email = ?";
      $statementhandler = $pdo->prepare($sql);
      $statementhandler->bindValue(1,$postData['email'],PDO::PARAM_STR);
      $statementhandler->execute();
      $pdo->commit();
    }catch(\PDOException $exception){
      $pdo->rollBack();
      error_log($exception,3,'./error_log');
      exit;
    }
  }
  /*
  * get_login_failed_count($postData)
  * argument|parameter:$postData = $_POST['email']
  * return:$loginFailedCount['login_failed_count'] = $row
  */
  public function get_login_failed_count($postData){
    $postData = array();
    $postData['email'] = $_POST['email'];
    try{
      $pdo = $this->database_connect();
      $sql = "SELECT login_failed_count FROM $this->tableName WHERE email = ?";
      $statementhandler = $pdo->prepare($sql);
      $statementhandler->bindValue(1,$postData['email'],PDO::PARAM_STR);
      $statementhandler->execute();
      $row = $statementhandler->fetch(\PDO::FETCH_ASSOC);
    }catch(\PDOException $exception){
      error_log($exception,3,'./error_log');
      exit;
    }
    $loginFailedCount = $row;
    return $loginFailedCount;
  }
  /*
  * lock_login_account($postData)
  * argument|parameter:$postData = $_POST['email']
  * return:$accountLock = bool
  */
  public function lock_login_account($postData){
    $accountLock = false;
    $postData = array();
    $postData['email'] = $_POST['email'];
    try{
      $pdo = $this->database_connect();
      $pdo->beginTransaction();
      $sql = "UPDATE $this->tableName SET login_lock_time = ? WHERE email = ?";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(1,date('Y-m-d H:i:s'),\PDO::PARAM_STR);
      $stmt->bindValue(2,$postData['email'],\PDO::PARAM_STR);
      $stmt->execute();
      $pdo->commit();
      $accountLock = true;
    }catch(\PDOException $exception){
      $pdo->rollBack();
      error_log($exception,3,'./error_log');
      exit;
    }
    return $accountLock;
  }
  /**
   * password_reissue
   * argument|parameter:$postData = $_POST
   * return:$complete
   *
   * $_POST['email'] → $postData['email']
   * $row = result_limit1_record
   * $postData['email'] = $row['email']
   * $passwordReissue = bin2hex(random_bytes(32));
   * $passwordHash = password_hash($passwordReissue,PASSWORD_DEFAULT);
   * password_update
   * email($postData['email'])
   * $complete = true
   */
  public function password_reissue($postData,$complete){
    $postData = array();
    $postData['email'] = $_POST['email'];
    try {
      $pdo = $this->database_connect();
      $sql = "SELECT email FROM $this->tableName WHERE email = :email LIMIT 1";
      $statementhandler = $pdo->prepare($sql);
      $statementhandler->bindValue(':email',$postData['email'],\PDO::PARAM_STR);
      $statementhandler->execute();
      $row = $statementhandler->fetch(\PDO::FETCH_ASSOC);
    }catch(\PDOException $exception){
      error_log($exception,3,'./error_log');
      exit;
    }
    if(isset($postData['email']) == isset($row['email'])){
      $passwordReissue = bin2hex(random_bytes(32));
      $passwordHash = password_hash($passwordReissue,PASSWORD_DEFAULT);
      try{
        $pdo->beginTransaction();
        $sql = "UPDATE $this->tableName SET password = ? WHERE email = ? LIMIT 1";
        $statementhandler = $pdo->prepare($sql);
        $statementhandler->bindValue(1,$passwordHash,\PDO::PARAM_STR);
        $statementhandler->bindValue(2,$postData['email'],\PDO::PARAM_STR);
        $statementhandler->execute();
        $pdo->commit();
      }catch(\PDOException $exception){
        $pdo->rollBack();
        error_log($exception,3,'./error_log');
        exit;
      }
      send_mail_password_reissue($postData,$passwordReissue);
      $complete = true;
    }else{
      $errorMessage['email'] = 'メールアドレスが確認できません。';
    }
    if(isset($complete) || isset($errorMessage)){
      return [$complete,$errorMessage];
    }
  }
  /**
   * change_password
   * argument|parameter:
     $sessionData = $_SESSION
     $postData = $_POST
     $complete = false
   * return:$complete = true
   *
   * $_SESSION['email'] → $sessionData['email']
   * $_POST['password']['new_password'] → $postData['password']['new_password']
   * $row = result_limit1_record
   * $sessionData['email'] = $row['email']
   * $postData['password'] = $row['password']
   * $passwordHash = password_hash($postData['new_password'],PASSWORD_DEFAULT);
   * password_update
   * $complete = true
   */
  public function change_password($sessionData,$postData,$complete){
    $sessionData = array();
    $sessionData['email'] = $_SESSION['email'];
    $postData = array();
    $postData['password'] = $_POST['password'];
    $postData['new_password'] = $_POST['new_password'];
    try{
      $pdo = $this->database_connect();
      $sql = "SELECT email,password FROM $this->tableName WHERE email = ? LIMIT 1";
      $statementhandler = $pdo->prepare($sql);
      $statementhandler->bindValue(1,$sessionData['email'],\PDO::PARAM_STR);
      $statementhandler->execute();
      $row = $statementhandler->fetch(\PDO::FETCH_ASSOC);
    }catch(\PDOException $exception){
      error_log($exception,3,'./error_log');
      exit;
    }
    if(isset($sessionData['email']) == isset($row['email'])){
      if(password_verify($postData['password'],$row['password'])){
        $passwordHash = password_hash($postData['new_password'],PASSWORD_DEFAULT);
        try{
          $pdo->beginTransaction();
          $sql = "UPDATE $this->tableName SET password = ? WHERE email = ? LIMIT 1";
          $statementhandler = $pdo->prepare($sql);
          $statementhandler->bindValue(1,$passwordHash,\PDO::PARAM_STR);
          $statementhandler->bindValue(2,$sessionData['email'],\PDO::PARAM_STR);
          $statementhandler->execute();
          $pdo->commit();
        }catch(\PDOException $exception){
          $pdo->rollBack();
          error_log($exception,3,'./error_log');
          exit;
        }
        send_mail_change_password($sessionData,$postData);
        $complete = true;
      }else{
        $errorMessage['password'] = 'パスワードが一致しません。';
      }
    }
    if(isset($complete) || isset($errorMessage)){
      return [$complete,$errorMessage];
    }
  }
  /**
   * member_delete
   * argument|parameter:$userdata = $_SESSION,$complete = false
   * return:$complete = true
   *
   * $_SESSION['email'] → $sessionData['email']
   * $row = result_limit1_record
   * $sessionData['email'] = $row['email']
   * dalete(email)
   * email($sessionData['email'])
   * $complete = true
   * session(delete)
   */
  public function member_delete($sessionData,$complete){
    $sessionData = array();
    $sessionData['email'] = $_SESSION['email'];
    try{
      $pdo = $this->database_connect();
      $sql = "SELECT * FROM $this->tableName WHERE email = ? LIMIT 1";
      $statementhandler = $pdo->prepare($sql);
      $statementhandler->bindValue(1,$sessionData['email'],\PDO::PARAM_STR);
      $statementhandler->execute();
      $row = $statementhandler->fetch(\PDO::FETCH_ASSOC);
    }catch(\PDOException $exception){
      error_log($exception,3,'./error_log');
      exit;
    }
    if(isset($sessionData['email']) == isset($row['email'])){
      try{
        $pdo->beginTransaction();
        $sql = "DELETE FROM $this->tableName WHERE email = ? LIMIT 1";
        $statementhandler = $pdo->prepare($sql);
        $statementhandler->bindValue(1,$sessionData['email'],\PDO::PARAM_STR);
        $statementhandler->execute();
        $pdo->commit();
      }catch(\PDOException $exception){
        $pdo->rollBack();
        error_log($exception,3,'./error_log');
        exit;
      }
      send_mail_delete($sessionData);
      $complete = true;
      return $complete;
    }
  }
  /**
   * member_update
   * argument|parameter:$sessionData = $_SESSION
   * return:$complete = true
   *
   * $_SESSION['id'] → $sessionData['id']
   * $row = result_limit1_record
   * $sessionData['id'] = $row['id']
   * $_SESSION → $sessionData
   * update($sessionData)
   * email($sessionData['email'])
   * $complete = true
   */
  public function member_update($sessionData,$genders,$ages,$prefectures,$complete){
    $sessionData = array();
    $sessionData['id'] = $_SESSION['id'];
    try {
      $pdo = $this->database_connect();
      $sql = "SELECT * FROM $this->tableName WHERE id = :id";
      $statementhandler = $pdo->prepare($sql);
      $statementhandler->bindValue(':id',(int)$sessionData['id'],\PDO::PARAM_INT);
      $statementhandler->execute();
      $row = $statementhandler->fetch(\PDO::FETCH_ASSOC);
    }catch(\PDOException $exception){
      error_log($exception,3,'./error_log');
      exit;
    }
    if(isset($sessionData['id']) == isset($row['id'])){
      $sessionData['user_name'] = $_SESSION['user_name'];
      $sessionData['read_name'] = $_SESSION['read_name'];
      $sessionData['email'] = $_SESSION['email'];
      $sessionData['password'] = password_hash($_SESSION['password'],PASSWORD_DEFAULT);
      if(isset($_SESSION['gender'])){$sessionData['gender'] = $genders[$_SESSION['gender']];};
      $sessionData['age'] = $ages[$_SESSION['age']];
      $sessionData['birthday'] = $_SESSION['birthday'];
      $sessionData['prefecture'] = $prefectures[$_SESSION['prefecture']];
      try{
        $pdo->beginTransaction();
        $sql = "UPDATE $this->tableName
               SET user_name = ?,
                   read_name = ?,
                   email = ?,
                   password = ?,
                   gender = ?,
                   age = ?,
                   birthday = ?,
                   prefecture = ?
               WHERE id = ? LIMIT 1";
        $statementhandler = $pdo->prepare($sql);
        $statementhandler->bindValue(1,$sessionData['user_name'],\PDO::PARAM_STR);
        $statementhandler->bindValue(2,$sessionData['read_name'],\PDO::PARAM_STR);
        $statementhandler->bindValue(3,$sessionData['email'],\PDO::PARAM_STR);
        $statementhandler->bindValue(4,$sessionData['password'],\PDO::PARAM_STR);
        $statementhandler->bindValue(5,$sessionData['gender'],\PDO::PARAM_STR);
        $statementhandler->bindValue(6,$sessionData['age'],\PDO::PARAM_STR);
        $statementhandler->bindValue(7,$sessionData['birthday'],\PDO::PARAM_STR);
        $statementhandler->bindValue(8,$sessionData['prefecture'],\PDO::PARAM_STR);
        $statementhandler->bindValue(9,(int)$sessionData['id'],\PDO::PARAM_INT);
        $statementhandler->execute();
        $pdo->commit();
      }catch(\PDOException $exception){
        $pdo->rollBack();
        error_log($exception,3,'./error_log');
        exit;
      }
      send_mail_update($sessionData,$_SESSION);
      $complete = true;
      return $complete;
    }
  }
}
?>