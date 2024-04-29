<!-- body -->
<?php
if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) {
?>
    <div id="message" style="position: fixed; top: 130px; right: 100px; z-index: 1; width: 400px;" class="alert alert-success mt-3 fs-3" role="alert">
        <?= $_SESSION['msg'] ?>
    </div>
<?php
    $_SESSION['msg'] = '';
}
?>

<!-- slider -->


<div id="carouselExampleIndicators" class="carousel slide " data-bs-ride="carousel" data-aos="fade-up">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="<?= _PATH_IMG_PUBLIC . '/slide/1.png' ?>" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="<?= _PATH_IMG_PUBLIC . '/slide/2.png' ?>" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="<?= _PATH_IMG_PUBLIC . '/slide/3.png' ?>" class="d-block w-100" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>




<!-- body-product -->
<div class="body-product">
    <div class="grid wide">

        <div class="home-product-new mb-5" data-aos="zoom-in">
            <span class="text-center w-100 fw-bold d-block fs-1 text-color-main p-3">LATEST PRODUCT</span>
        </div>



        <section class="product-tabs" data-aos="fade-up">
            <div class="product-section row">
                <div class="product-list-item col-lg-12">
                    <div id="" class="content-list-item-body">

                        <?php
                        // show_array($data['category_id']);

                        foreach ($data['products'] as $product) {

                        ?>
                            <div class="product-item">
                                <a href="<?= _WEB_ROOT . '/detailproduct/product/' . $product['product_id'] ?>" class="home-product-item">
                                    <div class="home-product-item__img">
                                        <img src="<?= _PATH_IMG_PRODUCT . $product['image'] ?>" alt="" srcset="">
                                    </div>
                                    <div class="home-product-item-body">
                                        <h4 class="home-product-item__name"><?= $product['product_name'] ?></h4>
                                        <div class="home-product-item__price">
                                            <span class="home-product-item__price-current"><?php echo '$' . $product['unit_price'] . ' / ' .  $product['unit_quantity'] ?></span>
                                        </div>

                                        <div class="home-product-item__origin">
                                            <!-- <span class="home-product-item__brand">Lining</span> -->
                                            <div class="home-product-item__origin-name"><?= $product['in_stock'] ?> Left</div>
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

                        ?>




                    </div>


                </div>
            </div>

        </section>





    </div>
</div>