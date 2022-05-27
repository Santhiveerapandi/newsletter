<main>
    <div class="container-fluid">
<!-- 
	<div id="container">
		<h1>Header !</h1>
    </div> -->
      <div class="row">
        <div class="col-sm-6 login-section-wrapper">
          <div class="brand-wrapper">
            <img src="<?= base_url(); ?>assets/img/logo.gif" alt="logo" class="logo">
          </div>
          <div class="login-wrapper my-auto">
            <h1 class="login-title"><?php echo $title; ?></h1>
            <?php if($this->session->flashdata('message')): ?>
                <div class="alert alert-danger message">
                <?=$this->session->flashdata('message')?>
            </div>
            <?php endif; ?>
            <form action="<?=base_url()?>index.php/login/loginaction"
                method="post">
                <?php
                $csrf=array(
                    'name' => $this->security->get_csrf_token_name(),
                    'hash' => $this->security->get_csrf_hash()
                );
                echo form_hidden($csrf['name'], $csrf['hash']);?>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="user_email" id="email" class="form-control" placeholder="Enter email">
                </div>
                <div class="form-group mb-4">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="enter your passsword">
                </div>
                <!-- <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">Check me out</label>
                </div> -->
                <input name="login" id="login" class="btn btn-block login-btn" type="submit" value="Login">
            </form>
            <!-- <a href="#!" class="forgot-password-link">Forgot password?</a> -->
            <p class="login-wrapper-footer-text">Subscribe News Letter? <a href="<?= base_url(); ?>index.php/login/subscribe" class="text-reset">Subscribe here</a></p>
          </div>
        </div>
        <div class="col-sm-6 px-0 d-none d-sm-block">
          <img src="<?= base_url(); ?>assets/img/login.jpg" alt="login image" class="login-img">
        </div>
      </div>
    </div>
</main>