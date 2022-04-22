
	<div id="container" class="cls-container">
		<!-- BACKGROUND IMAGE -->
		<!--===================================================-->
		<div id="bg-overlay" class="bg-img img-balloon"></div>
		<!-- HEADER -->
		<!--===================================================-->
		<div class="cls-header cls-header-lg">
			<div class="cls-brand">
				<a class="box-inline" href="index-2.html">
					<!-- <img alt="Nifty Admin" src="img/logo.png" class="brand-icon"> -->
					<span class="brand-title"><span class="text-thin">Registration Page</span></span>
				</a>
			</div>
		</div>
		<!--===================================================-->
		<!-- LOGIN FORM -->
		<!--===================================================-->
		<div class="cls-content">
			<div class="cls-content-sm panel">
				<div class="panel-body">
					<p class="pad-btm">Registration</p>
					<form method="post" action="<?= base_url('auth/registration'); ?>">



                       
                       <div class="form-group">
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-user"></i></div>
								<input type="text" class="form-control" id="name" name="name" placeholder="Full Name" value="<?= set_value('name'); ?>">


							</div>
							
							<?= form_error('name', '<small class="text-danger">', '</small>'); ?>
							
						</div>


						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-envelope"></i></div>
								<input type="text" class="form-control" id="email" name="email" placeholder="Enter Email Address" value="<?= set_value('email'); ?>">
							</div>
							<?= form_error('email', '<small class="text-danger">', '</small>'); ?>
						</div>

						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-building"></i></div>
								<select name="hub" id="hub" class="form-control">
								 <option value="">Pilih</option>
								 <?php foreach ($dept as $row) : ?>
								 	<option value="<?= $row->id_departement; ?>"><?= $row->nama; ?></option>
								 <?php endforeach; ?>
								</select>
							</div>
						</div>

						<div class="form-group row">

							<div class="col-sm-6 mb-3 mb-sm-0">
								
								<input type="password" class="form-control" id="password1" name="password1" placeholder="Password">

								<?= form_error('password1', '<small class="text-danger">', '</small>'); ?>

							</div>
						     

							<div class="col-sm-6">
		                    <input type="password" class="form-control form-control-user" id="password2"  name="password2" placeholder="Repeat Password">


		                  </div>

						</div>		
							<button type="submit" class="btn btn-primary btn-user btn-block">
		                      Register Account
		                    </button>		
						</div>
					</form>             
				</div>

				<div class="pad-ver">

				<a href="pages-password-reminder.html" class="btn-link mar-rgt">Forgot password ?</a>
				<a href="<?= base_url('auth'); ?>" class="btn-link mar-lft">Already have an account? Login!</a>

			</div>
		
		</div>

			



		<!--===================================================-->
		<!-- DEMO PURPOSE ONLY -->
		<!--===================================================-->
		<!--<div class="demo-bg">
			<div id="demo-bg-list">
				<div class="demo-loading"><i class="fa fa-refresh"></i></div>
				<img class="demo-chg-bg bg-trans" src="img/bg-img/thumbs/bg-trns.jpg" alt="Background Image">
				<img class="demo-chg-bg" src="img/bg-img/thumbs/bg-img-1.jpg" alt="Background Image">
				<img class="demo-chg-bg active" src="img/bg-img/thumbs/bg-img-2.jpg" alt="Background Image">
				<img class="demo-chg-bg" src="img/bg-img/thumbs/bg-img-3.jpg" alt="Background Image">
				<img class="demo-chg-bg" src="img/bg-img/thumbs/bg-img-4.jpg" alt="Background Image">
				<img class="demo-chg-bg" src="img/bg-img/thumbs/bg-img-5.jpg" alt="Background Image">
				<img class="demo-chg-bg" src="img/bg-img/thumbs/bg-img-6.jpg" alt="Background Image">
				<img class="demo-chg-bg" src="img/bg-img/thumbs/bg-img-7.jpg" alt="Background Image">
			</div>
		</div>-->
		<!--===================================================-->
	</div>
	<!--===================================================-->
	<!-- END OF CONTAINER -->
	<!--JAVASCRIPT-->
	<!--=================================================-->
	