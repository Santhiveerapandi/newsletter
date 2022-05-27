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
                    <?php 
                    if ($coinsrow) { ?>
                    <div class="table-responsive">
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
                                    <th><input type="checkbox" name="select-all" id="select-all"></th>
                                    <th>Name</th>
                                    <th>Letter</th>
                                    <th>Mail Content</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                             <?php
                                foreach ($coins as $rec) {
                                    echo "<tr><td><input type='checkbox' name='chk' value='{$rec->id}'></td><td>{$rec->name}</td><td>{$rec->letter_name}</td>
                                    <td>
                                    <a href='Admin/letter/{$rec->letter_id}'>edit</a>
                                    </td>
                                    <td>
                                    <a href='mailer/sendmail/{$rec->id}'>
                                    Send mail
                                    </a></td>
                                    </tr>";
                                }
                            ?>
                            </tbody>
                        </table>
                    <?php } ?>
                    </div>
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
</script>
</div>