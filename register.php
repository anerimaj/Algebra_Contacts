<?php
	require_once 'core/init.php';
	
	Helper::getHeader('Registration | Algebra Contacts');
	
	$validate = new Validation();
	//echo '<pre>';
	//var_dump($validate);
	//echo '</pre>';
	
	if(Input::exists()){
		
		$validation = $validate->check(array(
			'name' => array(
				'required' => true,
				'min'      => 2,
				'max'      => 50
			),
			'username' => array(
				'required' => true,
				'min'      => 2,
				'max'      => 20,
				'unique'   => 'users'
			),
			'password' => array(
				'required' => true,
				'min'      => 8
			),
			'password_again' => array(
				'required' => true,
				'match'    => 'password'
			)
		));
		
		if($validation->passed()) {
			// proces registracije
		}
		
	}
	

?>

<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<div class="panel panel-primary">
		  <div class="panel-heading">
			<h3 class="panel-title">Create an account</h3>
		  </div>
		  <div class="panel-body">
			<form method="post">
				<div class="form-group <?php echo ($validate->hasError('name')) ? 'has-error' : '' ?>">
					<label for="name" class="control-label">Name*</label>
					<input type="text" class="form-control" id="name" name ="name" placeholder="Enter your name" value="<?php echo sanitize(Input::get('name')); ?>">
					<?php echo ($validate->hasError('name')) ? '<p class="text-danger">'.$validate->hasError('name').'</p>' : '' ?>
				</div>
				<div class="form-group <?php echo ($validate->hasError('username')) ? 'has-error' : '' ?>">
					<label for="username" class="control-label">Username*</label>
					<input type="text" class="form-control" id="username" name ="username" placeholder="Choose your username">
					<?php echo ($validate->hasError('username')) ? '<p class="text-danger">'.$validate->hasError('username').'</p>' : '' ?>
				</div>
				<div class="form-group <?php echo ($validate->hasError('password')) ? 'has-error' : '' ?>">
					<label for="password" class="control-label">Password*</label>
					<input type="password" class="form-control" id="password" name ="password" placeholder="Choose a password">
					<?php echo ($validate->hasError('password')) ? '<p class="text-danger">'.$validate->hasError('password').'</p>' : '' ?>
				</div>
				<div class="form-group <?php echo ($validate->hasError('password_again')) ? 'has-error' : '' ?>">
					<label for="password_again" class="control-label">Confirm Password*</label>
					<input type="password" class="form-control" id="password_again" name ="password_again" placeholder="Enter your password again">
					<?php echo ($validate->hasError('password_again')) ? '<p class="text-danger">'.$validate->hasError('password_again').'</p>' : '' ?>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Create an account</button>
				</div>
			</form>
		  </div>
		</div>
	</div>
</div>
	
<?php
	Helper::getFooter();
?>