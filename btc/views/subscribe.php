<main>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6 login-section-wrapper">
          <div class="brand-wrapper">
            <img src="<?= base_url(); ?>assets/img/logo.gif" alt="logo" class="logo">
          </div>
          <div class="login-wrapper my-auto">
            <h1 class="login-title"><?php echo $title; ?></h1>
            <?php if($this->session->flashdata('message')): ?>
                <div class="message alert alert-danger">
                <?=$this->session->flashdata('message')?>
            </div>
            <?php endif; ?>
            <form action="<?=base_url()?>index.php/login/subscribeaction"
                method="post">
                <?php
                $csrf=array(
                    'name' => $this->security->get_csrf_token_name(),
                    'hash' => $this->security->get_csrf_hash()
                );
                echo form_hidden($csrf['name'], $csrf['hash']);?>
                <div class="form-group">
                    <label for="letters">Letters</label>
                    <select name="letter_id" id="letters" class="form-control">
                        <option value="1">May 2022</option>
                        <option value="2">April 2022</option>
                        <option value="3">March 2022</option>
                        <option value="4">Feb 2022</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="user_name">Name</label>
                    <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Enter Name">
                </div>
                <div class="form-group mb-4">
                    <label for="email">Email</label>
                    <input type="email" name="user_email" id="email" class="form-control" placeholder="Enter Email">
                </div>
                <input name="subscribe" id="subscribe" class="btn btn-block login-btn" type="submit" value="Subscribe">
            </form>
          </div>
        </div>
        <div class="col-sm-6 px-0 d-none d-sm-block">
          <img src="<?= base_url(); ?>assets/img/login.jpg" alt="login image" class="login-img">
        </div>
      </div>
    </div>
</main>