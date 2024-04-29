<?php
if (!empty($data['msg'])) {
  echo '<div class="alert alert-' . $data['type'] . '">' . $data['msg'] . '</div>';
}
?>
<form method="POST">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">User group name</label>
    <input type="text" class="form-control" name="groupname" placeholder="User group name" value="<?php echo $data['group']['name'] ?>">
  </div>
  <input type="hidden" name="update_group" value="update_group">
  <button type="submit" class="btn btn-primary">UPDATE</button>
</form>