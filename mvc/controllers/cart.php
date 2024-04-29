<?php

class cart extends Controller
{
    private BillModel $bills;
	private CategoryModel $categories;
	private ProductModel $products;
	private UserModel $users;
    function __construct()
    {
        $this->products = $this->model('ProductModel');
        $this->categories = $this->model('CategoryModel');
        $this->bills = $this->model('BillModel');
    }

    public function index()
    {
        // unset($_SESSION['cart']);
        $categories = $this->categories->getAllCl();
        $cate = 0;
        $products = $this->products->getAll('', 0, $cate);

        $productNew = [];
        foreach ($products as $item) {
            // $item['detail_img'] = $this->products->getProImg($item['id'])['image'];
            array_push($productNew, $item);
        }


        $infoCart = $this->products->infoCart();
        // show_array($_SESSION['cart']);
        // show_array($_POST['quantity']);
        $this->view("client", [
            'page' => 'cart',
            'title' => 'Cart',
            'css' => ['base', 'main'],
            'js' => ['main'],
            'categories' => $categories,
            'products' => $productNew,
            'infoCart' => $infoCart
        ]);

    }



    public function add_cart()
    {
        $quantity = 0;
        $id = 0;

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }

        if (isset($_POST['num_order']) && isset($_SESSION['cart']['buy'][$id])) {
            $quantity = $_POST['num_order'] + $_SESSION['cart']['buy'][$id]['quantity'];
        } else if (isset($_POST['num_order'])) {
            $quantity = $_POST['num_order'];
        }

        $select = "SELECT * FROM products WHERE product_id = '$id'";

        $product = $this->products->pdo_query_one($select);

        $_SESSION['cart']['buy'][$id] = array(
            'id' => $product['product_id'],
            'image' => $product['image'],
            'name' => $product['product_name'],
            'price' => $product['unit_price'],
            'unit_quantity' => $product['unit_quantity'],
            'in_stock' => $product['in_stock'],
            'quantity' => $quantity,
            'dated_at' => date('Y-m-d H:i:s'),
            'sub_total' => $product['unit_price'] * $quantity,
        );

        $this->update_cart();

        redirectTo('cart');
    }

    public function update_cart()
    {
        if (isset($_SESSION['cart'])) {
            $num_order = 0;
            $total = 0;

            foreach ($_SESSION['cart']['buy'] as $item) {
                $num_order += $item['quantity'];
                $total += $item['sub_total'];
            }

            $_SESSION['cart']['info'] = array(
                'num_order' => $num_order,
                'total' => $total,
            );
        }
    }

    public function delete_cart()
    {
        $id = 0;
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }

        if (isset($_SESSION['cart'])) {
            if (!empty($id)) {
                unset($_SESSION['cart']['buy'][$id]);
            }
            if (!empty($id) && empty($_SESSION['cart']['buy'])) {
                unset($_SESSION['cart']);
            }
        }
        $this->update_cart();

        redirectTo('cart');
    }

    public function update() {
        if(isset($_SESSION['cart']) && isset($_POST['quantity'])) {
            foreach($_POST['quantity'] as $id => $quantity) {
                $select = "SELECT * FROM products WHERE product_id = '$id'";

                $product = $this->products->pdo_query_one($select);

                $_SESSION['cart']['buy'][$id]['quantity'] = $quantity;
                $_SESSION['cart']['buy'][$id]['sub_total'] = $quantity * $product['unit_price'];
            }

            $this->update_cart();
            redirectTo('cart');
        }
    }
}
