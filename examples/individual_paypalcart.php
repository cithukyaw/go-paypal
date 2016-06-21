<?php
################
# Using html() #
################
$paypal = new GoPayPal(PAYPAL_CART); # can also use ADD_TO_CART
//$paypal->sandbox = true;
$paypal->openInNewWindow = true;
$paypal->set('business', 'cithukyaw@gmail.com');
$paypal->set('currency_code', 'SGD');
$paypal->set('country', 'SG');
$paypal->set('return', 'http://cithu.0fees.net/GoPayPal/Example/index.php?api=individual_paypalcart');
$paypal->set('cancel_return', 'http:///cithu.0fees.net/PayPal/PayPal/index.php?api=individual_paypalcart');
$paypal->set('notify_url', 'http://cithu.0fees.net/GoPayPal/Example/payment_complete.php'); # rm must be 2, need to be hosted online
$paypal->set('rm', 2); # return by POST
$paypal->set('no_note', 0);
$paypal->set('custom', md5(time()));
$paypal->set('cbt', 'Return to our site to validate your payment!'); # caption override for "Return to Merchant" button
$paypal->set('shipping', 5);

# Setup single item
	$item = new GoPayPalCartItem();
	$item->set('item_name', 'Drupal for Dummies');
	$item->set('item_number', 10);
	$item->set('amount', 49.99);
	$item->set('quantity', 1);
$paypal->addItem($item);

# If you set your custom button here, PayPal Add To Cart button will be displayed.
//$paypal->setButton('<button type="submit">Pay PayPal - The safer, easier way to pay online!</button>');

echo $paypal->html();

if(sizeof($_POST)){
	echo '<pre>'; print_r($_POST); echo '</pre>';
}

###################
# Using getHtml() #
###################
# If you want to use other HTML between paypal form opening and close tag, use getHtml(), but write </form> by yourself
/*
	$paypal = new GoPayPalPAYPAL_CART); # can also use ADD_TO_CART
	$paypal->sandbox = true;
	$paypal->openInNewWindow = true;
	$paypal->set('business', 'cithukyaw@gmail.com');
	$paypal->set('currency_code', 'SGD');
	$paypal->set('country', 'SG');
	$paypal->set('return', 'http://cithu.0fees.net/GoPayPal/Example/index.php?api=individual_paypalcart');
	$paypal->set('cancel_return', 'http://cithu.0fees.net/GoPayPal/Example/index.php?api=individual_paypalcart');
	$paypal->set('notify_url', 'http://cithu.0fees.net/GoPayPal/Example/payment_complete.php'); # rm must be 2, need to be hosted online
	$paypal->set('rm', 2); # return by POST
	$paypal->set('no_note', 0);
	$paypal->set('custom', md5(time()));
	$paypal->set('cbt', 'Return to our site to validate your payment!'); # caption override for "Return to Merchant" button
	$paypal->set('shipping', 5);
	
	# Setup single item
		$item = new GoPayPalCartItem();
		$item->set('item_name', 'Drupal for Dummies');
		$item->set('item_number', 10);
		$item->set('amount', 49.99);
		$item->set('quantity', 1);
	$paypal->addItem($item);
	
	echo $paypal->getHtml();
	?>
	<div>
		<button type="submit">Pay PayPal - The safer, easier way to pay online!</button>
	</div>
	</form>
*/