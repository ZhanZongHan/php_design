<?php
include_once($_COOKIE['ABSPATH'] . '/src/views/user/head_model.php');
$head_icons = scandir($_COOKIE['ABSPATH'] . '/uploads/user_head_icon');
$username = '';
$password = '';
if (isset($_COOKIE['username']) and isset($_COOKIE['password'])) {
    $username = $_COOKIE['username'];
    $password = $_COOKIE['password'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign In & Sign Up</title>
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
        <a href="products.html">Today's special Offers !</a>
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
    <div class="w3l_header_right">
        <ul>
            <li class="dropdown profile_details_drop">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user" aria-hidden="true"></i><span
                            class="caret"></span></a>
                <div class="mega-dropdown-menu">
                    <div class="w3ls_vegetables">
                        <ul class="dropdown-menu drp-mnu">
                            <li><a href="user_login.php">登录</a></li>
                            <li><a href="user_login.php">注册</a></li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
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
            <li><i class="fa fa-home" aria-hidden="true"></i><a href="user_index.php">Home</a><span>|</span></li>
            <li>登录 & 注册</li>
        </ul>
    </div>
</div>
<!-- //products-breadcrumb -->
<!-- banner -->
<div class="banner">

    <!-- login -->
    <div class="w3_login">
        <h3>登录 & 注册</h3>
        <div class="w3_login_module">
            <div class="module form-module">
                <div class="toggle"><i class="fa fa-times fa-pencil"></i>
                    <div class="tooltip">Click Me</div>
                </div>
                <div class="form">
                    <h2>登录</h2>
                    <form id="login_form">
                        <input type="text" name="username" id="login_username" placeholder="用户名" value="<?php echo $username?>" required=" ">
                        <input type="password" name="password" id="login_password" placeholder="密码" value="<?php echo $password?>" required=" ">
                        <input type="hidden" id="login_dst" value="user/user_index.php">
                        <input type="checkbox" id="remember_password"><span><label for="remember_password">记住密码</label></span>
                        <input type="submit" id="login" value="登录">
                    </form>
                </div>
                <div class="form">
                    <h2>注册</h2>
                    <form id="register_form">
                        <input type="text" name="username" id="username" placeholder="用户名" required=" "><span
                                id="username_span"></span>
                        <input type="password" name="password" id="password" placeholder="密码" required=" ">
                        <input type="email" name="email" id="email" placeholder="邮箱地址" required=" ">
                        <input type="text" name="telephone" id="telephone" placeholder="电话号码" required=" ">
                        <button type="button" data-toggle="modal" data-target="#myModal">点击选择头像</button>
                        <span><img id="head_icon_img" src="../../../uploads/user_head_icon/ji3ko3lltswqk.jpg"
                                   name="head_icon" height="60px" width="60px"></span>
                        <!-- 模态框（Modal） -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <img width="100px" height="100px"
                                             src="../../../uploads/user_head_icon/<?php echo $head_icons[2] ?>">
                                        <input type="radio" name="head_icon_radio" name="head_icon"
                                               value="<?php echo $head_icons[2] ?>" checked="checked">
                                        <?php
                                        $count = 1;
                                        for ($i = 3; $i < count($head_icons); $i++, $count++) { ?>
                                            <img width="100px" height="100px"
                                                 src="../../../uploads/user_head_icon/<?php echo $head_icons[$i] ?>">
                                            <input type="radio" name="head_icon_radio" name="head_icon"
                                                   value="<?php echo $head_icons[$i] ?>">
                                            <?php if ($count % 5 == 0) {
                                                echo "</br>";
                                            }
                                        } ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" id="yes" class="btn btn-primary"
                                                onclick="choose_head_icon()" data-dismiss="modal">确认
                                        </button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal -->
                        </div>
                        <input type="hidden" id="head_icon">
                        <div class="">
                            <br>
                            请选择地址：
                            <div data-toggle="distpicker">
                                <div class="form-group">
                                    <label class="sr-only" for="province1">Province</label>
                                    <select class="form-control" id="province1"></select>
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="city1">City</label>
                                    <select class="form-control" id="city1"></select>
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="district1">District</label>
                                    <select class="form-control" id="district1"></select>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="register_dst" value="user/user_login.php">
                        <input type="submit" id="register" value="注册">
                    </form>
                </div>
                <div class="cta"><a href="#">Forgot your password?</a></div>
            </div>
        </div>
        <script>
            $('.toggle').click(function () {
                // Switches the Icon
                $(this).children('i').toggleClass('fa-pencil');
                // Switches the forms
                $('.form').animate({
                    height: "toggle",
                    'padding-top': 'toggle',
                    'padding-bottom': 'toggle',
                    opacity: "toggle"
                }, "slow");
            });
        </script>
    </div>
    <!-- //login -->

    <div class="clearfix"></div>
</div>
<!-- //banner -->
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
    $(function () {
        $('#username').change(function () {
            var xmlhttp;
            var username = $('#username').val();
            var dst = $('#register_dst').val();
            if (username.length == 0) {
                return;
            }
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    if (xmlhttp.responseText == "0") {
                        $('#username_span').html("用户名可用");
                        return;
                    } else {
                        $('#username_span').html("用户名已存在");
                        return;
                    }
                }
            };
            xmlhttp.open("POST", "../../controllers/userController.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("username=" + username + "&username_validate=1");
        });

    /*    $('#register').click(function () {

        });*/
        $("#register_form").validate({
            rules: {
                username: {
                    required: true,
                },
                password: {
                    required: true,
                    minlength: 6,
                    maxlength: 16
                },
                email: {
                    required: true,
                    email: true
                },
                telephone: {
                    required: true,
                    digits: true,
                    minlength: 11,
                    maxlength: 11
                }
            },
            messages: {
                username: {
                    required: "用户名不能为空",
                },
                password: {
                    required: "密码不能为空",
                    minlength: "密码长度不能少于6个字符",
                    maxlength: "密码长度不能超过16个字符"
                },
                email: {
                    required: "邮箱不能为空",
                    email: "邮箱格式不正确"
                },
                telephone: {
                    required: "电话不能为空",
                    minlength: "电话长度为11位",
                    maxlength: "电话长度为11位"
                }
            },
            submitHandler: function (form) {
                var xmlhttp;
                var username = $('#username').val();
                var password = $('#password').val();
                var telephone = $('#telephone').val();
                var email = $('#email').val();
                var head_icon = $('#head_icon').val();
                var province = $('#province1').val();
                var city = $('#city1').val();
                var district = $('#district1').val();
                var address = province + "/" + city + "/" + district;
                xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        if (xmlhttp.responseText != "0") {

                            alert("注册成功，现在前往登录！");
                            window.location.href = "user_login.php";
                        } else {
                            alert("注册失败！");
                            return;
                        }
                    }
                };
                var item = "username=" + username + "&password=" + password + "&telephone=" + telephone
                    + "&email=" + email + "&head_icon=" + head_icon + "&address=" + address + "&register=1";
                xmlhttp.open("POST", "../../controllers/userController.php", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send(item);
            }
        });

        $('#login_form').validate({
            roles: {
                username: {
                    required: true
                },
                password: {
                    required: true
                }
            },
            messages: {
                username: {
                    required: "用户名不能为空"
                },
                password: {
                    required: "密码不能为空"
                }
            },
            submitHandler: function (form) {
                var xmlhttp;
                var username = $('#login_username').val();
                var password = $('#login_password').val();
                var remember_password = $('#remember_password');
                xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        if (xmlhttp.responseText == "1") {
                            alert("登录成功！");
                            window.location.href = "user_index.php";
                        } else {
                            alert("用户名或密码输入错误！");
                        }
                    }
                }
                xmlhttp.open("POST", "../../controllers/userController.php", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("username="+username+"&password="+password+"&login_submit=1&remember_password=" + remember_password.is(":checked"));
            }
        });
    });
</script>
<script type="text/javascript" id="snipcart" src="js/snipcart.js"
        data-api-key="ZGQxNzVjZTItOWRmNS00YjJhLTlmNGUtMDE4NjdiY2RmZGNj"></script>
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
        });

    });

    function choose_head_icon() {
        var img_name = $('input[name="head_icon_radio"]:checked').val();
        $('#head_icon_img').attr('src', "../../../uploads/user_head_icon/" + img_name);
        $('#head_icon').val(img_name);
    }
</script>
<script src="js/distpicker.data.js"></script>
<script src="js/distpicker.js"></script>
<script src="js/main.js"></script>
<script src="http://static.runoob.com/assets/jquery-validation-1.14.0/dist/jquery.validate.min.js"></script>
<script src="http://static.runoob.com/assets/jquery-validation-1.14.0/dist/localization/messages_zh.js"></script>
</body>
</html>