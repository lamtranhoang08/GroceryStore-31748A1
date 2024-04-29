<?php
class product extends Controller
{

    private ProductModel $products;
    private CategoryModel $categories;

    function __construct()
    {
        $this->products = $this->model('ProductModel');
        $this->categories = $this->model('CategoryModel');
    }

    function show_product()
    {
        $cate = 0;
        if (isset($_GET['cate'])) {

            $cate  = $_GET['cate'];
        }

        $categories = $this->categories->getAllCl();
        $productNew = [];

        $keyword = '';
        $cate = 0;
        if (isset($_GET['search'])) {
            $keyword = $_GET['search'];
            $cate = 0;
        } elseif (isset($_GET['cate'])) {

            $cate  = $_GET['cate'];
            $keyword = '';
        }
        $products = $this->products->getAll($keyword, 0, $cate);
        // foreach ($products as $item) {
        //     if (!empty($this->products->getProImg($item['product_id']))) {
        //         $item['detail_img'] = $this->products->getProImg($item['product_id'])['image'];
        //     }
        //     array_push($productNew, $item);
        // }

        // show_array($productNew);
        $count_product = !empty($products) ? count($products) : 0;

        $num_per_page = 8;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $start = ($page - 1) * $num_per_page;
        $SelectProByPage = $this->products->SelectProByPage($start, $num_per_page, $keyword, 0, $cate);
        return $this->view('client', [
            'page' => 'product',
            'css' => ['base', 'main'],
            'js' => ['main'],
            'title' => 'Product',
            'products' => $products,
            'categories' => $categories,
            'SelectProByPage' => $SelectProByPage,
            'keyword' => $keyword,
            'num_per_page' => $num_per_page,
            'cate' => $cate,
            'count_product' => $count_product,
        ]);
    }

    function index()
    {
        $cate = 0;
        if (isset($_POST['cate'])) {

            $cate  = $_POST['cate'];
        }

        $categories = $this->categories->getAll();

        $keyword = '';
        $cate = 0;
        if (isset($_GET['search'])) {
            $keyword = $_GET['search'];
            $cate = 0;
        } elseif (isset($_POST['cate'])) {

            $cate  = $_POST['cate'];
            $keyword = '';
        } elseif (isset($_GET['cate'])) {

            $cate  = $_GET['cate'];
            $keyword = '';
        }
        $products = $this->products->getAll($keyword, 0, $cate);

        $count_product = !empty($products) ? count($products) : 0;

        $num_per_page = 8;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $start = ($page - 1) * $num_per_page;
        $SelectProByPage = $this->products->SelectProByPage($start, $num_per_page, $keyword, 0, $cate);

        return $this->view('admin', [
            'page' => 'product/list',
            'js' => ['deletedata', 'search'],
            'title' => 'PRODUCT',
            'products' => $products,
            'categories' => $categories,
            'SelectProByPage' => $SelectProByPage,
            'keyword' => $keyword,
            'num_per_page' => $num_per_page,
            'cate' => $cate,
            'count_product' => $count_product,
            'keyword' => $keyword,
            'pagePag' => 'product'

        ]);
    }

    function add_product()
    {
        $msg = '';
        $type = '';

        $categories = $this->categories->getAll();

        if (isset($_POST['add_product']) && ($_POST['add_product'])) {
            $image = "";
            $id = $_POST['id'];
            $quantity = $_POST['quantity'];
            $in_stock = $_POST['in_stock'];
            if (isset($_FILES['product']['name'])) {
                $image = $this->processImg($_FILES['product']['name'], $_FILES['product']['tmp_name']);
            }
            $name = $_POST['productname'];
            $price = $_POST['price'];

            $category_id = $_POST['category'];
            if ($_POST['category'] < 1 || $_POST['category'] == 0) {
                $category_id = "0";
            } else {
                $category_id = $_POST['category'];
            }

            $idProduct = $this->products->insertPro($id, $name, $price, $quantity, $in_stock, $category_id, $image);

            if ($idProduct) {
                $type = 'success';
                $msg = 'Added product successfully';
                $_SESSION['msg'] = $msg;
                header('Location: ' . _WEB_ROOT . '/product/list');
            } else {
                $type = 'danger';
                $msg = 'System error';
            }

            unset($_POST['add_product']);
        }
        return $this->view('admin', [
            'page' => 'product/add',
            'categories' => $categories,
            'msg' => $msg,
            'type' => $type,
            'title' => 'PRODUCT',
            'js' => ['uploadImg']
        ]);
    }

    function update_product($id)
    {
        $msg = [];
        $type = [];

        $product = $this->products->SelectProduct($id);
        // $productImg = $this->products->SelectProductImg($id);
        $categories = $this->categories->getAll();

        if (isset($_POST['update_product']) && ($_POST['update_product'])) {
            $image = "";
            $name = $_POST['productname'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            $in_stock = $_POST['in_stock'];
            $category_id = $_POST['category'];


            if (isset($_FILES['product']['name'])) {
                $image = $this->processImg($_FILES['product']['name'], $_FILES['product']['tmp_name']);
            }
            // show_array($image);
            $status = $this->products->updateProduct($id, $name, $image, $price, $quantity, $in_stock, $category_id);

            if ($status) {
                $type = 'success';
                $msg = 'Updated product successfully';
                $_SESSION['msg'] = $msg;
                header('Location: ' . _WEB_ROOT . '/product/list');
            } else {
                $type = 'danger';
                $msg = 'System error';
            }

            unset($_POST['update_product']);
        }

        return $this->view('admin', [
            'page' => 'product/update',
            'product' => $product,
            'categories' => $categories,
            // 'productImg' => $productImg,
            'msg' => $msg,
            'type' => $type,
            'title' => 'PRODUCT',
            'js' => ['uploadImg']
        ]);
    }

    function delete_product($id)
    {
        // $this->products->deleteImgPro($id);
        $status = $this->products->deletePro($id);
        if ($status) echo -1;
        else echo -2;
    }



    function processImg($filesName, $tmpName)
    {
        if (isset($filesName) && !empty($filesName)) {
            $date = new DateTimeImmutable();
            $fileNameArr = explode(".", $filesName);
            $name = $date->getTimestamp() . rand();
            $target_file = _UPLOAD . '/product/' .  basename($name . "." . $fileNameArr[1]);

            if (move_uploaded_file($tmpName, $target_file)) {
                return $name . "." . $fileNameArr[1];
            }
        }
    }
}
