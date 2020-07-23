<!DOCTYPE html>
<html lang="zh-CN">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
  <Title><?php if (!empty($STitle)) echo $STitle . " - ";
          echo Get_Info('SiteName'); ?></Title>
  <meta name="description" content="<?php echo Get_Info('Description'); ?>">
  <meta name="keywords" content="<?php echo Get_Info('KeyWord'); ?>">
  <link rel="stylesheet" href="//cdnjs.loli.net/ajax/libs/mdui/0.4.3/css/mdui.min.css">
  <script src="//cdnjs.loli.net/ajax/libs/mdui/0.4.3/js/mdui.min.js"></script>


</head>

<style type="text/css">
  a {
    text-decoration: none;
    color: #4D4D4D;
  }
</style>

<body class="mdui-appbar-with-toolbar  mdui-theme-primary-indigo mdui-theme-accent-pink ">
  <header class="mdui-appbar mdui-appbar-fixed">
    <div class="mdui-toolbar mdui-color-theme">
      <span class="mdui-btn mdui-btn-icon mdui-ripple mdui-ripple-white " mdui-drawer="{target: '#main-drawer', swipe: true}"><i class="mdui-icon material-icons">menu</i></span>
      <a href="../" class="mdui-typo-headline mdui-hidden-xs"><?php echo Get_Info('SiteName'); ?></a>
      <div class="mdui-toolbar-spacer"></div>
      <!-- 请不要删除版权，请遵循开源协议 -->
      <a href="https://www.wunote.cn/" target="_blank" class="mdui-btn mdui-btn-icon mdui-ripple mdui-ripple-white" mdui-tooltip="{content: '版权提示'}">
        <i class="mdui-icon material-icons">&#xe86f;</i>
      </a>
    </div>
  </header>

  <div class="mdui-drawer mdui-drawer-close" id="main-drawer">
    <div class="mdui-list " mdui-collapse="{accordion: true}" style="margin-bottom: 76px;">
      <div class="mdui-list">
        <?php
        if ($rewrite == '1') {
          echo '<a href="' . Get_Info('SiteURL') . '" class="mdui-list-item mdui-ripple "><i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-black">near_me</i>&nbsp;&nbsp;&nbsp;&nbsp;下载</a>';
          echo '<a href="' . Get_Info('SiteURL') . 'Submit.php" class="mdui-list-item mdui-ripple "><i class="mdui-icon material-icons mdui-text-color-black">arrow_upward</i>&nbsp;&nbsp;&nbsp;&nbsp;提交文件</a>';
          echo '<a href="' . Get_Info('SiteURL') . 'About.php" class="mdui-list-item mdui-ripple "><i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-black">code</i>&nbsp;&nbsp;&nbsp;&nbsp;关于本站</a>';
        } else {
          echo '<a href="' . Get_Info('SiteURL') . '" class="mdui-list-item mdui-ripple "><i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-black">near_me</i>&nbsp;&nbsp;&nbsp;&nbsp;下载</a>';
          echo '<a href="' . Get_Info('SiteURL') . 'Submit/" class="mdui-list-item mdui-ripple "><i class="mdui-icon material-icons mdui-text-color-black">arrow_upward</i>&nbsp;&nbsp;&nbsp;&nbsp;提交文件</a>';
          echo '<a href="' . Get_Info('SiteURL') . 'About/" class="mdui-list-item mdui-ripple "><i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-black">code</i>&nbsp;&nbsp;&nbsp;&nbsp;关于本站</a>';
        }
        ?>
      </div>
    </div>
  </div>