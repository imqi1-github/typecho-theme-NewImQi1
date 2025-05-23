<?php

use Typecho\Widget\Helper\Form;
use Typecho\Widget\Helper\Form\Element\Radio;
use Typecho\Widget\Helper\Form\Element\Text;
use Typecho\Widget\Helper\Form\Element\Textarea;
use Typecho\Widget\Helper\Layout;

function themeConfig(Form $form): void
{
    $homeAnnounce = new Textarea(
        'homeAnnounce', NULL,
        '<p>你好，我是棋，目前在燕山大学读大四，正在做毕业设计中。</p><p>欢迎访问我的小站，我会在这里记录我觉得有趣的事情，话题主要是生活和社会。</p>',
        _t('首页自定义文字'),
        _t('<p class="description">设置首页第二行文字，可显示HTML标签。</p>'));
    $form->addInput($homeAnnounce);

    $staticUrl = new Textarea(
        'staticUrl', NULL,
        'https://cdn.imqi1.com/static',
        _t('静态文件路径'),
        _t('<p class="description">设置静态文件路径，若填写自定义CDN需将public内所有文件都移动至CDN内。</p>
                  <p class="description">前面带https前缀，后面不要带/</p>'));
    $form->addInput($staticUrl);

    $musicId = new Text(
        "musicId", NULL, "9255074836 || netease", _t("音乐列表id"),
        _t('<p class="description">设置音乐列表，在网页右下角展示胶囊音乐。</p>'.
          '<p class="description">格式：<code>列表id [|| 平台英文名]</code>，平台英文名可选，不包含默认为网易云。</p>'.
          '<p class="description">如<code>9255074836 || netease</code></p>'),
    );
    $form->addInput($musicId);

    $photoSlug = new Text(
        "photoSlug", NULL, "shot", _t("图片分类slug"),
        _t('<p class="description">设置图片分类slug，为图片的归档和文章页面显示独特样式。</p>'),
    );
    $form->addInput($photoSlug);

    $photoSuffix = new Text(
        "photoSuffix", NULL, "!600px.width", _t("图片封面后缀"),
        _t('<p class="description">为归档页面添加后缀，可用于图片处理。</p>'),
    );
    $form->addInput($photoSuffix);

    $coverSuffix = new Text(
        "coverSuffix", NULL, "!1000px", _t("文章封面后缀"),
        _t('<p class="description">为文章封面添加后缀，可用于图片处理。</p>'),
    );
    $form->addInput($coverSuffix);

    $avatarSource = new Radio(
      "avatarSource", array(
        "cravatar"=>_t("Cravatar 头像源"),
        "weavatar" => _t("Weavatar 头像源")
      ), "cravatar", _t("头像源切换"),
      _t("<p class='description'>为评论区切换头像源显示，默认为Cravatar，若出现故障可切换为其他。</p>")
    );
  $form->addInput($avatarSource);
}

function themeFields(Layout $form): void
{
    $cover = new Textarea(
        'cover', NULL,
        "",
        _t("封面链接"),
        _t('<p class="description">文章封面链接，显示在标题上方，不填写则不显示封面。</p>'
        ));
    $form->addItem($cover);

    $manyCovers = new Radio(
        "manyCovers",
        array(
            'on' => _t('开启'),
            'off' => _t('不开启')
        ), "off", _t("多张封面"),
        _t('<p class="description">是否为图片类型的文章添加多个封面，展示独特样式。</p>'
    ));
    $form->addItem($manyCovers);

    $description = new Text(
        'description', NULL,
        "",
        _t("描述"),
        _t('<p class="description">文章或页面的描述，显示在标题下方。</p>'
        ));
    $form->addItem($description);

    $toc = new Radio(
        "toc",
        array(
            'show' => _t('显示'),
            'hide' => _t('不显示')
        ),
        "hide",
        _t('目录'),
        _t('<p class="description">如果选择显示，文章会根据所有二级标题生成一个目录。</p>')
    );
    $form->addItem($toc);
}