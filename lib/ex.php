<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function editorEx(): void
{
  echo "<link rel='stylesheet' href='" . getResourcePath("css/editor.css") . "'>";
  echo "<script src='" . getResourcePath("js/editor.js") . "'></script>";
}

function contentEx(string $text, \Typecho\Widget $widget)
{
  if ($widget instanceof \Widget\Archive) {
    $text = dealingImage($text);
    $text = preg_replace('/<a\s+([^>]*)(?=\s*href=[^>]*)([^>]*)(>.*?<\/a>)/i', "<a $1$2 target=\"_blank\"$3", $text);
  }
  return $text;
}

function dealingImage(string $text): string
{
  return preg_replace_callback(
    '/<img(.*?)src="(.*?)"(.*?)alt="(.*?)"(.*?)>/s',
    function ($matches) {
      $src = $matches[2];
      $alt = $matches[4];
      $imgTag = '<img' . $matches[1] . ' src="' . $src . '" data-fancybox="gallery" alt="' . $alt . '" data-caption="' . $alt . '" data-thumb="' . $src . '" width="auto" height="auto" loading="lazy" />';
      $spanTag = !empty($alt) ? '<div class="article-image-description">' . $alt .'</div>' : '';
      return '<div class="article-image">' . $imgTag . $spanTag . '</div>';
    },
    $text
  );
}

function commentReplyEx()
{
  echo "<button class='reply-button' aria-label='回复评论'><i class='ri-at-line'></i></button>";
}

function commentEx($comments, $post, $last)
{
  $comment = empty($last) ? $comments : $last;  //提升同接口插件间的兼容性
  if (!validateToken($_POST["token"])) {
    throw new Exception("token无效");
  }
  return $comment;
}