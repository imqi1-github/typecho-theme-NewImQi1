<?php

use Typecho\Db;
use Typecho\Widget;
use Utils\Helper;


function generateNonce()
{
  // 生成一个32字节的随机字符串，并转换为Base64编码
  $nonce = base64_encode(random_bytes(32));

  // 清理Base64字符串中的"="符号，因为它在URL中可能导致问题
  return rtrim($nonce, '=');
}

function getResourcePath(string $filepath = ""): string
{
  static $cachedResults = [];

  if (isset($cachedResults[$filepath])) {
    return $cachedResults[$filepath];
  }

  $staticUrl = Helper::options()->staticUrl ?: Helper::options()->themeUrl . "/public";
  if ($filepath) {
    $staticUrl .= "/" . $filepath;
  }

  $cachedResults[$filepath] = $staticUrl;

  return $staticUrl;
}


function echoResourcePath(string $filepath = ""): void
{
  echo getResourcePath($filepath);
}

function echoCrumb(Widget $widget): void
{
  if ($widget->is("index")) {
    echo "<span>ImQi1</span>";
  } elseif ($widget->is("post")) {
    echo "<a href='/'>ImQi1</a> <span>/</span> <span><a href='" . $widget->categories[0]['permalink'] . "'>";
    echo "<i class=\"ri-menu-line\"></i> " . $widget->categories[0]['name'] . "</a></span> ";
    echo "<span>/</span> <span>" . $widget->title . "</span>";
  } elseif ($widget->is("page")) {
    echo "<a href='/'>ImQi1</a> <span>/</span> ";
    echo "<span><i class='ri-file-3-line'></i> " . $widget->title . "</span>";
  } elseif ($widget->is("category")) {
    echo "<a href='/'>ImQi1</a> <span>/</span> <span>";
    echo $widget->archiveTitle("", "<i class=\"ri-menu-line\"></i> ") . "</span>";
  } elseif ($widget->is("tag")) {
    echo "<a href='/'>ImQi1</a> <span>/</span> <span>";
    echo $widget->archiveTitle("", "# ") . "</span>";
  } elseif ($widget->is("search")) {
    echo "<a href='/'>ImQi1</a> <span>/</span> <span>";
    echo $widget->archiveTitle("", "<i class=\"ri-search-line\"></i> ") . "</span>";
  } else {
    echo '<a href="/">ImQi1</a> <span>/</span> <span><i class="ri-close-large-fill"></i> 页面未找到</span>';
  }
}

function echoRandomArticle(): void
{
  $db = Db::get();
  $result = $db->fetchAll($db->select()->from('table.contents')
    ->where('status = ?', 'publish')
    ->where('type = ?', 'post')
    ->where('created <= unix_timestamp(now())', 'post')
    ->where('password is NULL')
    ->limit(1)
    ->order('RAND()')
  );
  if (!$result) {
    echo "无文章";
    return;
  }
  $val = Widget::widget('Widget_Abstract_Contents')->push($result[0]);
  echo "<a class='blue' href=\"" . $val["permalink"] . "\">" . $val["title"] . "</a>";
}

function echoFormattedTime(int $time): void
{
  $etime = time() - $time;
  if ($etime < 1) {
    echo '刚刚';
    return;
  }
  $interval = array(
    12 * 30 * 24 * 60 * 60 => '年',
    30 * 24 * 60 * 60 => '个月',
    7 * 24 * 60 * 60 => '周',
    24 * 60 * 60 => '天',
    60 * 60 => '小时',
    60 => '分钟',
    1 => '秒'
  );
  foreach ($interval as $seconds => $unit) {
    $duration = floor($etime / $seconds);
    if ($duration >= 1) {
      echo $duration . $unit . '前';
      return;
    }
  }
}

function echoContentTitle(Widget $widget): void
{
  if ($widget->is("category")) {
    $widget->archiveTitle("", "<i class=\"ri-menu-line\"></i> ");
  } elseif ($widget->is("tag")) {
    $widget->archiveTitle("", "# ");
  } elseif ($widget->is("search")) {
    $widget->archiveTitle("", "<i class=\"ri-search-line\"></i> ");
  } elseif ($widget->is("single")) {
    $widget->archiveTitle("", "");
  }
}

