<?php
/**
 * 简洁，精美，功能丰富的主题。
 *
 * @package NewImQi1
 * @author 棋
 * @version 0.0.1
 * @link https://imqi1.com
 */

$resourcePath = getResourcePath();
$homeAnnounce = Helper::options()->homeAnnounce;

use Utils\Helper;

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');

$i = 1;
?>
  <div
      class="index-box fadeIn">
    <div
        id="index-snake-light">
      <img
          src="<?php echo $resourcePath . '/img/snake-Light.svg' ?>"
          alt="蛇"
          width="100%"/>
    </div>
    <div
        id="index-snake-dark">
      <img
          src="<?php echo $resourcePath . '/img/snake-Dark.svg' ?>"
          alt="蛇"
          width="100%"/>
    </div>
    <?php if ($homeAnnounce): ?>
      <section
          class="index-blockquote">
        <?php echo $homeAnnounce ?>
      </section>
    <?php endif ?>
    <section
        class="index-information">
      <div
          class="index-information-box">
        <div
            class="index-nickname">
          棋
        </div>
        <div
            class="index-description">
          前端、后端 /
          NodeJS、Python
        </div>
      </div>
      <img
          class="index-avatar"
          src="<?php echo $resourcePath . '/img/avatar.webp' ?>"
          alt="头像"
          width="100"
          height="100"/>
    </section>
    <section
        class="index-title">
      介绍
    </section>
    <section
        class="index-introduction">
      <p>2025
        年已经到来，在此祝大家新年快乐。</p>
      <p>
        我会在这个站点记录我觉得有趣的东西，相信一定有你感兴趣的，也可以阅读一下以前的文章。<br/><b>随机阅读：</b><?php echoRandomArticle(); ?>
      </p>
      <p>欢迎订阅本站点。<a
            href="/feed"
            class="blue"
            target="_blank">订阅地址</a>
      </p>
      <p>也可以看看我感兴趣的博主都更新了什么文章。<a
            href="/subscription"
            class="blue">我的订阅</a>
      </p>
      <p><a class="blue"
            href="/about">了解更多</a>
      </p>
    </section>
    <section
        class="index-title">
      我 <i
          class="ri-heart-2-fill"></i>
    </section>
    <section
        class="index-introduction">
      <p>
        <span text="听音乐">
          <i class="ri-music-2-fill"></i>
        </span>
        <span
            text="玩游戏">
        <i class="ri-game-fill"></i>
        </span>
        <span
            text="写代码">
        <i class="ri-code-fill"></i>
        </span>
        <span
            text="看电影">
        <i class="ri-video-fill"></i>
        </span>
        <span
            text="骑行">
        <i class="ri-riding-fill"></i>
        </span>
      </p>
    </section>
    <section
        class="index-title">
      我的 <i
          class="ri-tools-fill"></i>
    </section>
    <section
        class="index-introduction">
      <img
          id="index-skill-light"
          src="<?php echo $resourcePath . '/img/skills-light.svg' ?>"
          alt="技能"
          width="100%"/>
      <img
          id="index-skill-dark"
          src="<?php echo $resourcePath . '/img/skills-dark.svg' ?>"
          alt="技能"
          width="100%"/>
    </section>
    <section
        class="index-title">
      最近更新的内容
    </section>
    <section
        class="index-posts">
      <?php while (++$i <= 6):
        $this->next() ?>
        <div
            class="index-post">
          <a class="index-post-title"
             href="<?php $this->permalink(); ?>"><?php $this->title(); ?></a>
          <div
              class="index-post-meta">
            <span
                text="发布时间"><i
                  class="ri-time-line"></i><?php echoFormattedTime($this->created) ?></span>
            <?php if ($this->categories): ?>
              <span
                  text="分类"
                  class="index-post-category"><?php $this->category(' ') ?></span>
            <?php endif ?>
            <?php if ($this->tags) : ?>
              <span
                  text="话题"
                  class="index-post-tag"><?php $this->tags(' ') ?></span>
            <?php endif ?>
            <span
                text="评论数量"><i
                  class="ri-chat-2-line"></i>
                  <?php echo $this->commentsNum > 0 ? $this->commentsNum : "暂无评论" ?></span>
          </div>
        </div>
      <?php endwhile; ?>
      <p class="index-read-more">
        <a href="/archiving">阅读更多
          <i class="ri-arrow-right-fill"></i></a>
      </p>
    </section>
  </div>
<?php
$this->need('footer.php');
