<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">E-Mail Content</h1>
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
                    <h6 class="m-0 font-weight-bold text-primary">Subscribe Letter Content</h6>
                   
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form action="<?=base_url()?>index.php/admin/letteraction"
    	                method="post">
    	                <?php
    	                $csrf=array(
    	                    'name' => $this->security->get_csrf_token_name(),
    	                    'hash' => $this->security->get_csrf_hash()
    	                );
    	                echo form_hidden($csrf['name'], $csrf['hash']);
    	                echo form_hidden('letter_id', $letter_id);?>
    	                <div class="form-group">
    	                    <label for="subject">Subject</label>
    	                    <input type="text" class="form-control" id="subject" name="subject"
    	                        placeholder="Enter subject" value="<?php echo isset($letter['subject'])? $letter['subject']: "";?>">
    	                </div>
    	                <div class="form-group">
    	                	<label for="mail_content">Body</label>
    	                    <textarea name="mail_content" id="mail_content">
                            <?php echo isset($letter['mail_content'])? $letter['mail_content']: "";?>
                            </textarea>
                    	</div>
                    	<button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Row -->
</div>