<?php

function getStatusBill($status) {
	switch($status) {
		case 0:
			echo "Confirming";
			break;
		case 1:
			echo "Delivering";
			break;
		case 2:
			echo "Delivered";
			break;
	}
}