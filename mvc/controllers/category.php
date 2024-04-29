<?php
class category extends Controller
{

    private BillModel $bills;
    private CategoryModel $categories;
    private ProductModel $products;
    private UserModel $users;
    public function __construct()
    {
        $this->categories = $this->model('CategoryModel');
        $this->products = $this->model('ProductModel');
    }

    public function index()
    {
        $keyword = '';
        if (isset($_GET['search']) && ($_GET['search'] != '')) {
            $keyword = $_GET['search'];
        }
        $categories = $this->categories->getAll($keyword);
        $getAllCl = $this->categories->getAllCl();

        // show_array($getAllCl);
        return $this->view('admin', [
            'page' => 'category/list',
            'categories' => $categories,
            'getAllCl' => $getAllCl,
            'js' => ['deletedata', 'search'],
            'title' => 'CATEGORY',
            'keyword' => $keyword,
        ]);
    }

    public function add_category()
    {
        $msg = '';
        $type = '';
        if (isset($_POST['add_category']) && $_POST['add_category']) {
            $name = $_POST['categoryname'];
            $categories = $this->categories->getAll();
            $check = 0;
            foreach ($categories as $category) {
                if ($category['name'] == $name) {
                    $check = 1;
                    break;
                } else {
                    $check = 0;
                }
            }

            if ($check == 1) {
                $type = 'danger';
                $msg = 'Category name already exists';
            } else {
                $status = $this->categories->insertCate($name);
                if ($status) {
                    $type = 'success';
                    $msg = 'Added category successfully';
                    $_SESSION['msg'] = $msg;
                    header('Location:' . _WEB_ROOT . '/category/list_category');
                    return;
                } else {
                    $type = 'danger';
                    $msg = 'System error';
                }
            }
        }
        return $this->view('admin', [
            'page' => 'category/add',
            'msg' => $msg,
            'type' => $type,
            'title' => 'CATEGORY'

        ]);
    }

    public function update_category($id)
    {
        $msg = '';
        $type = '';
        $category = $this->categories->selectOneCate($id);

        if (isset($_POST['update_category']) && ($_POST['update_category'])) {
            $name = $_POST['categoryname'];
            $categories = $this->categories->getAll();

            $check = 0;
            foreach ($categories as $category) {
                if ($category['name'] == $name) {
                    $check = 1;
                    break;
                } else {
                    $check = 0;
                }
            }
            if ($check == 1) {
                $type = 'danger';
                $msg = 'Category name already exists';
            } else {
                $status = $this->categories->updateCate($id, $name);
                if ($status) {
                    $type = 'success';
                    $msg = 'Updated category successfully';
                    $_SESSION['msg'] = $msg;
                    header('Location:' . _WEB_ROOT . '/category/list_category');
                    return;
                } else {
                    $type = 'danger';
                    $msg = 'System error';
                }
            }
        }
        return $this->view('admin', [
            'page' => 'category/update',
            'category' => $category,
            'msg' => $msg,
            'type' => $type,
            'title' => 'CATEGORY'

        ]);
    }

    public function delete_category($id)
    {
        $status = $this->categories->deleteCate($id);
        if ($status) {
            echo -1;
        } else {
            echo -2;
        }
    }
}
