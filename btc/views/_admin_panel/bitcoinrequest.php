<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->

        <!-- Earnings (Monthly) Card Example -->
    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Bitcoins Request</h6>
                    <?php if($this->session->flashdata('message')):?>
                        <?php echo $this->session->flashdata('message'); ?>
                    <?php endif; ?>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <?php
                    /*if ($coinsrow) {
                        echo "<table><tr><th>Bitcoin Owner</th><th>Bitcoin Qty</th><th>Action</th></tr>";
                        foreach ($avail_coins as $rec) {
                            echo "<tr><td>{$rec->user_name}</td><td>{$rec->bitcoins}</td>
                            <td><a href='bitcoins/request/{$rec->login_id}'>Buy Request</a></td>";
                        }
                        echo "</table>";
                    }*/
                    echo "Available Coins = ".$avail_coins;
                    ?>
                    <form action="<?=base_url()?>index.php/bitcoins/submitrequest"
                        method="post">
                        <?php
                        $csrf=array(
                            'name' => $this->security->get_csrf_token_name(),
                            'hash' => $this->security->get_csrf_hash()
                        );
                        echo form_hidden($csrf['name'], $csrf['hash']);
                        echo form_hidden('avail', $avail_coins);
                        echo form_hidden('seller_id', $seller_id);
                        echo form_hidden('buyer_id', $buyer_id); ?>
                        <div class="form-group">
                            <label for="requested">Requested Coins</label>
                            <input type="number" class="form-control" id="requested" name="requested"
                            placeholder="Requesting Coins">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                    
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                            </div>
                        </div>
                        <canvas id="myPieChart" width="287" height="245"
                            style="display: block; width: 287px; height: 245px;"
                            class="chartjs-render-monitor"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Direct
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Social
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> Referral
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    

</div>