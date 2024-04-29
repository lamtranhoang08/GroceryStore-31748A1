<div>
	<div class="row">
		<div class="col-3 mb-3 p-3">
			<a href="<?= _WEB_ROOT . '/user' ?>" style="height: 200px;" class="d-flex p-3 align-items-center justify-content-around rounded-pill  text-center bg-success">
				<i class="display-3 fa-solid fa-users-line"></i>
				<h5 class="display-5 m-0"><?= $data['countUser'] ?> USER</h5>
			</a>
		</div>
		<div class="col-3 mb-3 p-3">
			<a href="<?= _WEB_ROOT . '/category' ?>" style="height: 200px;" class="d-flex p-3 align-items-center justify-content-around rounded-pill  text-center bg-info">
				<i class="display-3 fa-brands fa-elementor"></i>
				<h5 class="display-5 m-0"><?= $data['countCate'] ?> CATEGORY</h5>
			</a>
		</div>
		<div class="col-3 mb-3 p-3">
			<a href="<?= _WEB_ROOT . '/product' ?>" style="height: 200px;" class="d-flex p-3 align-items-center justify-content-around rounded-pill  text-center bg-secondary">
				<i class="display-3 fa-solid fa-boxes-stacked"></i>
				<h5 class="display-5 m-0"><?= $data['countPro'] ?> PRODUCT</h5>
			</a>
		</div>
		<div class="col-3 mb-3 p-3">
			<a href="<?= _WEB_ROOT . '/bill' ?>" style="height: 200px;" class="d-flex p-3 align-items-center justify-content-around rounded-pill  text-center bg-danger">
				<i class="display-3 fa-solid fa-list-check"></i>
				<h5 class="display-5 m-0"><?= $data['countBill'] ?> ORDER</h5>
			</a>
		</div>
		<div class="col-3 mb-3 p-3">
			<a href="<?= _WEB_ROOT . '/bill' ?>" style="height: 200px;" class="d-flex p-3 align-items-center justify-content-around rounded-pill  text-center bg-warning">
				<i class="display-3 fa-solid fa-coins"></i>
				<h5 class="display-5 m-0">REVENUE <p class="m-0"><?= numberFormat($data['sumBill']) ?></p>
				</h5>
			</a>
		</div>
		<div class="col-3 mb-3 p-3">
			<a href="<?= _WEB_ROOT . '/bill' ?>" style="height: 200px;" class="d-flex p-3 align-items-center justify-content-around rounded-pill  text-center bg-dark">
				<i class="display-3 fa-solid fa-star"></i>
				<h5 class="display-5 m-0">
					<p>BESTSELLER</p>
					<p style="display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;"><?php
						if (isset($data['sumDetailBill']['product_name'])) {
							echo $data['sumDetailBill']['product_name'];
						} else {
							echo 'No product';
						}
						?></p>
					<p class="m-0">SOLD <?php
										if (isset($data['sumDetailBill']['tong'])) {
											echo $data['sumDetailBill']['tong'];
										} else {
											echo 0;
										}
										?></p>
				</h5>
			</a>

		</div>
	</div>
</div>