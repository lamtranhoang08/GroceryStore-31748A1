<div class="grid wide">
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= _WEB_ROOT ?>">Home</a></li>

            <li class="breadcrumb-item ">
                <?php
                if (isset($_GET['cate']) || isset($_GET['search'])) {
                ?>
                    <a href="<?= _WEB_ROOT . '/product/show_product' ?>"><?= $data['title'] ?></a>
                <?php
                } else echo $data['title']
                ?>
            </li>
            <?php
            if (isset($_GET['cate'])) {
            ?>
                <li class="breadcrumb-item ">
                    <?= getNameCate($_GET['cate'])['name'] ?>
                </li>
            <?php
            }
            ?>
            <?php
            if (isset($_GET['search'])) {
            ?>
                <li class="breadcrumb-item ">
                    <?= $_GET['search'] ?>
                </li>
            <?php

            } ?>
        </ol>
    </nav>



    <div class="d-flex">
        <div class="col-3">
            <ul class="category-list d-flex flex-column gap-4">
                <?php
                foreach ($data['categories'] as $category) {

                ?>
                    <li class="category-item"><a href="?cate=<?php echo $category['id'] ?>" class="category-l <?php if (isset($_GET['cate']) && $category['id'] == $_GET['cate']) echo 'active-cate' ?>"><?php echo $category['name'] ?></a></li>

                <?php
                }

                ?>
            </ul>
        </div>
        <div class="col-9">
            <div id="" class="product-main d-flex flex-wrap">

                <?php
                if (!empty($data['SelectProByPage'])) {
                    foreach ($data['SelectProByPage'] as $item) {

                ?>
                        <div class="product-item col-lg-3">
                            <a href="<?= _WEB_ROOT . '/detailproduct/product/' . $item['product_id'] ?>" class="home-product-item">
                                <div class="pro-product-item__img">
                                    <img src="<?= _PATH_IMG_PRODUCT . $item['image'] ?>" alt="" srcset="" >
                                </div>
                                <div class="home-product-item-body">
                                    <h4 class="home-product-item__name"><?= $item['product_name'] ?></h4>
                                    <div class="home-product-item__price">
                                        <span class="home-product-item__price-current"><?php echo '$' . $item['unit_price'] . ' / ' .  $item['unit_quantity'] ?></span>
                                    </div>

                                    <div class="home-product-item__origin">
                                        <!-- <span class="home-product-item__brand">Lining</span> -->
                                        <div class="home-product-item__origin-name"><?= $item['in_stock'] ?> Left</div>
                                    </div>
                                    <div class="home-product-item__favourite">
                                        <i class="fa-solid fa-check"></i>
                                        <span>Latest</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <div class="text-center p-5 w-100">
                        <span class="alert text-center">No items found, please try again!</span>

                    </div>
                <?php
                }
                ?>

            </div>
        </div>
    </div>




    <?php
    getPaging($data['count_product'], $data['num_per_page']);
    ?>





</div>