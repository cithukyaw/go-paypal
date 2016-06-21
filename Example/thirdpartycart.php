<?php
################
# Using html() #
################
$paypal = new GoPayPal(THIRD_PARTY_CART);
//$paypal->sandbox = true;
$paypal->openInNewWindow = true;
$paypal->set('business', 'cithukyaw@gmail.com');
$paypal->set('currency_code', 'SGD');
$paypal->set('country', 'SG');
$paypal->set('return', 'http://cithu.0fees.net/GoPayPal/Example/index.php?api=thirdpartycart');
$paypal->set('cancel_return', 'http://cithu.0fees.net/GoPayPal/Example/index.php?api=thirdpartycart');
$paypal->set('notify_url', 'http://cithu.0fees.net/GoPayPal/Example/payment_complete.php'); # rm must be 2, need to be hosted online
$paypal->set('rm', 2); # return by POST
$paypal->set('no_note', 0);
$paypal->set('custom', md5(time()));
$paypal->set('cbt', 'Return to our site to validate your payment!'); # caption override for "Return to Merchant" button
// $paypal->set('shipping', 5); # this doesn't work for THIRD_PARTY_CART
$paypal->set('handling_cart', 1); # this overide the individual items' handling "handling_x"
$paypal->set('tax_cart', 0.29);
# Add first item
	$item = new GoPayPalCartItem();
	$item->set('item_name', 'Drupal for Dummies');
	$item->set('item_number', 10);
	$item->set('amount', 9.99);
	$item->set('quantity', 1);
	$item->set('shipping', 1.5);
	$item->set('handling', 1); # this is overriden by "handling_cart"
$paypal->addItem($item);
# Add second item
	$item = new GoPayPalCartItem();
	$item->set('item_name', 'Front-end Drupal');
	$item->set('item_number', 11);
	$item->set('amount', 9.99);
	$item->set('quantity', 1);
	$item->set('shipping', 1.5);
	$item->set('handling', 1); # this is overriden by "handling_cart"
$paypal->addItem($item);

# If you set your custom button here, PayPal Pay Now button will be displayed.
$paypal->setButton('<button type="submit">Pay via PayPal - The safer, easier way to pay online!</button>');

echo $paypal->html();

if(sizeof($_POST)){
	echo '<pre>'; print_r($_POST); echo '</pre>';
}
###################
# Using getHtml() #
###################
# If you want to use other HTML between paypal form opening and close tag, use getHtml(), but write </form> by yourself
/*
	$paypal = new GoPayPalTHIRD_PARTY_CART);
	$paypal->sandbox = true;
	$paypal->openInNewWindow = true;
	$paypal->set('business', 'cithukyaw@gmail.com');
	$paypal->set('currency_code', 'SGD');
	$paypal->set('country', 'SG');
	$paypal->set('return', 'http://cithu.0fees.net/GoPayPal/Example/index.php?api=thirdpartycart');
	$paypal->set('cancel_return', 'http://cithu.0fees.net/GoPayPal/Example/index.php?api=thirdpartycart');
	$paypal->set('notify_url', 'http://cithu.0fees.net/GoPayPal/Example/payment_complete.php'); # rm must be 2, need to be hosted online
	$paypal->set('no_note', 0);
	$paypal->set('custom', md5(time()));
	$paypal->set('rm', 2); # return by POST
	$paypal->set('cbt', 'Return to our site to validate your payment!'); # caption override for "Return to Merchant" button
	# Add first item
		$item = new GoPayPalCartItem();
		$item->set('item_name', 'Drupal for Dummies');
		$item->set('item_number', 10);
		$item->set('amount', 9.99);
		$item->set('quantity', 1);
		$item->set('shipping', 1.5);
		$item->set('handling', 1);
	$paypal->addItem($item);
	# Add second item
		$item = new GoPayPalCartItem();
		$item->set('item_name', 'Front-end Drupal');
		$item->set('item_number', 11);
		$item->set('amount', 9.99);
		$item->set('quantity', 1);
		$item->set('shipping', 1.5);
		$item->set('handling', 1);
	$paypal->addItem($item);
	
	echo $paypal->getHtml();
	?>
	<div>
		<button type="submit">Pay PayPal - The safer, easier way to pay online!</button>
	</div>
	</form>
*/