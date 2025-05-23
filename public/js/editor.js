$(document).ready(function () {
  let newRow = $("<ul class=\"wmd-button-row\"></ul>"), oldRow = $("#wmd-button-row");
  oldRow.after(newRow);
  let items = [{
    title: "段落折叠",
    click() {
      insertAtCursor("<div class=\"imqi1-folding\" data-title='\u6BB5\u843D\u6298\u53E0\u6807\u9898' data-content1='\u6BB5\u843D\u6298\u53E0\u5185\u5BB91' data-content2='\u6BB5\u843D\u6298\u53E0\u5185\u5BB92'></div>")
    }
  }, {
    title: "视频",
    click() {
      insertAtCursor("<div class=\"imqi1-video\" data-url='https://cdn.imqi1.com/static/example-video.mp4'></div>")
    }
  }, {
    title: "音乐（自动解析）",
    click() {
      insertAtCursor("<div class=\"imqi1-music\"><meting-js auto=\"https://music.163.com/#/song?id=2142943893\"></meting-js></div>")
    }
  }, {
    title: "音乐（单曲）",
    click() {
      insertAtCursor("<div class=\"imqi1-music\"><meting-js type=\"song\" server=\"netease\" id=\"2142943893\"></meting-js></div>")
    }
  }, {
    title: "音乐（列表）",
    click() {
      insertAtCursor("<div class=\"imqi1-music\"><meting-js server=\"netease\" type=\"playlist\" id=\"60198\"></meting-js></div>")
    }
  }, {
    title: "成功提示框",
    click() {
      insertAtCursor("<div class=\"imqi1-tip-green\">提醒内容</div>")
    }
  }, {
    title: "警告提示框",
    click() {
      insertAtCursor("<div class=\"imqi1-tip-yellow\">提醒内容</div>")
    }
  }, {
    title: "错误提示框",
    click() {
      insertAtCursor("<div class=\"imqi1-tip-red\">提醒内容</div>")
    }
  }, {
    title: "信息提示框",
    click() {
      insertAtCursor("<div class=\"imqi1-tip-blue\">提醒内容</div>")
    }
  }, {
    title: "大卡片",
    click() {
      insertAtCursor("<div class=\"imqi1-big-card\" data-title=\"大卡片标题\" data-href=\"https://imqi1.com\" data-content=\"不保证此地址的安全性，请谨慎访问。\" data-description=\"大卡片提示\" data-img=\"大卡片图片链接\"></div>")
    }
  }, {
    title: "轮播图",
    click() {
      insertAtCursor("<div class=\"imqi1-content-swiper\" data-img1=\"图片1链接||图片1描述\" data-img2=\"图片2链接||图片2描述\"></div>")
    }
  }, {
    title: "居中对齐",
    click() {
      insertAtCursor("<div class=\"imqi1-center\">居中对齐内容</div>")
    }
  }, {
    title: "空白",
    click() {
      insertAtCursor("<div class=\"imqi1-blank\"></div>")
    }
  }, {
    title: "b站视频",
    click() {
      insertAtCursor("<div class=\"imqi1-bilibili\">这里放bilibili的iframe代码</div>")
    }
  }];
  for (let item of items) {
    let button = $(`<li class="wmd-button">${item.title}</li>`);
    newRow.append(button);
    button.on("click", item.click)
  }
});

/**
 * 向指定位置插入文本
 * @param str {string}
 */
function insertAtCursor(str) {
  let text = document.querySelector("textarea");  // 使用 querySelector 选择文本框
  if (text.selectionStart !== undefined) {  // 检查是否支持 selectionStart
    let start = text.selectionStart;
    let end = text.selectionEnd;
    // 插入文本并更新光标位置
    text.value = text.value.substring(0, start) + str + text.value.substring(end);
    text.selectionStart = text.selectionEnd = start + str.length;  // 更新光标位置
    text.focus();
  } else {
    // 如果没有选择文本（即旧浏览器），直接追加文本
    text.value += str;
    text.focus();
  }
}