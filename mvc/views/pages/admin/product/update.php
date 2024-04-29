<?php
if (!empty($data['msg'])) {
  echo '<div class="alert alert-' . $data['type'] . '">' . $data['msg'] . '</div>';
}
?>
<form method="POST" action="" enctype="multipart/form-data" class="pb-4">
  <div class="grid-cols-12 grid gap-4 row">
    <div class="col">
      <div class="mb-3 col-span-6">
        <label for="exampleInputEmail1" class="form-label">Name product</label>
        <input required type="text" class="form-control" name="productname" placeholder="Name product" value="<?php echo $data['product']['product_name'] ?>">
      </div>
      <?php
      $mb = 'mb-3';
      if ($data['product'] != '') {
        $mb = 'mb-2 ';
      }
      ?>
      <div class="<?php echo $mb ?> col-span-6 " id="imgae-upload">
        <label for="image" class="form-label flex flex-col justify-center" id="upload-img">
          <span>Image Product</span>
          <div class="flex items-center gap-3 mt-2 px-2 py-1 rounded border ">
            <img src="<?php echo _PUBLIC . '/client/assets/image/image_upload.png' ?>" alt="" class="w-7">
            <span>
              Upload file
            </span>
          </div>
          <?php
          if (!empty($data['product'])) {
          ?>
            <img src="<?php echo _PATH_IMG_PRODUCT . $data['product']['image'] ?>" alt="" style="width: 50px; height: 50px; margin-top: 5px; max-width: 100%; object-fit: cover; object-position: center;" id="img-preview">
          <?php
          }
          ?>
        </label>
        <input type="file" id="image" class="form-control hidden" name="product" onchange="readURL(this);"><br>
      </div>

    </div>
    <div class="col">
      <div class="mb-3 col-span-6">
        <label for="exampleInputEmail1" class="form-label">Category</label><br>
        <select name="category" id="category" class="custom-select" required>
          <option>Select....</option>
          <?php
          foreach ($data['categories'] as $category) {
          ?>
            <option <?php echo $category['id'] == $data['product']['category_id'] ? 'selected' : ''
                    ?> value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
          <?php
          }
          ?>
        </select>
      </div>
      <div class="mb-3 col-span-6">
        <label for="exampleInputEmail1" class="form-label">Price</label>
        <input type="text" class="form-control" name="price" placeholder="Example: 205" value="<?php echo $data['product']['unit_price'] ?>">
      </div>
      <div class="mb-3 col-span-6">
        <label for="exampleInputEmail1" class="form-label">Quantity</label>
        <input type="text" class="form-control" name="quantity" placeholder="Example: 205" value="<?php echo $data['product']['unit_quantity'] ?>">
      </div>
      <div class="mb-3 col-span-6">
        <label for="exampleInputEmail1" class="form-label">In Stock</label>
        <input type="text" class="form-control" name="in_stock" placeholder="Example: 205" value="<?php echo $data['product']['in_stock'] ?>">
      </div>

    </div>


  </div>
  <input type="hidden" name="update_product" value="update_product">
  <button type="submit" class="btn btn-primary">Update</button>
</form>