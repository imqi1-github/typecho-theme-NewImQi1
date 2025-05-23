<?php

/**
 * 站点地图
 *
 * @package custom
 */

if (!defined('__TYPECHO_ROOT_DIR__'))
    exit;

$this->need("header.php");
?>
<div class="content-box fadeIn">
    <header class="content-title-box title-no-cover">
        <div class="content-title"><?php echoContentTitle($this); ?></div>
        <?php if ($this->user->hasLogin()) : ?>
            <a href="<?php $this->request->getRequestUrl(); ?>?refresh"
               class="content-description blue">刷新</a>
        <?php endif ?>
    </header>
    <?php
    $cacheFile = __DIR__ . '/cache/sitemap.html';
    // 检查缓存文件是否存在并且未过期
    if (!isset($_GET['refresh']) && file_exists($cacheFile) && (time() - filemtime($cacheFile) < 86400)) {
        echo file_get_contents($cacheFile);
    } else {
        ob_start();
        ?>
        <div class="sitemap-list">
            <div class="sitemap-col">
                <div class="sitemap-item">
                    <h3>
                        关于ImQi1</h3>
                    <ul class="sitemap-archive">
                        <li>
                            <a href="/about">ImQi1是什么</a>
                        </li>
                        <li>
                            <a href="/agreement">协议</a>
                        </li>
                        <li>
                            <a href="/link">友情链接</a>
                        </li>
                        <li>
                            <a href="/message">留言</a>
                        </li>
                        <li>
                            <a href="/feed"
                               target="_blank">订阅</a>
                        </li>
                        <li>
                            <a href="/sitemap">站点地图</a>
                        </li>
                        <li>
                            <a href="/sitemap.xml"
                               target="_blank">站点地图(XML)</a>
                        </li>
                        <li>
                            <a href="/archiving">归档</a>
                        </li>
                        <li>
                            <a href="/subscription">我的订阅</a>
                        </li>
                    </ul>
                </div>

                <div class="sitemap-item">
                    <h3>
                        分类</h3>
                    <ul class="sitemap-archive">
                        <?php $this->widget('Widget_Metas_Category_List')->parse('
                    <li><a href="{permalink}">{name}</a> ({count})</li>
                    '); ?>
                    </ul>
                </div>

                <div class="sitemap-item">
                    <h3>
                        最近发布的内容</h3>
                    <?php $this->widget('Widget_Contents_Post_Recent@index1', 'pageSize=5')->to($post); ?>
                    <?php if ($post->have()): ?>
                        <ul class="sitemap-archive">
                            <?php while ($post->next()): ?>
                                <li>
                                    <a href="<?php $post->permalink(); ?>"><?php $post->title(); ?></a>
                                    <span
                                            class="date"><?php $post->date('m.d', $this->modified) ?><?php echo $post->categories ? " | " . $post->categories[0]['name'] : "" ?><?php echo $post->tags ? " · " . $post->tags[0]['name'] : "" ?></span>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
            <div class="sitemap-col">
                <div class="sitemap-item">
                    <h3>
                        话题</h3>
                    <?php $this->widget('Widget_Metas_Tag_Cloud', 'sort=mid&desc=0')->to($tags); ?>
                    <?php if ($tags->have()): ?>
                    <ul class="sitemap-archive">
                        <?php while ($tags->next()): ?>
                            <li>
                                <a href="<?php $tags->permalink(); ?>"><?php $tags->name(); ?></a>
                                (<?php $tags->count(); ?>)
                            </li>
                        <?php endwhile; ?>
                        <?php else: ?>
                            <ul class="sitemap-archive">
                                <li><?php _e('没有任何话题'); ?></li>
                            </ul>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="sitemap-item">
                    <h3>
                        小记</h3>
                    <?php $this->widget('Widget_Archive@index2', 'pageSize=5&type=category', 'mid=1')->to($post); ?>
                    <?php if ($post->have()): ?>
                        <ul class="sitemap-archive">
                            <?php while ($post->next()): ?>
                                <li>
                                    <a href="<?php $post->permalink(); ?>"><?php $post->title(); ?></a>
                                    <span class="date"><?php $post->date('m.d', $this->modified) ?></span>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
            <div class="sitemap-col">
                <div class="sitemap-item">
                    <h3>
                        技术</h3>
                    <?php $this->widget('Widget_Archive@index3', 'pageSize=5&type=category', 'mid=3')->to($post); ?>
                    <?php if ($post->have()): ?>
                        <ul class="sitemap-archive">
                            <?php while ($post->next()): ?>
                                <li>
                                    <a href="<?php $post->permalink(); ?>"><?php $post->title(); ?></a>
                                    <span class="date"><?php $post->date('m.d', $this->modified) ?></span>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>
                </div>
                <div class="sitemap-item">
                    <h3>
                        讨论</h3>
                    <?php $this->widget('Widget_Archive@index4', 'pageSize=5&type=category', 'mid=15')->to($post); ?>
                    <?php if ($post->have()): ?>
                        <ul class="sitemap-archive">
                            <?php while ($post->next()): ?>
                                <li>
                                    <a href="<?php $post->permalink(); ?>"><?php $post->title(); ?></a>
                                    <span class="date"><?php $post->date('m.d', $post->modified) ?></span>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>
                </div>
                <div class="sitemap-item">
                    <h3>
                        摄影</h3>
                    <?php $this->widget('Widget_Archive@index5', 'pageSize=5&type=category', 'mid=2')->to($post); ?>
                    <?php if ($post->have()): ?>
                        <ul class="sitemap-archive">
                            <?php while ($post->next()): ?>
                                <li>
                                    <a href="<?php $post->permalink(); ?>"><?php $post->title(); ?></a>
                                    <span class="date"><?php $post->date('m.d', $this->modified) ?></span>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>

            <div class="sitemap-comment">
                <div class="sitemap-item">
                    <h3>
                        最近评论</h3>
                    <ul class="sitemap-archive">
                        <?php $this->widget('Widget_Comments_Recent')->to($comments); ?>
                        <?php while ($comments->next()): ?>
                            <li><?php $comments->author(false); ?>
                                :
                                <a
                                        href="<?php $comments->permalink(); ?>"><?php $comments->excerpt(100, '...'); ?></a><span><?php echo $comments->time ?></span>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php
        $content = ob_get_clean(); // 获取输出缓存内容并清空缓存
        // 将生成的内容写入缓存文件
        file_put_contents($cacheFile, $content);
        // 输出生成的内容
        echo $content;
    }
    ?>
</div>
<?php $this->need("footer.php"); ?>
