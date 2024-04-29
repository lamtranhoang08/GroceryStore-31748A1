<a href="<?php echo _WEB_ROOT . '/group/add_group' ?>" class="btn btn-primary mb-2">Add user groups</a>

<div class="mb-3">
    <form action="<?= _WEB_ROOT . '/group' ?>" method="get">
        <input type="text" class="form-control" placeholder="Search user groups" name="search" value="<?= $data['keyword'] ?>">
    </form>
</div>


<?php
if (isset($_SESSION['msg']) && $_SESSION['msg'] != "") {
?>
    <div class="alert alert-success"><?php echo  $_SESSION['msg'] ?></div>
<?php
    $_SESSION['msg'] = '';
}
?>

<table class="table table-striped table_group">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">USER GROUP</th>

            <th scope="col">UPDATE</th>
            <th scope="col">DELETE</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($data['groups'])) {
            foreach ($data['groups'] as $group) {
        ?>
                <tr>
                    <td><?= $group['id'] ?></td>
                    <td><?= $group['name'] ?></td>

                    <td>
                        <a href="<?= _WEB_ROOT . '/group/update_group/' . $group['id'] ?>" class="btn-outline-primary btn rounded">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                    <td>
                        <a class="handle_delete btn-outline-danger btn round" href="<?php echo _WEB_ROOT . '/group/delete_group/' . $group['id'] ?>">
                            <i class="fas fa-user-times"></i>
                        </a>
                    </td>
                </tr>
            <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="5" class="text-center">NO DATA</td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>