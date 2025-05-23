<?php

/**
 * 友情链接
 *
 * @package custom
 */

use Utils\Helper;

if (!defined('__TYPECHO_ROOT_DIR__'))
  exit;

$this->need('header.php');
$cover = $this->fields->cover;
?>
<div class="content-box fadeIn">
  <header class="content-title-box<?php if (!$cover) echo ' title-no-cover' ?>">
    <?php if ($cover): ?>
      <img class="content-cover" src="<?php echo $cover . Helper::options()->coverSuffix ?>" alt="封面" data-fancybox data-caption="封面" loading="lazy"/>
    <?php endif ?>
    <div class="content-title"><?php echoContentTitle($this); ?></div>
    <div class="content-description">
      <?php echoContentDescription($this);
      if ($this->user->hasLogin()) : ?>
        <a href="<?php $this->options->adminUrl(); ?>extending.php?panel=ImQi1ex%2Fmanage-links.php"
           class="blue" target="_blank">管理友情链接</a>
      <?php endif ?>
    </div>
  </header>
  <section class="links-container">
    <blockquote class="links-description">友链顺序不分先后，每一个都值得一看。</blockquote>
    <?php
    foreach (ImQi1ex_Plugin::getLink() as $link) : ?>
      <a class="links-item" href="<?php echo $link["url"]; ?>" target="_blank">
        <div class="link-avatar">
          <img src="<?php echo $link["image"] ?: getResourcePath("img/nopic.png") ?>" alt="<?php echo $link["name"] ?>" loading="lazy"/>
        </div>
        <div class="link-text">
          <div class="link-name"><?php echo $link["name"] ?></div>
          <?php if ($link["sort"]): ?>
            <div class="link-class"><?php echo $link["sort"] ?></div><?php endif ?>
        </div>
      </a>
    <?php endforeach;
    ?>
  </section>
  <article class="article-content">
    <?php $this->content() ?>
  </article>
  <section id="link-submit-box">
    <div class="comment-box-title">提交链接</div>
    <div class="comment-box-description">提交链接即代表你已阅读并同意<a class="blue" target="_blank" href="/agreement#title-5">友链协议</a>。
    </div>
    <input type="hidden" id="link-input-token" value="<?php echo encryptToken() ?>">
    <div class="comment-input-row">
      <input type="text" id="link-input-name" placeholder="名称 *">
    </div>
    <div class="comment-input-row">
      <input type="text" id="link-input-url" placeholder="链接 *">
    </div>
    <div class="comment-input-row">
      <input type="text" id="link-input-class" placeholder="分类">
    </div>
    <div class="comment-input-row">
      <input type="text" id="link-input-image" placeholder="头像">
      <button id="link-submit">申请友链</button>
    </div>
  </section>
</div>
<?php
$this->need("footer.php"); ?>
