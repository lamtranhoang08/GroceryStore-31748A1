<div class="grid wide">
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= _WEB_ROOT . '/home' ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= _WEB_ROOT . '/product/show_product' ?>">Product</a></li>
            <?php
            // show_array($data['nameCate']);
            ?>
            <li class="breadcrumb-item"><a href="<?= _WEB_ROOT . '/product/show_product?cate=' . $data['product']['category_id'] ?>"><?php echo getNameCate($data['product']['category_id'])['name'] ?></a></li>

            <li class="breadcrumb-item "><?= $data['product']['product_name'] ?></li>
        </ol>
    </nav>

    <div class="detail-product">
        <?php
        ?>
        <div class="info-product row">
            <div class="left-product col-5 d-flex" data-aos="fade-right">


                <div class="swiper-wrapper">
                    <div class="swiper-slide swiper-slide-r">
                        <img class="col w-100" style="width: 330px; height: 400px; max-width: 100%; object-fit: cover; object-position: center;" src="<?php echo _PATH_IMG_PRODUCT . $data['product']['image'] ?>" alt="">
                    </div>
                    <?php
                    if (isset($data['img_product']) && $data['img_product'] != '') {
                        foreach ($data['img_product'] as $item) {
                    ?>
                            <div class="swiper-slide swiper-slide-r">
                                <img class="col w-100" style="width: 330px; height: 330px; max-width: 100%; object-fit: cover; object-position: center;" src="<?php echo _PATH_IMG_PRODUCT . $item['image'] ?>" alt="">

                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="right-product col-7" data-aos="fade-left">

                <form action="<?= _WEB_ROOT . '/cart/add_cart?id=' . $data['product']['product_id'] ?>" method="post">

                    <p class="title-product"><?= $data['product']['product_name'] ?></p>
                    <p class="code-product">Code:
                        <span><?= $data['product']['product_id'] ?></span>
                    </p>
                    <p class="price-product"><?= '$' . $data['product']['unit_price'] . ' / ' . $data['product']['unit_quantity'] ?></p>
                    <p class="code-product">In stock:
                        <span><?= $data['product']['in_stock'] ?></span>
                    </p>
                    <div class="num-order-product">
                        <span>Quantity:</span>
                        <input type="number" id="num-order" name="num_order" value="<?= $data['product']['in_stock'] <1 ?0:1 ?>" min=0 max="<?= $data['product']['in_stock'] ?>" class="mb-3">
                        <?php if($data['product']['in_stock'] > 0) {
                            ?>
                        <p><input type="submit" name="add-to-cart" href="" title="" class="add-to-cart mt-3" value="Add to cart"></p>
                        <?php
                        } else {
                        ?>
                         <p><span class="add-to-cart mt-4">Not enough quantity</span></p>
                         <?php
                        } ?>

                </form>
            </div>
        </div>




    </div>



</div>
</div>