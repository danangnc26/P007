<div class="col-md-12">
	<h3>Form Log In</h3>
	<hr>
	<form method="post" action="<?php echo app_base.'authenticate' ?>">
	<div class="form-group">
		<div class="input-group">
			<span class="input-group-addon" id="sizing-addon1">
				<i class="fa fa-user"></i>
			</span>
			<input name="username" type="text" class="form-control cst" placeholder="Username">
		</div>
	</div>
	<div class="form-group">
		<div class="input-group">
			<span class="input-group-addon" id="sizing-addon1">
				<i class="fa fa-lock"></i>
			</span>
			<input name="password" type="password" class="form-control cst" placeholder="Password">
		</div>
	</div>
	<div class="form-group">
		<button class="button button-inline button-small button-primary full">Log In</button>
	</div>
</form>
</div>