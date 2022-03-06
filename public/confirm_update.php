<?php
/**
 * confirm_update.php
 */
/**
 * session(start)
 * get_data(gender,age,prefecture)
 * redirect(login.php)
 * session(regenerate_id)
 * CSRF(check_session_token)
 * error_message(init)
 * complete(false)
 * member_updata(database_update)
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
 * redirect(complete_update.php)
 * post(init)
 */
if(!isset($_SESSION)){session_start();}
//include_once(__DIR__.'/../class/confirm_update_data_output.php');
include(__DIR__.'/../functions/data.php');
require_once(__DIR__.'/../functions/redirect.php');
require_once(__DIR__.'/../security/security.php');
require_once(__DIR__.'/../functions/init.php');
require_once(__DIR__.'/../class/member_auth_process.php');
// instance_method
/*
$confirmUpdateDataOutput = new confirm_update_data_output();
$genders = $confirmUpdateDataOutput->genders_data_confirm_update();
$ages = $confirmUpdateDataOutput->ages_data_confirm_update();
$prefectures = $confirmUpdateDataOutput->prefectures_data_confirm_update();
*/
if(!isset($_SESSION['email'])){
  redirect_login();
}
session_id_regenerate();
CSRF_certification();
error_message_init();
$complete = false;
if(isset($_POST['check'])){
  $memberAuthProcess = new member_auth_process();
  $complete = $memberAuthProcess->member_update($_SESSION,$genders,$ages,$prefectures,$complete);
  if(empty($complete)){
    $errorMessage['failed_member_update'] = '登録更新に失敗しました';
  }
  redirect_complete_update();
}else{
  post_init();
}
?>
<!--
 * title
 * read
 * session_display
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
 * form,post(complete_update.php)
 * link(updete_form.php)
-->
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <!-- Internet Explorer互換モード対応 -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <meta name="robots" content="noindex,nofollow,noarchive">
  <title>登録確認</title>
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
  <link rel="canonical" href="URL" />
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <?php if(isset($errorMessage['failed_member_update'])):?>
      <div class="error-message"><?php echo hsc($errorMessage['failed_member_update']);?></div>
    <?php endif;?>
    <form name="confirm-update-form" method="POST">
    <input type="hidden" name="check" value="checked">
    <h1>更新確認</h1>
    <p>ご入力情報に変更が必要な場合、<br>変更ボタンを押して変更を行って下さい。</p>
    <hr>
    <div class="section-frame">
      <p>ユーザー名(漢字)</p>
      <p>
        <span class="fas fa-angle-double-right"></span>
        <span class="confirm-information"><?php echo hsc($_SESSION['user_name']);?></span>
      </p>
    </div>
    <div class="section-frame">
      <p>ヨミガナ(カタカナ)</p>
      <p>
        <span class="fas fa-angle-double-right"></span>
        <span class="confirm-information"><?php echo hsc($_SESSION['read_name']);?></span>
      </p>
    </div>
    <div class="section-frame">
      <p>メールアドレス</p>
      <p>
        <span class="fas fa-angle-double-right"></span>
        <span class="confirm-information"><?php echo hsc($_SESSION['email']);?></span>
      </p>
    </div>
    <div class="section-frame">
      <p>パスワード</p>
      <p>
        <span class="fas fa-angle-double-right"></span>
        <span class="confirm-information"><?php echo hsc($_SESSION['password']);?></span>
      </p>
    </div>
    <div class="section-frame">
      <p>性別</p>
      <p>
        <span class="fas fa-angle-double-right"></span>
        <span class="confirm-information"><?php echo hsc($genders[$_SESSION['gender']]);?></span>
      </p>
    </div>
    <div class="section-frame">
      <p>年齢</p>
      <p>
        <span class="fas fa-angle-double-right"></span>
        <span class="confirm-information"><?php echo hsc($ages[$_SESSION['age']]);?></span>
      </p>
    </div>
    <div class="section-frame">
      <p>誕生日</p>
      <p>
        <span class="fas fa-angle-double-right"></span>
        <span class="confirm-information"><?php echo hsc($_SESSION['birthday']);?></span>
      </p>
    </div>
    <div class="section-frame">
      <p>都道府県</p>
      <p>
        <span class="fas fa-angle-double-right"></span>
        <span class="confirm-information"><?php echo hsc($prefectures[$_SESSION['prefecture']]);?></span>
      </p>
    </div>
    <div class="section-frame">
      <button type="submit" class="next-btn">更新</button>
      <a href="../public/update_form.php" class="back-btn">変更</a>
    </div>
    </form>
  </div>
  <!-- <script src="../js/jquery-3.6.0.min.js"></script> -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="../js/script.js"></script>
</body>
</html>