<?php
/**
 * change_password.php
 */
/**
 * session(start)
 * redirect(login.php)
 * session(regenerate_id)
 * CSRF(check_session_token)
 * error_message(init)
 * complete(false)
 * validation
   (
     password
   )
 * change_password($_SESSION,$_POST,$complete),complete(true)
 * CSRF(unset(delete_session_token))(double_transmission_prevention)
 * post(init)
 */
if(!isset($_SESSION)){session_start();}
require_once(__DIR__.'/../functions/redirect.php');
require_once(__DIR__.'/../security/security.php');
require_once(__DIR__.'/../functions/init.php');
require_once(__DIR__.'/../security/validation.php');
require_once(__DIR__.'/../class/member_auth_process.php');
if(!isset($_SESSION['email'])){
  redirect_login();
}
session_id_regenerate();
CSRF_certification();
error_message_init();
//session_change_password_error_message_init();
$complete = false;
if($_POST){
  // instance_method
  $validation = new validation();
  $errorMessage = $validation->validation_change_password($_POST);
  /**
  if(count($errorMessage) > 0){
    $_SESSION = $errorMessage;
    redirect_change_password_return();
  }
  */
  if(empty($errorMessage)){
    // instance_method
    $memberAuthProcess = new member_auth_process();
    list($complete,$errorMessage) = $memberAuthProcess->change_password($_SESSION,$_POST,$complete);
    if(empty($complete)){
      $errorMessage['failed_change_password'] = 'パスワード更新に失敗しました。';
    }
    CSRF_delete();
  }
}else{
  post_init();
}
?>
<!--
 * title
 * read
 * input_text,input_radio,input_select
   (
     password,
     new_password
   )
 * error_message_display
   (
     password
   )
 * form,post(change_password.php)
 * link(member.php)
-->
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex,nofollow,noarchive">
  <title>パスワード変更</title>
  <meta name="description" content="抜粋文">
  <meta name="keywords" content="キーワード"/>
  <meta name="format-detection" content="telephone=no">
  <meta name="google-site-verification" content="サーチコンソール認証"/>
  <meta property="og:locale" content="ja_JP"/>
  <meta property="og:type" content="website"/>
  <meta property="og:title" content="タイトル"/>
  <meta property="og:description" content="抜粋文"/>
  <meta property="og:url" content="URL"/>
  <meta property="og:image" content="画像URL"/>
  <meta property="og:image:secure_url" content="画像URL"/>
  <meta name="twitter:site" content="サイト名"/>
  <meta name="twitter:domain" content="ドメイン"/>
  <meta name="twitter:title" content="タイトル"/>
  <meta name="twitter:description" content="抜粋文"/>
  <meta name="twitter:creator" content="@作者"/>
  <meta name="twitter:card" content="summary"/>
  <meta name="twitter:image" content="画像URL"/>
  <!-- <link rel="stylesheet" href="sanitize.css"> -->
  <link href="https://unpkg.com/sanitize.css" rel="stylesheet"/>
  <!-- <link rel="stylesheet" href="../css/style.css"> -->
  <link rel="preload" href="../css/style.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" href="../css/style.css"></noscript>
  <script defer>
    /*! loadCSS. [c]2017 Filament Group, Inc. MIT License */
    !function(e){"use strict";var t=function(t,n,r,o){var i,a=e.document,d=a.createElement("link");if(n)i=n;else{var f=(a.body||a.getElementsByTagName("head")     [0]).childNodes;i=f[f.length-1]}var l=a.styleSheets;if(o)for(var s in o)o.hasOwnProperty(s)&&d.setAttribute(s,o[s]);d.rel="stylesheet",d.href=t,d.media="only x",function e(t){if(a.body)return t();setTimeout(function(){e(t)})}(function(){i.parentNode.insertBefore(d,n?i:i.nextSibling)});var u=function(e){for(var t=d.href,n=l.length;n--;)if(l[n].href===t)return e();setTimeout(function(){u(e)})};function c(){d.addEventListener&&d.removeEventListener("load",c),d.media=r||"all"}return d.addEventListener&&d.addEventListener("load",c),d.onloadcssdefined=u,u(c),d};"undefined"!=typeof exports?exports.loadCSS=t:e.loadCSS=t}("undefined"!=typeof global?global:this);
  </script>
  <link rel="shortcut icon" href="画像URL">
  <link rel="canonical" href="URL"/>
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>
  <body>
    <div class="container">
      <?php if(isset($errorMessage['failed_change_password'])):?>
        <div class="error-message"><?php echo hsc($errorMessage['failed_change_password']);?></div>
      <?php endif;?>
      <?php if($complete){ ?>
        <h1>パスワード変更しました。</h1><br>
        <a href="../public/login.php" class="back-btn">会員専用画面</a>
      <?php }else{ ?>
        <form name="change-password" method="POST" action="../public/change_password.php">
          <h1>パスワード変更</h1><br>
          <div class="section-frame">
            <label for="password"><span class="required">必須</span>現在のパスワード:</label>
            <input type="password" name="password" id="password" placeholder="現在のパスワード">
            <?php if(isset($errorMessage['password'])):?>
              <div class="error-message"><?php echo hsc($errorMessage['password']);?></div>
            <?php endif;?>
          </div><br>
          <div class="section-frame">
            <label for="new_password"><span class="required">必須</span>新しいパスワード:</label>
            <input type="password" name="new_password" id="password" placeholder="新しいパスワード">
            <?php if(isset($errorMessage['new_password'])):?>
              <div class="error-message"><?php echo hsc($errorMessage['new_password']);?></div>
            <?php endif;?>
          </div>
          <div class="section-frame">
            <button type="submit" class="next-btn">パスワード変更</button>
            <a href="../public/member.php" class="back-btn">会員専用画面に戻る</a>
          </div>
        </form>
      <?php } ?>
    </div>
    <!-- <script src="../js/jquery-3.6.0.min.js"></script> -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../js/script.js"></script>
  </body>
</html>