function echoContentDescription(Widget $widget): void
{
  if ($widget->is("single")) {
    echo $widget->fields->description;
  }
}

function contentCoverExists(Widget $widget): bool
{
  return !!$widget->fields->cover;
}

function echoArticleBrief(Widget $widget, int $length = 50): void
{

  // 获取字符串内容和关键词
  $html_content = $widget->content;
  $keyword = $widget->getKeywords();

  // 将HTML内容转换为纯文本
  $content = strip_tags($html_content);

  // 找到关键词在内容中的第一个位置
  $pos = mb_strpos($content, $keyword);

  // 如果找到了关键词
  if ($pos !== false) {
    // 计算前后各取20个字符的位置
    $start = max(0, $pos - 26);
    $end = min(mb_strlen($content), $pos + mb_strlen($keyword) + 26);

    // 截取前后各20个字符
    $before_length = $pos - $start;
    $after_length = $end - ($pos + mb_strlen($keyword));

    $before = mb_substr($content, $start, $before_length);
    $after = mb_substr($content, $pos + mb_strlen($keyword), $after_length);

    // 将前后的扩充部分中的所有空白字符替换为空格
    $before = preg_replace('/\s+/', ' ', $before);
    $after = preg_replace('/\s+/', ' ', $after);

    // 合并新的字符串内容
    $newStr = "..." . $before . "<span class=\"search-word\">" . $keyword . "</span>" . $after . "...";

    // 输出新的字符串
    echo $newStr;
  } else {

    echo mb_substr(strip_tags($widget->excerpt), 0, $length, 'utf-8') . "...";
  }
}

function echoAvatar($comment, int $size = 64): void
{
  $avatarSource = Helper::options()->avatarSource;
  if (str_ends_with($comment->mail, "@qq.com") && preg_match('/^\d+$/', substr($comment->mail, 0, -7))) {
    $url = "https://q1.qlogo.cn/g?b=qq&nk=" . $comment->mail . "&s=640";
  } else if ($avatarSource == "cravatar") {
    $address = strtolower(trim($comment->mail));
    $hash = md5($address);
    $url = 'https://cravatar.cn/avatar/' . $hash;
  } else if ($avatarSource == "weavatar") {
    $address = strtolower(trim($comment->mail));
    $hash = md5($address);
    $url = 'https://weavatar.com/avatar/' . $hash;
  } else {
    $address = strtolower(trim($comment->mail));
    $hash = md5($address);
    $url = 'https://cravatar.cn/avatar/' . $hash;
  }

  echo '<img class="comment-avatar" loading="lazy" src="' . $url . '" alt="' .
    $comment->author . '" width="' . $size . '" height="' . $size . '" />';
}

function echoCommentParent($coid): void
{
  $db = Db::get();
  $prow = $db->fetchRow(
    $db->select('parent')->from('table.comments')->where('coid = ? AND status = ?', $coid, 'approved')
  );

  $parent = $prow['parent'];
  if ($parent != "0") {
    $arow = $db->fetchRow(
      $db->select('text', 'author', 'status')->from('table.comments')->where('coid = ?', $parent)
    );

    $author = $arow['author'];
    $status = $arow['status'];

    $href = "";

    if ($author) {
      if ($status == 'approved') {
        $href = ' <span class="comment-at">回复 @' . $author . '</span>';
      } else if ($status == 'waiting') {
        $href = '<a>评论审核中。</a>';
      }
    }
    echo $href;
  } else {
    echo "";
  }
}

function encryptToken(): string
{
  $key = "imqi1.com";
  $timestamp = time();
  $string = $key . $timestamp;
  $cipher = "aes-256-cbc";
  $iv_length = openssl_cipher_iv_length($cipher);
  $iv = openssl_random_pseudo_bytes($iv_length);
  $encrypted_string = openssl_encrypt($string, $cipher, $key, 0, $iv);
  return base64_encode($iv . $encrypted_string);
}

