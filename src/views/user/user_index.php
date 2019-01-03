<?php
include_once($_COOKIE['ABSPATH'] . '/src/views/user/head_model.php');
$sessionTool = new SessionTool();
$head_icons = scandir($_COOKIE['ABSPATH'] . '/uploads/user_head_icon');
$from = '';
(isset($_GET['from']) && $_GET['from'] = 'by_goods_class_id') ? $from = 'show_goodses_by_goods_class_id' : $from = 'show_all_goodses';
if (!$sessionTool->isExist('USER_LOGIN_SUCCESS'))
    $sessionTool->setAttribute('USER_LOGIN_SUCCESS', false);
$user = "";
if ($sessionTool->isExist("user"))
    $user = $sessionTool->getAttribute("user");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content=""/>
    <script type="application/x-javascript"> addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        } </script>
    <!-- //for-mobile-apps -->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <!-- font-awesome icons -->
    <link href="css/font-awesome.css" rel="stylesheet" type="text/css" media="all"/>
    <!-- //font-awesome icons -->
    <!-- js -->
    <script src="js/jquery-1.11.1.min.js"></script>
    <!-- start-smoth-scrolling -->
    <script type="text/javascript" src="js/move-top.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $(".scroll").click(function (event) {
                event.preventDefault();
                $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1000);
            });
        });
    </script>
    <!-- start-smoth-scrolling -->
</head>

<body>
<!-- header -->
<div class="agileits_header">
    <div class="w3l_offers">
        <a href="../../controllers/goodsController.php?type=show_all_goodses&dst=user/user_index.php">Today's special
            Offers !</a>
    </div>
    <div class="w3l_search">
        <form action="#" method="post">
            <input type="text" name="Product" value="Search a product..." onfocus="this.value = '';"
                   onblur="if (this.value == '') {this.value = 'Search a product...';}" required="">
            <input type="submit" value=" ">
        </form>
    </div>
    <div class="product_list_header">
        <div style="cursor: pointer;">
            <span class="glyphicon glyphicon-shopping-cart my-cart-icon"><i
                        class="badge badge-notify my-cart-badge"></i></span>
        </div>
    </div>
    <?php if ($user) { ?>
        <div class="w3l_header_right">
            <ul>
                <li class="dropdown profile_details_drop">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">欢迎您 ： <i class="fa fa-user"
                                                                                        aria-hidden="true"></i><?php echo $user->getUsername() ?>
                        <span
                                class="caret"></span></a>
                    <div class="mega-dropdown-menu">
                        <div class="w3ls_vegetables">
                            <ul class="dropdown-menu drp-mnu">
                                <li><a href="#">修改个人信息</a></li>
                                <li><a href="#">查看订单</a></li>
                                <li><a id="logout_a" href="#">退出账户</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    <?php } else { ?>
        <div class="w3l_header_right">
            <ul>
                <li class="dropdown profile_details_drop">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"
                                                                                  aria-hidden="true"></i><span
                                class="caret"></span></a>
                    <div class="mega-dropdown-menu">
                        <div class="w3ls_vegetables">
                            <ul class="dropdown-menu drp-mnu">
                                <li><a href="user_login.php">登录</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    <?php } ?>
    <div class="clearfix"></div>
</div>
<!-- script-for sticky-nav -->
<script>
    $(document).ready(function () {
        var navoffeset = $(".agileits_header").offset().top;
        $(window).scroll(function () {
            var scrollpos = $(window).scrollTop();
            if (scrollpos >= navoffeset) {
                $(".agileits_header").addClass("fixed");
            } else {
                $(".agileits_header").removeClass("fixed");
            }
        });

    });
