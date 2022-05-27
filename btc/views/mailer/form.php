<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
# mailer/myapp/application/views/mailer/form.php
?><div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
            	<?php if($this->session->flashdata('message')): ?>
                <div class="message alert alert-danger">
                    <?=$this->session->flashdata('message')?>
                </div>
                <?php endif; ?>
                 <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Sending email</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
					<form method="post" action="mailer/send" enctype="multipart/form-data">
					<?php
	                $csrf=array(
	                    'name' => $this->security->get_csrf_token_name(),
	                    'hash' => $this->security->get_csrf_hash()
	                );
	                echo form_hidden($csrf['name'], $csrf['hash']);?>
					<input type="email" id="to" name="to" placeholder="Email">
					<input type="submit" value="Send" />
					</form> 
				</div>
            </div>
        </div>
    </div>
    <!-- Content Row -->
</div>