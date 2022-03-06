<?php
/**
 * init.php
 */
/**
* error_message_init
* argument|parameter:void
* return:void
*/
function error_message_init(){
  $errorMessage = array();
}
/**
* session_regist_error_message_init
* argument|parameter:void
* return:void
*/
function session_regist_error_message_init(){
  $errorMessage = $_SESSION;
  $_SESSION['user_name'] = '';
  $_SESSION['read_name'] = '';
  $_SESSION['email'] = '';
  $_SESSION['password'] = '';
  $_SESSION['gender'] = '';
  $_SESSION['age'] = '';
  $_SESSION['birthday'] = '';
  $_SESSION['prefecture'] = '';
}
/**
* session_update_error_message_init
* argument|parameter:void
* return:void
*/
function session_update_error_message_init(){
  $errorMessage = $_SESSION;
  $_SESSION['user_name'] = '';
  $_SESSION['read_name'] = '';
  $_SESSION['email'] = '';
  $_SESSION['password'] = '';
  $_SESSION['gender'] = '';
  $_SESSION['age'] = '';
  $_SESSION['birthday'] = '';
  $_SESSION['prefecture'] = '';
}
/**
* session_login_error_message_init
* argument|parameter:void
* return:void
*/
function session_login_error_message_init(){
  $errorMessage = $_SESSION;
  $_SESSION['email'] = '';
  $_SESSION['password'] = '';
}
/**
* session_password_reissue_error_message_init
* argument|parameter:void
* return:void
*/
function session_password_reissue_error_message_init(){
  $errorMessage = $_SESSION;
  $_SESSION['email'] = '';
}
/**
* session_password_reissue_error_message_init
* argument|parameter:void
* return:void
*/
function session_change_password_error_message_init(){
  $errorMessage = $_SESSION;
  $_SESSION['password'] = '';
  $_SESSION['new_password'] = '';
}
/**
* session_delete_error_message_init
* argument|parameter:void
* return:void
*/
function session_delete_error_message_init(){
  $errorMessage = $_SESSION;
  $_SESSION['email'] = '';
}
/**
* session_delete
* argument|parameter:void
* return:void
*/
function session_delete(){
  $_SESSION = array();
  session_destroy();
}
/**
* post_init
* argument|parameter:void
* return:void
*/
function post_init(){
  $_POST = array();
}
/**
* post_email_init
* argument|parameter:void
* return:void
*/
function post_email_init(){
  $_POST['email'] = '';
}
?>