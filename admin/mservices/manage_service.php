<?php
require_once('../../config.php');
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `mobile_service_list` where id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    }
}
?>

<style>
    #cimg {
        object-fit: scale-down;
        object-position: center center;
        height: 200px;
        width: 200px;
    }
</style>
<div class="container-fluid">
    <form action="" id="service-form">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <div class="form-group">
            <label for="service" class="control-label">Service</label>
            <input type="text" name="service" id="service" class="form-control form-control-border" placeholder="Service" value ="<?php echo isset($service) ? $service : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="description" class="control-label">Description</label>
            <textarea rows="3" name="description" id="description" class="form-control form-control-sm rounded-0" placeholder="Write the service description here." required><?php echo isset($description) ? $description : '' ?></textarea>
        </div>
        <div class="form-group">
            <label for="cost" class="control-label">Cost</label>
            <input type="number" step="any" name="cost" id="cost" class="form-control form-control-border text-right" placeholder="Cost" value ="<?php echo isset($cost) ? $cost : 0 ?>" required>
        </div>
    </form>
</div>

<script>
    $(function() {
        $('#service-form').submit(function(e) {
            e.preventDefault();
            var _this = $(this);
            $('.pop-msg').remove();
            var el = $('<div>').addClass("pop-msg alert").hide();
            start_loader();

            $.ajax({
                url: _base_url_ + "classes/Master.php?f=mobilesave_service",
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                dataType: 'json',
                error: function(err) {
                    console.error(err);
                    alert_toast("An error occurred", 'error');
                    end_loader();
                },
                success: function(resp) {
                    console.log(resp); // Log the response
                    if (resp.status === 'success') {
                        location.reload();
                    } else {
                        el.addClass("alert-danger").text(resp.msg || "An error occurred due to unknown reasons.");
                        _this.prepend(el);
                    }
                    el.show('slow');
                    $('html, body, .modal').animate({ scrollTop: 0 }, 'fast');
                    end_loader();
                }
            });
        });
    });
</script>
