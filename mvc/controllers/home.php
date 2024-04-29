<?php

class home extends Controller
{
    private ProductModel $products;
    private CategoryModel $categories;

    function __construct()
    {
        $this->products = $this->model('ProductModel');
        $this->categories = $this->model('CategoryModel');
    }

    public function index()
    {
        // show_array($_SESSION);
        $categories = $this->categories->getAllCl();
        // show_array($categories);
        $cate = 0;
        $products = $this->products->getAll('', 0, $cate);

        $productNew = [];
        foreach ($products as $item) {
            array_push($productNew, $item);
        }
        $category_id = 0;

        $new_product = $this->products->getNewProduct($category_id);


        // exit;

        // show_array($new_product);
        $this->view("client", [
            'page' => 'home',
            'title' => 'Home',
            'css' => ['base', 'main'],
            'js' => ['main'],
            'products' => $productNew,
            'categories' => $categories,
            'new_product' => $new_product,
            'category_id' => $category_id,



        ]);
    }
}
