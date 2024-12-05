<style>
    #cover-img{
        object-fit:cover;
        object-position:center center;
        width: 100%;
        height: 100%;
    }
</style>

<?php
$user = $conn->query("SELECT * FROM users where id ='" . $_settings->userdata('id') . "'");
foreach ($user->fetch_array() as $k => $v) {
	$meta[$k] = $v;
}
?>

<h1>Welcome to <?php echo $_settings->info('name') ?> - <?php echo ($meta['type'] == 1) ? "Administrator" : (($meta['type'] == 2) ? "Staff" : "Technician"); ?></h1>
<hr class="border-info">
<div class="row">
    <div class="">
        <div class="">
            <span class=""><i class=""></i></span>

            
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-primary elevation-1"><i class="fas fa-users"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Total Clients</span>
            <h5 class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `client_list` ")->num_rows;
                ?>
            </h5>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-secondary elevation-1"><i class="fas fa-tools"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Pending Repairs</span>
            <h5 class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `repair_list` where status = 0 ")->num_rows;
                ?>
            </h5>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-primary elevation-1"><i class="fas fa-tools"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Approved Repairs</span>
            <h5 class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `repair_list` where status = 1 ")->num_rows;
                ?>
            </h5>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-info elevation-1"><i class="fas fa-tools"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">In-Progress Repairs</span>
            <h5 class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `repair_list` where status = 2 ")->num_rows;
                ?>
            </h5>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-warning elevation-1"><i class="fas fa-tools"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Checking Repairs</span>
            <h5 class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `repair_list` where status = 3 ")->num_rows;
                ?>
            </h5>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-success elevation-1"><i class="fas fa-tools"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Done Repairs</span>
            <h5 class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `repair_list` where status = 4 ")->num_rows;
                ?>
            </h5>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-danger elevation-1"><i class="fas fa-tools"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Cancelled Repairs</span>
            <h5 class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `repair_list` where status = 5 ")->num_rows;
                ?>
            </h5>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
</div>
<hr>
<div class="w-100" style="height:50vh">
<img src="uploads/Desktop1.png" alt="System Cover Image" id="cover-img" class="img-fluid h-100 bg-gradient-dark">
</div>