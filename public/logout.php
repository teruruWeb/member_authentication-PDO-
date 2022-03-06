<?php
/**
 * logout
 */
/**
 * session(start)
 * session(regenerate_id)
 * CSRF(check_session_token)
 * CSRF(unset(delete_session_token))(double_transmission_prevention)
 * session(delete)
 */
if(!isset($_SESSION)){session_start();}
require_once(__DIR__.'/../security/security.php');
require_once(__DIR__.'/../functions/init.php');
session_id_regenerate();
CSRF_certification();
CSRF_delete();
session_delete();
?>
<!--
 * title
 * link(login.php)
-->
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
  <meta name="robots" content="noindex,nofollow,noarchive">
  <title>ログアウト</title>
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
  <!-- bootstrap.min.css -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous"> -->
</head>
<body>
  <div class="container">
    <h1>ログアウト</h1>
    <br><br>
    <div class="section-frame">
      <a href="../public/login.php" class="back-btn">ログイン画面へ</a>
    </div>
  </div>
  <!-- <script src="../js/jquery-3.6.0.min.js"></script> -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="../js/script.js"></script>
</body>
</html>