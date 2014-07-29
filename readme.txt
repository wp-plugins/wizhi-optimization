=== Plugin Name ===
Contributors: Amos Lee
Donate link: 
Tags: admin, post, pages, plugin
Requires at least: 3.4
Tested up to: 3.9.1
Stable tag: 1.0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Clean up and optimization WordPress for Chinese user or who use English in China, 对WordPress的清理和优化。

== Description ==

= For English users =

**Clean up**
* remove useless dashboard widget
* clean up <head> content
* remove useless topbar menu
* remove dashboard google font，resolved the slow dashboard problem in China 
* clean up menu classes
* for safe reason, remove the frontend wp generator version

**Optimization**
* hide update notice for non-admin users
* reorder the tinymce buttons, add font size and font background button
* set maximum to 5 of post revision
* set images default link to none
* limit maximum upload size to 2M
* transform chinese filename to the first 8 character of filename`s md5 value
* automatic add post title 'Untitled'
* automatic add a featured image


Contact：iwillhappy1314@gmail.com


= 中文用户 =

**清理**
* 移除无用的仪表盘部件
* 移除head里没用的内容
* 移除无用的顶部工具条菜单
* 移除谷歌open sans字体，解决后台在中国打开慢的问题
* 移除菜单的多余CSS选择器
* 移除版本号

**优化**
* 对非管理用户隐藏更新提醒
* 调整编辑器顺序、添加字号和背景颜色选择按钮
* 设置一个最大的文章版本数量
* 设置图片链接默认选项为无连接
* 限制上传的文件尺寸最大为2M
* 转化中文图片名称为md5
* 自动添加标题为 Untitled
* 自动设置特色图像

联系方式：iwillhappy1314@gmail.com


== Installation ==

= For English user =
1. Upload `wizhi-optimization` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

= 中文用户 =
1. 上传插件到`/wp-content/plugins/` 目录
2. 在插件管理菜单激活插件

== Frequently Asked Questions ==


== Screenshots ==

Screenshots is here：[http://www.wpzhiku.com/wizhi-optimization/](http://www.wpzhiku.com/wizhi-optimization/)


== Changelog ==

= 1.0 =
* The first released

= 1.0.1 =
* Fix errors