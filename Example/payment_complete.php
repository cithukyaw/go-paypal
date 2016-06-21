<h2>Return from PayPal</h2>
<?php
if(sizeof($_POST)){
	echo '<h3>POST</h3>';
	echo '<pre>'; print_r($_POST); echo '</pre>';
}
if(sizeof($_GET)){
	echo '<h3>GET</h3>';
	echo '<pre>'; print_r($_GET); echo '</pre>';
}
?>