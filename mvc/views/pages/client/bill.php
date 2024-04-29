<?php
if (empty($_SESSION['user']['group_id'])) {
	redirectTo('');
}

?>
<div class="grid wide">
	<nav>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= _WEB_ROOT . '/home' ?>">Home</a></li>
			<li class="breadcrumb-item active"><?= $data['title'] ?></li>
		</ol>
	</nav>


	<div class="row">
		<?php
		if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) {
		?>
			<div id="message" style="position: fixed; top: 130px; right: 100px; z-index: 1; width: 400px;" class="alert alert-success mt-3 fs-3" role="alert">
				<?= $_SESSION['msg'] ?>
			</div>
		<?php
			$_SESSION['msg'] = '';
		}
		?>
		<div class="col-3 fs-3 pb-4" data-aos="fade-right">
			<div class="intro-heading p-4 pt-0">
				<span class="font-weight-bold text-center">TYPE</span>
			</div>
			<div data-aos="fade-right">
				<ul>
					<li><a class="
				<?php if (!isset($_GET['type'])) {
					echo "bill-name-type-active";
				} ?>" href="<?= _WEB_ROOT . '/bill/show_bill' ?>">All</a> </li>

					<li class="bill-name-type d-flex align-items-center">
						<a class="
					<?php
					if (isset($_GET['type']) && $_GET['type'] == 0) {
						echo "bill-name-type-active ps-4";
					}
					?>" href="<?= _WEB_ROOT . '/bill/show_bill?type=0' ?>">Confirming</a>
					</li>

					<li class="bill-name-type d-flex align-items-center
				">
						<a class="<?php
									if (isset($_GET['type']) && $_GET['type'] == 1) {
										echo "bill-name-type-active ps-4";
									}
									?>" href="<?= _WEB_ROOT . '/bill/show_bill?type=1' ?>">Delivering</a>
					</li>

					<li class="bill-name-type d-flex align-items-center 
				">

						<a class="<?php
									if (isset($_GET['type']) && $_GET['type'] == 2) {
										echo "bill-name-type-active ps-4";
									}
									?>" href="<?= _WEB_ROOT . '/bill/show_bill?type=2' ?>">Delivered</a>
					</li>
				</ul>
			</div>

		</div>
		<div class="col-9 px-4" data-aos="fade-left">
			<div class="intro-heading p-4 pt-0" data-aos="fade-bottom">
				<span class="font-weight-bold text-center"><?= $data['title'] ?></span>
			</div>

			<?php
			if (isset($data['getAllBill']) && !empty($data['getAllBill'])) {
				foreach ($data['getAllBill'] as $bill) {
					// show_array($bill);
			?>
					<div class="bill-section mb-5 border-main" data-aos="fade-left">
						<div class="d-flex justify-content-between border-bottom-main p-3">
							<span class="fs-3"><?= 'Order #: ' . $bill['id'] ?></span>
							<span class="fs-3" style="color: blue"><?php if (getStatusBill($bill['status'])) ?></span>
						</div>

						<ul class="fs-4 bill-list-pro">

							<?php
							// show_array($bill['detail']);

							foreach ($bill['detail'] as $item) {
							?>
								<li class="row mx-3 p-3 bill-item-pro">
									<!-- <td><?= $item['id'] ?></td> -->
									<div class="col-2">
										<img class="border-main" src="<?= _PATH_IMG_PRODUCT . $item['image'] ?>" alt="" style="width: 60px; height: 60px;  max-width: 100%; object-fit: cover; object-position: center;">
									</div>
									<div class="col-8">
										<a href="<?= _WEB_ROOT . '/detailproduct/product/' . $item['product_id']  ?>" title="" class="name-product "><?= $item['product_name'] ?></a>
										<span class="d-block">x <?= $item['quantity'] ?></span>
									</div>
									<div class="text-color-primary col-2 d-flex justify-content-end align-items-md-center"><?= "$" . $item['price'] . " / " . $item['unit_quantity'] ?></div>
									<div>
									</div>
								</li>
							<?php
							}
							?>
						</ul>
						<div class="d-flex justify-content-between fs-3 p-3 pe-5 bill-total">
							<span class="fs-3"><?= 'Created at: ' . $bill['created_at'] ?></span>

							<div>
								<span>The total amount: </span>
								<span class="text-color-main fw-bold fs-2"><?= "$" . $bill['total'] ?></span>
							</div>
						</div>
					</div>
				<?php
				}
			} else {
				?>
				<p class="fs-2 ps-5">No orders</p>

			<?php
			}
			?>
		</div>

	</div>


</div>