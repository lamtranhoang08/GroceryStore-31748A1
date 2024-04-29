<a class="mb-2 btn btn-primary" href="<?php echo _WEB_ROOT . '/product/add_product' ?>">Add product</a>

<div class="row w-100">
    <div class="col-4">
        <form class="" action="<?= _WEB_ROOT . '/product' ?>" method="POST">

            <select name="cate" class="custom-select mb-2">
                <option value="">Select category....</option>
                <?php
                foreach ($data['categories'] as $category) {
                ?>
                    <option value="<?= $category['id'] ?>" <?php if (isset($_POST['cate']) && $_POST['cate'] == $category['id'] || isset($_GET['cate']) && $_GET['cate'] == $category['id']) {
                                                                    echo 'selected';
                                                                } ?>><?= $category['name'] ?></option>
                <?php
                }
                ?>
            </select>

            <button type="submit" class="btn btn-outline-primary mb-3">Filter</button>
        </form>
    </div>
    <div class="col-8">
        <form action="<?= _WEB_ROOT . '/product' ?>" method="get">
            <input type="text" class="form-control" placeholder="Search product" name="search" value="<?= $data['keyword'] ?>">
        </form>
    </div>

</div>


<?php
if (!empty($_SESSION['msg'])) {
    echo '<div class="alert alert-success" id="toast-success">' . $_SESSION['msg'] . '</div>';
    $_SESSION['msg'] = '';
}
?>
<?php
if (!empty($data['products'])) {
    $count_product = count($data['products']);
?>
    <div class="d-flex justify-content-between">
        <h4>Current Items In Stock <?= $count_product ?></h4>
        <?php
        getPagingAdmin($data['count_product'], $data['num_per_page'], $data['pagePag']);
        ?>

    </div>
    <table class="table table-striped table_product">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">PRODUCT NAME</th>
                <th scope="col">CATEGORY</th>
                <th scope="col">PRICE</th>
                <th scope="col">IN STOCK</th>
                <th class="text-center" scope="col">UPDATE</th>
                <th class="text-center" scope="col">DETELE</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data['SelectProByPage'] as $product) {
            ?>
                <tr>
                    <td class="align-middle" scope="row"><b><?php echo $product['product_id'] ?></b></td>
                    <!-- <td class="align-middle w-25"><?php echo $product['product_name'] ?></td> -->
                    <td class="align-middle"><img style="width: 70px; height: 70px; margin-top: 5px; margin-right: 5px; max-width: 100%; object-fit: cover; object-position: center;" class="img-thumbnail" src="
                    <?php if (empty($product['image'])) {
                        echo _PATH_AVATAR . 'avt_default.png';
                    } else {
                        echo _PATH_IMG_PRODUCT . $product['image'];
                    } ?>" width="60px"><?= $product['product_name'] ?></td>
                    <td class="align-middle"><?php echo getNameCate($product['category_id'])['name'] ?></td>
                    <td class="align-middle"><?php echo '$' . $product['unit_price'] . ' / ' . $product['unit_quantity'] ?></td>
                    <td class="align-middle"><?php echo $product['in_stock'] ?></td>
                    <td class="align-middle text-center">
                        <a class="btn btn-outline-primary" href="<?php echo _WEB_ROOT . '/product/update_product/' . $product['product_id'] ?>">
                            <i class="far fa-edit"></i>
                        </a>
                    </td>
                    <td class="align-middle text-center">
                        <a class="btn btn-outline-danger delete_product handle_delete" href="<?php echo _WEB_ROOT . '/product/delete_product/' . $product['product_id'] ?>">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
            <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="8" class="text-center">NO DATA</td>
            </tr>
        <?php
        }
        ?>
        </tbody>

    </table>


    <?php
