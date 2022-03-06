<?php
/**
 * regist_form.php
 */
/**
 * session(start)
 * get_data(gender,age,prefecture)
 * session(regenerate_id)
 * CSRF(check_session_token)
 * error_message(init)
 * validation
   (
     user_name
     read_name
     email
     password
     confirm_password
     gender
     age
     birthday
     prefecture
   )
 * define,XSS(POST→SESSION,htmlspecialchars)
   (
     user_name
     read_name
     email
     password
     gender
     age
     birthday
     prefecture
   )
 * redirect(confirm_regist.php)
 * post_email(init)
 */
if(!isset($_SESSION)){session_start();}
//include_once(__DIR__.'/../class/regist_form_data_output.php');
include(__DIR__.'/../functions/data.php');
require_once(__DIR__.'/../security/security.php');
require_once(__DIR__.'/../functions/init.php');
require_once(__DIR__.'/../security/validation.php');
require_once(__DIR__.'/../functions/define.php');
require_once(__DIR__.'/../functions/redirect.php');
// instance_method
/*
$registFormDataOutput = new regist_form_data_output();
$genders = $registFormDataOutput->genders_data_regist_form();
$ages = $registFormDataOutput->ages_data_regist_form();
$prefectures = $registFormDataOutput->prefectures_data_regist_form();
*/
session_id_regenerate();
CSRF_certification();
error_message_init();
//session_regist_error_message_init();
if($_POST){
  // instance_method
  $validation = new validation();
  $errorMessage = $validation->validation_regist($_POST);
  /**
  if(count($errorMessage) > 0){
    $_SESSION = $errorMessage;
    redirect_regist_form_return();
  }
  */
  $_SESSION = define_regist($_POST);
  if(empty($errorMessage)){
    redirect_confirm_regist();
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
     user_name,
     read_name,
     email,
     password,
     confirm_password,
     gender,
     age,
     birthday,
     prefecture
   )
 * error_message_display
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
 * CSRF,XSS(token_issuance,htmlspecialchars)
 * form,post(confirm_regist.php)
 * link(login.php)
-->
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <meta name="robots" content="noindex,nofollow,noarchive">
  <title>新規登録</title>
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
  <!-- bootstrap.min.css -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous"> -->
</head>
<body>
  <div class="container">
    <form name="regist-form" method="POST">
      <h1>新規登録</h1>
      <p>当サービスをご利用する為、<br>ご登録お願い致します。</p>
      <br>
      <div class="section-frame">
        <label for="user_name"><span class="required">必須</span>ユーザー名(漢字):</label>
        <input type="text" name="user_name" id="user_name" placeholder="山田　花子" value="">
        <?php if(isset($errorMessage['user_name'])):?>
          <div class="error-message"><?php echo hsc($errorMessage['user_name']);?></div>
        <?php endif;?>
      </div>
      <div class="section-frame">
        <label for="read_name"><span class="required">必須</span>ヨミガナ(カタカナ):</label>
        <input type="text" name="read_name" id="read_name" placeholder="ヤマダ　ハナコ" value="">
        <?php if(isset($errorMessage['read_name'])):?>
          <div class="error-message"><?php echo hsc($errorMessage['read_name']);?></div>
        <?php endif;?>
      </div>
      <div class="section-frame">
        <label for="email"><span class="required">必須</span>メールアドレス:</label>
        <input type="email" name="email" id="email" placeholder="12345@abc.com" value="<?php echo hsc($_POST['email']);?>">
        <?php if(isset($errorMessage['email'])):?>
          <div class="error-message"><?php echo hsc($errorMessage['email']);?></div>
        <?php endif;?>
      </div>
      <div class="section-frame">
        <label for="password"><span class="required">必須</span>パスワード:<br>(大小英字、小数字、<br>8文字以上100文字以下)</label>
        <input type="password" name="password" id="password" placeholder="1234Abcd">
        <?php if(isset($errorMessage['password'])):?>
          <div class="error-message"><?php echo hsc($errorMessage['password']);?></div>
        <?php endif;?>
      </div>
      <div class="section-frame">
        <label for="confirm_password"><span class="required">必須</span>パスワード(確認):<br>(大小英字、小数字、<br>8文字以上100文字以下)</label>
        <input type="password" name="confirm_password" id="confirm-password" placeholder="1234Abcd">
      </div>
      <div class="section-frame">
        <div class="gender"><span class="required">必須</span>性別:</div>
        <?php foreach($genders as $key => $value){?>
          <?php if(isset($_SESSION['gender']) == $key){?>
          <label class="label-gender"><input type="radio" name="gender" class="radio-circle" value="<?php echo $key;?>" checked><div class="radio-name-frame"><?php echo hsc($value);?></div></label>
          <?php }else{ ?>
          <label class="label-gender"><input type="radio" name="gender" class="radio-circle" value="<?php echo $key;?>"><div class="radio-name-frame"><?php echo hsc($value);?></div></label>
          <?php }?>
        <?php }?>
        <?php if(isset($errorMessage['gender'])):?>
          <div class="error-message"><?php echo hsc($errorMessage['gender']);?></div>
        <?php endif;?>
      </div>
      <div class="section-frame">
        <label for="age"><div class="age"><span class="required">必須</span>年齢:</div></label>
        <select class="age-frame" name="age">
        <?php foreach($ages as $key => $value){?>
          <?php if($_SESSION['age'] == $key){?>
          <option value="<?php echo $key;?>" selected><?php echo hsc($value);?></option>;
          <?php }else{?>
          <option value="<?php echo $key;?>"><?php echo hsc($value);?></option>;
          <?php }?>
        <?php }?>
        </select>
        <?php if(isset($errorMessage['age'])):?>
          <div class="error-message"><?php echo hsc($errorMessage['age']);?></div>
        <?php endif;?>
      </div>
      <div class="section-frame">
        <label for="birthday"><span class="required">必須</span>誕生日:</label>
        <input type="date" name="birthday" id="birthday" min="1920-01-01" max="2021-12-31"  value="2000-01-01" required pattern="\d{4}-\d{2}-\d{2}">
      </div>
      <?php if(isset($errorMessage['birthday'])):?>
        <div class="error-message"><?php echo hsc($errorMessage['birthday']);?></div>
      <?php endif;?>
      <div class="section-frame">
        <label for="prefecture"><div class="prefectures"><span class="required">必須</span>都道府県:</div></label>
        <select class="prefectures-frame" name="prefecture">
        <?php foreach($prefectures as $key => $value){?>
          <?php if($_SESSION['prefecture'] == $key){?>
          <option value="<?php echo $key;?>" selected><?php echo hsc($value);?></option>;
          <?php }else{?>
          <option value="<?php echo $key;?>"><?php echo hsc($value);?></option>;
          <?php } ?>
        <?php } ?>
        </select>
        <?php if(isset($errorMessage['prefecture'])):?>
          <div class="error-message"><?php echo hsc($errorMessage['prefecture']);?></div>
        <?php endif;?>
      </div>
      <input type="hidden" name="csrf_token" value="<?php echo hsc(CSRF_token());?>">
      <div class="section-frame">
        <button type="submit" class="next-btn">確認</button>
        <a href="../public/login.php" class="back-btn">ログイン画面に戻る</a>
      </div>
    </form>
  </div>
  <!-- <script src="../js/jquery-3.6.0.min.js"></script> -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="../js/script.js"></script>
</body>
</html>