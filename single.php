<?php

use Utils\Helper;

if (!defined('__TYPECHO_ROOT_DIR__'))
    exit;

$this->need("header.php");
$cover = $this->fields->cover;
$toc = $this->fields->toc == "show";
$photoSlug = $this->category && $this->categories[0]["slug"] == Helper::options()->photoSlug;
?>
<div class="content-box fadeIn<?php if ($toc) echo " article-has-toc";
if ($photoSlug) echo " photo-content" ?>">
  <header class="content-title-box<?php if (!$cover) echo ' title-no-cover' ?>">
      <?php if ($this->fields->manyCovers == "on"): ?>
        <div class="swiper-container">
          <div class="swiper-wrapper">
              <?php
              foreach (explode("\n", $this->fields->cover) as $line):
                  if (trim($line) == "") continue;
                  if (str_contains($line, '||')) {
                      list($img_link, $img_desc) = explode('||', $line);
                      $img_link = trim($img_link);
                  } else {
                      $img_link = trim($line);
                      $img_desc = "";
                  }
                  ?>
                <div class="swiper-slide">
                  <img class="swiper-img" src="<?php echo $img_link ?>"
                       alt="<?php echo $img_desc ?>" loading="lazy" data-fancybox="gallery"
                       data-caption="<?php echo $img_desc ?>">
                    <?php if ($img_desc): ?>
                      <div class="swiper-slide-title"><?php echo $img_desc; ?></div>
                    <?php endif ?>
                </div>
              <?php endforeach; ?>
          </div>
          <div class="swiper-buttons">
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
          </div>
        </div>
      <?php elseif ($photoSlug): ?>
        <img class="content-big-cover" data-fancybox="gallery" data-caption="封面" loading="lazy"
             src="<?php echo $cover . Helper::options()->coverSuffix ?>" alt="封面"/>
      <?php elseif ($cover): ?>
        <img class="content-cover" data-fancybox="gallery" data-caption="封面" loading="lazy"
             src="<?php echo $cover . Helper::options()->coverSuffix ?>" alt="封面"/>
      <?php endif; ?>
    <div class="content-title"><?php echoContentTitle($this); ?></div>
    <div class="content-description">
        <?php echoContentDescription($this);
        if ($this->user->hasLogin()) :
            if ($this->is("post")) : ?>
              <a href="<?php $this->options->adminUrl(); ?>write-post.php?cid=<?php $this->cid(); ?>"
                 class="blue" target="_blank">编辑此文章</a>
            <?php else: ?>
              <a href="<?php $this->options->adminUrl(); ?>write-page.php?cid=<?php $this->cid(); ?>"
                 class="blue" target="_blank">编辑此页面</a>
            <?php endif; endif; ?>
    </div>
  </header>
  <article class="article-content">
      <?php if ($toc): ?>
        <div id="toc"></div>
        <div class="content">
            <?php $this->content(); ?>
        </div>
      <?php else: ?>
          <?php $this->content(); ?>
      <?php endif ?>
  </article>
    <?php if ($this->is("post")) : ?>
      <section class="article-information">
        <div class="article-updated">
          <div class="article-information-title">最近修改</div>
          <div class="article-information-content">
            此文章最后更新于<b><?php echoFormattedTime($this->modified) ?></b>。
          </div>
        </div>
          <?php if ($this->tags): ?>
            <div class="article-tags">
              <div class="article-information-title">话题</div>
              <div class="article-information-content">
                <span><?php $this->tags('</span> <span>', true) ?></span>
              </div>
            </div>
          <?php endif ?>
        <div class="article-copyright">
          <div class="article-information-title">版权</div>
          <div class="article-information-content">
            除非另有声明，本网站内容采用<a target="_blank"
                                          href="https://creativecommons.org/licenses/by-nc-sa/4.0/deed.zh-hans">知识共享署名-非商业性使用-相同方式</a>共享授权。
          </div>
        </div>
          <?php $this->related(5)->to($relatedPosts);
          if ($relatedPosts->length > 0):
              ?>
            <div class="article-related">
              <div class="article-information-title">相关内容</div>
              <div class="article-information-content">
                  <?php
                  while ($relatedPosts->next()): ?>
                    <a href="<?php $relatedPosts->permalink(); ?>">
                        <?php $relatedPosts->title(); ?>
                    </a>
                  <?php endwhile; ?>
              </div>
            </div>
          <?php endif ?>
      </section>
    <?php endif ?>
    <?php if ($this->is("post") || $this->is("page") && $this->allow("comment")): ?>
      <section id="comment-box" data-comment-link="<?php $this->commentUrl() ?>">
          <?php if ($this->allow("comment")) : ?>
            <div id="comment-input-box">
              <div class="comment-box-title">评论</div>
              <div class="comment-box-description">评论即代表你已阅读并同意<a
                    href="/agreement#title-2" class="blue" target="_blank">评论协议</a>。
              </div>
              <div class="comment-input-row comment-inputs">
                <textarea id="comment-content-input"
                          placeholder="评论内容 *"><?php $this->remember('text'); ?></textarea>
              </div>
              <div class="comment-input-row comment-inputs">
                <input type="hidden" id="comment-input-token" value="<?php echo encryptToken() ?>"/>
                <input type="hidden" id="comment-input-reply" value="-1"/>
                  <?php if ($this->user->hasLogin()) : ?>
                    <input type="hidden" id="comment-input-name" value="<?php $this->user->name() ?>"/>
                    <input type="hidden" id="comment-input-mail" value="<?php $this->user->mail() ?>"/>
                    <input type="hidden" id="comment-input-link" value="<?php $this->user->url() ?>"/>
                    <p>
                      已登录：<?php $this->user->screenName() ?>
                        <?php if ($this->allow("comment")): ?>
                          <a target="_blank" class="blue"
                             href="<?php echo Helper::options()->adminUrl . "manage-comments.php?cid=" . $this->cid ?>">
                            管理此内容评论
                          </a>
                        <?php endif ?>
                    </p>
                  <?php else: ?>
                    <input type="text" id="comment-input-name" placeholder="昵称 *"
                           value="<?php $this->remember('author') ?>"/>
                    <input type="text" id="comment-input-mail" placeholder="邮箱"
                           value="<?php $this->remember('mail') ?>"/>
                    <input type="text" id="comment-input-link" placeholder="链接"
                           value="<?php $this->remember('url') ?>"/>
                  <?php endif ?>
                <div class="comment-buttons">
                  <button id="emoji"><i class="ri-emoji-sticker-line"></i></button>
                  <button id="commentSubmit">提交评论</button>
                  <button id="cancel-reply" style="display: none">取消回复</button>
                </div>
                <div id="emoji-box" style="display: none;">
                  <div class="emoji-list">表情加载中</div>
                  <div class="emoji-class"></div>
                </div>
                <div class="emoji-backdrop"></div>
              </div>
            </div>
              <?php $this->need("comment.php") ?>
          <?php else: ?>
            <div id="comment-forbidden"><i class="ri-error-warning-fill"></i> 此内容未开放评论</div>
          <?php endif;
          ?>
      </section>
    <?php endif ?>
</div>
<?php $this->need("footer.php"); ?>
