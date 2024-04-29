<?php
if (!empty($data['msg'])) {
  echo '<div class="alert alert-' . $data['type'] . '">' . $data['msg'] . '</div>';
}
?>

<form method="POST" action="<?php echo _WEB_ROOT . '/user/add_user' ?>" enctype="multipart/form-data" class="pb-5">
  <div class="grid-cols-12 grid gap-4">

    <div class="row">
      <div class="mb-3 col">
        <label for="" class="form-label">User name</label>
        <input type="text" class="form-control" name="username" placeholder="User name" required>
      </div>
      <div class="mb-3 col">
        <label for="" class="form-label">Phone number</label>
        <input type="text" class="form-control" name="phone" placeholder="Phone" required>
      </div>
    </div>

    <div class="row">
      <div class="mb-3 col">
        <label for="" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" placeholder="example@gmail.com" required>
      </div>
      <div class="mb-3 col">
        <label for="" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" placeholder="Password" required>
      </div>
    </div>
    <div class="row">
      <div class="mb-3 col" id="image-upload">
        <label for="image" class="form-label flex flex-col justify-center" id="upload-img">
          <span>Avatar</span>
          
        </label>
        <input type="file" id="image" class="form-control hidden" name="avatar" onchange="readURL(this);"><br>
      </div>
      <div class="mb-3 col">
        <label for="exampleInputEmail1" class="form-label">User group</label><br>
        <select name="group" id="groupuser" class="custom-select" required>
          <?php
          foreach ($data['groups'] as $group) {
          ?>
            <option value="<?php echo $group['id'] ?>"><?php echo $group['name'] ?></option>
          <?php
          }
          ?>
        </select>
      </div>

    </div>
    <div class="row">
      <div class="mb-3 col">
        <label for="exampleInputEmail1" class="form-label">Address</label>
        <textarea rows="4" type="text" class="form-control" name="address" placeholder="Address" required></textarea>
      </div>
      
    </div>




  </div>
  <input type="hidden" name="add_user" value="add_user">
  <button type="submit" class="btn btn-primary">Add</button>
</form>