</script>
<!-- //script-for sticky-nav -->
<div class="logo_products">
    <div class="container">
        <div class="w3ls_logo_products_left">
            <h1><a href="user_index.php"><span>Grocery</span> Store</a></h1>
        </div>
        <div class="w3ls_logo_products_left1">
            <ul class="special_items">
                <li>
                    <a href="../../controllers/goodsController.php?type=show_all_goodses&dst=user/user_index.php">所有</a>
                    <i>/</i></li>
                <?php for ($i = 0;
                           $i < count($goods_classes);
                           $i++) { ?>
                    <li>
                        <a href="../../controllers/goodsController.php?type=show_goodses_by_goods_class_id&dst=user/user_index.php&goods_class_id=<?php echo $goods_classes[$i]->getGoodsClassId() ?>"><?php echo $goods_classes[$i]->getGoodsClassName() ?></a>
                        <i>/</i></li>
                <?php } ?>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- //header -->
<!-- products-breadcrumb -->
<div class="products-breadcrumb">
    <div class="container">
        <ul>
            <li><i class="fa fa-home" aria-hidden="true"></i><a
                        href="../../controllers/goodsController.php?type=show_all_goodses&dst=user/user_index.php">Home</a><span>|</span>
            </li>
            <li>Single Page</li>
        </ul>
    </div>
