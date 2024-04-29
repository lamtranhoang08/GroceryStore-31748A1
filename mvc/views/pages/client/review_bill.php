<div class="grid wide">
	<nav>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= _WEB_ROOT . '/home' ?>">Home</a></li>
			<li class="breadcrumb-item active"><?= $data['title'] ?></li>
		</ol>
	</nav>

	<p>Bạn đã đặt hàng thành công</p>

	<div>
		<p>Thông tin khách hàng</p>
		<?php
		foreach($data['getAllBill'] as $item) {
			show_array($item);
		}
		?>
		<span>Họ tên :</span>
	</div>
</div>