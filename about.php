<?php

/**
 * 关于
 *
 * @package custom
 */

if (!defined('__TYPECHO_ROOT_DIR__'))
    exit;

$resourcePath = getResourcePath();

$this->need('header.php');
?>
  <section class="about-cover fadeIn">
    <div class="about-content-title">关于</div>
  </section>
  <div class="about-huge-blank"></div>
  <div class="about-scroll"><i class="ri-mouse-line"></i></div>
  <section class="about-body fadeIn">
    <div id="typer" class="about-aborted"></div>
    <div class="about-description">
      做技术的分享者、<br/>生活的摄影师、<br/>时事的评论员。
    </div>
    <div class="about-favourite">
      <div class="about-title about-with-icon"><i class="ri-heart-fill"></i>爱好</div>
      <div class="about-favourite-content">💻编程</div>
      <div class="about-favourite-content">🎮游戏</div>
      <div class="about-favourite-content">🎸音乐</div>
    </div>
    <div class="about-personality">
      <img src="<?php echo $resourcePath . "/img" . "/entp.svg" ?>" class="about-personality-img" alt="性格人物">
      <div class="about-personality-left">
        <div class="about-personality-item">
          <div class="about-personality-percent"></div>
          <div class="about-personality-text">外向</div>
        </div>
        <div class="about-personality-item">
          <div class="about-personality-percent"></div>
          <div class="about-personality-text">远见</div>
        </div>
        <div class="about-personality-item">
          <div class="about-personality-percent"></div>
          <div class="about-personality-text">理性</div>
        </div>
        <div class="about-personality-item">
          <div class="about-personality-percent"></div>
          <div class="about-personality-text">展望</div>
        </div>
        <div class="about-personality-item">
          <div class="about-personality-percent"></div>
          <div class="about-personality-text">坚决</div>
        </div>
      </div>
      <div class="about-personality-right">
        <div class="about-with-icon"><i class="ri-user-heart-line"></i>MBTI 人格类型</div>
        <div class="about-personality-text2">ENTP-A<br>辩论家</div>
        <a href="https://www.16personalities.com/ch/entp-%E4%BA%BA%E6%A0%BC" target="_blank" class="about-href">了解</a>
      </div>
    </div>
    <div class="about-hometown"
         style="background-image: linear-gradient(rgba(0,0,0,.3),rgba(0,0,0,.3)),url(<?php echo $resourcePath . "/img" . "/shenyang.webp" ?>)">
      <div class="about-title"><i class="ri-home-line"></i>我来自</div>
      <div class="about-where-content">辽宁沈阳</div>
    </div>
    <div class="about-college"
         style="background-image: linear-gradient(rgba(0,0,0,.3),rgba(0,0,0,.3)),url(<?php echo $resourcePath . "/img" . "/ysu.webp" ?>)">
      <div class="about-title"><i class="ri-school-line"></i>在读</div>
      <div class="about-college-content">燕山大学</div>
      <div class="about-college-college">YSU</div>
      <div class="about-college-ranking">校友会排名61 河北第一</div>
    </div>
    <div class="about-position" style="background-image: url(<?php echo $resourcePath . "/img/position.webp" ?>)">
      <div class="about-title"><i class="ri-map-pin-line"></i>位置</div>
      <div class="about-position-content">河北省 秦皇岛市</div>
    </div>
    <div class="about-qinhuangdao"
         style="background-image: linear-gradient(rgba(0,0,0,.2),rgba(0,0,0,.2)),url(<?php echo $resourcePath . "/img" . "/qinhuangdao.webp" ?>)"></div>
    <div class="about-skills">
      <div class="about-skills-container">
        <div class="about-skills-emoji">💻</div>
        <div class="about-skills-title">无限进步</div>
        <div class="about-skills-box">
          <div class="about-skills-content">
            <img src="<?php echo $resourcePath . "/skill/regex.svg" ?>" alt="Regex">
            <img src="<?php echo $resourcePath . "/skill/c.svg" ?>" alt="C">
            <img src="<?php echo $resourcePath . "/skill/cpp.svg" ?>" alt="C++">
            <img src="<?php echo $resourcePath . "/skill/java.svg" ?>" alt="Java">
            <img src="<?php echo $resourcePath . "/skill/sqlite.svg" ?>" alt="SQLite">
            <img src="<?php echo $resourcePath . "/skill/mysql.svg" ?>" alt="MySQL">
            <img src="<?php echo $resourcePath . "/skill/html.svg" ?>" alt="HTML">
            <img src="<?php echo $resourcePath . "/skill/css.svg" ?>" alt="CSS">
            <img src="<?php echo $resourcePath . "/skill/js.svg" ?>" alt="JavaScript">
            <img src="<?php echo $resourcePath . "/skill/php.svg" ?>" alt="PHP">
            <img src="<?php echo $resourcePath . "/skill/md.svg" ?>" alt="Markdown">
            <img src="<?php echo $resourcePath . "/skill/latex.svg" ?>" alt="LaTeX">
            <img src="<?php echo $resourcePath . "/skill/python.svg" ?>" alt="Python">
            <img src="<?php echo $resourcePath . "/skill/qt.svg" ?>" alt="Qt">
            <img src="<?php echo $resourcePath . "/skill/flask.svg" ?>" alt="Flask">
            <img src="<?php echo $resourcePath . "/skill/django.svg" ?>" alt="Django">
            <img src="<?php echo $resourcePath . "/skill/fastapi.svg" ?>" alt="FastAPI">
            <img src="<?php echo $resourcePath . "/skill/linux.svg" ?>" alt="Linux">
            <img src="<?php echo $resourcePath . "/skill/bash.svg" ?>" alt="Bash">
            <img src="<?php echo $resourcePath . "/skill/powershell.svg" ?>" alt="PowerShell">
            <img src="<?php echo $resourcePath . "/skill/nginx.svg" ?>" alt="Nginx">
            <img src="<?php echo $resourcePath . "/skill/docker.svg" ?>" alt="Docker">
            <img src="<?php echo $resourcePath . "/skill/git.svg" ?>" alt="Git">
            <img src="<?php echo $resourcePath . "/skill/mongodb.svg" ?>" alt="MongoDB">
            <img src="<?php echo $resourcePath . "/skill/redis.svg" ?>" alt="Redis">
            <img src="<?php echo $resourcePath . "/skill/jquery.svg" ?>" alt="jQuery">
            <img src="<?php echo $resourcePath . "/skill/bootstrap.svg" ?>" alt="Bootstrap">
            <img src="<?php echo $resourcePath . "/skill/vue.svg" ?>" alt="Vue.js">
          </div>
        </div>
      </div>
      <div class="about-skill-details">
        <div class="about-title"><i class="ri-code-line"></i>技能</div>
        <div class="about-skills-card">
          <img src="<?php echo $resourcePath . "/skill/regex.svg" ?>" alt="Regex">
          <div class="about-skill-content">Regex</div>
        </div>
        <div class="about-skills-card">
          <img src="<?php echo $resourcePath . "/skill/c.svg" ?>" alt="C">
          <div class="about-skill-content">C</div>
        </div>
        <div class="about-skills-card">
          <img src="<?php echo $resourcePath . "/skill/cpp.svg" ?>" alt="C++">
          <div class="about-skill-content">C++</div>
        </div>
        <div class="about-skills-card">
          <img src="<?php echo $resourcePath . "/skill/java.svg" ?>" alt="Java">
          <div class="about-skill-content">Java</div>
        </div>
        <div class="about-skills-card">
          <img src="<?php echo $resourcePath . "/skill/sqlite.svg" ?>" alt="SQLite">
          <div class="about-skill-content">SQLite</div>
        </div>
        <div class="about-skills-card">
          <img src="<?php echo $resourcePath . "/skill/mysql.svg" ?>" alt="MySQL">
          <div class="about-skill-content">MySQL</div>
        </div>
        <div class="about-skills-card">
          <img src="<?php echo $resourcePath . "/skill/html.svg" ?>" alt="HTML">
          <div class="about-skill-content">HTML</div>
        </div>
        <div class="about-skills-card">
          <img src="<?php echo $resourcePath . "/skill/css.svg" ?>" alt="CSS">
          <div class="about-skill-content">CSS</div>
        </div>
        <div class="about-skills-card">
          <img src="<?php echo $resourcePath . "/skill/js.svg" ?>" alt="JavaScript">
          <div class="about-skill-content">JavaScript</div>
        </div>
        <div class="about-skills-card">
          <img src="<?php echo $resourcePath . "/skill/php.svg" ?>" alt="PHP">
          <div class="about-skill-content">PHP</div>
        </div>
        <div class="about-skills-card">
          <img src="<?php echo $resourcePath . "/skill/md.svg" ?>" alt="Markdown">
          <div class="about-skill-content">Markdown</div>
        </div>
        <div class="about-skills-card">
          <img src="<?php echo $resourcePath . "/skill/latex.svg" ?>" alt="LaTeX">
          <div class="about-skill-content">LaTeX</div>
        </div>
        <div class="about-skills-card">
          <img src="<?php echo $resourcePath . "/skill/python.svg" ?>" alt="Python">
          <div class="about-skill-content">Python</div>
        </div>
        <div class="about-skills-card">
          <img src="<?php echo $resourcePath . "/skill/qt.svg" ?>" alt="Qt">
          <div class="about-skill-content">Qt</div>
        </div>
        <div class="about-skills-card">
          <img src="<?php echo $resourcePath . "/skill/flask.svg" ?>" alt="Flask">
          <div class="about-skill-content">Flask</div>
        </div>
        <div class="about-skills-card">
          <img src="<?php echo $resourcePath . "/skill/django.svg" ?>" alt="Django">
          <div class="about-skill-content">Django</div>
        </div>
        <div class="about-skills-card">
          <img src="<?php echo $resourcePath . "/skill/fastapi.svg" ?>" alt="FastAPI">
          <div class="about-skill-content">FastAPI</div>
        </div>
        <div class="about-skills-card">
          <img src="<?php echo $resourcePath . "/skill/linux.svg" ?>" alt="Linux">
          <div class="about-skill-content">Linux</div>
        </div>
        <div class="about-skills-card">
          <img src="<?php echo $resourcePath . "/skill/bash.svg" ?>" alt="Bash">
          <div class="about-skill-content">Bash</div>
        </div>
        <div class="about-skills-card">
          <img src="<?php echo $resourcePath . "/skill/powershell.svg" ?>" alt="PowerShell">
          <div class="about-skill-content">PowerShell</div>
        </div>
        <div class="about-skills-card">
          <img src="<?php echo $resourcePath . "/skill/nginx.svg" ?>" alt="NGINX">
          <div class="about-skill-content">NGINX</div>
        </div>
        <div class="about-skills-card">
          <img src="<?php echo $resourcePath . "/skill/docker.svg" ?>" alt="Docker">
          <div class="about-skill-content">Docker</div>
        </div>
        <div class="about-skills-card">
          <img src="<?php echo $resourcePath . "/skill/git.svg" ?>" alt="Git">
          <div class="about-skill-content">Git</div>
        </div>
        <div class="about-skills-card">
          <img src="<?php echo $resourcePath . "/skill/mongodb.svg" ?>" alt="MongoDB">
          <div class="about-skill-content">MongoDB</div>
        </div>
        <div class="about-skills-card">
          <img src="<?php echo $resourcePath . "/skill/redis.svg" ?>" alt="Redis">
          <div class="about-skill-content">Redis</div>
        </div>
        <div class="about-skills-card">
          <img src="<?php echo $resourcePath . "/skill/jquery.svg" ?>" alt="jQuery">
          <div class="about-skill-content">jQuery</div>
        </div>
        <div class="about-skills-card">
          <img src="<?php echo $resourcePath . "/skill/bootstrap.svg" ?>" alt="Bootstrap">
          <div class="about-skill-content">Bootstrap</div>
        </div>
        <div class="about-skills-card">
          <img src="<?php echo $resourcePath . "/skill/vue.svg" ?>" alt="Vue">
          <div class="about-skill-content">Vue</div>
        </div>
        <div class="about-skills-card">...</div>
      </div>
    </div>
    <div class="about-avatar about-aborted"
         style="background-image: url(<?php echo $resourcePath . "/img" . "/avatar.webp" ?>)"></div>
    <a class="about-homepage about-aborted" href="https://qi1.website" target="_blank">
      <div class="about-homepage-content"><i class="ri-home-line"></i>首页</div>
    </a>
    <a class="about-mail about-aborted" href="mailto:imqi1@qq.com" target="_blank">
      <div class="about-mail-content"><i class="ri-mail-line"></i>imqi1@qq.com</div>
    </a>
    <div class="about-motto">
      <i class="ri-double-quotes-l about-motto-quote"></i>
      <div class="about-motto-right">
        <div class="about-motto-content">
          <p>梦虽遥，追则能达；愿虽艰，持则可圆。</p>
          <div class="about-motto-author"> —— 习近平 - 二〇二五年新年贺词</div>
        </div>
      </div>
    </div>
    <a class="about-to-sitemap" href="/sitemap">
      探索<br/>本站
    </a>
    <a class="about-to-archiving" href="/archiving">
      我发表的内容
    </a>
  </section>
  <div class="about-huge-blank"></div>
  <section class="about-content article-content fadeIn">
      <?php $this->content(); ?>
  </section>
  <div class="about-huge-blank"></div>
<?php
$this->need("footer.php"); ?>