<?php
if (!empty($data['msg'])) {
  echo '<div class="alert alert-' . $data['type'] . '">' . $data['msg'] . '</div>';
}
?>

<form method="POST" action="" enctype="multipart/form-data" class="pb-5">
  <div class="grid-cols-12 grid gap-4 row">
    <div class="col">
      <div class="mb-3 col-span-6">
        <label for="exampleInputEmail1" class="form-label">User name</label>
        <input type="text" class="form-control" name="username" placeholder="User name" value="<?php echo $data['user']['name'] ?>">
      </div>
      <div class="mb-3 col-span-6 " id="avatar-upload">
        <label for="image" class="form-label flex flex-col justify-center" id="upload-img">
          <span>Avatar</span>
          
        </label>

        <input type="file" id="image" class="form-control hidden" name="avatar" onchange="readURL(this);">

        <?php if (!empty($data['user']['avatar'])) { ?>
          <img class=" my-2 img-thumbnail" src="<?php echo _PATH_AVATAR . $data['user']['avatar'] ?>" alt="" id="img-preview" style="object-fit: cover; object-position: center; width: 100px; height: 100px">
        <?php } ?>

      </div>
      <div class="mb-3 col-span-6">
        <label for="exampleInputEmail1" class="form-label">User group</label><br>
        <select name="group" id="groupuser" class="custom-select" required>
          <option>Lựa chọn....</option>
          <?php
          foreach ($data['groups'] as $group) {
          ?>
            <option <?php
                    echo $group['id'] == $data['user']['group_id'] ? 'selected' : ''
                    ?> value="<?php echo $group['id'] ?>"><?php echo $group['name'] ?></option>
          <?php
          }
          ?>
        </select>
      </div>
      <div class="mb-3 col-span-6">
        <label for="exampleInputEmail1" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" placeholder="example@gmail.com" value="<?php echo $data['user']['email'] ?>">
      </div>
    </div>
    <div class="col">
      <div class="mb-3 col-span-6">
        <label for="exampleInputEmail1" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" placeholder="Password">
      </div>
      <div class="mb-3 col-span-6">
        <label for="exampleInputEmail1" class="form-label">Phone number</label>
        <input type="text" class="form-control" name="phone" placeholder="Phone number" value="<?php echo $data['user']['phone'] ?>">
      </div>
      <div class="mb-3 col-span-6">
        <label for="exampleInputEmail1" class="form-label">Address</label>
        <textarea rows="4" type="text" class="form-control" name="address" placeholder="Address"><?php echo $data['user']['address'] ?></textarea>
      </div>

    </div>


  </div>
  <input type="hidden" name="update_user" value="update_user">
  <button type="submit" class="btn btn-primary w-100">Update</button>
</form>