</div>
<!-- //products-breadcrumb -->
<!-- top-brands -->
<div class="top-brands">
    <div class="container">
        <h3>Hot Offers</h3>
        <div class="agile_top_brands_grids">
            <?php foreach ($goodses as $goods) { ?>
                <div class="col-md-3 top_brand_left">
                    <div class="hover14 column">
                        <div class="agile_top_brand_left_grid">
                            <div class="agile_top_brand_left_grid1">
                                <figure>
                                    <div class="snipcart-item block">
                                        <div class="snipcart-thumb">
                                            <a href="goods_item.php?goods_id=<?php echo $goods->getGoodsId() ?>"><img
                                                        height="155px" width="220px"
                                                        src="<?php echo $goods->getGoodsPrimaryImgUrl() ?>"/></a>
                                            <p><?php echo $goods->getGoodsName() ?></p>
                                            <h4>￥<?php echo $goods->getGoodsPrice() ?></h4>
                                        </div>
                                        <div class="snipcart-details top_brand_home_details">
                                            <button class="btn btn-danger my-cart-btn hvr-sweep-to-right"
                                                    data-id="<?php echo $goods->getGoodsId() ?>"
                                                    data-name="<?php echo $goods->getGoodsName() ?>"
                                                    data-summary="<?php echo $goods->getGoodsDescription() ?>"
                                                    data-price="<?php echo $goods->getGoodsPrice() ?>" data-quantity="1"
                                                    data-image="<?php echo $goods->getGoodsPrimaryImgUrl() ?>">Add
                                                to
                                                Cart
                                            </button>
                                        </div>
                                    </div>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <div class="clearfix"></div>
        </div>
        <ul class="pager">
            共<span class="pagination pagination-sm"><?php echo $pager->getTotalPage() ?></span>页
            <?php if ($pager->getCurPage() == 1) { ?>
                <li>
                    <a href="../../controllers/goodsController.php?type=<?php echo $from ?>&dst=user/user_index.php&cur_page=<?php echo $pager->getNextPage();
                    if (isset($_GET['goods_class_id'])) echo "&goods_class_id=" . $_GET['goods_class_id'] ?>">下一页</a>
                </li>
                <li>
                    <a href="../../controllers/goodsController.php?type=<?php echo $from ?>&dst=user/user_index.php&cur_page=<?php echo $pager->getTailPage();
                    if (isset($_GET['goods_class_id'])) echo "&goods_class_id=" . $_GET['goods_class_id'] ?>">尾
                        页</a>
                </li>
            <?php } else if ($pager->getCurPage() == $pager->getTotalPage()) { ?>
                <li>
                    <a href="../../controllers/goodsController.php?type=<?php echo $from ?>&dst=user/user_index.php&cur_page=<?php echo $pager->getHomePage();
                    if (isset($_GET['goods_class_id'])) echo "&goods_class_id=" . $_GET['goods_class_id'] ?>">首
                        页</a>
                </li>
                <li>
                    <a href="../../controllers/goodsController.php?type=<?php echo $from ?>&dst=user/user_index.php&cur_page=<?php echo $pager->getPrevPage();
                    if (isset($_GET['goods_class_id'])) echo "&goods_class_id=" . $_GET['goods_class_id'] ?>">上一页</a>
                </li>
            <?php } else { ?>
                <li>
                    <a href="../../controllers/goodsController.php?type=<?php echo $from ?>&dst=user/user_index.php&cur_page=<?php echo $pager->getHomePage();
                    if (isset($_GET['goods_class_id'])) echo "&goods_class_id=" . $_GET['goods_class_id'] ?>">首
                        页</a>
                </li>
                <li>
                    <a href="../../controllers/goodsController.php?type=<?php echo $from ?>&dst=user/user_index.php&cur_page=<?php echo $pager->getPrevPage();
                    if (isset($_GET['goods_class_id'])) echo "&goods_class_id=" . $_GET['goods_class_id'] ?>">上一页</a>
                </li>
                <li>
                    <a href="../../controllers/goodsController.php?type=<?php echo $from ?>&dst=user/user_index.php&cur_page=<?php echo $pager->getNextPage();
                    if (isset($_GET['goods_class_id'])) echo "&goods_class_id=" . $_GET['goods_class_id'] ?>">下一页</a>
                </li>
                <li>
                    <a href="../../controllers/goodsController.php?type=<?php echo $from ?>&dst=user/user_index.php&cur_page=<?php echo $pager->getTailPage();
                    if (isset($_GET['goods_class_id'])) echo "&goods_class_id=" . $_GET['goods_class_id'] ?>">尾
                        页</a>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>
<!-- newsletter -->
<div class="newsletter">
    <div class="container">
        <div class="w3agile_newsletter_left">
            <h3>sign up for our newsletter</h3>
        </div>
        <div class="w3agile_newsletter_right">
            <form action="#" method="post">
                <input type="email" name="Email" value="Email" onfocus="this.value = '';"
                       onblur="if (this.value == '') {this.value = 'Email';}" required="">
                <input type="submit" value="subscribe now">
            </form>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- //newsletter -->
<!-- footer -->
<div class="footer">
    <div class="container">
        <div class="col-md-3 w3_footer_grid">
            <h3>information</h3>
            <ul class="w3_footer_grid_list">
                <li><a href="events.html">Events</a></li>
                <li><a href="about.html">About Us</a></li>
                <li><a href="products.html">Best Deals</a></li>
                <li><a href="services.html">Services</a></li>
                <li><a href="short-codes.html">Short Codes</a></li>
            </ul>
        </div>
        <div class="col-md-3 w3_footer_grid">
            <h3>policy info</h3>
            <ul class="w3_footer_grid_list">
                <li><a href="faqs.html">FAQ</a></li>
                <li><a href="privacy.html">privacy policy</a></li>
                <li><a href="privacy.html">terms of use</a></li>
            </ul>
        </div>
        <div class="col-md-3 w3_footer_grid">
            <h3>what in stores</h3>
            <ul class="w3_footer_grid_list">
                <li><a href="pet.html">Pet Food</a></li>
                <li><a href="frozen.html">Frozen Snacks</a></li>
                <li><a href="kitchen.html">Kitchen</a></li>
                <li><a href="products.html">Branded Foods</a></li>
                <li><a href="household.html">Households</a></li>
            </ul>
        </div>
        <div class="col-md-3 w3_footer_grid">
            <h3>twitter posts</h3>
            <ul class="w3_footer_grid_list1">
                <li><label class="fa fa-twitter" aria-hidden="true"></label><i>01 day ago</i><span>Non numquam <a
                                href="#">http://sd.ds/13jklf#</a>
						eius modi tempora incidunt ut labore et
						<a href="#">http://sd.ds/1389kjklf#</a>quo nulla.</span></li>
                <li><label class="fa fa-twitter" aria-hidden="true"></label><i>02 day ago</i><span>Con numquam <a
                                href="#">http://fd.uf/56hfg#</a>
						eius modi tempora incidunt ut labore et
						<a href="#">http://fd.uf/56hfg#</a>quo nulla.</span></li>
            </ul>
        </div>
        <div class="clearfix"></div>
        <div class="agile_footer_grids">
            <div class="col-md-3 w3_footer_grid agile_footer_grids_w3_footer">
                <div class="w3_footer_grid_bottom">
                    <h4>100% secure payments</h4>
                    <img src="images/card.png" alt=" " class="img-responsive"/>
                </div>
            </div>
            <div class="col-md-3 w3_footer_grid agile_footer_grids_w3_footer">
                <div class="w3_footer_grid_bottom">
                    <h5>connect with us</h5>
                    <ul class="agileits_social_icons">
                        <li><a href="#" class="facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#" class="twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#" class="google"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                        <li><a href="#" class="instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        <li><a href="#" class="dribbble"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="wthree_footer_copy">
            <p>Copyright &copy; 2016.Company name All rights reserved.More Templates <a href="http://www.cssmoban.com/"
                                                                                        target="_blank" title="模板之家">模板之家</a>
                - Collect from <a href="http://www.cssmoban.com/" title="网页模板" target="_blank">网页模板</a></p>
        </div>
    </div>
</div>
<!-- //footer -->
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        $(".dropdown").hover(
            function () {
                $('.dropdown-menu', this).stop(true, true).slideDown("fast");
                $(this).toggleClass('open');
            },
            function () {
                $('.dropdown-menu', this).stop(true, true).slideUp("fast");
                $(this).toggleClass('open');
            }
        );
    });

