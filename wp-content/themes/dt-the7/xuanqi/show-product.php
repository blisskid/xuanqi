<?php
$current_user = wp_get_current_user();
$wpurl = get_bloginfo('wpurl');

if (0 == $current_user->ID) {

	echo "用户未登录！";

} else {
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	global $wpdb;

	$searchSql = "SELECT `ID`, `product_name`, `product_price`, `product_dealer_price`, `product_direct_price`, `product_origin_price`, `product_type`, `product_introduction`, `bad_date`, `reserved_text` FROM `xq_products`";

	$countSql = "SELECT COUNT(*) FROM `xq_products`";
	$conditionStr = "";
	if (count($_POST) > 1) {
		//有传入参数，需要加入where条件
		$conditionStr .= "WHERE";
		//表示是否有大于两个条件
		$conditionFlag = false;
		if (isset($_POST["ID"])) {
			if ($conditionFlag) {
				$conditionStr .= " AND `ID`=" . $_POST["ID"];
			} else {
				$conditionStr .= " `ID`=" . $_POST["ID"];
			}
			$conditionFlag = true;
		}
		if (isset($_POST["product_name"])) {
			if ($conditionFlag) {
				$conditionStr .= " AND `product_name`='" . $_POST["product_name"] . "'";
			} else {
				$conditionStr .= " `product_name`='" . $_POST["product_name"] . "'";
			}
			$conditionFlag = true;
		}
		if (isset($_POST["product_price"])) {
			if ($conditionFlag) {
				$conditionStr .= " AND `product_price`=" . $_POST["product_price"];
			} else {
				$conditionStr .= " `product_price`=" . $_POST["product_price"];
			}
			$conditionFlag = true;
		}
		if (isset($_POST["product_dealer_price"])) {
			if ($conditionFlag) {
				$conditionStr .= " AND `product_dealer_price`=" . $_POST["product_dealer_price"];
			} else {
				$conditionStr .= " `product_dealer_price`=" . $_POST["product_dealer_price"];
			}
			$conditionFlag = true;
		}
		if (isset($_POST["product_direct_price"])) {
			if ($conditionFlag) {
				$conditionStr .= " AND `product_direct_price`=" . $_POST["product_direct_price"];
			} else {
				$conditionStr .= " `product_direct_price`=" . $_POST["product_direct_price"];
			}
			$conditionFlag = true;
		}
		if (isset($_POST["product_origin_price"])) {
			if ($conditionFlag) {
				$conditionStr .= " AND `product_origin_price`=" . $_POST["product_origin_price"];
			} else {
				$conditionStr .= " `product_origin_price`=" . $_POST["product_origin_price"];
			}
			$conditionFlag = true;
		}		
		if (isset($_POST["product_type"])) {
			if ($conditionFlag) {
				$conditionStr .= " AND `product_type`='" . $_POST["product_type"] . "'";
			} else {
				$conditionStr .= " `product_type`='" . $_POST["product_type"] . "'";

			}
			$conditionFlag = true;
		}
		if (isset($_POST["reserved_text"])) {
			if ($conditionFlag) {
				$conditionStr .= " AND `reserved_text`='" . $_POST["reserved_text"] . "'";
			} else {
				$conditionStr .= " `reserved_text`='" . $_POST["reserved_text"] . "'";
			}
			$conditionFlag = true;
		}
	}
	$searchSql .= $conditionStr;
	$countSql .= $conditionStr;

	if (isset($_GET["page_num"])) {
		$index = ($_GET["page_num"] - 1) * 20;
		$searchSql .= " LIMIT " . $index . ",20";
	}

	$count = $wpdb->get_var($countSql);
	//var_dump($searchSql);
	$productArray = $wpdb->get_results($searchSql);
	$outp = "";
	foreach ($productArray as $product) {
		if ($outp != "") {$outp .= ",";}
		$outp .= '{"product_id":"' . $product->ID . '",';
		$outp .= '"product_name":"' . $product->product_name . '",';
		$outp .= '"product_price":"' . $product->product_price . '",';
		$outp .= '"product_dealer_price":"' . $product->product_dealer_price . '",';
		$outp .= '"product_direct_price":"' . $product->product_direct_price . '",';
		$outp .= '"product_origin_price":"' . $product->product_origin_price . '",';
		$outp .= '"product_introduction":"' . $product->product_introduction . '",';
		$outp .= '"bad_date":"' . $product->bad_date . '",';

		if ("0" == $product->product_type) {
			$outp .= '"product_type":"疫苗类产品"}';
		} else if ("1" == $product->product_type) {
			$outp .= '"product_type":"其他"}';
		}
	}

	$outp = '{"records":[' . $outp . '], "count":"' . $count . '"}';
	echo ($outp);
}

?>