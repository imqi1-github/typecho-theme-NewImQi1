<?php

use Typecho\Plugin;

if (!defined('__TYPECHO_ROOT_DIR__'))
    exit;

if (!array_key_exists("ImQi1ex", Plugin::export()["activated"])) {
    throw new Exception("ImQi1 配套插件未开启");
}

$nonceValue = generateNonce();
$resourcePath = getResourcePath();
$iconPath = $resourcePath . "/img/imqi1-64.ico";
$cssMainPath = $resourcePath . "/css/main.css";
$fontCssPath = $resourcePath . "/font/font.css";
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Content-Security-Policy"
        content="script-src 'self' 'nonce-<?= $nonceValue ?>' https://cdn.imqi1.com;">
  <meta name="renderer" content="webkit">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <meta name="generator" content="Typecho">
  <meta name="theme" content="NewImQi1">
  <meta name="baidu-site-verification" content="codeva-Ae2TKK5amm"/>
  <meta name="google-site-verification" content="rdosrGRHzIOwhkBpCLAcTEqdBAHFkYBk4OInN3X_qEI"/>
  <meta name="author" content="棋">
  <meta name="copyright" content="棋">
  <meta name="keyword" content="棋,ImQi1,棋的小站,生活,技术,拍照,建站,Python,Linux,编程,学习,科技,社会">
  <meta name="description"
        content="ImQi1是一个汇集技术分享、生活摄影和多样兴趣的个人网站。探索最新的技术踩坑记录、精彩的生活摄影作品，以及对时事和兴趣话题的深入讨论。">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="theme-color" content="#f9fafb">
  <meta name="x5-fullscreen" content="true">
  <meta name="full-screen" content="yes">
  <meta name="resource-prefix" content="<?php echo $resourcePath; ?>"/>
  <title><?php echoTitle($this) ?></title>
  <link rel="canonical" href="<?php echo $this->request->getRequestUrl(); ?>"/>
  <link rel="dns-prefetch" href="https://cdn.imqi1.com">
  <link rel="alternate" type="application/rss+xml" title="ImQi1订阅" href="/feed">
  <link rel="icon" href="<?php echo $iconPath; ?>" sizes="64x64">
  <link rel="apple-touch-icon" href="<?php echo $iconPath; ?>"/>
  <link rel="bookmark" href="<?php echo $resourcePath . '/favicon.ico'; ?>">
  <link rel="manifest" href="<?php echo $resourcePath . '/imqi1-manifest.json'; ?>">
  <link rel="icon" href="https://cdn.imqi1.com/static/img/imqi1-512.png" sizes="512x512">
  <link rel="icon" href="https://cdn.imqi1.com/static/img/imqi1-144.png" sizes="144x144">
  <link rel="stylesheet" href="<?php echo $cssMainPath; ?>">
  <link rel="stylesheet" href="<?php echo $fontCssPath; ?>">
  <link rel="stylesheet" href="<?php echo $resourcePath . '/css/sm1.css'; ?>" media="(max-width: 768px)">
  <link rel="stylesheet" href="<?php echo $resourcePath . '/css/sm2.css'; ?>" media="(max-width: 460px)">
  <link rel="stylesheet" href="<?php echo $resourcePath . '/css/md1.css'; ?>" media="(width > 460px) and (width <= 690px)">
  <link rel="stylesheet" href="<?php echo $resourcePath . '/css/md2.css'; ?>" media="(max-width: 1280px)">
  <link rel="stylesheet" href="<?php echo $resourcePath . '/css/md3.css'; ?>" media="(max-width: 950px) and (min-width: 690px)">
  <script defer src="<?php echoResourcePath("js/main.js"); ?>" crossorigin="anonymous"></script>
  <script nonce="<?= $nonceValue ?>">
    (() => {
      let themeExpireTime = localStorage.getItem("theme-dark-expire");
      if (themeExpireTime && new Date().getTime() > themeExpireTime) {
        localStorage.removeItem("theme-dark");
        localStorage.removeItem("theme-dark-expire");
      }
      let theme = localStorage.getItem("theme-dark");
      if (theme && theme === "true") {
        document.documentElement.className = "skin-dark";
      } else if (theme && theme === "false") {
        document.documentElement.className = "skin-light";
      } else if (window.matchMedia("(prefers-color-scheme: dark)").matches) {
        document.documentElement.className = "skin-dark";
      } else {
        document.documentElement.className = "skin-light";
      }
      setTimeout(() => {
        let box = document.querySelector("#loading-box:not(.hide)");
        if (!box) return;
        box.innerText = "点击可去除此遮罩";
        box.addEventListener("click", () => {
          box.classList.add("hide");
          box.classList.add("loading-done");
          document.querySelectorAll(".fadeIn").forEach(el => {
            el.classList.remove("fadeIn");
            el.classList.add("fadeInPace")
          })
          setTimeout(() => {
            box.innerText = "页面加载中..."
          }, 150)
        })
      }, 1000);
    })()
  </script>
</head>
<body>
<div id="main" class="loading">
  <div id="holder">
    <div class="holder-title">
      <a href="/"> ImQi1 </a>
    </div>
  </div>
  <nav id="nav">
    <div id="nav-title">
        <?php echoCrumb($this); ?>
    </div>
    <div id="nav-menu">
      <span id="search-button" class="nav-pages-item">
        <i class="ri-search-line"></i> 搜索
      </span>
      <span id="category-button" tabindex="0">
          <span id="category-title" class="nav-pages-item">
            <i class="ri-menu-line"></i> 分类
          </span>
          <span id="category-items">
            <a class="nav-page-item" href="/note">
                <i class="ri-pencil-fill"></i>
              <span class="nav-category-title">小记</span>
            </a>
            <a class="nav-page-item" href="/shot">
                <i class="ri-camera-fill"></i>
              <span class="nav-category-title">图片</span>
            </a>
            <a class="nav-page-item" href="/tech">
                <i class="ri-cpu-line"></i>
              <span class="nav-category-title">技术</span>
            </a>
            <a class="nav-page-item" href="/discuss">
                <i class="ri-chat-1-fill"></i>
              <span class="nav-category-title">讨论</span>
            </a>
          </span>
        </span>
      <a class="nav-pages-item" href="/message">
        <i class="ri-chat-1-line"></i> 留言
      </a>
      <a class="nav-pages-item" href="/link">
        <i class="ri-group-line"></i> 友链
      </a>
      <a class="nav-pages-item" href="/about">
        <i class="ri-user-line"></i> 关于
      </a>
    </div>
  </nav>
  <main id="content">