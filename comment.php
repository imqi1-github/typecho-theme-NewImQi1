<?php
if (!defined('__TYPECHO_ROOT_DIR__'))
    exit;
$this->comments()->to($comments);
function threadedComments($comments, $options): void
{
    $commentLevelClass = $comments->_levels > 0 ? ' comment-child' : ' comment-parent';
    ?>
  <li id="<?php $comments->theId(); ?>" class="comment-body<?php echo $commentLevelClass ?>">
    <div class="comment-body-inner" data-name="<?php echo $comments->author ?>">
      <div class="comment-avatar-box" text="回复">
          <?php $comments->reply("", $comments); ?>
          <?php echoAvatar($comments) ?>
      </div>
      <div class="comment-main">
        <div class="comment-meta">
        <span class="comment-author">
        <?php $comments->author(false); ?>
        </span>
            <?php if ($comments->url): ?>
              <a class="comment-link" target="_blank" href="<?php $comments->url(); ?>"
                 rel="noreferrer noopener nofollow">
                  <?php echo parse_url($comments->url)['host']; ?></a>
            <?php endif ?>
          <span class="comment-date">
            <?php if ('waiting' == $comments->status) { ?>
              <em class="comment-waiting">正在审核</em>
            <?php } else { ?>
                <?php echoCommentParent($comments->coid);
            } ?>
          </span>
        </div>
        <div class="comment-content">
            <?php $comments->content(); ?>
        </div>
        <div class="comment-information">
          <span><i class="ri-time-fill"></i><?php echoFormattedTime($comments->created); ?></span>
            <?php echoUserAgent($comments->agent); ?>
            <?php ImQi1ex_Plugin::echoIpInformation($comments->ip); ?>
        </div>
      </div>
    </div>
      <?php if ($comments->children) { ?>
        <div class="comment-children">
            <?php $comments->threadedComments($options); ?>
        </div>
      <?php } ?>
  </li>
<?php } ?>
<?php if ($comments->have()): ?>
  <div id="comments">
      <?php $comments->listComments(); ?>
    <div id="comment-nav">
        <?php $comments->pageNav('<i class="ri-arrow-left-double-fill"></i>', '<i class="ri-arrow-right-double-fill"></i>', 3, "<a>...</a>"); ?>
    </div>
  </div>
<?php endif; ?>