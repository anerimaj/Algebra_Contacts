<?php
	require_once 'core/init.php';
	
	Helper::getHeader('Registration | Algebra Contacts');
	
	DB::getInstance()->action('SELECT *', 'users');
	
	echo '<pre>';
	var_dump(DB::getInstance());
	echo '</pre>';
?>

	
<?php
	Helper::getFooter();
?>