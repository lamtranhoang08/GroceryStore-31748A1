<?php

class admin extends Controller
{
    private BillModel $bills;
	private CategoryModel $categories;
	private ProductModel $products;
	private UserModel $users;
    function __construct()
    {
        $this->users = $this->model('UserModel');
        $this->products = $this->model('ProductModel');
        $this->categories = $this->model('CategoryModel');
        $this->bills = $this->model('BillModel');
    }

    function index()
    {
        $countUser = count($this->users->getAll());
        $countCate = count($this->categories->getAll());
        $countPro = count($this->products->getAll());
        $countBill = count($this->bills->getAllBill());
        $sumBill = $this->bills->sumBill();
        $sumDetailBill = $this->bills->sumDetailBill();
        // show_array($countCate);

        return $this->view('admin', [
            'title' => 'Manage',
            'page' => 'manager/list',
            'countUser' => $countUser,
            'countCate' => $countCate,
            'countPro' => $countPro,
            'countBill' => $countBill,
            'sumBill' => $sumBill,
            'sumDetailBill' => $sumDetailBill,
        ]);
    }
}
