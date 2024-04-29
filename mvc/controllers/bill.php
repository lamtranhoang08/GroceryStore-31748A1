<?php
class bill extends Controller
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

	public function index()
	{
		$keyword = '';
		$status = -1;

		if (isset($_POST['status'])) {
			$status = $_POST['status'];
		}
		if (isset($_GET['status'])) {
			$status = $_GET['status'];
		}
		if (isset($_GET['search'])) {
			$keyword = $_GET['search'];
			if ($keyword == 'khong co tai khoan') {
				$keyword = 0;
			}
		}

		$getAllBill = $this->bills->getAllBill($status, 0, $keyword);
		$count_product = !empty($getAllBill) ? count($getAllBill) : 0;
		// show_array($count_product);

		$num_per_page = 8;
		$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
		$start = ($page - 1) * $num_per_page;
		$getAllBillAdmin = $this->bills->getAllBillAdmin($status, $keyword, $start, $num_per_page);
		// show_array($getAllBillAdmin);
		$billsNew = [];
		foreach ($getAllBillAdmin as $bill) {
			$bill['detail'] = $this->bills->getDetailBill($bill['id']);
			if ($bill['user_id'] > 0) {
				$bill['email_user'] = $this->users->SelectUser($bill['user_id'])['email'];
				$bill['name_user'] = $this->users->SelectUser($bill['user_id'])['name'];
			} else {
				$bill['email_user'] = '';
				$bill['name_user'] = '';
				$bill['user_id'] = 'No such account';
			}
			array_push($billsNew, $bill);
		}
		// show_array($billsNew);
		return $this->view('admin', [
			'page' => 'bill/list',
			// 'getAllBill' => $billsNew,
			'js' => ['deletedata', 'search'],
			'title' => 'ORDER LIST',
			'keyword' => $keyword,
			'billsNew' => $billsNew,
			'num_per_page' => $num_per_page,
			'count_product' => $count_product,
			'keyword' => $keyword,
			'pagePag' => 'bill',
		]);
	}

	public function show_bill()
	{
// 		show_array($_SESSION['user']);
		$status = -1;
		if (isset($_GET['type'])) {
			$status = $_GET['type'];
		}
		if (isset($_SESSION['user'])) {
			$user_id = $_SESSION['user']['id'];
		}
		$categories = $this->categories->getAllCl();

		$getAllBill = $this->bills->getAllBill($status, $user_id, '');
		$billsNew = [];

		foreach ($getAllBill as $bill) {
			$bill['detail'] = $this->bills->getDetailBill($bill['id']);
			array_push($billsNew, $bill);
		}
// 		show_array($billsNew);

		$this->view("client", [
			'page' => 'bill',
			'title' => 'Order',
			'css' => ['base', 'main'],
			'js' => ['main'],
			'getAllBill' => $billsNew,
			'categories' => $categories,


		]);
	}

	public function add_bill()
	{
		if (isset($_POST['add_bill']) && ($_POST['add_bill']) != " ") {
			$fullname = $_POST['fullname'];
			$tel = $_POST['tel'];
			$email = $_POST['email'];
			$address = $_POST['address'] . ', ' . $_POST['state'];
			$note = $_POST['note'];
			$total = $_POST['total'];
			$method = $_POST['method'];
			if (isset($_SESSION['user'])) {
				$user_id = $_SESSION['user']['id'];
			} else $user_id = 0;
			$created_at = date('Y-m-d H:i:s');

			// show_array($address);

			$idBill = $this->bills->insertBill($fullname, $tel, $email, $address, $note, $total, 0, $method, $user_id, $created_at);

			// show_array($idBill);
			if ($idBill) {
				foreach ($_SESSION['cart']['buy'] as $item) {
					if (isset($item['id']) && $item['id']) {

						$this->bills->insertDetailBill($item['id'], $item['image'], $item['name'], $item['price'], $item['unit_quantity'], $item['quantity'],  $item['sub_total'], $idBill);
						$this->products->updateRemaining($item['id'], (int)($this->products->SelectProduct($item['id'])['in_stock'] - $item['quantity']));
					}
				}
				unset($_SESSION['cart']);
			}

			if ($idBill) {
				$subject =  "Confirmation of Your Order from The Reds";
				$content = "<p>Dear " . $fullname . ",</p><br>";
				$content .= "<p>Thank you for choosing The Reds. We are pleased to confirm your order:</p><br>";
				$content .= "<p><strong>Order Number:</strong> $idBill</p>";
				$content .= "<p><strong>Order Date:</strong> $created_at</p>";
				$content .= "<p><strong>Order Total:</strong> $total</p>";
				$content .= "<p><strong>Shipping Address:</strong> $address</p><br><br>";
				$content .= "<p>If you have any questions or feedback that need to be addressed by The Reds, please feel free to reply to this email.</p><br>";
				$content .= "<p>Thank you once again for choosing The Reds.</p>";
				$statusMail = sendMail($email, $subject, $content);
			}


			if ($idBill) {
				$_SESSION['msg'] = "Order # $idBill has been successfully created, please check your email: $email!";
			} else {
				$_SESSION['msg'] = "Error! An error occurred. Please try again later";
			}
			if(isset($_SESSION['user'])) {
			redirectTo('bill/show_bill');
			} else {
			    redirectTo('/');
			}
		}
	}

	function update_bill($id)
	{
		$bill = $this->bills->SelectOneBill($id);
		// show_array($bill);

		if (!empty($bill)) {
			// $updated_at = ('Y-m-d H:i:s');
			$update = $this->bills->editStatus($id, (int)$bill['status'] + 1);
			header('Location:' . _WEB_ROOT . '/bill');
		}
	}

	function delete_bill($id)
	{
		$status = $this->bills->deleteBill($id);
		if ($status) {
			echo -1;
		} else {
			echo -2;
		}
	}


	function vnPay_return()
	{
		return $this->view('vnpay_return', [
			'js' => ['vn_pay']
		]);
	}


	function vnPay()
	{

		$sum = $_POST['sum'];
		$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
		$vnp_Returnurl = _WEB_ROOT . "/bill/vnpay_return";
		$vnp_TmnCode = "T8F0OXZG"; //Mã website tại VNPAY 
		$vnp_HashSecret = "pynmkrnotawjordz"; //Chuỗi bí mật

		$vnp_TxnRef = rand(); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
		$vnp_OrderInfo = 'Thanh toán đơn hàng test';
		$vnp_OrderType = 'billpayment';
		$vnp_Amount =   (float)$sum * 100;
		$vnp_Locale = 'vn';
		$vnp_BankCode = 'NCB';
		$vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
		//Add Params of 2.0.1 Version
		// $vnp_ExpireDate = $_POST['txtexpire'];
		//Billing


		$inputData = array(
			"vnp_Version" => "2.1.0",
			"vnp_TmnCode" => $vnp_TmnCode,
			"vnp_Amount" => $vnp_Amount,
			"vnp_Command" => "pay",
			"vnp_CreateDate" => date('YmdHis'),
			"vnp_CurrCode" => "VND",
			"vnp_IpAddr" => $vnp_IpAddr,
			"vnp_Locale" => $vnp_Locale,
			"vnp_OrderInfo" => $vnp_OrderInfo,
			"vnp_OrderType" => $vnp_OrderType,
			"vnp_ReturnUrl" => $vnp_Returnurl,
			"vnp_TxnRef" => $vnp_TxnRef,
			// "vnp_ExpireDate" => $vnp_ExpireDate

		);

		if (isset($vnp_BankCode) && $vnp_BankCode != "") {
			$inputData['vnp_BankCode'] = $vnp_BankCode;
		}
		if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
			$inputData['vnp_Bill_State'] = $vnp_Bill_State;
		}

		//var_dump($inputData);
		ksort($inputData);
		$query = "";
		$i = 0;
		$hashdata = "";
		foreach ($inputData as $key => $value) {
			if ($i == 1) {
				$hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
			} else {
				$hashdata .= urlencode($key) . "=" . urlencode($value);
				$i = 1;
			}
			$query .= urlencode($key) . "=" . urlencode($value) . '&';
		}

		$vnp_Url = $vnp_Url . "?" . $query;
		if (isset($vnp_HashSecret)) {
			$vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
			$vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
		}
		$returnData = array(
			'code' => '00', 'message' => 'success', 'data' => $vnp_Url
		);
		if (isset($_POST['redirect'])) {
			header('Location: ' . $vnp_Url);
			die();
		} else {
			echo json_encode($returnData);
		}
		// vui lòng tham khảo thêm tại code demo
	}
}
