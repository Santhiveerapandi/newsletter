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
                    if ($coinsrow) {
                        echo "<table><tr><th>Name</th><th>Letter</th><th>mail_content</th></tr>";
                        foreach ($coins as $rec) {
                            echo "<tr><td>{$rec->name}</td><td>{$rec->letter_id}</td><td>".
                            "<a href='Admin/letter/{$rec->letter_id}'>edit</a>".
                            "</td>";
                        }
                        echo "</table>";
                    }
                    ?>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
      
    </div>

    <!-- Content Row -->
    

</div>