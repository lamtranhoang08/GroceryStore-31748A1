<?php
if (!empty($data['msg'])) {
    echo '<div class="alert alert-' . $data['type'] . '">' . $data['msg'] . '</div>';
}
?>
<form method="POST">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Category name</label>
        <input type="text" class="form-control" name="categoryname" placeholder="Category name" required>
    </div>
    <input type="hidden" name="add_category" value="add_category">
    <button type="submit" class="btn btn-primary">Add</button>
</form>