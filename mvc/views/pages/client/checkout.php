<?php
$cart_buy = array();

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
			<li class="breadcrumb-item"><a href="<?= _WEB_ROOT . '/cart' ?>">Cart</a></li>
			<li class="breadcrumb-item active"><?= $data['title'] ?></li>
		</ol>
	</nav>
	<form class="detail row p-3 pt-0 form_checkout" method="POST" id="form" action="<?= _WEB_ROOT . "/bill/add_bill" ?>">
		<div class="col">
			<div class="checkout-heading">Customer information</div>
			<?php
			if (isset($_SESSION['msg']) && $_SESSION['msg'] != "") {
			?>
				<div id="message" class="alert alert-success"><?php echo $_SESSION['msg'] ?></div>
			<?php
				$_SESSION['msg'] = '';
			}
			?>

			<?php
			if (isset($_SESSION['msglg']) && $_SESSION['msglg'] != "") {
			?>
				<div id="message" class="alert alert-danger"><?php echo $_SESSION['msglg'] ?></div>
			<?php
				$_SESSION['msglg'] = '';
			}
			?>
			<div class="m-3">
				<div class="row  p-0">
					<div class="field-wp mb-4 col-6">
						<label class="form-label" for="fullname">Full name</label>
						<input class="form-control form-control-main" type="text" name="fullname" id="fullname" placeholder="" value="<?= $data['user']['name'] ?? '' ?>">
					</div>

					<div class="field-wp  mb-4 col-6">
						<label class="form-label" for="tel">Phone number</label>
						<input class="form-control form-control-main" type="tel" name="tel" id="tel" placeholder="" value="<?= $data['user']['phone'] ?? '' ?>">
					</div>
				</div>
				<div class="field-wp  mb-4">
					<label class="form-label" for="email">Email</label>
					<input class="form-control form-control-main" type="email" name="email" id="email" placeholder="" value="<?= $data['user']['email'] ?? '' ?>">
				</div>

				<div class="field-wp  mb-4">
					<label class="form-label" for="address">Delivery address</label>
					<input class="form-control form-control-main" type="text" name="address" id="address" placeholder="" value="<?= $data['user']['address'] ?? '' ?>">
				</div>
				<!--  -->
				<div class="field-wp mb-4">
					<label class="form-label" for="state">State</label>
					<select class="form-select form-select-lg form-control-main form-control" name="state" id="state" required>
						<option value="">Select State</option>
						<?php
						$australian_states = array(
							'Australian Capital Territory',
							'New South Wales',
							'Northern Territory',
							'Queensland',
							'South Australia',
							'Tasmania',
							'Victoria',
							'Western Australia'
						);

						foreach ($australian_states as $state) {
							$selected = ($data['user']['state'] ?? '') === $state ? 'selected' : '';
							echo "<option value='$state' $selected>$state</option>";
						}
						?>
					</select>
				</div>


				<div class="field-wp  mb-4">
					<label class="form-label" for="note">Note</label>
					<textarea id="note" class="form-control form-control-main" name="note" rows="3"></textarea>
				</div>

			</div>

		</div>
		<div class="col">
			<div class="checkout-heading">Information line</div>
			<p class="fw-bold p-3 checkout-num-pro">Products ( <?php if ($_SESSION['cart']) echo $_SESSION['cart']['info']['num_order'] ?> )</p>

			<ul class="checkout-item-list px-2">
				<?php
				if (isset($_SESSION['cart'])) {

					foreach ($cart_buy as $item) {
				?>
						<li class="row checkout-item-pro">
							<p class="col-2 m-0"><img width="60px" src="<?= _PATH_IMG_PRODUCT . $item['image'] ?>" alt=""></p>
							<div class="col-7">

								<p class="checkout-item-name"><?= $item['name'] ?></p>
								<strong> x <?= $item['quantity'] ?></strong>
							</div>
							<p class="m-0 col-3 d-flex justify-content-end align-items-center text-color-main fw-bold"><?= '$' . $item['sub_total'] ?></p>
						</li>
				<?php
					}
				}
				?>
			</ul>
			<div class="row my-4">
				<div class="col-7">

					<div class="col-10">
						<ul class="nav nav-tabs d-block border-0 fs-3" id="myTab" role="tablist">
							<li class="d-flex align-items-baseline justify-content-between pay-method mb-2" role="presentation">
								<input type="radio" name="method" id="pay-cod" checked value="payment-cod">
								<label for="pay-cod" id="paycod-tab" data-bs-toggle="tab" data-bs-target="#paycod" type="button" role="tab" aria-controls="paycod" aria-selected="true">Payment on delivery</label>
								<i class="text-color-main ps-4 fa-solid fa-money-bill-1"></i>
							</li>
							<li class="d-flex align-items-baseline justify-content-between pay-method" role="presentation">
								<input type="radio" name="method" id="pay-bank" value="payment-bank">
								<label for="pay-bank" class="" id="paybank-tab" data-bs-toggle="tab" data-bs-target="#paybank" type="button" role="tab" aria-controls="paybank" aria-selected="false">Paying through bank</label>
								<i class="text-color-main ps-4 fa-solid fa-building-columns"></i>
							</li>
						</ul>
					</div>
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade show active p-2 border-main" id="paycod" role="tabpanel" aria-labelledby="paycod-tab">If you do not select a payment method, payment will be defaulted upon receipt</div>
						<div class="tab-pane fade p-2 border-main" id="paybank" role="tabpanel" aria-labelledby="paybank-tab">
							<p class="fs-4"><b>Vietinbank</b> Bank Account <br>
								Number: <b>10987456321</b> <br>
								Account owner: <b>Nguyen Van A</b> <br>
								Transfer content: Name + Order phone number</p>
						</div>
					</div>

				</div>


				<div class="col-5 fs-2">
					<div class=" d-flex justify-content-end flex-wrap gap-3">
						<span>Total price:</span>
						<span class="text-color-main fw-bold">
							<?php if (isset($_SESSION['cart'])) {
								echo '$' . $_SESSION['cart']['info']['total'];
							}
							?>
						</span>
						<input type="hidden" name="total" value="<?= $_SESSION['cart']['info']['total'] ?>">

					</div>
					<!-- <div class="text-center fs-3 mt-5">
						<label>Thanh toán bằng VNPAY</label>
						<img style="cursor: pointer;" class="vnpay_img border-main p-2" width="200px" src="<?php echo _PATH_IMG_PUBLIC . '/vn_pay.png' ?>" alt="">
					</div> -->
				</div>

			</div>
			<button type="submit" name="add_bill" value="add_bill" class="btn-main fs-3 w-100 mt-3">Order now</button>



		</div>
	</form>


	<!-- <form class="submit_vnpay" action="<?php echo _WEB_ROOT . '/bill/vnPay' ?>" method="post">
		<input type="hidden" name="sum" value="<?php echo  $_SESSION['cart']['info']['total'] ?>">
		<input type="hidden" name="redirect" value="redirect">
	</form> -->
</div>