function validateToken($encrypted_token): bool
{
  try {
    $key = "imqi1.com";
    $cipher = "aes-256-cbc";
    $encrypted_token = base64_decode($encrypted_token);
    $iv_length = openssl_cipher_iv_length($cipher);
    $iv = substr($encrypted_token, 0, $iv_length);
    $encrypted_string = substr($encrypted_token, $iv_length);
    $decrypted_string = openssl_decrypt($encrypted_string, $cipher, $key, 0, $iv);
    $timestamp = substr($decrypted_string, strlen($key));
    if (!is_numeric($timestamp)) return false;
    $current_time = time();
    $validity_period = 1600;
    return ($current_time - $timestamp) <= $validity_period;
  } catch (Exception) {
    return false;
  }
}

function echoTitle(Widget $widget): void
{
  $widget->archiveTitle(array(
    'category' => '分类：%s',
    'search' => '搜索：%s',
    'tag' => '话题： %s',
    'author' => '%s 的文章'
  ), '', ' - ');

  Helper::options()->title();
}

function echoArchive(Widget $widget): void
{
  ob_start();
  $widget->widget('Widget_Contents_Post_Recent', 'pageSize=10000')->to($archiving);

  // 初始化年份和月份
  $year = 0;
  $mon = 0;

  // 初始化输出字符串

  // 遍历文章
  while ($archiving->next()):
    $year_tmp = date('Y', $archiving->created);
    $mon_tmp = date('m', $archiving->created);
    if ($mon != $mon_tmp) {
      if ($mon > 0) echo '</div></div></section>';
      echo '<section class="archiving-period">' . $year_tmp . '年' . $mon_tmp . '月</section><section class="archiving-line-container"><div class="archiving-line"><div class="archiving-articles">';
      $mon = $mon_tmp;
      $year = $year_tmp;
    }
    echo '<div class="archiving-article-item">';
    echo '<span class="archiving-date">' . date('d日', $archiving->created) . '</span><div class="archiving-article">';
    echo '<a class="archiving-article-title" href="' . $archiving->permalink . '">' . $archiving->title . '</a>';
    echo '</div><div class="archiving-marker"></div></div>';
  endwhile;
  if ($year > 0) echo '</div></div></section>';
  $cache_file = __DIR__ . '/../cache/archiving.html';
  $output = ob_get_clean();
  file_put_contents($cache_file, $output);
  ob_end_flush();
  echo $output;
}

