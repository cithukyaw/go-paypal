<?php
################
# Using html() #
################
$paypal = new GoPayPal(SUBSCRIBE);
//$paypal->sandbox = true;
//$paypal->openInNewWindow = true;
$paypal->set('business', 'cithukyaw@gmail.com');
$paypal->set('currency_code', 'SGD');
$paypal->set('country', 'SG');
$paypal->set('item_name', 'Subscription');
$paypal->set('a3', 10);
$paypal->set('p3', 2);
$paypal->set('t3', 'W');
$paypal->set('return', 'http://cithu.0fees.net/GoPayPal/Example/index.php?api=subscribe');
$paypal->set('cancel_return', 'http://cithu.0fees.net/GoPayPal/Example/index.php?api=subscribe');
$paypal->set('notify_url', 'http://cithu.0fees.net/GoPayPal/Example/payment_complete.php'); # rm must be 2, need to be hosted online
$paypal->set('rm', 2); # return by POST
$paypal->set('no_note', 0);
$paypal->set('custom', md5(time()));
$paypal->set('cbt', 'Return to our site to validate your payment!'); # caption override for "Return to Merchant" button

# If you set your custom button here, PayPal subscribe button will be displayed.
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
	$paypal = new GoPayPalSUBSCRIBE);
	$paypal->sandbox = true;
	//$paypal->openInNewWindow = true;
	$paypal->set('business', 'cithukyaw@gmail.com');
	$paypal->set('currency_code', 'SGD');
	$paypal->set('country', 'SG');
	$paypal->set('item_name', 'Subscription');
	$paypal->set('a3', 10);
	$paypal->set('p3', 2);
	$paypal->set('t3', 'W');
	$paypal->set('return', 'http://cithu.0fees.net/GoPayPal/Example/index.php?api=subscribe');
	$paypal->set('cancel_return', 'http://cithu.0fees.net/GoPayPal/Example/index.php?api=subscribe');
	$paypal->set('no_note', 0);
	$paypal->set('custom', 'sderbvderereewe');
	$paypal->set('rm', 2);
	$paypal->set('cbt', 'Return to our site to validate your payment!');
	
	echo $paypal->getHtml();
	?>
	<div>
		<button type="submit">Pay PayPal - The safer, easier way to pay online!</button>
	</div>
	</form>
*/