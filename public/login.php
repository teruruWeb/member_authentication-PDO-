<?php
/**
 * login.php
 */
/**
 * session(start)
 * session_timeout(30minute)
 * error_message(init)
 * complete(false)
 * validation
   (
     email
     password
   )
 * member_search
 * member_authentication,complete(true)
 * redirect(member.php)
 * post_email(init)
 */
if(!isset($_SESSION)){session_start();}
require_once(__DIR__.'/../security/security.php');
require_once(__DIR__.'/../functions/init.php');
require_once(__DIR__.'/../security/validation.php');
require_once(__DIR__.'/../class/member_auth_process.php');
require_once(__DIR__.'/../functions/redirect.php');
require_once(__DIR__.'/../config/env.php');
//require_once(__DIR__.'/../config/lolipop_env.php');
session_timeout_exit();
error_message_init();
//session_login_error_message_init();
$complete = false;
if($_POST){
  // instance_method
  $validation = new validation();
  $errorMessage = $validation->validation_login($_POST);
  /**
  if(count($errorMessage) > 0){
    $_SESSION = $errorMessage;
    redirect_login_return();
  }
  */
  if(empty($errorMessage)){
    // instance_method
    $memberAuthProcess = new member_auth_process();
    $row = $memberAuthProcess->member_search($_POST);
    list($complete,$errorMessage) = $memberAuthProcess->member_authentication($row,$_POST,$complete);
    if(empty($complete)){
      $errorMessage['failed_member_authentication'] = 'ログインに失敗しました';
    }
  }
  if($errorMessage){
    $memberAuthProcess = new member_auth_process();
    $row = $memberAuthProcess->member_search($_POST);
    $memberAuthProcess->login_failed_count_up($row,$_POST);
    $loginFailedCount = $memberAuthProcess->get_login_failed_count($_POST);
    if(is_numeric(LOGIN_FAILED_COUNT)){
      if($loginFailedCount['login_failed_count'] === LOGIN_FAILED_COUNT){
        $memberAuthProcess = new member_auth_process();
        $accountLock = $memberAuthProcess->lock_login_account($_POST);
        if($accountLock){
          $errorMessage['lock_login_account'] = 'アカウントがロックされました。'."\n".'時間を置いてからお試し下さい。';
        }
      }else if($loginFailedCount['login_failed_count'] >= LOGIN_FAILED_COUNT + 1){
        $memberAuthProcess = new member_auth_process();
        $row = $memberAuthProcess->member_search($_POST);
        if($row['login_lock_time']){
          $currentLockTime = strtotime('now') - strtotime($row['login_lock_time']);
          if($currentLockTime < LOGIN_LOCK_TIME){
            redirect_login();
          }else{
            $memberAuthProcess = new member_auth_process();
            $memberAuthProcess->unlock_login_account($_POST);
            $memberAuthProcess->login_failed_count_up($row,$_POST);
          }
        }
      }
    }
  }
}else{
  post_email_init();
}
?>
<!--
 * title
 * read
 * input_text
   (
     email,
     password
   )
 * CSRF,XSS(token_issuance,htmlspecialchars)
 * form,post(member.php)
 * link(regist_form.php,password_reissue.php)
-->
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
  <meta name="robots" content="noindex,nofollow,noarchive">
  <title>ログイン</title>
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
    <?php if(isset($errorMessage['failed_member_authentication'])):?>
      <div class="error-message"><?php echo hsc($errorMessage['failed_member_authentication']);?></div>
    <?php endif;?>
    <?php if(isset($errorMessage['lock_login_account'])):?>
      <div class="error-message"><?php echo hsc($errorMessage['lock_login_account']);?></div>
    <?php endif;?>
    <form name="login-form" method="POST">
      <h1>ログイン</h1>
      <p>メールアドレスとパスワードを入力して、<br>ログインして下さい。</p>
      <br>
      <div class="section-frame">
        <label for="email"><span class="required">必須</span>メールアドレス:</label>
        <input type="email" name="email" id="email" placeholder="12345@abc.com" value="<?php echo hsc($_POST['email']);?>">
        <?php if(isset($errorMessage['email'])):?>
          <div class="error-message"><?php echo hsc($errorMessage['email']);?></div>
        <?php endif;?>
      </div>
      <div class="section-frame">
        <label for="password"><span class="required">必須</span>パスワード:</label>
        <input type="password" name="password" id="password">
        <?php if(isset($errorMessage['password'])):?>
          <div class="error-message"><?php echo hsc($errorMessage['password']);?></div>
        <?php endif;?>
      </div>
      <input type="hidden" name="csrf_token" value="<?php echo hsc(CSRF_token());?>">
      <div class="section-frame">
        <button type="submit" class="next-btn">ログイン</button>
        <a href="../public/regist_form.php" class="back-btn">新規登録</a>
        <a href="../public/password_reissue.php" class="back-btn">パスワード再発行</a>
      </div>
    </form>
  </div>
  <!-- <script src="../js/jquery-3.6.0.min.js"></script> -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="../js/script.js"></script>
</body>
</html>