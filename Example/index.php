<?php
include('../GoPayPal.class.php');
$api = 'buynow';
if(isset($_GET['api']) && $_GET['api']) $api = $_GET['api'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>PayPal API Example</title>
    <style type="text/css">
		#menu a{ color:#0088cc; padding:3px 7px; display:inline-block; font:12px Arial, Helvetica, sans-serif; }
		#menu a.active{ background:#666; color:#fff; }
		#form{ margin:10px 0; }
	</style>
</head>
<body>
	<div id="menu">
    	<a href="index.php?api=buynow" <?php if($api == 'buynow') echo 'class="active"'; ?>>Buy Now</a> |
        <a href="index.php?api=subscribe" <?php if($api == 'subscribe') echo 'class="active"'; ?>>Subscribe</a> |
        <a href="index.php?api=donation" <?php if($api == 'donation') echo 'class="active"'; ?>>Donation</a> |
        <a href="index.php?api=gift_certificate" <?php if($api == 'gift_certificate') echo 'class="active"'; ?>>Gift Certificate</a> |
        <a href="index.php?api=individual_paypalcart" <?php if($api == 'individual_paypalcart') echo 'class="active"'; ?>>Individual PayPal Cart</a> |
        <a href="index.php?api=thirdpartycart" <?php if($api == 'thirdpartycart') echo 'class="active"'; ?>>Third Party Shopping Cart</a>
    </div>
    <div id="form">
    	<?php include($api.'.php') ?>
    </div>
</body>
</html>
