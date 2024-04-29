<?php
// desc time
$cart_buy = array();
// show_array($_SESSION);
// unset($_SESSION['cart']);



if (isset($_SESSION['cart']['buy'])) {
	$cart_buy = $_SESSION['cart']['buy'];

	usort($cart_buy, function ($a, $b) {
		return strtotime($b['dated_at']) - strtotime($a['dated_at']);
	});
}
?>

<div class="grid wide">
	<nav>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= _WEB_ROOT . '/home' ?>">Home</a></li>
			<li class="breadcrumb-item active"><?= $data['title'] ?></li>
		</ol>
	</nav>


	<div class="intro-heading">
		<span class="title">Cart</span>
	</div>


	<?php
	if (isset($_SESSION['cart'])) {
		if (!empty($_SESSION['cart']['buy'])) {


	?>

			<form action="<?= _WEB_ROOT . '/cart/update' ?>" method="POST" class="bg-form-control p-4 border-radius-main border-main">
				<table class="w-100 mb-3" data-aos="fade-down">
					<thead class="fs-3">
						<tr class="">
							<!-- <th>Mã sản phẩm</th> -->
							<th class="text-center">Image</th>
							<th class="text-center">Product's name</th>
							<th class="text-center">Product price</th>
							<th class="text-center">In stock</th>
							<th class="text-center">Quantity</th>
							<th class="text-center" colspan="2">Into money</th>
						</tr>
					</thead>
					<tbody class="fs-4 border-bottom-main border-top-main">

						<?php
						if (isset($cart_buy)) {
							foreach ($cart_buy as $item) {
						?>
								<tr class="">
									<td class="text-center">
										<a href="<?= _WEB_ROOT . '/detailproduct/product/' . $item['id']  ?>" title="" class=" m-3">
											<img class="border" width="60px" src="<?= _PATH_IMG_PRODUCT . $item['image'] ?>" alt="">
										</a>
									</td>
									<td>
										<a href="<?= _WEB_ROOT . '/detailproduct/product/' . $item['id']  ?>" title="" class="name-product text-truncate"><?= $item['name'] ?></a>
									</td>
									<td class="text-end pe-5"><?= '$' . $item['price'] . ' / ' . $item['unit_quantity'] ?></td>
									<td class="text-end pe-5"><?= $item['in_stock'] ?></td>
									<td>
										<input max="<?= $item['in_stock'] ?>" type="number" data-id="<?= $item['id'] ?>" name="quantity[<?= $item['id'] ?>]" value="<?= $item['quantity'] ?>" id="num-order" min="1">
									</td>
									<td class=" text-end pe-5"><?= '$' . $item['sub_total'] ?></td>
									<td>
										<a href="<?= _WEB_ROOT .  '/cart/delete_cart?id=' . $item['id']  ?>" title="Xoá sản phẩm" class="del-product"><i class="fa-solid fa-trash-can"></i></a>
									</td>
								</tr>
						<?php
							}
						}
						?>



					</tbody>
				</table>
				<div class="fs-3">

					<p id="total-price" class="d-flex justify-content-end gap-3 fs-2 font" data-aos="fade-left">Total price:
						<span class="ml-4 fw-bold">
							<?php if (isset($_SESSION['cart'])) {
								echo '$' . $data['infoCart']['total'];
							}
							?></span>
					</p>


					<div class="row" data-aos="fade-up">
						<div class="col d-flex justify-content-start gap-3" data-aos="fade-left">
							<a href="<?= _WEB_ROOT . '/bill/show_bill' ?>" title="" id="buy-more" class="outline-main p-3">My order</a>
							<a href="<?= _WEB_ROOT . '/product/show_product' ?>" title="" id="buy-more" class="outline-main p-3">Continue shopping</a>
						</div>
						<div class="col d-flex justify-content-end gap-3" data-aos="fade-right">
							<button type="submit" name="" id="update-cart" class="outline-main p-3 btn-update-cart">Update shopping cart</button>
							<a href="<?= _WEB_ROOT . '/checkout' ?>" title="" class="fs-3 px-5 btn-main" id="checkout-cart">Pay</a>
						</div>
					</div>

				</div>
			</form>

			<div class="section-detail fs-4 mt-3" headể>
				<p class="title">Click <span class="text-color-main">“Update shopping cart”</span> to update the quantity. Click <span class="text-color-main">"Pay"</span> to go to the payment page.</p>			</div>

		<?php
		}
	}
	// show_array($_SESSION['cart']['buy']);
	if (empty($_SESSION['cart']['buy'])) {
		?>
		<p class="fs-3">There are no products in the cart, click <a href="home">here</a> to go to the home page.</p>
	<?php
	}
	?>


</div>