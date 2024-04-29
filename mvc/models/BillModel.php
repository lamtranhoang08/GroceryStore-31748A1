<?php
class BillModel extends DB
{

	public function insertBill($fullname, $tel, $email, $address, $note, $total, $status, $method, $user_id, $created_at)
	{
		$insert = "INSERT INTO bills(fullname, tel, email, address, note, total, status, method, user_id, created_at) VALUES('$fullname', '$tel', '$email','$address', '$note','$total', '$status', '$method','$user_id', '$created_at')";
		return $this->pdo_execute_lastInsertID($insert);
	}

	public function insertDetailBill($product_id, $image, $product_name, $price, $unit_quantity, $quantity, $sub_total, $bill_id)
	{
		$insert = "INSERT INTO detail_bill(product_id, image, product_name, price, unit_quantity, quantity, sub_total, bill_id) VALUES ('$product_id','$image','$product_name','$price', '$unit_quantity', '$quantity','$sub_total','$bill_id' )";

		$this->pdo_execute($insert);
	}

	public function getAllBill($status = -1, $user_id = 0, $keyword = '')
	{
		$select = "SELECT * FROM bills WHERE 1 ";
		if ($status > -1) {
			$select .= " AND status = $status ";
		}
		if ($user_id > 0) {
			$select .= " AND user_id = $user_id ";
		}
		if ($keyword  != '') {
			$select .= " AND email like '%" . $keyword . "%' OR address like '%" . $keyword . "%' OR fullname like '%" . $keyword . "%' OR method like '%" . $keyword . "%' OR tel like '%" . $keyword . "%'";
		}
		return $this->pdo_query($select);
	}
	public function getAllBillAdmin($status = -1, $keyword = '', $start, $num_per_page)
	{
		$select = "SELECT * FROM bills WHERE 1 ";
		if ($status > -1) {
			$select .= " AND status = $status ";
		}
		if ($keyword  != '') {
			$select .= " AND email like '%" . $keyword . "%' OR address like '%" . $keyword . "%' OR fullname like '%" . $keyword . "%' OR method like '%" . $keyword . "%' OR tel like '%" . $keyword . "%'";
		}
		$select .= "  LIMIT $start, $num_per_page";
		return $this->pdo_query($select);
	}

	public function getDetailBill($bill_id)
	{
		$select = "SELECT * FROM detail_bill WHERE bill_id = $bill_id";
		return $this->pdo_query($select);
	}

	function updateBill($id, $status, $updated_at)
	{
		$update = "UPDATE bills SET status = '$status', updated_at = '$updated_at' WHERE id = '$id'";
		return $this->pdo_execute($update);
	}

	function SelectOneBill($id)
	{
		$select = "SELECT * FROM bills WHERE id = '$id'";
		if ($this->pdo_query_one($select)) {
			return $this->pdo_query_one($select);
		} else {
			return [];
		}
	}

	function editStatus($id, $status)
	{
		$sql = "UPDATE bills SET status= '$status' WHERE id= '$id' ";

		return $this->pdo_execute($sql);
	}

	public function deleteBill($id)
	{
		$detele_detail_bill = "DELETE FROM detail_bill WHERE bill_id = $id";
		$detele_bill = "DELETE FROM bills WHERE id = $id";
		$this->pdo_execute($detele_detail_bill);
		return $this->pdo_execute($detele_bill);
	}

	public function sumBill()
	{
		$select = "SELECT SUM(total) FROM bills";
		if ($this->pdo_query_one($select)) {
			return $this->pdo_query_value($select);
		} else {
			return [];
		}
	}
	public function sumDetailBill()
	{
		$select = " SELECT product_name,SUM(quantity) as tong  FROM detail_bill  GROUP BY product_id  HAVING SUM(quantity) = (SELECT MAX(tong) as tong FROM (SELECT product_id,SUM(quantity) as tong  FROM detail_bill GROUP BY product_id) as abc)";
		return $this->pdo_query_one($select);
	}
}
