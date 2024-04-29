<?php
// desc time
$cart_buy = array();

if (isset($_SESSION['cart']['buy'])) {
    $cart_buy = $_SESSION['cart']['buy'];

    usort($cart_buy, function ($a, $b) {
        return strtotime($b['dated_at']) - strtotime($a['dated_at']);
    });
}
?>

<!-- header -->
<header class="header">
    <div class="grid wide">
        <div class="box-header">
            <div class="row align-items-center">
                <div class="header-logo col-2">
                    <a href="<?= _WEB_ROOT . '/home' ?>" class="logo-link text-center">
                        <img src="<?= _PATH_IMG_PUBLIC ?>avt_default.png" alt="" class="logo-img">
                    </a>
                </div>
                <div class="header-mid col-8">
                    <div class="menu-top">
                        <ul class="list-top d-flex p-2 list-unstyled">
                            <li class="list-top-item header-hotline">
                                <i class="fa-solid fa-phone"></i>
                                <span class="font-weight-bold">HOTLINE:</span>
                                <a href="tel:0123456789">0123456789</a>
                            </li>
                            <li class="list-top-item header-search">
                                <form action="<?= _WEB_ROOT . '/product/show_product' ?>" method="GET" class="header-search-form input-group">
                                    <input type="text" class="input-search form-control" placeholder="Search..." name="search" required>
                                    <button class="btn-search btn" type="submit">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>

                                    <!-- history search -->
                                    <div class="header-search-history">
                                        <h3 class="header-search-history-heading">Most popular</h3>
                                        <ul class="header-search-history-list">
                                            <li class="header-search-hisroty-item">
                                                <a href="http://localhost/thereds/roduct/show_product?cate=1">Dog food</a>
                                            </li>
                                            <li class="header-search-hisroty-item">
                                                <a href="">Chocolate</a>
                                            </li>
                                            <li class="header-search-hisroty-item">
                                                <a href="">Banana</a>
                                            </li>
                                        </ul>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="header-right col-2">
                    <div class="header-item header-account">
                        <a href="#" class="a-header-right header-account-link">
                            <span class="box-icon">
                                <?php
                                if (isset($_SESSION['user']) && !empty($_SESSION['user']) && !empty($_SESSION['user']['avatar'])) {
                                ?>
                                    <img class=" rounded-circle" src="<?= _WEB_ROOT . '/upload/avt/' . $_SESSION['user']['avatar'] ?> " alt="" style="width: 30px; height: 30px; max-width: 100%; object-fit: cover; object-position: center; margin-bottom: 5px;">
                                <?php
                                } else {
                                ?>
                                    <i class="fa-solid fa-user"></i>

                                <?php
                                }
                                ?>
                            </span>
                            <span class="item-title">ACCOUNT</span>
                            <ul class="header-account-option">
                                <?php
                                if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
                                ?>
                                    <li class="option-select">
                                        <a href="<?php if ($_SESSION['user']['group_id'] == 1) echo _WEB_ROOT . '/admin';
                                                    else echo _WEB_ROOT . '/user/profile' ?>" class="a-option d-flex m-0 justify-content-center">
                                            <i class="fa-solid fa-user-check"></i>
                                            <span class="" style="white-space: nowrap;"><?php echo $_SESSION['user']['name'] ?></span>
                                        </a>
                                    </li>
                                    <li class="option-select">
                                        <a class="a-option heading-regis" href="<?= _WEB_ROOT . '/auth/logout' ?>">
                                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                            Log out</a>
                                    </li>
                                <?php
                                } else {
                                ?>

                                    <li class="option-select">
                                        <a class="a-option " href="<?= _WEB_ROOT . '/auth/login' ?>">
                                            <i class="fa-solid fa-arrow-right-to-bracket"></i>
                                            Login</a>
                                    </li>
                                    <li class="option-select">
                                        <a class="a-option heading-regis" href="<?= _WEB_ROOT . '/auth/register' ?>">
                                            <i class="fa-solid fa-user-plus"></i>
                                            Register</a>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </a>
                    </div>
                    <div class="header-item header-cart">
                        <a href="<?= _WEB_ROOT . '/cart' ?> " class="a-header-right header-cart-link">
                            <span class="box-icon">
                                <i class="fa-solid fa-cart-arrow-down"></i>
                            </span>
                            <span class="item-title">CART</span>

                            <span class="header-cart-notice">
                                <?php
                                if (isset($_SESSION['cart'])) {
                                    echo $_SESSION['cart']['info']['num_order'];
                                } else echo 0;
                                ?></span>


                        </a>
                        <div class="header-cart-list">
                            <?php
                            if (isset($_SESSION['cart']) && !empty($_SESSION['cart']['buy'])) {
                            ?>

                                <span class="header__cart-heading">New added products</span>

                                <ul class="header__cart-list-item">
                                    <?php
                                    foreach ($cart_buy as $item) {
                                    ?>

                                        <!-- cart -->
                                        <li class="header__cart-item">
                                            <img src="<?= _PATH_IMG_PRODUCT . $item['image'] ?>" alt="" class="header__cart-img">
                                            <div class="header__cart-item-info">
                                                <div class="header__cart-item-head">
                                                    <h5 class="header__cart-item-name"><?= $item['name'] ?></h5>
                                                    <div class="header__cart-item-price-wrap">
                                                        <span class="header__cart-item-price" name="quantity[<?= $item['id'] ?>]"><?= '$' . $item['price'] ?></span>
                                                        <span class="header__cart-item-multiply">x</span>
                                                        <span class="header__cart-item-qnt"><?= $item['quantity'] ?></span>
                                                    </div>
                                                </div>

                                            </div>
                                        </li>



                                    <?php
                                    }
                                    ?>
                                </ul>

                                <div class="d-flex justify-content-end m-3">
                                    <?php
                                    if (!empty($_SESSION['user']['group_id'])) {
                                    ?>
                                        <a class="outline-main fs-4 p-2 me-4" href="<?= _WEB_ROOT . '/bill/show_bill' ?>">My order</a>
                                    <?php
                                    }
                                    ?>
                                    <a class="outline-main fs-4 p-2" href="<?= _WEB_ROOT . '/cart' ?>">View cart</a>

                                </div>

                            <?php

                            } else {

                            ?>
                                <!-- No cart .header-no-cart-->

                                <img src="<?= _PATH_IMG_PUBLIC ?>no-cart.png" alt="" class="header-no-cart-img">
                                <span class="header-no-cart-msg">
                                    No product
                                </span>
                                <?php
                                if (!empty($_SESSION['user']['group_id'])) {
                                ?>
                                    <div class="d-flex justify-content-center mb-3"><a class="outline-main p-3 fs-4" href="<?= _WEB_ROOT . '/bill/show_bill' ?>">My order</a></div>
                                <?php } ?>
                            <?php }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- navbar -->
    <nav class="main-menu bg-main">
        <div class="container">
            <ul class="nav-list list-unstyled d-flex justify-content-around">
                <li class="nav-item">
                    <a class="nav-link" href="<?= _WEB_ROOT . '/home' ?>">HOME</a>
                </li>
                <li class="nav-item header-has-menu-product">
                    <a class="nav-link <?php
                                        if ($data['page'] == 'product') echo 'active-header-nav' ?>" href="<?= _WEB_ROOT . '/product/show_product' ?>">PRODUCT
                        <i class="fa-solid fa-angle-down"></i>
                    </a>
                    <!-- menu-product -->
                    <div class="header-menu-product fadein-list">
                        <!-- <div class="header-menu-product-list"> -->
                        <ul class="">
                            <?php
                            foreach ($data['categories'] as $category) {
                            ?>
                                <li class=" ">
                                    <a class="header-heading-product" href="<?php echo _WEB_ROOT . '/product/show_product?cate=' . $category['id'] ?>"><?= $category['name'] ?></a>
                                </li>
                            <?php
                            }
                            ?>

                        </ul>
                        <!-- </div> -->
                    </div>

                </li>

                <li class="nav-item"><a class="nav-link 
                        <?php
                        if ($data['page'] == 'introduce') echo 'active-header-nav' ?>" href="<?= _WEB_ROOT . '/introduce' ?>">ABOUT US</a></li>
                <li class="nav-item"><a class="nav-link 
                        <?php
                        if ($data['page'] == 'contact') echo 'active-header-nav' ?>" href="<?= _WEB_ROOT . '/contact' ?>">CONTACT</a></li>
            </ul>
        </div>
    </nav>
    <nav class="hidden "></nav>
</header>