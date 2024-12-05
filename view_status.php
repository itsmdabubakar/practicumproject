<?php 
if (isset($_GET['code'])) {
    $qry = $conn->query("SELECT r.*, CONCAT(c.firstname, ' ', c.lastname, ' ', c.middlename) as client FROM `repair_list` r INNER JOIN client_list c ON r.client_id = c.id WHERE r.code = '{$_GET['code']}'");
    
    if ($qry->num_rows > 0) {
        $res = $qry->fetch_array();
        foreach ($res as $k => $v) {
            if (!is_numeric($k)) {
                $$k = $v;
            }
        }

        if (isset($tech_id) && is_numeric($tech_id)) {
            $tech = $conn->query("SELECT CONCAT(firstname, ' ', lastname) as `name` FROM `users` WHERE id = '{$tech_id}'");
            if ($tech->num_rows > 0) {
                $tech_name = $tech->fetch_array()['name'];
            }
        }
    } else {
        echo "<script>alert('Unknown Repair Code'); location.replace('./');</script>";
    }
} else {
    echo "<script>alert('Repair Code is required'); location.replace('./');</script>";
}
?>

<style>
    @media screen {
        .show-print {
            display: none;
        }
    }
    img#repair-banner {
        height: 45vh;
        width: 20vw;
        object-fit: scale-down;
        object-position: center center;
    }
    .table.border-info tr, .table.border-info th, .table.border-info td {
        border-color: var(--dark);
    }
    .badge {
        margin-left: 1rem;
    }
</style>

<div class="content py-3">
    <div class="card card-outline card-dark rounded-0">
        <div class="card-header rounded-0">
            <h5 class="card-title text-primary">Repair Details</h5>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <div id="outprint">
                    <fieldset>
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-bordered border-info">
                                    <colgroup>
                                        <col width="30%">
                                        <col width="70%">
                                    </colgroup>
                                    <tr>
                                        <th class="text-muted text-white bg-gradient-dark">Code</th>
                                        <td><?= htmlspecialchars($code) ?></td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted text-white bg-gradient-dark">Client Name</th>
                                        <td><?= ucwords(htmlspecialchars($client)) ?></td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted text-white bg-gradient-dark">Assigned Technician</th>
                                        <td><?= isset($tech_name) ? htmlspecialchars($tech_name) : '' ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <fieldset>
                                    <legend class="text-muted border-bottom">Services</legend>
                                    <table class="table table-striped table-bordered" id="service_list">
                                        <colgroup>
                                            <col width="70%">
                                            <col width="30%">
                                        </colgroup>
                                        <thead>
                                            <tr class='bg-gradient-dark text-light'>
                                                <th class="text-center">Service</th>
                                                <th class="text-center">Fee</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $services = $conn->query("SELECT rs.*, s.service FROM `repair_services` rs INNER JOIN service_list s ON rs.service_id = s.id WHERE rs.repair_id = '{$id}'");
                                            while ($row = $services->fetch_assoc()):
                                            ?>
                                                <tr>
                                                    <td class="py-1"><?= htmlspecialchars($row['service']) ?></td>
                                                    <td class="py-1 text-right"><?= number_format($row['fee'], 2) ?></td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </fieldset>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="form-group col-md-12">
                                <h3>
                                    <b>Total Payable Amount: <span id="total_amount" class="pl-3"><?= number_format($total_amount, 2) ?></span></b>
                                </h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <small class="text-muted">Remarks</small><br>
                                <p><?= nl2br(htmlspecialchars($remarks)) ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <small class="text-muted">Payment Status</small><br>
                                <span class="rounded-pill badge <?= $payment_status == 1 ? 'badge-success' : 'badge-dark' ?>">
                                    <?= $payment_status == 1 ? 'Paid' : 'Unpaid' ?>
                                </span>
                            </div>
                            <div class="form-group col-md-4">
                                <small class="text-muted">Status</small><br>
                                <?php 
                                $statusClasses = [
                                    0 => 'badge-secondary',
                                    1 => 'badge-primary',
                                    2 => 'badge-info',
                                    3 => 'badge-warning',
                                    4 => 'badge-success',
                                    5 => 'badge-danger'
                                ];
                                $statusTexts = [
                                    0 => 'Pending',
                                    1 => 'Approved',
                                    2 => 'In-Progress',
                                    3 => 'Checking',
                                    4 => 'Done',
                                    5 => 'Cancelled'
                                ];
                                echo '<span class="ml-4 rounded-pill badge ' . $statusClasses[$status] . '">' . $statusTexts[$status] . '</span>';
                                ?>
                            </div>
                        </div>
                    </fieldset>
                </div>

                <hr>
                <div class="text-center mt-3">
                    <a class="btn btn-light border btn-sm" href="./?page=check_status"><i class="fa fa-angle-left"></i> Back</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('#delete_data').click(function() {
            _conf("Are you sure to delete <b><?= htmlspecialchars($code) ?>'s</b> repair permanently?", "delete_repair", [$(this).attr('data-id')]);
        });
    });

    function delete_repair($id) {
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=delete_repair",
            method: "POST",
            data: { id: $id },
            dataType: "json",
            error: function(err) {
                console.error(err);
                alert_toast("An error occurred.", 'error');
                end_loader();
            },
            success: function(resp) {
                if (typeof resp === 'object' && resp.status === 'success') {
                    location.replace('./?page=repairs');
                } else {
                    alert_toast("An error occurred.", 'error');
                    end_loader();
                }
            }
        });
    }
</script>
