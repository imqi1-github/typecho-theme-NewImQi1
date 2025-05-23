<?php

use Typecho\Plugin;
use Utils\Helper;

if (!defined('__TYPECHO_ROOT_DIR__'))
  exit;

require_once "lib/utils.php";
require_once "lib/config.php";
require_once "lib/ex.php";

Plugin::factory("Widget_Feedback")->comment = "commentEx";
Plugin::factory("Widget_Comments_Archive")->reply = "commentReplyEx";
Plugin::factory("Widget_Abstract_Contents")->contentEx = "contentEx";
Plugin::factory('admin/write-post.php')->bottom = "editorEx";
Plugin::factory('admin/write-page.php')->bottom = "editorEx";

Helper::options()->commentsAntiSpam = false;
// Helper::options()->commentsMaxNestingLevels = '9999';
// Helper::options()->commentsPageDisplay = 'first';
Helper::options()->commentsOrder = 'DESC';

header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');