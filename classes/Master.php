<?php
require_once('../config.php');

class Master extends DBConnection {
    private $settings;

    public function __construct() {
        global $_settings;
        $this->settings = $_settings;
        parent::__construct();
    }

    public function __destruct() {
        parent::__destruct();
    }

    function capture_err() {
        if (!$this->conn->error) return false;
        
        $resp = [
            'status' => 'failed',
            'error' => $this->conn->error,
        ];
        return json_encode($resp);
    }

    function save_message() {
        extract($_POST);
        $data = [];
        foreach ($_POST as $k => $v) {
            if ($k !== 'id') {
                $data[$k] = $this->conn->real_escape_string($v);
            }
        }

        if (empty($id)) {
            $sql = "INSERT INTO `message_list` SET " . $this->build_set_clause($data);
        } else {
            $sql = "UPDATE `message_list` SET " . $this->build_set_clause($data) . " WHERE id = '{$id}'";
        }

        if ($this->conn->query($sql)) {
            $resp['status'] = 'success';
            $resp['msg'] = empty($id) ? "Your message has successfully sent." : "Message details have been updated successfully.";
        } else {
            $resp = $this->handle_error($sql);
        }

        if ($resp['status'] == 'success') {
            $this->settings->set_flashdata('success', $resp['msg']);
        }

        return json_encode($resp);
    }

    function delete_message() {
        extract($_POST);
        $stmt = $this->conn->prepare("DELETE FROM `message_list` WHERE id = ?");
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            $resp = ['status' => 'success'];
            $this->settings->set_flashdata('success', "Message has been deleted successfully.");
        } else {
            $resp = ['status' => 'failed', 'error' => $stmt->error];
        }

