<?php
if(!empty($data['msg'])) {
    echo '<div class="alert alert-'.$data['type'].'">'.$data['msg'].'</div>';
}
?>
<form method="POST">
  <div class="mb-3">
    <label for="" class="form-label">Category name</label>
    <input type="text" class="form-control" name="categoryname" placeholder="Category name" value="<?php echo $data['category']['name'] ?>">
  </div>
  <input type="hidden" name="update_category" value="update_category">
  <button type="submit" class="btn btn-primary">Update</button>
</form>