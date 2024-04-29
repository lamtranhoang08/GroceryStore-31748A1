<?php
if (!empty($data['msg'])) {
    echo '<div class="alert alert-' . $data['type'] . '">' . $data['msg'] . '</div>';
}
?>

<form method="POST" action="<?php echo _WEB_ROOT . '/product/add_product' ?>" enctype="multipart/form-data" class="pb-4">
    <div class="grid-cols-12 grid gap-4 row">
        <div class="col">
            <div class="mb-3 col-span-6">
                <label for="exampleInputEmail1" class="form-label">Id</label>
                <input required type="text" class="form-control" name="id" placeholder="id" value="">
            </div>
            <div class="mb-3 col-span-6">
                <label for="exampleInputEmail1" class="form-label">Name product</label>
                <input required type="text" class="form-control" name="productname" placeholder="Name product" value="">
            </div>

            <div class="<?php echo $mb ?> col-span-6 " id="imgae-upload">
                <label for="image" class="form-label flex flex-col justify-center" id="upload-img">
                    <span>Image Product</span>
                    
                    
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
                        <option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3 col-span-6">
                <label for="exampleInputEmail1" class="form-label">Price</label>
                <input type="text" class="form-control" name="price" placeholder="Example: 205" value="">
            </div>
            <div class="mb-3 col-span-6">
                <label for="exampleInputEmail1" class="form-label">Quantity</label>
                <input type="text" class="form-control" name="quantity" placeholder="Example: 205" value="">
            </div>
            <div class="mb-3 col-span-6">
                <label for="exampleInputEmail1" class="form-label">In Stock</label>
                <input type="text" class="form-control" name="in_stock" placeholder="Example: 205" value="">
            </div>

        </div>


    </div>
    <input type="hidden" name="add_product" value="add_product">
    <button type="submit" class="btn btn-primary">Add product</button>
</form>