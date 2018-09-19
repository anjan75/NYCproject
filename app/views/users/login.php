<?php require APPROOT . '/views/inc/login_header.php'; ?> 
  <div class="row">
  	<div class="col-md-6 mx-auto">
  		<div class="card card-body bg-light mt-5">
        <?php echo flash('register_success'); ?>
        <div style="text-align: center;">
        <img style="padding: 8px; width: 30%; height: auto;" src="../public/img/mta.png">
  			<h3>Employee Compliance Reporting 2</h3>
        </div>
        <hr />
  			<form action="<?php echo URLROOT; ?>/users/login" method="post" autocomplete="off">

  				<div class="form-group form-inline">
  					<label class="col-md-4" for="email">BSC ID: <sup>*</sup></label>
  					<input type="text" name="email" class="col-md-8 form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
  					<span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
  				</div>

  				<div class="form-group form-inline">
  					<label class="col-md-4" for="password">Password: <sup>*</sup></label>
  					<input type="password" name="password" class="col-md-8 form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
  					<span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
  				</div>

  				<div class="row">
  					<div class="col">
  						<input type="submit" value="login" class="btn btn-success btn-block">
  					</div>
  					<div class="col">
  						<a href="<?php echo URLROOT; ?>/users/register" class="btn btn-light btn-block">Forgot Password</a>
  					</div>
  				</div>
  			</form>
  		</div>
  	</div>
  </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
