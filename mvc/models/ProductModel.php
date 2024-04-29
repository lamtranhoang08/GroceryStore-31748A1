<?php
class ProductModel extends DB
{
    function getAll($keyword = '', $product_id = 0, $category_id = 0)
    {
        $select = "SELECT * FROM products WHERE 1";
        if (!empty($keyword)) {
            $select .= " AND  product_name like '%" . $keyword . "%'";
        }

        if ($product_id > 0) {
            $select .= " AND product_id <> $product_id";
        }
        if ($category_id > 0) {
            $select .= " AND category_id = $category_id";
        }
        $select .= " ORDER BY product_id DESC";
        return $this->pdo_query($select);
    }

    function countProduct()
    {
        return $this->pdo_query_value('SELECT count(*) FROM products');
    }

    function SelectProByPage($start, $num_per_page, $keyword = '', $id = 0, $category_id = 0)
    {
        $select = "SELECT * FROM products ";
        if (!empty($keyword)) {
            $select .= " WHERE  product_name like '%" . $keyword . "%'";
        }

        if ($id > 0) {
            $select .= " WHERE product_id <> $id";
        }
        if ($category_id > 0) {
            $select .= " WHERE category_id = $category_id";
        }
        $select .= "  ORDER BY product_id ASC LIMIT $start, $num_per_page";
        return $this->pdo_query($select);
    }

    function getNewProduct($category_id = 0)
    {
        $select = "SELECT * from products WHERE 1";
        return $this->pdo_query($select);
    }

    function insertPro($id, $name, $price, $quantity, $in_stock, $category_id, $image)
    {
        $pro = "INSERT INTO products(product_id, product_name, unit_price, unit_quantity, in_stock, category_id, image) VALUES('$id','$name','$price', $quantity, $in_stock, '$category_id', '$image')";
        return $this->pdo_execute($pro);
    }

    function addImageProduct($productId, $image, $created_at)
    {
        $insert = "INSERT INTO img_product(product_id, image, created_at) VALUES('$productId', '$image', '$created_at')";
        return $this->pdo_execute($insert);
    }

    function deletePro($id)
    {
        $delete = "DELETE FROM products WHERE product_id = '$id'";
        return $this->pdo_execute($delete);
    }

    function SelectProduct($id)
    {
        $select = "SELECT * FROM products WHERE product_id = '$id'";
        if ($this->pdo_query_one($select)) {
            return $this->pdo_query_one($select);
        } else {
            return [];
        }
    }





    function SelectProductImg($id)
    {
        $select = "SELECT * FROM img_product WHERE product_id = '$id'";
        if ($this->pdo_query($select)) {
            return $this->pdo_query($select);
        } else {
            return [];
        }
    }

    function updateProduct($id, $name, $image, $price, $quantity, $in_stock, $category_id)
    {
        if (empty($image)) {
            $update = "UPDATE products SET product_name = '$name', category_id = '$category_id', unit_price = '$price', unit_quantity = '$quantity', in_stock = '$in_stock' WHERE product_id = '$id'";
        } else {
            $update = "UPDATE products SET product_name = '$name', image = '$image', category_id = '$category_id', unit_price = '$price', unit_quantity = '$quantity', in_stock = '$in_stock' WHERE product_id = '$id'";
        }
        return $this->pdo_execute($update);
    }
    
    public function updateRemaining($id, $remaining)
    {
        $sql = "UPDATE products SET in_stock = '$remaining' WHERE product_id = '$id'";
        return $this->pdo_execute($sql);
    }

    function deleteImgPro($id)
    {
        $delete = "DELETE FROM img_product WHERE product_id = '$id'";
        return $this->pdo_execute($delete);
    }

    function updateImgProduct($productId, $image, $updated_at)
    {
        $update = "UPDATE img_product SET image = '$image', updated_at = '$updated_at' WHERE product_id = '$productId'";
        return $this->pdo_execute($update);
    }

    function getTrendPro()
    {
        $pro = "SELECT * FROM products ORDER BY view DESC LIMIT 3 ";
        return $this->pdo_query($pro);
    }

    function getTrendProImg($id)
    {
        $select = "SELECT * FROM img_product WHERE product_id = '$id' LIMIT 1";
        if ($this->pdo_query_one($select)) {
            return $this->pdo_query_one($select);
        } else {
            return [];
        }
    }

    function getProImg($id)
    {
        $select = "SELECT * FROM img_product WHERE product_id = '$id'";
        if ($this->pdo_query_one($select)) {
            return $this->pdo_query_one($select);
        } else {
            return [];
        }
    }

    function addCart($id)
    {


        // return $this->pdo_query_one($select);
        $select = "SELECT * FROM products WHERE id = '$id'";
        $quantity = 1;
        if (isset($_SESSION['cart']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
            $quantity = $_SESSION['cart']['buy'][$id]['quantity'] + 1;
        }
        $product = $this->pdo_query_one($select);
        // show_array($product);
        $_SESSION['cart']['buy'][$id] = array(
            'id' => $product['id'],
            'image' => $product['image'],
            'name' => $product['name'],
            'price' => $product['price'],
            'quantity' => $quantity,

            'sub_total' => $product['price'] * $quantity,
        );
    }

    function infoCart()
    {
        if (isset($_SESSION['cart'])) {
            return $_SESSION['cart']['info'];
        }
    }

    function addProductCart($id, $number = 1)
    {
        $itemPro = $this->SelectProduct($id);
        $itemPro['number'] = $number;
        $itemPro['total'] = $itemPro['number'] * $itemPro['price'];

        $check = 0;
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {

            foreach ($_SESSION['cart'] as $key => $item) {
                if (isset($item['id']) && $item['id']) {

                    if ($item['id'] == $id) {
                        if ($number > 1) {
                            $item['number'] = $item['number'] + $number;
                        } else  if ($number == 1) {

                            $item['number']++;
                        } else {
                            $item['number']--;
                        }
                        $item['total'] = $item['number'] * $item['price'];
                        $itemNew = $item;
                        $keyNew  = $key;
                        $check = 1;
                    }
                }
            }
            if ($check == 1) {
                $_SESSION['cart'][$keyNew] = [];
                $_SESSION['cart'][$keyNew] = $itemNew;
            } else {

                array_push($_SESSION['cart'], $itemPro);
            }
        } else {
            $_SESSION['cart'] = [];
            array_push($_SESSION['cart'], $itemPro);
        }
        return json_encode($_SESSION['cart']);
    }

    function  removeItem($id)
    {
        if (isset($_SESSION['cart']) && $_SESSION['cart']) {
            $keyRemove = -1;
            foreach ($_SESSION['cart'] as $key => $item) {
                if ($item['id'] == $id) {
                    $keyRemove = $key;
                }
            }
            if ($keyRemove > -1) {
                array_splice($_SESSION['cart'], $keyRemove, 1);
            }
        }
        return json_encode($_SESSION['cart']);
    }
}