</script>
<!-- here stars scrolling icon -->
<script type="text/javascript">
    $(document).ready(function () {
        /*
            var defaults = {
            containerID: 'toTop', // fading element id
            containerHoverID: 'toTopHover', // fading element hover id
            scrollSpeed: 1200,
            easingType: 'linear'
            };
        */

        $().UItoTop({easingType: 'easeOutQuart'});
    });
</script>
<!-- //here ends scrolling icon -->
<script type='text/javascript' src="js/jquery.mycart.js"></script>
<script type="text/javascript">
    $(function () {
        var goToCartIcon = function ($addTocartBtn) {
            var $cartIcon = $(".my-cart-icon");
            var $image = $('<img width="30px" height="30px" src="' + $addTocartBtn.data("image") + '"/>').css({
                "position": "fixed",
                "z-index": "999"
            });
            $addTocartBtn.prepend($image);
            var position = $cartIcon.position();
            $image.animate({}, 500, "linear", function () {
                $image.remove();
            });
        };
        <?php if (!$sessionTool->isExist('user')) {?>
        $('.my-cart-btn').click(function () {
            alert("请先登录在添加购物车！");
        });<?php }else {?>
        $('.my-cart-btn').myCart({
            classCartIcon: 'my-cart-icon',
            classCartBadge: 'my-cart-badge',
            affixCartIcon: true,
            checkoutCart: function (products) {
                $.each(products, function () {
                    console.log(this);
                });
            },
            clickOnAddToCart: function ($addTocart) {
                goToCartIcon($addTocart);

            },
            getDiscountPrice: function (products) {
                var total = 0;
                $.each(products, function () {
                    total += this.quantity * this.price;
                });
                return total * 1;
            }
        });<?php }?>

        $('#logout_a').logout({});

        $('#settlement_button').click(function () {
            var products = JSON.parse(sessionStorage.products);
            $.each(products, function () {
                alert(this.id);
                alert(this.name);
                alert(this.summary);
                alert(this.price);
                alert(this.quantity);
                alert(this.image);
            });
        });

    });
</script>
</body>
</html>
