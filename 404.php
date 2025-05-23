<?php
if (!defined('__TYPECHO_ROOT_DIR__'))
    exit;

$this->need('header.php');
?>
  <div class="error-page fadeIn">
    <div class="error-inner">
      <div class="error-title"><i class="ri-close-large-fill"></i> 页面未找到</div>
      <div>未找到内容，你可以<a href="/">返回首页</a>。</div>
    </div>
  </div>
<?php $this->need("footer.php"); ?>
