<?php
/**
 * send_mail.php
 */
/**
 * send_mail_regist
 * argument|parameter:void
 * return:void
 */
function send_mail_regist($sessionData){
  $sessionData['password'] = $_SESSION['password'];
  $to = $sessionData['email'];
  $subject = '新規登録完了';
  $message = "新規登録完了しました。 \r\n"
             . '名前：　'.$sessionData['user_name']."\r\n"
             . 'ヨミガナ：　'.$sessionData['read_name']."\r\n"
             . 'メールアドレス：　'.$sessionData['email']."\r\n"
             . 'パスワード：　'.$sessionData['password']."\r\n"
             . '性別：　'.$sessionData['gender']."\r\n"
             . '年齢：　'.$sessionData['age']."\r\n"
             . '誕生日：　'.$sessionData['birthday']."\r\n"
             . '都道府県：　'.$sessionData['prefecture']."\r\n";
  $additionalHeader = 'From:XXXX@gmail.com';
  mb_language('ja');
  mb_internal_encoding('UTF-8');
  mb_send_mail($to,$subject,$message,$additionalHeader);
}
/**
 * send_mail_password_reissue
 * argument|parameter:void
 * return:void
 */
function send_mail_password_reissue($postData,$passwordReissue){
  $to = $postData['email'];
  $subject = 'パスワード再発行完了';
  $message = "パスワード再発行しました。 \r\n".$passwordReissue."\r\n";
  $additionalHeader = 'From:XXXX@gmail.com';
  mb_language('ja');
  mb_internal_encoding('UTF-8');
  mb_send_mail($to,$subject,$message,$additionalHeader);
}
/**
 * send_mail_change_password
 * argument|parameter:void
 * return:void
 */
function send_mail_change_password($sessionData,$postData){
  $to = $sessionData['email'];
  $subject = 'パスワード変更完了';
  $message = "パスワード変更しました。 \r\n".$postData['new_password']."\r\n";
  $additionalHeader = 'From:XXXX@gmail.com';
  mb_language('ja');
  mb_internal_encoding('UTF-8');
  mb_send_mail($to,$subject,$message,$additionalHeader);
}

/**
 * send_mail_delete
 * argument|parameter:void
 * return:void
 */
function send_mail_delete($sessionData){
  $to = $sessionData['email'];
  $subject = '退会完了';
  $message = '退会完了致しました。';
  $additionalHeader = 'From:XXXX@gmail.com';
  mb_language('ja');
  mb_internal_encoding('UTF-8');
  mb_send_mail($to,$subject,$message,$additionalHeader);
}
/**
 * send_mail_update
 * argument|parameter:void
 * return:void
 */
function send_mail_update($sessionData){
  $sessionData['password'] = $_SESSION['password'];
  $to = $sessionData['email'];
  $subject = '登録更新完了';
  $message = "登録更新完了しました。 \r\n"
             . '名前：　'.$sessionData['user_name']."\r\n"
             . 'ヨミガナ：　'.$sessionData['read_name']."\r\n"
             . 'メールアドレス：　'.$sessionData['email']."\r\n"
             . 'パスワード：　'.$sessionData['password']."\r\n"
             . '性別：　'.$sessionData['gender']."\r\n"
             . '年齢：　'.$sessionData['age']."\r\n"
             . '誕生日：　'.$sessionData['birthday']."\r\n"
             . '都道府県：　'.$sessionData['prefecture']."\r\n";
  $additionalHeader = 'From:XXXX@gmail.com';
  mb_language('ja');
  mb_internal_encoding('UTF-8');
  mb_send_mail($to,$subject,$message,$additionalHeader);
}
?>