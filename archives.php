<?php
/**
 * 归档
 *
 * @package custom
 */

if (!defined('__TYPECHO_ROOT_DIR__'))
    exit;
$this->need('header.php');
?>
<div class="archiving-box fadeIn">
  <header class="content-title-box title-no-cover">
    <div class="content-title"><?php echoContentTitle($this); ?></div>
      <?php if ($this->user->hasLogin()) : ?>
        <a href="<?php $this->request->getRequestUrl(); ?>?refresh" class="content-description blue">刷新</a>
      <?php endif ?>
  </header>
    <?php
    $cache_file = __DIR__ . '/cache/archiving.html';
    if (isset($_GET['refresh'])) {
        echoArchive($this);
    } else if (file_exists($cache_file) && (time() - filemtime($cache_file) < 24 * 3600)) {
        readfile($cache_file);
    } else {
        echoArchive($this);
    }
    ?>
</div>
<?php
$this->need("footer.php"); ?>
