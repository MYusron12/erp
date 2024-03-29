
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
					<span class="brand-title"><span class="text-thin">Login Page</span></span>
				</a>
			</div>
		</div>
		<!--===================================================-->
		<!-- LOGIN FORM -->
		<!--===================================================-->
		<div class="cls-content">
			<div class="cls-content-sm panel">
				<div class="panel-body">
					<p class="pad-btm">Sign In to your account</p>
					<?= $this->session->flashdata('message'); ?>
					<form method="post" action="<?= base_url('auth'); ?>">
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-envelope"></i></div>
								<input type="text" class="form-control" id="email" name="email"placeholder="Enter Email Address" value="<?= set_value('email'); ?>">
							</div>
							<?= form_error('email', '<small class="text-danger">', '</small>'); ?>
						</div>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
								<input type="password" class="form-control" id="password" name="password" placeholder="Password">
							</div>
							<?= form_error('password', '<small class="text-danger">', '</small>'); ?>
						</div>		
							<button type="submit" class="btn btn-primary btn-user btn-block">
		                      Login
		                    </button>		
						</div>
					</form>             
				</div>

				<div class="pad-ver">

				<a href="" class="btn-link mar-rgt">Forgot password ?</a>
				<a href="<?= base_url('auth/registration'); ?>" class="btn-link mar-lft">Create a new account</a>

			</div>
		
		</div>
	</div>
	