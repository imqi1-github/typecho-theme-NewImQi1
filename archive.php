<?php

use Utils\Helper;

if (!defined('__TYPECHO_ROOT_DIR__'))
    exit;
$isNotPhotoSlug = false;
if (Helper::options()->photoSlug && Helper::options()->photoSlug != $this->getArchiveSlug()) {
    $isNotPhotoSlug = true;
}
$this->need('header.php');
?>
<?php if (!$this->have()): ?>
  <div class="error-page fadeIn">
    <div class="error-inner">
      <div class="error-title"><?php echoContentTitle($this); ?></div>
      <div>未找到内容，你可以<a href="/">返回首页</a>。</div>
    </div>
  </div>
<?php else: ?>
  <div class="archive-box fadeIn<?php echo $isNotPhotoSlug ? "" : " photo-slug" ?>">
      <?php if ($isNotPhotoSlug): ?>
        <header class="content-title-box title-no-cover">
          <div class="content-title"><?php echoContentTitle($this); ?></div>
          <div class="content-description"><?php echoContentDescription($this); ?></div>
        </header>
        <section class="archive-articles">
            <?php while ($this->next()):
                if (contentCoverExists($this)) $hasCover = true;
                else $hasCover = false;
                ?>
              <div class="archive-article <?php echo $hasCover ? "archive-has-cover" : "archive-no-cover" ?>">
                  <?php if ($hasCover): ?>
                    <a href="<?php $this->permalink() ?>">
                        <?php
                        if ($this->fields->manyCovers == "on"):
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
                              <img class="archive-article-cover" alt="文章封面"
                                   src="<?php echo $img_link . Helper::options()->photoSuffix ?>"/>
                                <?php break; endforeach; else: ?>
                          <img class="archive-article-cover" alt="文章封面"
                               src="<?php echo $this->fields->cover . Helper::options()->photoSuffix ?>"/>
                        <?php endif; ?>
                    </a>
                  <?php endif ?>
                <div class="archive-article-box">
                  <a class="archive-article-title" href="<?php $this->permalink() ?>">
                      <?php $this->title() ?>
                  </a>
                  <div class="archive-article-info">
                <span class="archive-date" text="最后更新时间">
                  <i class="ri-time-line"></i>
                    <?php echoFormattedTime($this->created); ?>
                </span>
                      <?php if (!$this->is("category") && $this->categories): ?>
                        <span class="archive-category" text="分类">
                          <?php $this->category(" ") ?>
                        </span>
                      <?php endif ?>
                      <?php if (!$this->is("tag") && $this->tags): ?>
                        <span class="archive-tag" text="话题">
                          <?php $this->tags(" ") ?>
                        </span>
                      <?php endif ?>
                    <span class="archive-comment" text="评论数量">
                    <i class="ri-chat-2-line"></i>
                  <?php echo $this->commentsNum > 0 ? $this->commentsNum : "暂无评论" ?>
                  </span>
                  </div>
                  <div class="archive-article-brief">
                      <?php if ($this->is("search")) {
                          echoArticleBrief($this, 60);
                      } else {
                          echo $this->fields->description;
                      } ?>
                  </div>
                </div>
              </div>
            <?php endwhile; ?>
        </section>
      <?php else: ?>
        <section class="photos-container">
            <?php while ($this->next()):
                if ($this->fields->manyCovers == "on"):
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
                      <a href="<?php $this->permalink(); ?>" class="photo-item">
                        <img src="<?php echo $img_link . Helper::options()->photoSuffix ?>"
                             alt="封面" loading="lazy">
                        <div
                            class="photo-name"><?php echo $img_desc != "" ? $img_desc . " - " . $this->title : $this->title ?></div>
                      </a>
                    <?php endforeach; else: ?>
                  <a href="<?php $this->permalink() ?>" class="photo-item">
                    <img src="<?php echo $this->fields->cover . Helper::options()->photoSuffix ?>"
                         alt="封面">
                    <div class="photo-name"><?php $this->title() ?></div>
                  </a>
                <?php endif;
            endwhile; ?>
        </section>
      <?php endif;
      $this->pageNav('<i class="ri-arrow-left-double-line"></i>', '<i class="ri-arrow-right-double-line"></i>', 3, '...'); ?>
  </div>
<?php
endif;
$this->need("footer.php"); ?>
