<?php
/**
* validation.php
*/
require_once(__DIR__.'/../class/database_connect.php');
class validation extends database_connect{
  protected $tableName = 'members';
  /**
   * validation_regist
   * argument|parameter:$postData = $_POST
   * return:$errorMessage
   * $_POST → $postData
   * user_name(check_input,character_limit)
     read_name(check_input,character_limit)
     email(check_input,character_limit,mail_format_check,duplicate_email_check)
     password(check_input,password_character_condition,Password_match_confirm)
     confirm_password(check_input,Password_match_confirm)
     gender(check_item_select,check_select_outside_item)
     age(check_item_select,check_select_outside_item)
     birthday(check_input)
     prefecture(check_item_select,check_select_outside_item)
   *
   */
  public function validation_regist($postData){
    $postData = array();
    $postData['user_name'] = $_POST['user_name'];
    $postData['read_name'] = $_POST['read_name'];
    $postData['email'] = $_POST['email'];
    $postData['password'] = $_POST['password'];
    $postData['confirm_password'] = $_POST['confirm_password'];
    if(isset($_POST['gender'])){$postData['gender'] = $_POST['gender'];}
    $postData['age'] = $_POST['age'];
    $postData['birthday'] = $_POST['birthday'];
    $postData['prefecture'] = $_POST['prefecture'];
    if(empty($postData['user_name'])){
      $errorMessage['user_name'] = 'ユーザー名を入力して下さい。';
    }else if(mb_strlen($postData['user_name']) > 100){
      $errorMessage['user_name'] = 'ユーザー名は100文字未満にして下さい。';
    }
    if(empty($postData['read_name'])){
      $errorMessage['read_name'] = 'ヨミガナを入力して下さい。';
    }else if(mb_strlen($postData['read_name']) > 100){
      $errorMessage['read_name'] = 'ヨミガナは100文字未満にして下さい。';
    }
    if(empty($postData['email'])){
      $errorMessage['email'] = 'メールアドレスを入力して下さい。';
    }else if(mb_strlen($postData['email']) > 200){
      $errorMessage['email'] = 'メールアドレスは200文字未満にして下さい。';
    }else if(!filter_var($postData['email'],FILTER_VALIDATE_EMAIL)){
      $errorMessage['email'] = 'メールアドレスが不正です。';
    }
    try{
      $pdo = $this->database_connect();
      $sql = "SELECT email FROM $this->tableName WHERE email = ? LIMIT 1";
      $statementhandler = $pdo->prepare($sql);
      $statementhandler->bindValue(1,$postData['email'],PDO::PARAM_STR);
      $statementhandler->execute();
      $result = $statementhandler->fetch(PDO::FETCH_ASSOC);
      if(isset($result['email']) == isset($postData['email'])){
        $errorMessage['email'] = 'そのメールアドレスは既に登録されています。';
      }
    }catch(PDOException $exception){
      error_log($exception,3,'./error_log');
      exit;
    }
    if(empty($postData['password'])){
      $errorMessage['password'] = 'パスワードを入力して下さい。';
    }else if(!preg_match('/\A(?=.*?[a-z])(?=.*?[A-Z])(?=.*?\d)[a-zA-Z\d]{8,100}+\z/',$postData['password'])){
      $errorMessage['password'] = 'パスワードは大小英字、小数字、'."\n".'8文字以上100文字以下で入力して下さい。';
    }
    if($postData['password'] !== $postData['confirm_password']){
      $errorMessage['password'] = 'パスワードと確認用パスワードが一致しません。';
    }
    if(!isset($postData['gender']) || empty($postData['gender'])){
      $errorMessage['gender'] = '性別を選択して下さい。';
    }else if($postData['gender'] <= 0 || $postData['gender'] >= 3){
      $errorMessage['gender'] = '性別が不正です。';
    }
    if(empty($postData['age'])){
      $errorMessage['age'] = '年齢を選択して下さい。';
    }else if($postData['age'] <= 0 || $postData['age'] >= 101){
      $errorMessage['age'] = '年齢が不正です。';
    }
    if(empty($postData['birthday'])){
      $errorMessage['birthday'] = '誕生日を選択して下さい。';
    }
    if(empty($postData['prefecture'])){
      $errorMessage['prefecture'] = '都道府県を選択して下さい。';
    }else if($postData['prefecture'] <= 0 || $postData['prefecture'] >= 48){
      $errorMessage['prefecture'] = '都道府県が不正です。';
    }
    if(isset($errorMessage)){
      return $errorMessage;
    }
  }
  /**
   * validation_login
   * argument|parameter:$postData = $_POST
   * return:$errorMessage
   * $_POST → $postData
   * email(check_input,character_limit,mail_format_check)
   * password(check_input,password_character_condition)
   */
  public function validation_login($postData){
    $postData = array();
    $postData['email'] = $_POST['email'];
    $postData['password'] = $_POST['password'];
    if(empty($postData['email'])){
      $errorMessage['email'] = 'メールアドレスを入力して下さい。';
    }elseif(mb_strlen($postData['email']) > 200){
      $errorMessage['email'] = 'メールアドレスは200文字未満にして下さい。';
    }elseif(!filter_var($postData['email'],FILTER_VALIDATE_EMAIL)){
      $errorMessage['email'] = 'メールアドレスが不正です。';
    }
    if(empty($postData['password'])){
      $errorMessage['password'] = 'パスワードを入力して下さい。';
    }
    if(isset($errorMessage)){
      return $errorMessage;
    }
  }
  /**
   * validation_password_reissue
   * argument|parameter:$postData = $_POST
   * return:$errorMessage
   * $_POST → $postData
   * email(check_input,character_limit,mail_format_check)
   */
  public function validation_password_reissue($postData){
    $postData = array();
    $postData['email'] = $_POST['email'];
    if(empty($postData['email'])){
      $errorMessage['email'] = 'メールアドレスを入力して下さい。';
    }else if(mb_strlen($postData['email']) > 200){
      $errorMessage['email'] = 'メールアドレスは200文字未満にして下さい。';
    }else if(!filter_var($postData['email'],FILTER_VALIDATE_EMAIL)){
      $errorMessage['email'] = 'メールアドレスが不正です。';
    }
    if(isset($errorMessage)){
      return $errorMessage;
    }
  }
  /**
   * validation_change_password
   * argument|parameter:$postData = $_POST
   * return:$errorMessage
   * $_POST → $postData
   * password(check_input,password_character_condition)
     new_password(check_input,password_character_condition)
   */
  public function validation_change_password($postData){
    $postData = array();
    $postData['password'] = $_POST['password'];
    $postData['new_password'] = $_POST['new_password'];
    if(empty($postData['password'])){
      $errorMessage['password'] = 'パスワードを入力して下さい。';
    }
    if(empty($postData['new_password'])){
      $errorMessage['new_password'] = 'パスワードを入力して下さい。';
    }else if(!preg_match('/\A(?=.*?[a-z])(?=.*?[A-Z])(?=.*?\d)[a-zA-Z\d]{8,100}+\z/',$postData['new_password'])){
      $errorMessage['new_password'] = 'パスワードは大小英字、小数字、'."\n".'8文字以上100文字以下で入力して下さい。';
    }
    if(isset($errorMessage)){
      return $errorMessage;
    }
  }
  /**
   * validation_member_delete
   * argument|parameter:$postData = $_POST
   * return:$errorMessage
   * $_POST → $postData
   * email(check_input,character_limit,mail_format_check)
   */
  public function validation_member_delete($postData){
    $postData = array();
    $postData['email'] = $_POST['email'];
    if(empty($postData['email'])){
      $errorMessage['email'] = 'メールアドレスを入力して下さい。';
    }else if(mb_strlen($postData['email']) > 200){
      $errorMessage['email'] = 'メールアドレスは200文字未満にして下さい。';
    }else if(!filter_var($postData['email'],FILTER_VALIDATE_EMAIL)){
      $errorMessage['email'] = 'メールアドレスが不正です。';
    }
    if(isset($errorMessage)){
      return $errorMessage;
    }
  }
  /**
   * validation_update
   * argument|parameter:$postData = $_POST
   * return:$errorMessage
   * $_POST → $postData
   * user_name(check_input,character_limit)
     read_name(check_input,character_limit)
     email(check_input,character_limit,mail_format_check)
     password(check_input,password_character_condition,Password_match_confirm)
     confirm_password(check_input,Password_match_confirm)
     gender(check_item_select,check_select_outside_item)
     age(check_item_select,check_select_outside_item)
     birthday(check_input)
     prefecture(check_item_select,check_select_outside_item)
   *
   */
  public function validation_update($postData){
    $postData = array();
    $postData['user_name'] = $_POST['user_name'];
    $postData['read_name'] = $_POST['read_name'];
    $postData['email'] = $_POST['email'];
    $postData['password'] = $_POST['password'];
    $postData['confirm_password'] = $_POST['confirm_password'];
    if(isset($_POST['gender'])){$postData['gender'] = $_POST['gender'];};
    $postData['age'] = $_POST['age'];
    $postData['birthday'] = $_POST['birthday'];
    $postData['prefecture'] = $_POST['prefecture'];
    if(empty($postData['user_name'])){
      $errorMessage['user_name'] = 'ユーザー名を入力して下さい。';
    }else if(mb_strlen($postData['user_name']) > 100){
      $errorMessage['user_name'] = 'ユーザー名は100文字未満にして下さい。';
    }
    if(empty($postData['read_name'])){
      $errorMessage['read_name'] = 'ヨミガナを入力して下さい。';
    }else if(mb_strlen($postData['read_name']) > 100){
      $errorMessage['read_name'] = 'ヨミガナは100文字未満にして下さい。';
    }
    if(empty($postData['email'])){
      $errorMessage['email'] = 'メールアドレスを入力して下さい。';
    }else if(mb_strlen($postData['email']) > 200){
      $errorMessage['email'] = 'メールアドレスは200文字未満にして下さい。';
    }else if(!filter_var($postData['email'],FILTER_VALIDATE_EMAIL)){
      $errorMessage['email'] = 'メールアドレスが不正です。';
    }
    if(empty($postData['password'])){
      $errorMessage['password'] = 'パスワードを入力して下さい。';
    }else if(!preg_match('/\A(?=.*?[a-z])(?=.*?[A-Z])(?=.*?\d)[a-zA-Z\d]{8,100}+\z/',$postData['password'])){
      $errorMessage['password'] = 'パスワードは大小英字、小数字、'."\n".'8文字以上100文字以下で入力して下さい。';
    }
    if($postData['password'] !== $postData['confirm_password']){
      $errorMessage['password'] = 'パスワードと確認用パスワードが一致しません。';
    }
    if(!isset($postData['gender']) || empty($postData['gender'])){
      $errorMessage['gender'] = '性別を選択して下さい。';
    }else if($postData['gender'] <= 0 || $postData['gender'] >= 3){
      $errorMessage['gender'] = '性別が不正です。';
    }
    if(empty($postData['age'])){
      $errorMessage['age'] = '年齢を選択して下さい。';
    }else if($postData['age'] <= 0 || $postData['age'] >= 101){
      $errorMessage['age'] = '年齢が不正です。';
    }
    if(empty($postData['birthday'])){
      $errorMessage['birthday'] = '誕生日を選択して下さい。';
    }
    if(empty($postData['prefecture'])){
      $errorMessage['prefecture'] = '都道府県を選択して下さい。';
    }else if($postData['prefecture'] <= 0 || $postData['prefecture'] >= 48){
      $errorMessage['prefecture'] = '都道府県が不正です。';
    }
    if(isset($errorMessage)){
      return $errorMessage;
    }
  }
}
?>