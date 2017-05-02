<?php
    require_once 'core/init.php';

	$user = new User('tomo');
	
    Helper::getHeader('Algebra Contacts', 'header', $user);

    require_once 'notifications.php';
?>
<h1> Dashboard</h1>

<?php
    Helper::getFooter();
?>
