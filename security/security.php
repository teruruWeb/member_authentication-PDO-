<?php
/**
 * security.php
 */
/**
 * hsc($string)
 * XSS(htmlspecialchars)
 * argument|parameter:string $string
 * return:void
 */
function hsc($string){
	return htmlspecialchars($string,ENT_QUOTES,'UTF-8');
}
/**
 * CSRF_token
 * CSRF(token)
 * argument|parameter:void
 * return:string $csrfToken
 */
function CSRF_token(){
  $csrfToken = bin2hex(random_bytes(32));
  $_SESSION['csrf_token'] = $csrfToken;
  return $csrfToken;
}
/**
 * CSRF_certification
 * CSRF(certification)
 * argument|parameter:void
 * return:void
 */
function CSRF_certification(){
  if(!isset($_SESSION['csrf_token'])){
    exit('不正なリクエストです。');
  }
}
/**
 * CSRF_delete
 * CSRF(delete)
 * argument|parameter:void
 * return:void
 */
function CSRF_delete(){
  unset($_SESSION['csrf_token']);
}
/**
 * session_timeout
 * timeout
 * argument|parameter:void
 * return:void
 */
function session_timeout(){
  if(isset($_SESSION['timeout']) && (time() - $_SESSION['timeout'] > 1800)){
    session_unset();
    session_destroy();
    echo 'セッションを切断しました。';
    echo '<br>';
  }
  $_SESSION['timeout'] = time();
}
/**
 * session_timeout_exit
 * timeout
 * argument|parameter:void
 * return:void
 */
function session_timeout_exit(){
  if(isset($_SESSION['timeout']) && (time() - $_SESSION['timeout'] > 1800)){
    session_unset();
    session_destroy();
    exit('セッションを切断しました。');
  }
  $_SESSION['timeout'] = time();
}
/**
 * session_id_regenerate
 * regenerate_id
 * argument|parameter:void
 * return:void
 */
function session_id_regenerate(){
  if(isset($_SESSION['timeout'])){
    $_SESSION['timeout'] = time();
  }else If(time() - $_SESSION['timeout'] > 1800){
    session_regenerate_id(true);
    $_SESSION['timeout'] = time();
  }
}
?>