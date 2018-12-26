## php_design

php课程设计作业-网上商城

## 目录
-   [php\_design](#php_design)
-   [目录](#目录)
-   [需求](#需求)
    -   [前台管理](#前台管理)
    -   [后台管理](#后台管理)
-   [数据库表](#数据库表)
-   [数据字典](#数据字典)
    -   [用户表(user)](#用户表user)
    -   [管理员表(admin)](#管理员表admin)
    -   [商品类别表(goods\_class)](#商品类别表goods_class)
    -   [商品表(goods)](#商品表goods)
    -   [商品图片表(goods\_img)](#商品图片表goods_img)
    -   [购物车表(cart)](#购物车表cart)
    -   [购物车项表(cart\_item)](#购物车项表cart_item)
    -   [收藏夹表(favorite)](#收藏夹表favorite)
    -   [收藏夹项表(favorite\_item)](#收藏夹项表favorite_item)
    -   [订单表(order)](#订单表order)
    -   [订单项表(order\_item)](#订单项表order_item)
-   [参考文献](#参考文献)


## 需求

### 前台管理
- 匿名用户
   - 用户注册登陆
   - 前台显示分类，例如格式为：手机（3） 数量为改分类下的所有商品数量。
   - 前台显示商品列表
   - 有查询框，根据商品名查询
   - 商品显示分页显示，例如格式为：<Prev 1  2  3 4  5  Next>   当前页面显示在中间，自动补齐功能
   - 商品详细页，有难点是：一张主图，多张小图。

- 已注册用户
   - 可根据email跟用户名的匹配找回密码
   - 可点击收藏添加进收藏夹
   - 加入购物车（有修改数量功能，删除功能）
   - 结算填写收获地址，结账数据提交到数据库
   - 查看订单， 取消订单（需在发货前取消）

### 后台管理

- 商品管理
    - 添加分类
    - 有查询框，根据商品名查询
    - 添加、删除前台显示的商品
    - 更改商品库存量
    - 修改商品描述
    - 更换商品图片
- 订单管理
    - 可通过用户名查询订单
    - 按商品分类查看用户下的订单，更改订单状态(未发货，已发货，配送中，已收货)
- 用户管理
    - 通过用户名， email查询用户
    - 统计注册的用户数量，查看用户信息(用户名，注册时间)
- 报表统计
    - 统计7天内每天的销售额(表格显示)
    - 绘制时间段内的销售额图表(量力而行)

---

## 数据库表

表名|属性
---|---
用户表(user)|user_id, username, password, email, head_icon, register_time, latest_login_time
管理员表(admin)|admin_id, username, password, email, register_time, latest_login_time
商品类别表(goods_class)|goods_class_id, goods_class_name, goods_description
商品表(goods)|goods_id, goods_name, goods_stock, goods_price, goods_description, goods_class_id 
商品图片表(goods_img)|goods_img_id, goods_img_url, goods_id
购物车表(cart)|cart_id, total_price, user_id
购物车项表(cart_item)|cart_item_id, buy_num, cart_id, goods_id
收藏夹表(favorite)|favorite_id, user_id
收藏夹项表(favorite_item)|favorite_item_id, favorite_id, goods_id
订单表(order)|order_id, order_code, total_price, user_addr, user_phone, postcode, order_state, user_id
订单项表(order_item)|order_item_id, buy_num, order_id, goods_id

## 数据字典

#### 用户表(user)

字段名|备注|数据类型|是否为空|其他  
:---|:---|:---|:---|:---  
user_id|用户id|int(11)|否|primary_key，自加  
username|用户名|varchar(20)|否|无  
password|密码（可用md5()加密|varchar(16)|否|无  
email|邮箱|varchar(20)|否|无  
head_icon|头像图标地址|text|否|无  
register_time|注册时间|timestamp|否|默认当前时间  
latest_login_time|最新登录时间|timestamp|否|每次根据当前时间更新

#### 管理员表(admin)

字段名|备注|数据类型|是否为空|其他
:---|:---|:---|:---|:---
admin_id|管理员id|int(11)|否|primary_key，自加
username|用户名|varchar(20)|否|无
password|密码（可用md5()加密）|varchar(16)|否|无
email|邮箱|varchar(20)|否|无
register_time|注册时间|timestamp|否|默认当前时间
latest_login_time|最新登录时间|timestamp|否|每次根据当前时间更新

#### 商品类别表(goods_class)

字段名|备注|数据类型|是否为空|其他
:---|:---|:---|:---|:---
goods_class_id|商品类别id|int(11)|否|primary_key，自加
goods_class_name|商品类别名|varchar(20)|否|无

#### 商品表(goods) 

字段名|备注|数据类型|是否为空|其他
:---|:---|:---|:---|:---
goods_id|商品id|int(11)|否|primary_key，自加
goods_name|商品名|varchar(20)|否|无
goods_stock|商品库存|int(7)|否|默认为0
goods_price|商品单价|int(7)|否|默认为0
goods_description|商品描述|text|是|无
goods_class_id|商品类别id|int(11)|否|foreign_key

#### 商品图片表(goods_img) 
> 存储每个商品的所有图片url


字段名|备注|数据类型|是否为空|其他
:---|:---|:---|:---|:---
goods_img_id|商品图片id|int(11)|否|primary_key，自加
goods_img_url|商品图片地址|text|否|无
goods_id|商品id|int(11)|否|foreign_key

#### 购物车表(cart)

字段名|备注|数据类型|是否为空|其他
:---|:---|:---|:---|:---
cart_id|购物车id|int(11)|否|primary_key，自加
total_price|购物车商品总价|int(10)|否|默认为0
user_id|用户id|int(11)|否|foreign_key

#### 购物车项表(cart_item)
> 存储购物车中每个商品的购买情况

字段名|备注|数据类型|是否为空|其他
:---|:---|:---|:---|:---
cart_item_id|购物车项id|int(11)|否|primary_key，自加
buy_num|购买量|int(7)|否|默认为0
cart_id|购物车id|int(11)|否|foreign_key
goods_id|商品id|int(11)|否|foreign_key

#### 收藏夹表(favorite)

字段名|备注|数据类型|是否为空|其他
:---|:---|:---|:---|:---
favorite_id|收藏夹id|int(11)|否|primary_key，自加
user_id|用户id|int(11)|否|foreign_key

#### 收藏夹项表(favorite_item)
> 记录收藏夹中的每个商品

字段名|备注|数据类型|是否为空|其他
:---|:---|:---|:---|:---
favorite_item_id|收藏夹项id|int(11)|否|primary_key，自加
favorite_id|收藏夹id|int(11)|否|foreign_key
goods_id|商品id|int(11)|否|foreign_key

#### 订单表(order)
    
字段名|备注|数据类型|是否为空|其他
:---|:---|:---|:---|:---
order_id|订单id|int(11)|否|primary_key，自加
order_code|订单编码|char(13)|否|无
total_price|订单商品总价|int(10)|否|默认为0
user_addr|用户地址|varchar(50)|否|无
user_phone|用户电话|char(11)|否|无
postcode|邮政编码|char(6)|否|无
order_state|订单状态|enum('未发货','已发货','配送中','已收货')|否|默认'未发货'
user_id|用户id|int(11)|否|foreign_key

#### 订单项表(order_item)

字段名|备注|数据类型|是否为空|其他
:---|:---|:---|:---|:---
order_item_id|订单项id|int(11)|否|primary_key，自加
buy_num|购买量|int(7)|否|默认为0
order_id|订单id|int(11)|否|foreign_key
goods_id|商品id|int(11)|否|foreign_key

## 参考文献

---
- https://wenku.baidu.com/view/5840439a250c844769eae009581b6bd97f19bc3e.html