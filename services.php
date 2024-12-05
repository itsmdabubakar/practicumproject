<div class="content py-3">
    <center><h1 class="">Our Services</h1></center>
    
    <a href="http://localhost/rsms/computer%20technician.php"><h2>Computer Services</h2></a>

<hr>
<style>
    .callout {
        width: 100%;
        height: 250px; 
        display: flex;
        flex-direction: column;
        justify-content: space-between; 
        padding: 20px; 
        box-sizing: border-box; 
    }

    .description {
        max-height: 100px; /* Set a maximum height for the description */
        overflow-y: auto; /* Enable vertical scrolling */
        text-overflow: ellipsis; /* Optional: Adds ellipsis if text overflows */
    }
</style>

<div class="container-fluid">
    <div class="row row-cols-sm-1 row-cols-md-2 row-cols-lg-3 gx-2 gy-2">
        <?php 
            $services = $conn->query("SELECT * FROM service_list WHERE delete_flag = 0 ORDER BY service ASC");
            while($row = $services->fetch_assoc()):
        ?>
            <div class="col">
                <div class="callout border-primary rounded-0 shadow">
                    <h3><b><?= $row['service'] ?></b></h3>
                        <span class="float-right"><i class="fa fa-tags text-muted"></i> <?= number_format($row['cost'], 2) ?></span>
                    <div class="description text-muted">
                        <small><?= str_replace("\n", "<br/>", $row['description']) ?></small>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>  

    <a href="http://localhost/rsms/mobile%20technician.php"><h2>Mobile Services</h2></a>
<hr>

    <style>
    .callout {
        width: 100%;
        height: 250px; 
        display: flex;
        flex-direction: column;
        justify-content: space-between; 
        padding: 20px; 
        box-sizing: border-box; 
    }

    .description {
        max-height: 100px; /* Set a maximum height for the description */
        overflow-y: auto; /* Enable vertical scrolling */
        text-overflow: ellipsis; /* Optional: Adds ellipsis if text overflows */
    }
</style>

<div class="container-fluid">
<div class="row row-cols-sm-1 row-cols-md-2 row-cols-lg-3 gx-2 gy-2">
        <?php 
            $services = $conn->query("SELECT * FROM `mobile_service_list` where delete_flag = 0 order by `service` asc");
            while($row = $services->fetch_assoc()):
        ?>
            <div class="col">
                <div class="callout border-primary rounded-0 shadow">
                <h3><b><?= $row['service'] ?></b></h3>
                <span class="float-right"><i class="fa fa-tags text-muted"></i> <?= number_format($row['cost'],2) ?></span>
                    <div class="description text-muted">
                        <p class="text-muted"><small><?= str_replace("\n","<br/>",$row['description']) ?></small></p>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
</div>


    