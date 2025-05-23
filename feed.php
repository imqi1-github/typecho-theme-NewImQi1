<?php

/**
 * 订阅
 *
 * @package custom
 */

use Utils\Helper;

if (!defined('__TYPECHO_ROOT_DIR__'))
    exit;
$this->need('header.php');

// 设置缓存过期时间（单位：秒，3小时）
$expiry = 3 * 60 * 60; // 3小时

$db = \Typecho\Db::get();

// 模拟 feed 数据（可以替换成真实数据获取的逻辑）
$feeds = $db->fetchAll($db->select("name", "avatar", "feed")->from("table.feeds"));

// 检查是否需要刷新缓存
$refresh = isset($_GET['refresh']);

$cover = $this->fields->cover;
?>
<div class="content-box fadeIn">
    <header class="content-title-box<?php if (!$cover) echo ' title-no-cover' ?>">
        <?php if ($cover): ?>
            <img class="content-cover"
                 src="<?php echo $cover . Helper::options()->coverSuffix ?>"
                 alt="封面"
                 data-fancybox
                 data-caption="封面"/>
        <?php endif ?>
        <div class="content-title"><?php echoContentTitle($this); ?></div>
        <div class="content-description">
            最后更新于 <?php echo date("Y-m-d H:i:s", filemtime(ImQi1ex_Plugin::filePath())) ?>
            <?php if ($this->user->hasLogin()) : ?>
                <a href="<?php $this->options->adminUrl(); ?>extending.php?panel=ImQi1ex%2Fmanage-feeds.php"
                   class="blue"
                   target="_blank">管理订阅列表</a>
                <a href="<?php $this->request->getRequestUrl(); ?>?refresh"
                   class="blue">刷新</a>
            <?php endif ?>
        </div>
    </header>
    <section class="feed-content-box">
        <?php // 检查缓存文件是否存在且未过期
        ImQi1ex_Plugin::echoCache();
        if ($refresh || !file_exists(ImQi1ex_Plugin::filePath()) || time() - filemtime(ImQi1ex_Plugin::filePath()) > $expiry) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, Helper::options()->siteUrl . "update-feed-cache?token=" . encryptToken()); // 目标 URL
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT_MS, 100);
            curl_exec($ch);
            curl_close($ch);
        }
        ?>
    </section>
    <article class="article-content">
        <?php $this->content() ?>
    </article>
</div>
<?php
$this->need("footer.php"); ?>
