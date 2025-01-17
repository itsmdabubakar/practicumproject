<?php 
if (isset($_GET['id'])) {
    $qry = $conn->query("SELECT * FROM repair_list WHERE id = '{$_GET['id']}'");
    if ($qry->num_rows > 0) {
        $res = $qry->fetch_array();
        foreach ($res as $k => $v) {
            if (!is_numeric($k)) {
                $$k = $v;
            }
        }

        $service_list = $conn->query("SELECT rs.*, s.service, s.cost FROM repair_services rs INNER JOIN service_list s ON rs.service_id = s.id WHERE rs.repair_id = '{$id}'")->fetch_all(MYSQLI_ASSOC);
        $material_list = $conn->query("SELECT * FROM repair_materials WHERE repair_id = '{$id}'")->fetch_all(MYSQLI_ASSOC);
    }
}
?>
<div class="content py-3">
    <div class="container-fluid">
        <div class="card card-outline card-info rounded-0 shadow">
            <div class="card-header rounded-0">
                <h4 class="card-title"><?= isset($code) ? "Update Repair Details" : "Add New Repair" ?></h4>
            </div>
            <div class="card-body rounded-0">
                <div class="container-fluid">
                    <form action="" id="entry-form">
                        <input type="hidden" name="id" value="<?= isset($id) ? $id : '' ?>">
                        <fieldset>
                            <div class="row">
                                <div class="form-group col-md-8">
                                   <select name="client_id" id="client_id" class="form-control form-control-sm form-control-border select2" data-placeholder="Please Select Client Here">
                                       <option value="" disabled <?= !isset($client_id) ? "selected" : "" ?>></option>
                                       <?php 
                                       $clients = $conn->query("SELECT *, CONCAT(firstname, ' ', middlename, ' ', lastname) AS name FROM client_list ORDER BY `id` DESC");
                                       while ($row = $clients->fetch_assoc()):
                                        if ($row['delete_flag'] == 1 && (!isset($client_id) || (isset($client_id) && $client_id != $row['id'])))
                                            continue;
                                       ?>
                                       <option value="<?= $row['id'] ?>" <?= isset($client_id) && $client_id == $row['id'] ? "selected" : "" ?>><?= $row['name'] ?></option>
                                       <?php endwhile; ?>
                                   </select>
                                    <small class="text-muted px-4">Client Name</small>
                                </div>
                            </div>

                            <?php if($_settings->userdata('type') == 3 && !isset($id)): ?>
                            <input type="hidden" name="tech_id" value="<?= $_settings->userdata('id') ?>">
                        <?php endif; ?>
                        <?php if($_settings->userdata('type') != 3): ?>
                        <fieldset class="mb-3">
                            <legend class="text-muted border-bottom">Assign</legend>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <select name="tech_id" id="tech_id" class="form-control form-control rounded-0">
                                        <option value="" disabled <?= !isset($tech_id) ? "selected" : "" ?>>Please Select Technician</option>
                                        <option value="" <?= isset($tech_id) && in_array($tech_id,[null,""]) ? "selected" : "" ?>>Unset</option>
                                        <?php 
                                        $tech_qry = $conn->query("SELECT *, concat(firstname, ' ', lastname) as `name` FROM `users` WHERE `type` = 3 ORDER BY `id` DESC");
                                        while($row = $tech_qry->fetch_array()):
                                        ?>
                                        <option value="<?= $row['id'] ?>" <?= isset($tech_id) && $tech_id == $row['id'] ? "selected" : "" ?>><?= $row['name'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                        </fieldset>
                        <?php endif; ?>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <fieldset>
                                        <legend class="text-muted border-bottom">Services</legend>
                                        <div class="row">
                                            <div class="form-group col-md-9">
                                                <select id="service" class="form-control form-control-sm form-control-border select2" data-placeholder="Please Select Computer Service Here">
                                                    <option value="" disabled selected></option>
                                                    <?php 
                                                    $service_arr = [];
                                                    $services = $conn->query("SELECT id, service, cost FROM service_list WHERE delete_flag = 0 ORDER BY service ASC");
                                                    while ($row = $services->fetch_assoc()):
                                                        $service_arr[$row['id']] = $row;
                                                    ?>
                                                    <option value="<?= $row['id'] ?>" <?= isset($service_id) && $service_id == $row['id'] ? "selected" : "" ?>><?= $row['service'] ?></option>
                                                    <?php endwhile; ?>
                                                </select>
                                                <small class="text-muted px-4">Computer Service</small>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" id="cost" class="form-control form-control-sm form-control-border text-right" value="0.00" disabled>
                                                <small class="text-muted px-4">Fee</small>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-9">
                                                <select id="mobile_service" class="form-control form-control-sm form-control-border select2" data-placeholder="Please Select Mobile Service Here">
                                                    <option value="" disabled selected></option>
                                                    <?php 
                                                    $mobile_service_arr = [];
                                                    $mobile_services = $conn->query("SELECT id, service, cost FROM mobile_service_list WHERE delete_flag = 0 ORDER BY service ASC");
                                                    while ($row = $mobile_services->fetch_assoc()):
                                                        $mobile_service_arr[$row['id']] = $row;
                                                    ?>
                                                    <option value="<?= $row['id'] ?>" <?= isset($mobile_service_id) && $mobile_service_id == $row['id'] ? "selected" : "" ?>><?= $row['service'] ?></option>
                                                    <?php endwhile; ?>
                                                </select>
                                                <small class="text-muted px-4">Mobile Service</small>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" id="mobile_cost" class="form-control form-control-sm form-control-border text-right" value="0.00" disabled>
                                                <small class="text-muted px-4">Fee</small>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <button class="btn btn-flat btn-primary btn-sm mb-3" type="button" id="add_service"><i class="fa fa-plus"></i> Add Computer Service</button>
                                                <button class="btn btn-flat btn-primary btn-sm" type="button" id="add_mobile_service"><i class="fa fa-plus"></i> Add Mobile Service</button>
                                            </div>
                                        </div>
                                        <table class="table table-striped table-bordered" data-placeholder='true' id="service_list">
                                            <colgroup>
                                                <col width="10%">
                                                <col width="65%">
                                                <col width="25%">
                                            </colgroup>
                                            <thead>
                                                <tr class='bg-gradient-dark text-light'>
                                                    <th class="text-center py-1"></th>
                                                    <th class="text-center py-1">Service</th>
                                                    <th class="text-center py-1">Fee</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </fieldset>
                                </div>
                                <div class="col-md-6">
                                    <fieldset>
                                        <!-- Add any additional fields if necessary -->
                                    </fieldset>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="form-group col-md-12">
                                    <input type="hidden" name="total_amount" value="0">
                                    <h3><b>Total Payable Amount: <span id="total_amount" class="pl-3">0.00</span></b></h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12 col-md-8 col-lg-7">
                                    <small class="text-muted px-4">Remarks</small>
                                    <textarea name="remarks" id="remarks" rows="3" class="form-control form-control-sm rounded-0"><?= isset($remarks) ? $remarks : "" ?></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <select name="payment_status" id="payment_status" class="form-control form-control-sm form-control-border" required>
                                        <option value="0" <?= isset($payment_status) && $payment_status == 0 ? "selected" : "" ?>>Unpaid</option>
                                        <option value="1" <?= isset($payment_status) && $payment_status == 1 ? "selected" : "" ?>>Paid</option>
                                    </select>
                                    <small class="text-muted px-4">Payment Status</small>
                                </div>
                                <div class="form-group col-md-4">
                                    <select name="status" id="status" class="form-control form-control-sm form-control-border" required>
                                        <option value="0" <?= isset($status) && $status == 0 ? "selected" : "" ?>>Pending</option>
                                        <option value="1" <?= isset($status) && $status == 1 ? "selected" : "" ?>>Approved</option>
                                        <option value="2" <?= isset($status) && $status == 2 ? "selected" : "" ?>>In-progress</option>
                                        <option value="3" <?= isset($status) && $status == 3 ? "selected" : "" ?>>Checking</option>
                                        <option value="4" <?= isset($status) && $status == 4 ? "selected" : "" ?>>Done</option>
                                        <option value="5" <?= isset($status) && $status == 5 ? "selected" : "" ?>>Cancelled</option>
                                    </select>
                                    <small class="text-muted px-4">Status</small>
                                </div>
                            </div>
                        </fieldset>
                        
                        <hr class="bg-navy">
                        <center>
                            <button class="btn btn-sm bg-primary btn-flat mx-2 col-3">Save</button>
                            <?php if (isset($id)): ?>
                                <a class="btn btn-sm btn-light border btn-flat mx-2 col-3" href="./?page=repairs/view_details&id=<?= $id ?>">Cancel</a>
                            <?php else: ?>
                                <a class="btn btn-sm btn-light border btn-flat mx-2 col-3" href="./?page=repairs">Cancel</a>
                            <?php endif; ?>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var service_list  = $.parseJSON('<?= json_encode(isset($service_list) ? $service_list : []) ?>');
    var material_list  = $.parseJSON('<?= json_encode(isset($material_list) ? $material_list : []) ?>');
    var services = $.parseJSON('<?= json_encode($service_arr) ?>');
    var mobile_services = $.parseJSON('<?= json_encode($mobile_service_arr) ?>');

    function submit_entry() {
        var _this = $("#entry-form");
        $('.pop-msg').remove();
        var el = $('<div>');
        el.addClass("pop-msg alert").hide();
        start_loader();

        $.ajax({
            url: _base_url_ + "classes/Master.php?f=save_repair",
            data: new FormData($("#entry-form")[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            dataType: 'json',
            error: err => {
                console.log(err);
                alert_toast("An error occurred", 'error');
                end_loader();
            },
            success: function(resp) {
                if (resp.status === 'success') {
                    location.href = "./?page=repairs/view_details&id=" + resp.id;
                } else if (!!resp.msg) {
                    el.addClass("alert-danger").text(resp.msg);
                    _this.prepend(el);
                } else {
                    el.addClass("alert-danger").text("An error occurred due to unknown reason.");
                    _this.prepend(el);
                }
                el.show('slow');
                $('html, body').animate({scrollTop: 0}, 'fast');
                end_loader();
            }
        });
    }

    function calc_total() {
        var total = 0;
        $('#service_list tbody tr').each(function() {
            var cost = $(this).find('td:nth-child(3)').text().trim();
            cost = cost.replace(/\,/gi, '');
            total += parseFloat(cost);
        });
        $('#total_amount').text(parseFloat(total).toLocaleString('en-US', {style: "decimal", maximumFractionDigits: 2, minimumFractionDigits: 2}));
        $('input[name="total_amount"]').val(parseFloat(total));
    }

    function add_service(id, fee = '', type = 'computer') {
        if ((type === 'computer' && !!services[id]) || (type === 'mobile' && !!mobile_services[id])) {
            fee = fee === '' ? (type === 'computer' ? services[id].cost : mobile_services[id].cost) : fee;
            var tr = $('<tr>');
            tr.append('<td class="px-2 py-1 text-center"><input type="hidden" name="service_id[]" value="' + id + '"/><input type="hidden" name="fee[]" value="' + fee + '"/> <button class="btn btn-remove btn-rounded btn-sm btn-danger"><i class="fa fa-trash"></i></button></td>');
            tr.attr('data-id', id);
            tr.append("<td class='px-2 py-1'>" + (type === 'computer' ? services[id].service : mobile_services[id].service) + "</td>");
            tr.append("<td class='px-2 py-1 text-right'>" + (parseFloat(fee).toLocaleString('en-US', {style: 'decimal', maximumFractionDigits: 2, minimumFractionDigits: 2})) + "</td>");
            $('#service_list tbody').append(tr);
            tr.find('.btn-remove').click(function() {
                tr.remove();
                calc_total(); // Recalculate total after removing a service
            });
            $('#service').val('').trigger('change');
            $('#mobile_service').val('').trigger('change');
            $('#cost').val('0.00');
            $('#mobile_cost').val('0.00');
            calc_total();
        }
    }

    $(function() {
        if (Object.keys(service_list).length > 0) {
            Object.keys(service_list).map(k => {
                add_service(service_list[k].service_id, service_list[k].fee, 'computer');
            });
        }

        $('#service').change(function() {
            var id = $(this).val();
            if (!!services[id]) {
                $('#cost').val(parseFloat(services[id].cost).toLocaleString('en-US', {
                    style: 'decimal',
                    maximumFractionDigits: 2,
                    minimumFractionDigits: 2
                }));
            }
        });

        $('#mobile_service').change(function() {
            var id = $(this).val();
            if (!!mobile_services[id]) {
                $('#mobile_cost').val(parseFloat(mobile_services[id].cost).toLocaleString('en-US', {
                    style: 'decimal',
                    maximumFractionDigits: 2,
                    minimumFractionDigits: 2
                }));
            }
        });

        $('#add_service').click(function() {
            var id = $('#service').val();
            if ($('#service_list tbody tr[data-id="' + id + '"]').length > 0) {
                alert_toast("Service already listed.", 'warning');
                return false;
            }
            add_service(id);
        });

        $('#add_mobile_service').click(function() {
            var id = $('#mobile_service').val();
            if ($('#service_list tbody tr[data-id="' + id + '"]').length > 0) {
                alert_toast("Mobile service already listed.", 'warning');
                return false;
            }
            add_service(id, '', 'mobile');
        });

        $('.select2').each(function() {
            var _this = $(this);
            _this.select2({
                placeholder: _this.attr('data-placeholder') || 'Please Select Here',
                width: '100%'
            });
        });

        $('#entry-form').submit(function(e) {
            e.preventDefault();
            _conf("Please make sure that you have reviewed the form before you continue to save the entry details.", "submit_entry", []);
        });
    });
</script>
