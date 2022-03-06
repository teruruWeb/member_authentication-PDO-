<?php
/**
 * define.php
 */
/**
* define_regist
* argument|parameter:$postData = $_POST
* return:void
* $_POST → $postData
* $postData(XSS) → $_SESSION
* user_name,
  read_name,
  email,
  password,
  gender,
  age,
  birthday,
  prefecture
*/
require_once(__DIR__.'/../security/security.php');
function define_regist($postData){
  $postData = array();
  $postData['user_name'] = $_POST['user_name'];
  $postData['read_name'] = $_POST['read_name'];
  $postData['email'] = $_POST['email'];
  $postData['password'] = $_POST['password'];
  if(isset($_POST['gender'])){
    $postData['gender'] = $_POST['gender'];
  }
  $postData['age'] = $_POST['age'];
  $postData['birthday'] = $_POST['birthday'];
  $postData['prefecture'] = $_POST['prefecture'];
  $_SESSION['user_name'] = hsc($postData['user_name']);
  $_SESSION['read_name'] = hsc($postData['read_name']);
  $_SESSION['email'] = hsc($postData['email']);
  $_SESSION['password'] = hsc($postData['password']);
  if(isset($postData['gender'])){
    $_SESSION['gender'] = hsc($postData['gender']);
  }
  $_SESSION['age'] = hsc($postData['age']);
  $_SESSION['birthday'] = hsc($postData['birthday']);
  $_SESSION['prefecture'] = hsc($postData['prefecture']);
  return $_SESSION;
 }
/**
* define_login
* argument|parameter:$databaseData = $row
* return:void
* $row(XSS) → $_SESSION
* id,
  user_name,
  read_name,
  email,
  password,
  gender,
  age,
  birthday,
  prefecture
*/
function define_login($row){
  $_SESSION['id'] = hsc($row['id']);
  $_SESSION['user_name'] = hsc($row['user_name']);
  $_SESSION['read_name'] = hsc($row['read_name']);
  $_SESSION['email'] = hsc($row['email']);
  $_SESSION['password'] = hsc($row['password']);
  $_SESSION['gender'] = hsc($row['gender']);
  $_SESSION['age'] = hsc($row['age']);
  $_SESSION['birthday'] = hsc($row['birthday']);
  $_SESSION['prefecture'] = hsc($row['prefecture']);
  return $_SESSION;
}
/**
* define_update
* argument|parameter:$postData = $_POST
* return:void
* $_POST → $postData
* $postData(XSS) → $_SESSION
* user_name,
  read_name,
  email,
  password,
  gender,
  age,
  birthday,
  prefecture
*/
function define_update($postData){
  $postData = array();
  $postData['user_name'] = $_POST['user_name'];
  $postData['read_name'] = $_POST['read_name'];
  $postData['email'] = $_POST['email'];
  $postData['password'] = $_POST['password'];
  if(isset($_POST['gender'])){
    $postData['gender'] = $_POST['gender'];
  }
  $postData['age'] = $_POST['age'];
  $postData['birthday'] = $_POST['birthday'];
  $postData['prefecture'] = $_POST['prefecture'];
  $_SESSION['user_name'] = hsc($postData['user_name']);
  $_SESSION['read_name'] = hsc($postData['read_name']);
  $_SESSION['email'] = hsc($postData['email']);
  $_SESSION['password'] = hsc($postData['password']);
  if(isset($postData['gender'])){
    $_SESSION['gender'] = hsc($postData['gender']);
  }
  $_SESSION['age'] = hsc($postData['age']);
  $_SESSION['birthday'] = hsc($postData['birthday']);
  $_SESSION['prefecture'] = hsc($postData['prefecture']);
  return $_SESSION;
}
?>
