<?php

use Utils\Helper;

if (!defined('__TYPECHO_ROOT_DIR__'))
    exit;

$isIndex = $this->is("index");
?>

</main>
<footer id="footer">
  <div class="footer-inner">
    <div class="footer-part">
      <span>2025 © <a href="https://imqi1.com">ImQi1</a></span>
        <?php if ($isIndex): ?>
          <a href="https://beian.miit.gov.cn" target="_blank">冀ICP备2023007665号</a>
        <?php endif; ?>
    </div>
    <div class="footer-part">
      <a href="/sitemap">站点地图</a>
      <a href="/agreement">协议</a>
      <a href="/subscription">我的订阅</a>
        <?php if ($isIndex): ?>
          <a href="https://travellings.cn/go.html" target="_blank">开往</a>
          <a href="https://foreverblog.cn/go.html" target="_blank">虫洞</a>
        <?php endif; ?>
    </div>
  </div>
</footer>
<div id="search-panel" class="hide" style="display: none;">
  <div class="search-box">
    <div class="search-area">
      <input type="text" id="search-input" placeholder="搜索内容 *" autocomplete="off"/>
      <button id="search-submit" text="搜索" aria-label="搜索"><i class="ri-search-line"></i></button>
    </div>
    <div class="search-close">双击可关闭搜索，或者点我关闭</div>
  </div>
</div>
<div id="loading-box">
  内容加载中...
</div>
<div id="footer-button-box">
  <button id="to-top" class="hide" text="返回顶部" aria-label="返回顶部">
    <i class="to-top-icon ri-arrow-up-line"></i>
    <svg id="scroll-progress" viewBox="0 0 30 30">
      <circle class="ring-progress" cx="15" cy="15" r="11"></circle>
    </svg>
  </button>
  <button id="switch-theme" text="切换主题" aria-label="切换主题"><i class="ri-sun-line"></i></button>
    <?php if (is_string(Helper::options()->musicId) && Helper::options()->musicId != ""): ?>
      <button id="music-box" class aria-label="切换音乐播放">
        <span id="music-backdrop"></span>
        <span id="music-box-text">播放音乐</span>
        <span id="music-name">歌曲名称</span>
        <img id="music-cover" src="<?php echoResourcePath("img/nopic.png"); ?>" alt="歌曲封面"/>
      </button>
    <?php endif; ?>
  <button id="footer-button" title="菜单切换" aria-label="菜单切换"><i class="ri-menu-line"></i></button>
</div>
<div id="notify-wrapper" style="display: none"></div>
<div id="menu" style="display: none; left: 0; top: 0;">
  <ul class="icons show">
    <li id="back"><i class="ri-arrow-left-line"></i></li>
    <li id="forward"><i class="ri-arrow-right-line"></i></li>
    <li id="refresh"><i class="ri-restart-line"></i></li>
    <li><a href="/"><i class="ri-home-4-line"></i></a></li>
  </ul>
  <ul class="default" style="display: none;">
    <li><a href="/"><i class="ri-home-4-line"></i>访问首页</a></li>
    <li id="refresh-li"><i class="ri-restart-line"></i>刷新页面</li>
    <li><a href="/agreement"><i class="ri-file-line"></i>查看协议</a></li>
    <li id="copyLink"><i class="ri-clipboard-line"></i>复制本页链接</li>
  </ul>
  <ul class="text" style="display: none;">
    <li id="copyText"><i class="ri-file-copy-2-line"></i>复制文本</li>
    <li><a href id="siteSearch"><i class="ri-search-2-line"></i>站内搜索</a></li>
  </ul>
  <ul class="icons text" style="display: none;">
    <li id="baiduSearch"><i class="ri-baidu-fill"></i></li>
    <li id="bingSearch">
      <svg class="icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg"
           width="16" height="16">
        <path
            d="M176.19999969 32L368 99.44V774.39999969l270.12-155.79999938-132.40000031-62.20000031-83.59999969-208.00000031 425.59999969 149.52v217.40000062L368.12 992l-191.88-106.8V32z"
        ></path>
      </svg>
    </li>
    <li id="googleSearch">
      <i class="ri-google-fill"></i></li>
  </ul>
  <ul class="link" style="display: none;">
    <li class="copyLinkName"><i class="ri-file-copy-2-line"></i>复制链接文字</li>
    <li class="copyLinkAddr"><i class="ri-file-copy-2-line"></i>复制链接地址</li>
    <li class="goLinkAddr"><i class="ri-share-box-line"></i>打开链接</li>
    <li class="gotoLinkAddr"><i class="ri-share-box-line"></i>新窗口打开链接</li>
  </ul>
  <ul class="input" style="display: none;">
    <li class="copyText"><i class="ri-clipboard-line"></i>复制内容</li>
    <li class="pasteText"><i class="ri-clipboard-line"></i>粘贴内容</li>
  </ul>
  <div class="menu-remind">按住ctrl可打开默认菜单</div>
</div>
</body>
</html>