function echoUserAgent(string $userAgent)
{
  // 浏览器类型与标识符的映射
  $browsers = [
    'Chrome' => '<i class="ri-chrome-fill"></i>',
    'Firefox' => '<i class="ri-firefox-fill"></i>',
    'Safari' => '<i class="ri-safari-fill"></i>',
    'Edge' => '<i class="ri-edge-new-fill"></i>',
    'MSIE' => '<i class="ri-ie-fill"></i>',
    'Opera' => '<i class="ri-opera-fill"></i>',
  ];

  $ios = '<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"><path d="M5.93794 4.0227C6.5138 4.0227 7.01898 3.79783 7.45346 3.34808C7.88794 2.89834 8.10519 2.37536 8.10519 1.77915C8.10519 1.71367 8.10001 1.62062 8.08967 1.5C8.01381 1.51034 7.95691 1.51895 7.91898 1.52585C7.38794 1.60167 6.9207 1.86187 6.51725 2.30643C6.11381 2.75101 5.91208 3.22661 5.91208 3.73322C5.91208 3.7918 5.9207 3.8883 5.93794 4.0227ZM8.00173 11.9268C8.41208 11.9268 8.86553 11.646 9.36209 11.0842C9.85865 10.5225 10.2379 9.86248 10.5 9.1043C9.52415 8.60113 9.03622 7.87914 9.03622 6.93828C9.03622 6.15253 9.43105 5.4805 10.2207 4.9222C9.67243 4.23637 8.9483 3.89346 8.04829 3.89346C7.66898 3.89346 7.32243 3.95033 7.00864 4.06406L6.81209 4.13643L6.54829 4.23982C6.37587 4.3053 6.21897 4.33805 6.0776 4.33805C5.96725 4.33805 5.82241 4.30013 5.64312 4.22431L5.44138 4.1416L5.25001 4.06406C4.97069 3.94688 4.6707 3.88829 4.35001 3.88829C3.49139 3.88829 2.80173 4.17779 2.28104 4.75677C1.76034 5.33575 1.5 6.09911 1.5 7.04684C1.5 8.38057 1.91724 9.61263 2.75173 10.743C3.33104 11.5322 3.86035 11.9268 4.33966 11.9268C4.54311 11.9268 4.74484 11.8872 4.94483 11.8079L5.19828 11.7045L5.40002 11.6322C5.68277 11.5322 5.94311 11.4823 6.18104 11.4823C6.43277 11.4823 6.72243 11.546 7.05002 11.6735L7.21036 11.7356C7.54483 11.8631 7.80864 11.9268 8.00173 11.9268Z" /></svg>';

  // 设备类型与标识符的映射
  $devices = [
    'Windows NT' => '<span><i class="ri-windows-fill"></i></span>',
    'Macintosh' => '<span><i class="ri-finder-fill"></i></span>',
    'iPhone' => $ios,
    'iPad' => $ios,
    'Linux' => '<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"><path d="M2.39035 11.4351C2.97866 11.5013 3.63967 11.86 4.19285 11.9233C4.749 11.9894 4.9211 11.5668 4.9211 11.5668C4.9211 11.5668 5.54695 11.4351 6.20492 11.42C6.86352 11.4026 7.48696 11.5489 7.48696 11.5489C7.48696 11.5489 7.60786 11.8095 7.83354 11.9233C8.05923 12.0393 8.54513 12.055 8.85654 11.7462C9.16856 11.4351 10.001 11.0433 10.4685 10.7984C10.9389 10.5529 10.8526 10.1785 10.5572 10.0647C10.2619 9.9509 10.0201 9.77153 10.0386 9.42736C10.0547 9.08603 9.77777 8.85846 9.77777 8.85846C9.77777 8.85846 10.0201 8.10739 9.79445 7.48522C9.56876 6.86589 8.82442 5.86985 8.25219 5.12101C7.67996 4.36994 8.16582 3.50284 7.64483 2.3947C7.12377 1.2849 5.77267 1.3505 5.04441 1.82353C4.31615 2.2966 4.53943 3.46974 4.57456 4.02634C4.60969 4.58011 4.59064 4.97638 4.52335 5.11878C4.45607 5.26338 3.98625 5.78858 3.67423 6.22858C3.36281 6.67082 3.13709 7.58389 2.90903 7.96056C2.68572 8.33499 2.84175 8.67633 2.84175 8.67633C2.84175 8.67633 2.68576 8.72676 2.56249 8.97229C2.44159 9.215 2.19983 9.331 1.76453 9.41006C1.33222 9.49356 1.33222 9.7559 1.43644 10.0496C1.54122 10.3427 1.43644 10.507 1.31554 10.8814C1.19468 11.2558 1.79966 11.3695 2.39035 11.4351ZM8.50582 9.72723C8.81486 9.85447 9.25908 9.67733 9.39425 9.5501C9.52885 9.42343 9.62411 9.2351 9.62411 9.2351C9.62411 9.2351 9.75928 9.29843 9.74558 9.49963C9.73127 9.70366 9.83846 9.99457 10.0409 10.0955C10.2434 10.1958 10.5524 10.3359 10.3922 10.476C10.2291 10.6162 9.32636 10.9581 9.05663 11.2249C8.78926 11.49 8.43793 11.7069 8.22414 11.643C8.00802 11.5797 7.81924 11.3017 7.91216 10.8947C8.00802 10.4895 8.08901 10.045 8.07531 9.7911C8.06104 9.5372 8.00802 9.1953 8.07531 9.14483C8.14259 9.09493 8.24978 9.11903 8.24978 9.11903C8.24978 9.11903 8.19613 9.6006 8.50582 9.72723ZM6.50029 2.86777C6.79801 2.86777 7.038 3.14577 7.038 3.48767C7.038 3.73037 6.9171 3.94057 6.74025 4.04147C6.6956 4.0241 6.64913 4.00447 6.59793 3.98427C6.70512 3.9344 6.77952 3.80717 6.77952 3.6603C6.77952 3.46807 6.65391 3.31 6.49608 3.31C6.34246 3.31 6.21441 3.46804 6.21441 3.6603C6.21441 3.7304 6.23289 3.80044 6.26324 3.85537C6.17036 3.82004 6.08639 3.7898 6.01911 3.7657C5.98398 3.68217 5.96312 3.588 5.96312 3.4877C5.96316 3.1458 6.20251 2.86777 6.50029 2.86777ZM5.76307 3.9361C5.90958 3.9602 6.31208 4.12444 6.46099 4.17487C6.60986 4.22307 6.77478 4.31274 6.7587 4.40244C6.74025 4.49491 6.66344 4.49491 6.46099 4.61094C6.26091 4.72474 5.82384 4.97865 5.68389 4.99601C5.54454 5.01338 5.46536 4.93938 5.31645 4.84914C5.16758 4.75721 4.88835 4.54254 4.95857 4.42877C4.95857 4.42877 5.1771 4.27127 5.2724 4.19057C5.36769 4.10704 5.6142 3.9103 5.76307 3.9361ZM5.12115 2.96643C5.35576 2.96643 5.54692 3.2293 5.54692 3.55327C5.54692 3.61214 5.53976 3.66704 5.52847 3.72197C5.47011 3.73934 5.41178 3.76794 5.35576 3.8139C5.32838 3.83577 5.30275 3.85537 5.27955 3.87724C5.31645 3.81167 5.33076 3.7175 5.31408 3.61884C5.28192 3.44397 5.15628 3.3145 5.03301 3.33187C4.90913 3.3515 4.8353 3.5118 4.86508 3.68894C4.89784 3.8683 5.02107 3.99774 5.14672 3.97814C5.15387 3.9759 5.16042 3.97367 5.16758 3.9714C5.10745 4.02634 5.05146 4.07454 4.9931 4.11377C4.8234 4.0392 4.69776 3.81614 4.69776 3.55327C4.6978 3.22707 4.88594 2.96643 5.12115 2.96643ZM3.81411 7.20722C4.05587 6.84852 4.21186 6.06435 4.45363 5.80372C4.6978 5.54365 4.88594 4.98931 4.80021 4.74437C4.80021 4.74437 5.32123 5.33121 5.68389 5.23481C6.04712 5.13615 6.86352 4.56501 6.98439 4.66311C7.10528 4.76174 8.14496 6.91409 8.24975 7.59959C8.35457 8.28453 8.18009 8.80806 8.18009 8.80806C8.18009 8.80806 7.78234 8.70939 7.7311 8.93696C7.67989 9.16676 7.67989 9.99913 7.67989 9.99913C7.67989 9.99913 7.14218 10.6998 6.3097 10.8158C5.47722 10.9296 5.06038 10.8466 5.06038 10.8466L4.59294 10.3427C4.59294 10.3427 4.9562 10.2923 4.90496 9.94867C4.85375 9.60733 3.79499 9.13423 3.60443 8.70936C3.41395 8.28449 3.56937 7.56649 3.81411 7.20722ZM1.75557 9.7777C1.79726 9.60956 2.33673 9.60956 2.54397 9.4913C2.7512 9.37303 2.79285 9.03336 2.96021 8.94369C3.12512 8.85176 3.43002 9.178 3.55567 9.3618C3.67894 9.54116 4.15117 10.3253 4.3441 10.5204C4.5394 10.7171 4.71865 10.9777 4.66267 11.212C4.60969 11.4463 4.31612 11.6173 4.31612 11.6173C4.05353 11.6935 3.3211 11.3959 2.98825 11.2647C2.65541 11.133 1.80862 11.0937 1.69966 10.9777C1.58772 10.8595 1.75324 10.5988 1.79729 10.3516C1.83656 10.1017 1.71333 9.9464 1.75557 9.7777Z" /> ></svg>',
    'Android' => '<span><i class="ri-android-fill"></i></span>',
    'Ubuntu' => '<span><i class="ri-ubuntu-fill"></i></span>',
    "Debian" => '<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"><path d="M6.9218 7.04969C6.7468 7.04969 6.9568 7.13719 7.18474 7.17219C7.24599 7.12844 7.30286 7.07594 7.35536 7.02781C7.21221 7.05927 7.06784 7.06658 6.92224 7.04969M7.85849 6.81781C7.95911 6.67344 8.03349 6.51594 8.06411 6.35406C8.03786 6.47219 7.97661 6.57281 7.91974 6.67344C7.59161 6.87906 7.88911 6.55531 7.91974 6.42844C7.56974 6.87031 7.87161 6.69094 7.85849 6.81781ZM8.20017 5.92094C8.22205 5.6055 8.13892 5.70175 8.11267 5.82425C8.1433 5.84175 8.16955 6.043 8.20017 5.9205M6.26555 1.63563C6.35305 1.65313 6.46242 1.66625 6.4493 1.68813C6.54992 1.66625 6.5718 1.64437 6.26117 1.63563M6.4493 1.68813L6.38367 1.70125L6.44492 1.69687L6.44492 1.68813M9.34686 6.03862C9.35561 6.31862 9.25936 6.45425 9.18061 6.69487L9.02749 6.77406C8.90499 7.01031 9.04061 6.92719 8.95311 7.11531C8.76061 7.28594 8.36686 7.64906 8.24436 7.6845C8.15642 7.6845 8.30561 7.57513 8.32749 7.53575C8.06892 7.71075 8.11705 7.79825 7.72767 7.90763L7.71455 7.88137C6.74286 8.33638 5.3945 7.43512 5.41637 6.2005C5.40324 6.27488 5.38575 6.25737 5.36387 6.288C5.36058 6.24902 5.35875 6.20999 5.3584 6.17088C5.35805 6.13177 5.35919 6.0927 5.36181 6.05372C5.36441 6.01469 5.36848 5.9758 5.37402 5.93708C5.37953 5.89836 5.38652 5.85993 5.39498 5.82175C5.40341 5.78357 5.41326 5.74575 5.42455 5.70832C5.43584 5.67088 5.44853 5.63392 5.46261 5.59743C5.4767 5.56095 5.49213 5.52505 5.5089 5.48973C5.5257 5.45441 5.5438 5.41978 5.5632 5.38583C5.58262 5.35188 5.60328 5.31871 5.62519 5.28632C5.64709 5.25393 5.67019 5.22242 5.69449 5.19177C5.71876 5.16112 5.74416 5.13143 5.7707 5.10271C5.79721 5.07398 5.82478 5.0463 5.85339 5.01965C5.88203 4.993 5.91162 4.96748 5.94216 4.94306C5.97269 4.91865 6.00411 4.89542 6.0364 4.87339C6.06871 4.85135 6.1018 4.83056 6.13566 4.81102C6.16953 4.79148 6.20408 4.77324 6.23931 4.75631C6.30449 4.72352 6.37169 4.69573 6.44094 4.67294C6.51024 4.65015 6.58085 4.63261 6.65269 4.62033C6.72462 4.60805 6.79702 4.60115 6.86991 4.59964C6.94284 4.59814 7.01547 4.60204 7.08779 4.61134C7.16015 4.62064 7.23142 4.63525 7.30155 4.65516C7.37172 4.67507 7.44006 4.70006 7.50647 4.73014C7.57293 4.76021 7.63681 4.79504 7.69806 4.83462C7.75931 4.8742 7.81732 4.9181 7.87205 4.96631C7.83718 4.92109 7.79977 4.87806 7.75987 4.83722C7.71997 4.79638 7.67784 4.75801 7.63339 4.72211C7.58903 4.68622 7.54265 4.65304 7.49436 4.62257C7.44605 4.59211 7.39618 4.56457 7.34464 4.53995C7.29311 4.51534 7.24034 4.49382 7.18627 4.47539C7.13228 4.45696 7.07733 4.44175 7.0215 4.42977C6.96568 4.41778 6.90937 4.40909 6.8525 4.4037C6.79567 4.39832 6.73871 4.39627 6.68161 4.39756C6.16537 4.40194 5.68368 4.73006 5.52181 5.08444C5.25931 5.25069 5.22868 5.72756 5.11493 5.81112C4.957 6.94906 5.40368 7.4395 6.15618 8.017C6.2743 8.10012 6.19118 8.10888 6.20868 8.17013C6.08084 8.10944 5.96056 8.03638 5.84783 7.95089C5.73508 7.86541 5.63223 7.76933 5.53931 7.66262C5.63993 7.807 5.74493 7.95138 5.88931 8.06075C5.64868 7.982 5.33368 7.492 5.24181 7.47013C5.64868 8.19637 6.89555 8.74806 7.54349 8.47638C7.37124 8.48858 7.19939 8.48438 7.02794 8.46378C6.85652 8.44317 6.68857 8.40655 6.52411 8.35388C6.37974 8.28387 6.18724 8.13075 6.21787 8.1045C6.27049 8.12664 6.32378 8.14698 6.37777 8.16553C6.43176 8.18408 6.48631 8.20079 6.54144 8.21562C6.59656 8.2305 6.65212 8.24349 6.70812 8.25456C6.76412 8.26567 6.82043 8.27491 6.87704 8.28221C6.93366 8.28952 6.99049 8.29494 7.04745 8.2984C7.10441 8.30186 7.16146 8.30343 7.21851 8.30308C7.27565 8.30269 7.33265 8.30041 7.38957 8.29621C7.44649 8.29197 7.50319 8.28584 7.55972 8.27779C7.61624 8.26974 7.67246 8.25981 7.72829 8.248C7.78411 8.23614 7.8395 8.22245 7.8944 8.20687C7.94936 8.1913 8.00369 8.17389 8.05742 8.15464C8.11119 8.13543 8.16421 8.11439 8.21654 8.09159C8.26886 8.06876 8.3204 8.04421 8.37106 8.01792C8.42172 7.99162 8.47147 7.96362 8.52025 7.93401C8.56903 7.90434 8.61676 7.87306 8.66344 7.84021C8.71012 7.80735 8.75562 7.77292 8.79999 7.737C8.99249 7.58388 9.20686 7.32575 9.26811 7.32137C9.18061 7.46138 9.28561 7.39138 9.21561 7.51388C9.40811 7.19887 9.12811 7.38263 9.41686 6.97137L9.52186 7.11575C9.48249 6.85325 9.84561 6.53781 9.81061 6.12612C9.89374 5.99487 9.89811 6.25737 9.81061 6.5505C9.93749 6.22675 9.84561 6.17863 9.87624 5.91175C9.91124 5.99925 9.95499 6.0955 9.97686 6.18738C9.89811 5.88112 10.0644 5.66237 10.0994 5.48738C10.06 5.4655 9.97686 5.61863 9.95936 5.2555C9.95936 5.09363 10.0031 5.168 10.0206 5.133C9.98561 5.11112 9.90686 4.993 9.85436 4.75631C9.88936 4.69944 9.95061 4.90069 10.0031 4.90506C9.96811 4.72131 9.91561 4.57694 9.91561 4.43256C9.76686 4.13506 9.86311 4.47631 9.74061 4.30131C9.59186 3.824 9.87186 4.19194 9.88936 3.97756C10.1256 4.31444 10.2569 4.83506 10.3185 5.05381C10.2748 4.79131 10.196 4.52881 10.1042 4.28381C10.1742 4.31444 9.99042 3.74088 10.196 4.12194C10.1624 4.02057 10.124 3.92101 10.081 3.82323C10.0381 3.72545 9.9906 3.6299 9.93867 3.53657C9.88674 3.44324 9.83056 3.35254 9.7701 3.26447C9.70968 3.1764 9.64528 3.09134 9.57685 3.00931C9.50852 2.92727 9.43646 2.8486 9.36069 2.77331C9.28491 2.69801 9.20581 2.62642 9.12334 2.55854C9.04092 2.49065 8.95547 2.42676 8.86701 2.36688C8.77859 2.30699 8.68755 2.25137 8.59392 2.2C8.67267 2.27437 8.77767 2.37063 8.7383 2.38375C8.41017 2.18687 8.46705 2.17375 8.41892 2.09063C8.15205 1.98125 8.13455 2.09938 7.95517 2.09063C7.44767 1.81938 7.35142 1.85 6.8868 1.675L6.90867 1.77562C6.5718 1.66625 6.51492 1.81938 6.15181 1.77562C6.12993 1.75813 6.26992 1.71438 6.38367 1.69687C6.05949 1.74063 6.07699 1.63563 5.75762 1.71C5.832 1.65313 5.91512 1.61812 5.99825 1.57C5.73574 1.5875 5.36825 1.72312 5.482 1.60063C5.04931 1.7975 4.28237 2.06875 3.85362 2.47125L3.84093 2.375C3.64406 2.61125 2.98343 3.07981 2.93093 3.38606L2.87362 3.39919C2.77299 3.57419 2.70737 3.77106 2.62424 3.95088C2.49299 4.17838 2.42737 4.03837 2.44924 4.07337C2.18674 4.60713 2.05549 5.05819 1.94174 5.4305C2.02049 5.54862 1.94174 6.15238 1.97237 6.638C1.84112 9.02806 3.65237 11.3525 5.63118 11.8906C5.92431 11.9913 6.35305 11.9913 6.72055 12C6.28742 11.8775 6.23056 11.9344 5.81056 11.7856C5.50431 11.6456 5.43868 11.4794 5.22431 11.2913L5.31181 11.4444C4.887 11.2956 5.06243 11.2606 4.71637 11.1512L4.80824 11.0331C4.67262 11.02 4.44512 10.8013 4.38387 10.6788L4.23512 10.6831C4.05575 10.4639 3.9595 10.3021 3.96825 10.1752L3.91968 10.2627C3.86281 10.1708 3.25468 9.431 3.56968 9.60163C3.51281 9.54912 3.43406 9.51412 3.35093 9.361L3.41218 9.28662C3.25906 9.09412 3.13218 8.84037 3.14093 8.76163C3.22843 8.86662 3.28093 8.89288 3.33781 8.906C2.95281 7.95575 2.93093 8.8535 2.63737 7.94263L2.70299 7.93388C2.65925 7.86387 2.62424 7.78512 2.58924 7.71075L2.61549 7.44825C2.33987 7.1245 2.53674 6.09113 2.57612 5.52238C2.60674 5.28613 2.80799 5.04113 2.96112 4.65569L2.86925 4.63819C3.04424 4.32756 3.89343 3.38169 4.28718 3.43025C4.47531 3.18963 4.24781 3.43025 4.20843 3.369C4.62843 2.93544 4.75968 3.06275 5.04012 2.984C5.34637 2.80856 4.77762 3.054 4.922 2.91794C5.44699 2.78669 5.29387 2.61169 5.98118 2.54606C6.05118 2.58981 5.81056 2.60731 5.75368 2.65981C6.19118 2.44544 7.13224 2.49794 7.74955 2.77794C8.46267 3.11481 9.26374 4.09525 9.29436 5.02319L9.32936 5.03194C9.31186 5.40381 9.38624 5.82863 9.25499 6.218L9.34249 6.03425M5.02306 7.29075L5.00118 7.41325C5.11493 7.56637 5.20681 7.73263 5.35118 7.85512C5.24618 7.6495 5.16743 7.56637 5.02306 7.28638M5.29431 7.27763C5.23306 7.212 5.19806 7.12887 5.15868 7.05013C5.19368 7.19012 5.27243 7.31262 5.34681 7.43512L5.29431 7.27763ZM10.0827 6.2355L10.0521 6.30113C10.0084 6.63363 9.90336 6.96219 9.75024 7.26888C9.92524 6.9495 10.0346 6.59469 10.0784 6.2355M6.29617 1.5525C6.4143 1.50875 6.58492 1.53062 6.7118 1.5C6.54992 1.51312 6.38805 1.52188 6.23056 1.54375L6.29617 1.5525ZM2.16443 3.74962C2.19506 3.999 1.97631 4.09963 2.21256 3.93337C2.34381 3.64462 2.16443 3.85462 2.16881 3.74962M1.88881 4.91381C1.94131 4.74319 1.95443 4.64256 1.97631 4.54631C1.82318 4.73881 1.90193 4.77819 1.88881 4.90944" /></svg>',
    'CentOS' => '<span><i class="ri-coreos-fill"></i></span>',
  ];

  // 判断浏览器类型
  foreach ($browsers as $key => $browser) {
    if (strpos($userAgent, $key) !== false) {
      $browserType = $browser;
      break;
    }
  }

  // 判断设备类型
  foreach ($devices as $key => $device) {
    if (strpos($userAgent, $key) !== false) {
      $deviceType = $device;
      break;
    }
  }

  // 如果没有匹配到浏览器类型，默认给一个“未知浏览器”
  $browserType = $browserType ?? '';

  // 如果没有匹配到设备类型，默认给一个“未知设备”
  $deviceType = $deviceType ?? '';

  echo " <span>$browserType</span> $deviceType";
}


