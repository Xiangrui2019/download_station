# 未知下载站

欢迎使用未知下载站

## 这是什么
这是我业余时随便写的一个简易下载站, 懒得搞数据库, 结果拿Info文件简单造了个数据库.

## 各个配置文件作用介绍
Info.List
此文件在于给您下载站的文件添加简洁，如果未添加默认为‘不解释，你应该懂的，2333333’，添加格式如下
#文件名|!|#文件介绍|!|#图片设定|!|#附加介绍|!|#其他地址
#如果此项为空请设定值为|!|
#分割符为'|!|'

Passwd.Info
此文件为下载密码
#文件/文件夹途径|!|#密码

About.Info
此文件为关于页面介绍，您可以自行修改

## 如何运行
### 开发环境
请在电脑上安装PhpStudy/WAMP/XAMPP等集成环境, 并且创建一个虚拟主机, 使用/etc/hosts文件配置好虚拟主机的域名. 把本站源码复制到那个目录下面, 启动nginx/apache和php, 访问对应的虚拟主机就行了.

### 生产环境
请准备一台VPS, 安装宝塔面板，使用FTP上传本站源码, 然后配置域名解析, OK!

## 如何贡献
There are many ways to contribute to the project: logging bugs, submitting pull requests, reporting issues, and creating suggestions.
Even if you have push rights on the repository, you should create a personal fork and create feature branches there when you need them. This keeps the main repository clean, and your personal workflow cruft out of sight.
We're also interested in your feedback for the future of this project. You can submit a suggestion or feature request through the issue tracker. To make this process more effective, we're asking that these include more information to help define them more clearly.

## 开源许可证
本软件使用GNU General Public License (GPL) V3开源许可证

## 备注
另外，由于作者是咸鱼一条，所以。。。没有开发后台，邮件发送用的也是我已经开发好的API。且本人代码写的较烂，各位大佬谅解