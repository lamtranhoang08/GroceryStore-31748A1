<a href="<?php echo _WEB_ROOT . '/category/add_category' ?>" class="btn btn-primary mb-2">Add category</a>
<div class="mb-3">
    <form action="<?= _WEB_ROOT . '/category' ?>" method="get">
        <input type="text" class="form-control" placeholder="Search category" name="search" value="<?= $data['keyword'] ?>">
    </form>
</div>

<?php
if (!empty($_SESSION['msg'])) {
    echo '<div class="alert alert-success" id="toast-success">' . $_SESSION['msg'] . '</div>';
    $_SESSION['msg'] = '';
}
?>

<table class="table table-striped table_category">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">CATEGORY NAME</th>
            <th scope="col">THE NUMBER OF PRODUCTS</th>
            <th class="text-center" scope="col">UPDATE</th>
            <th class="text-center" scope="col">DELETE</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($data['categories'])) {
            foreach ($data['categories'] as $category) {
        ?>
                <tr>
                    <th scope="row"><?php echo $category['id'] ?></th>
                    <td><?php echo $category['name'] ?></td>
                    <th scope="row"><?php
                                    $count_cate_value = null;
                                    foreach ($data['getAllCl'] as $cate) {
                                        if ($cate['id'] == $category['id']) {
                                            $count_cate_value = $cate['count_cate'];
                                            break;
                                        }
                                    }
                                    if ($count_cate_value !== null) {
                                        echo '' . $count_cate_value . '';
                                    } else {
                                        echo  0;
                                    }
                                    ?></th>
                    <td class="text-center"><a class="btn btn-outline-primary" href="<?php echo _WEB_ROOT . '/category/update_category/' . $category['id'] ?>"><i class="far fa-edit"></i></a></td>
                    <td class="text-center"><a class="handle_delete btn btn-outline-danger" href="<?php echo _WEB_ROOT . '/category/delete_category/' . $category['id'] ?>">
                            <i class="fas fa-trash-alt"></i>
                        </a></td>
                </tr>
            <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="5" class="text-center">KHÔNG CÓ DỮ LIỆU</td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>