        $stmt->close();
        return json_encode($resp);
    }
	
    function mobilesave_service() {
		extract($_POST);
        $data = [];
        foreach ($_POST as $k => $v) {
            if ($k !== 'id') {
                $data[$k] = $this->conn->real_escape_string($v);
            }
        }

        // Check for existing service
        $check_stmt = $this->conn->prepare("SELECT * FROM `mobile_service_list` WHERE `service` = ? AND delete_flag = 0" . (isset($id) && $id > 0 ? " AND id != ?" : ""));
        if (isset($id) && $id > 0) {
            $check_stmt->bind_param('si', $data['service'], $id);
        } else {
            $check_stmt->bind_param('s', $data['service']);
        }
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0) {
            $resp['status'] = 'failed';
            $resp['msg'] = "Service already exists.";
        } else {
            if (empty($id)) {
                $sql = "INSERT INTO `mobile_service_list` SET " . $this->build_set_clause($data);
            } else {
                $sql = "UPDATE `mobile_service_list` SET " . $this->build_set_clause($data) . " WHERE id = '{$id}'";
            }

            if ($this->conn->query($sql)) {
                $resp['status'] = 'success';
                $resp['msg'] = empty($id) ? "Service has successfully added." : "Service has been updated successfully.";
                $this->settings->set_flashdata('success', $resp['msg']);
            } else {
                $resp = $this->handle_error($sql);
            }
        }

        $check_stmt->close();
        return json_encode($resp);
    }

    function mobiledelete_service() {
		extract($_POST);
        $stmt = $this->conn->prepare("UPDATE `mobile_service_list` SET delete_flag = 1 WHERE id = ?");
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            $resp = ['status' => 'success'];
            $this->settings->set_flashdata('success', "Service has been deleted successfully.");
        } else {
            $resp = ['status' => 'failed', 'error' => $stmt->error];
        }

        $stmt->close();
        return json_encode($resp);
    }

    function save_service() {
        extract($_POST);
        $data = [];
        foreach ($_POST as $k => $v) {
            if ($k !== 'id') {
                $data[$k] = $this->conn->real_escape_string($v);
            }
        }

        // Check for existing service
        $check_stmt = $this->conn->prepare("SELECT * FROM `service_list` WHERE `service` = ? AND delete_flag = 0" . (isset($id) && $id > 0 ? " AND id != ?" : ""));
        if (isset($id) && $id > 0) {
            $check_stmt->bind_param('si', $data['service'], $id);
        } else {
            $check_stmt->bind_param('s', $data['service']);
        }
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0) {
            $resp['status'] = 'failed';
            $resp['msg'] = "Service already exists.";
        } else {
            if (empty($id)) {
                $sql = "INSERT INTO `service_list` SET " . $this->build_set_clause($data);
            } else {
                $sql = "UPDATE `service_list` SET " . $this->build_set_clause($data) . " WHERE id = '{$id}'";
            }

            if ($this->conn->query($sql)) {
                $resp['status'] = 'success';
                $resp['msg'] = empty($id) ? "Service has successfully added." : "Service has been updated successfully.";
                $this->settings->set_flashdata('success', $resp['msg']);
            } else {
                $resp = $this->handle_error($sql);
            }
        }

        $check_stmt->close();
        return json_encode($resp);
    }

    function delete_service() {
        extract($_POST);
        $stmt = $this->conn->prepare("UPDATE `service_list` SET delete_flag = 1 WHERE id = ?");
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            $resp = ['status' => 'success'];
            $this->settings->set_flashdata('success', "Service has been deleted successfully.");
        } else {
            $resp = ['status' => 'failed', 'error' => $stmt->error];
        }

        $stmt->close();
        return json_encode($resp);
    }


    function save_client() {
        extract($_POST);
        $data = [];
        foreach ($_POST as $k => $v) {
            if ($k !== 'id') {
                $data[$k] = $this->conn->real_escape_string($v);
            }
        }

        // Check for existing email
        $check_stmt = $this->conn->prepare("SELECT * FROM `client_list` WHERE `email` = ? AND delete_flag = 0" . (isset($id) && $id > 0 ? " AND id != ?" : ""));
        if (isset($id) && $id > 0) {
            $check_stmt->bind_param('si', $data['email'], $id);
        } else {
            $check_stmt->bind_param('s', $data['email']);
        }
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0) {
            $resp['status'] = 'failed';
            $resp['msg'] = "Client's Email already exists.";
        } else {
            if (empty($id)) {
                $sql = "INSERT INTO `client_list` SET " . $this->build_set_clause($data);
            } else {
                $sql = "UPDATE `client_list` SET " . $this->build_set_clause($data) . " WHERE id = '{$id}'";
            }

            if ($this->conn->query($sql)) {
                $resp['status'] = 'success';
                $resp['msg'] = empty($id) ? "Client has successfully added." : "Client has been updated successfully.";
                $this->settings->set_flashdata('success', $resp['msg']);
            } else {
                $resp = $this->handle_error($sql);
            }
        }

        $check_stmt->close();
        return json_encode($resp);
    }

    function delete_client() {
        extract($_POST);
        $stmt = $this->conn->prepare("UPDATE `client_list` SET delete_flag = 1 WHERE id = ?");
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            $resp['status'] = 'success';
            $this->settings->set_flashdata('success', "Client has been deleted successfully.");
        } else {
            $resp = ['status' => 'failed', 'error' => $stmt->error];
        }

        $stmt->close();
        return json_encode($resp);
    }

    function save_repair() {
        // Generate unique repair code
        if (empty($_POST['id'])) {
            $prefix = "RSMS-" . date("Ym");
            $code = sprintf("%'.04d", 1);
            while (true) {
                $check = $this->conn->query("SELECT * FROM `repair_list` WHERE code = '{$prefix}{$code}'")->num_rows;
                if ($check <= 0) {
                    $_POST['code'] = $prefix . $code;
                    break;
                } else {
                    $code = sprintf("%'.04d", ceil($code) + 1);
                }
            }
        }

        extract($_POST);
        $data = [];
        foreach ($_POST as $k => $v) {
            if ($k !== 'id' && !is_array($v)) {
                $data[$k] = $this->conn->real_escape_string($v);
            }
        }

        if (empty($id)) {
            $sql = "INSERT INTO `repair_list` SET " . $this->build_set_clause($data);
        } else {
            $sql = "UPDATE `repair_list` SET " . $this->build_set_clause($data) . " WHERE id = '{$id}'";
        }

        if ($this->conn->query($sql)) {
            $rid = !empty($id) ? $id : $this->conn->insert_id;
            $resp['id'] = $rid;
            $resp['status'] = 'success';
            $resp['msg'] = empty($id) ? "New Repair Details have successfully added." : "Repair Details have been updated successfully.";

            // Delete previous services and materials
            $this->conn->query("DELETE FROM `repair_services` WHERE repair_id = '{$rid}'");
            $this->conn->query("DELETE FROM `repair_materials` WHERE repair_id = '{$rid}'");

            // Insert services
            if (isset($service_id)) {
                $this->insert_repair_services($rid, $service_id, $fee);
            }

            // Insert materials
            if (isset($material)) {
                $this->insert_repair_materials($rid, $material, $mcost);
            }
        } else {
            $resp = $this->handle_error($sql);
        }

        if ($resp['status'] == 'success') {
            $this->settings->set_flashdata('success', $resp['msg']);
        }

        return json_encode($resp);
    }

    function delete_repair() {
        extract($_POST);
        $stmt = $this->conn->prepare("DELETE FROM `repair_list` WHERE id = ?");
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            $resp['status'] = 'success';
            $this->settings->set_flashdata('success', "Entry Details have been deleted successfully.");
        } else {
            $resp = ['status' => 'failed', 'error' => $stmt->error];
        }

        $stmt->close();
        return json_encode($resp);
    }

    private function build_set_clause($data) {
        $set_clause = [];
        foreach ($data as $k => $v) {
            $set_clause[] = "`{$k}`='{$v}'";
        }
        return implode(", ", $set_clause);
    }

    private function handle_error($sql) {
        return [
            'status' => 'failed',
            'msg' => "An error occurred.",
            'err' => $this->conn->error . "[{$sql}]",
        ];
    }

    private function insert_repair_services($rid, $service_id, $fee) {
        $data = [];
        foreach ($service_id as $k => $v) {
            $data[] = "('{$rid}', '{$v}', '{$fee[$k]}')";
        }
        if (!empty($data)) {
            $sql = "INSERT INTO `repair_services` (`repair_id`, `service_id`, `fee`) VALUES " . implode(", ", $data);
            if (!$this->conn->query($sql)) {
                $this->conn->query("DELETE FROM `repair_list` WHERE id = '{$rid}'");
                return $this->handle_error($sql);
            }
        }
    }

    private function insert_repair_materials($rid, $material, $mcost) {
        $data = [];
        foreach ($material as $k => $v) {
            $data[] = "('{$rid}', '{$v}', '{$mcost[$k]}')";
        }
        if (!empty($data)) {
            $sql = "INSERT INTO `repair_materials` (`repair_id`, `material`, `cost`) VALUES " . implode(", ", $data);
            if (!$this->conn->query($sql)) {
                $this->conn->query("DELETE FROM `repair_list` WHERE id = '{$rid}'");
                return $this->handle_error($sql);
            }
        }
    }
}

$Master = new Master();
$action = $_GET['f'] ?? 'none';
$sysset = new SystemSettings();

switch (strtolower($action)) {
    case 'save_storage':
        echo $Master->save_storage();
        break;
    case 'delete_storage':
        echo $Master->delete_storage();
        break;
    case 'save_repair':
        echo $Master->save_repair();
        break;
    case 'delete_repair':
        echo $Master->delete_repair();
        break;
    case 'save_message':
        echo $Master->save_message();
        break;
    case 'delete_message':
        echo $Master->delete_message();
        break;
    case 'save_service':
        echo $Master->save_service();
        break;
    case 'delete_service':
        echo $Master->delete_service();
        break;
    case 'mobilesave_service':
        echo $Master->mobilesave_service();
        break;
    case 'mobiledelete_service':
        echo $Master->mobiledelete_service();
        break;
    case 'save_client':
        echo $Master->save_client();
        break;
    case 'delete_client':
        echo $Master->delete_client();
        break;
    // Add other cases as needed
    default:
        // echo $sysset->index();
        break;
}
