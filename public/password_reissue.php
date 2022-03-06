<?php
/**
 * password_reissue.php
 */
/**
 * session(start)
 * session(regenerate_id)
 * CSRF(check_session_token)
 * error_message(init)
 * complete(false)
 * validation
   (
     email
   )
 * password_reissue($_POST,$complete),complete(true)
 * CSRF(unset(delete_session_token))(double_transmission_prevention)
 * redirect(member.php)
 * post_email(init)
 */
if(!isset($_SESSION)){session_start();}
require_once(__DIR__.'/../security/security.php');
require_once(__DIR__.'/../functions/init.php');
require_once(__DIR__.'/../security/validation.php');
require_once(__DIR__.'/../class/member_auth_process.php');
require_once(__DIR__.'/../functions/redirect.php');
session_id_regenerate();
CSRF_certification();
error_message_init();
//session_password_reissue_error_message_init();
$complete = false;
if($_POST){
  // instance_method
  $validation = new validation();
  /**
  if(count($errorMessage) > 0){
    $_SESSION = $errorMessage;
    redirect_password_reissue_return();
  }
  */
  $errorMessage = $validation->validation_password_reissue($_POST);
  if(empty($errorMessage)){
    // instance_method
    $memberAuthProcess = new member_auth_process();
    list($complete,$errorMessage) = $memberAuthProcess->password_reissue($_POST,$complete);
    if(empty($complete)){
      $errorMessage['failed_password_reissue'] = 'パスワード再発行に失敗しました。';
    }
    CSRF_delete();
  }
}else{
  post_email_init();
}
?>
<!--
 * title
 * read
 * input_text,input_radio,input_select
   (
     email
   )
 * error_message_display
   (
     email
   )
 * CSRF,XSS(token_issuance,htmlspecialchars)
 * form,post(password_reissue.php)
 * link(login.php)
-->
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex,nofollow,noarchive">
  <title>パスワード再発行</title>
  <meta name="description" content="抜粋文">
  <meta name="keywords" content="キーワード" />
  <meta name="format-detection" content="telephone=no">
  <meta name="google-site-verification" content="サーチコンソール認証" />
  <meta property="og:locale" content="ja_JP" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="タイトル" />
  <meta property="og:description" content="抜粋文" />
  <meta property="og:url" content="URL" />
  <meta property="og:image" content="画像URL" />
  <meta property="og:image:secure_url" content="画像URL" />
  <meta name="twitter:site" content="サイト名" />
  <meta name="twitter:domain" content="ドメイン" />
  <meta name="twitter:title" content="タイトル" />
  <meta name="twitter:description" content="抜粋文" />
  <meta name="twitter:creator" content="@作者" />
  <meta name="twitter:card" content="summary" />
  <meta name="twitter:image" content="画像URL" />
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
      <?php if(isset($errorMessage['failed_password_reissue'])):?>
        <div class="error-message"><?php echo hsc($errorMessage['failed_password_reissue']);?></div>
      <?php endif;?>
      <?php if($complete){?>
        <h1>パスワード再発行しました。</h1>
        <br>
        <a href="../public/login.php" class="back-btn">ログイン画面に戻る</a>
      <?php }else{?>
        <form name="password-reissue" action="../public/password_reissue.php" method="POST">
          <h1>パスワード再発行</h1>
          <br>
          <div class="section-frame">
            <label for="email"><span class="required">必須</span>メールアドレス:</label>
            <input type="email" name="email" id="email" placeholder="12345@abc.com" value="<?php echo hsc($_POST['email']);?>">
            <?php if(isset($errorMessage['email'])):?>
              <div class="error-message"><?php echo hsc($errorMessage['email']);?></div>
            <?php endif;?>
          </div>
          <input type="hidden" name="csrf_token" value="<?php echo hsc(CSRF_token());?>">
          <div class="section-frame">
            <button type="submit" class="next-btn">パスワード再発行</button>
            <a href="../public/login.php" class="back-btn">ログイン画面に戻る</a>
          </div>
        </form>
       <?php };?>
    </div>
    <!-- <script src="../js/jquery-3.6.0.min.js"></script> -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../js/script.js"></script>
  </body>
</html>