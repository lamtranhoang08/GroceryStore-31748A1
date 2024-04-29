<?php

class detailproduct extends Controller
{
    private BillModel $bills;
	private CategoryModel $categories;
	private ProductModel $products;
	private UserModel $users;
    function __construct()
    {
        $this->products = $this->model('ProductModel');
        $this->categories = $this->model('CategoryModel');
        
    }

    function product($id){
        // echo $id;
        // die();
        $product = $this->products->SelectProduct($id);
        // $img_product = $this->products->SelectProductImg($id);
        $products = $this->products->getAll();
        $categories = $this->categories->getAllCl();
        // show_array($product);
        $nameCate = $this->categories->getNameCate($product['category_id']);
        $infoCart = $this->products->infoCart();

        
        return $this->view("client", [
            'page' => 'detail_product',
            'title' => 'Chi tiết sản phẩm',
            'css' => ['base', 'main'],
            'js' => ['main'],
            'products' => $products,
            'categories' => $categories,
            'product' => $product,
            // 'img_product' => $img_product,
            'nameCate' => $nameCate,
            'infoCart' => $infoCart

        ]);
    }
}
