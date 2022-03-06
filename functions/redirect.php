<?php
/**
 * redirect.php
 */
/**
 * redirect_regist_form
 * redirect → regist_form.php
 */
function redirect_regist_form(){
  $host = $_SERVER['HTTP_HOST'];
  $uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\/');
  header("Location: //$host$uri/regist_form.php");
  exit;
}
/**
 * redirect_regist_form_return
 * redirect → regist_form.php
 */
function redirect_regist_form_return(){
  $host = $_SERVER['HTTP_HOST'];
  $uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\/');
  header("Location: //$host$uri/regist_form.php");
  return;
}
/**
 * redirect_confirm_regist
 * redirect → confirm_regist.php
 */
function redirect_confirm_regist(){
  $host = $_SERVER['HTTP_HOST'];
  $uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\/');
  header("Location: //$host$uri/confirm_regist.php");
  exit;
}
/**
 * redirect_complete_regist
 * redirect → complete_regist.php
 */
function redirect_complete_regist(){
  $host = $_SERVER['HTTP_HOST'];
  $uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\/');
  header("Location: //$host$uri/complete_regist.php");
  exit;
}
/**
 * redirect_login
 * redirect → login.php
 */
function redirect_login(){
  $host = $_SERVER['HTTP_HOST'];
  $uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\/');
  header("location: //$host$uri/login.php");
  exit;
}
/**
 * redirect_login_return
 * redirect → login.php
 */
function redirect_login_return(){
  $host = $_SERVER['HTTP_HOST'];
  $uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\/');
  header("location: //$host$uri/login.php");
  return;
}
/**
 * redirect_member
 * redirect → member.php
 */
function redirect_member(){
  $host = $_SERVER['HTTP_HOST'];
  $uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\/');
  header("location: //$host$uri/member.php");
  exit;
}
/**
 * redirect_update_form
 * redirect → update_form.php
 */
function redirect_update_form(){
  $host = $_SERVER['HTTP_HOST'];
  $uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\/');
  header("location: //$host$uri/update_form.php");
  exit;
}
/**
 * redirect_update_form_return
 * redirect → update_form.php
 */
function redirect_update_form_return(){
  $host = $_SERVER['HTTP_HOST'];
  $uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\/');
  header("location: //$host$uri/update_form.php");
  return;
}
/**
 * redirect_confirm_update
 * redirect → confirm_update.php
 */
function redirect_confirm_update(){
  $host = $_SERVER['HTTP_HOST'];
  $uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\/');
  header("location: //$host$uri/confirm_update.php");
  exit;
}
/**
 * redirect_complete_update
 * redirect → complete_update.php
 */
function redirect_complete_update(){
  $host = $_SERVER['HTTP_HOST'];
  $uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\/');
  header("location: //$host$uri/complete_update.php");
  exit;
}
/**
 * redirect_password_reissue_return
 * redirect → password_reissue.php
 */
function redirect_password_reissue_return(){
  $host = $_SERVER['HTTP_HOST'];
  $uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\/');
  header("location: //$host$uri/password_reissue.php");
  return;
}
/**
 * redirect_change_password_return
 * redirect → change_password.php
 */
function redirect_change_password_return(){
  $host = $_SERVER['HTTP_HOST'];
  $uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\/');
  header("location: //$host$uri/change_password.php");
  return;
}
/**
 * redirect_member_delete_return
 * redirect → delete.php
 */
function redirect_member_delete_return(){
  $host = $_SERVER['HTTP_HOST'];
  $uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\/');
  header("location: //$host$uri/member_delete.php");
  return;
}
?>