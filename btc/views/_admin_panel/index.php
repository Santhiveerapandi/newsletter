<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Subscribers List</h6>
                   
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <?php if($this->session->flashdata('message')): ?>
                    <div class="alert alert-danger alert-dismissible message">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?=$this->session->flashdata('message')?>
                    </div>
                    <?php endif; 

                    if ($coinsrow) { ?>
                    <div class="table-responsive">
                        <form action="<?=base_url()?>index.php/mailer/sendmail"
                            method="post">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" name="select-all" id="select-all"></th>
                                    <th>Name</th>
                                    <th>Letter</th>
                                    <th>Mail Content</th>
                                    <th>Action</th>
                                </tr>

                            </thead>
                            <tfoot>
                                <tr>
                                    <th><input type="checkbox" name="select-all" id="select-all-bottom"></th>
                                    <th>Name</th>
                                    <th>Letter</th>
                                    <th>Mail Content</th>
                                    <th>Action</th>
                                </tr>
                                <tr><td colspan="5">
                                <button type="submit" name="email_send" class="btn btn-primary">Email Send</button>
                                <input type="submit" name="delete" value="Delete" class="btn btn-warning" />
                            </td></tr>
                            </tfoot>
                            <tbody>
                      
                                <?php
                                $csrf=array(
                                    'name' => $this->security->get_csrf_token_name(),
                                    'hash' => $this->security->get_csrf_hash()
                                );
                                echo form_hidden($csrf['name'], $csrf['hash']);
                                foreach ($coins as $rec) {
                                    echo "<tr><td><input type='checkbox' name='chk[]' value='{$rec->sub_id}'></td><td>{$rec->name}</td><td>{$rec->letter_name}</td>
                                    <td>
                                    <a href='Admin/letter/{$rec->letter_id}'>edit</a>
                                    </td>
                                    <td>
                                    <a href='mailer/sendmail/{$rec->sub_id}'>
                                    Send mail
                                    </a></td>
                                    </tr>";
                                }
                                ?>

                            </tbody>
                        </table>
                    </form>
                    </div>
                    <?php } else {
                        echo "No Subscribers Registered";
                    } ?>
                    
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
      
    </div>

    <!-- Content Row -->
    
<script type="text/javascript">
    
document.getElementById('select-all').onclick = function() {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var checkbox of checkboxes) {
        checkbox.checked = this.checked;
    }
}
document.getElementById('select-all-bottom').onclick = function() {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var checkbox of checkboxes) {
        checkbox.checked = this.checked;
    }
}

document.getElementsByName('chk').onclick = function() {
    var checkboxes = document.querySelectorAll('input[name="select-all"]');
    for (var checkbox of checkboxes) {
        checkbox.checked = this.checked;
    }
}
</script>
</div>