<?php

namespace App\Models;

use CodeIgniter\Model;
ini_set('display_errors', 1);
class UserModel extends Model
{
    public function verifyuser($userid, $password)
    {
        $procedure = "EXEC PASSWORD_CHECKING_FOR_USER_ID @USER_ID = '" . $userid . "', @PASSWORD ='" . $password . "'";
        // echo $procedure;
        // die;
        $query = $this->db->query($procedure);
        if ($query->getNumRows() > 0) {
            $data = $query->getRowArray();
            return $data;
        } else {
            return false;
        }
    }

    public function dashboard_manu_data()
    {
        $user_code = session()->get('user_info')['USER_CODE'];
        $procedure = "EXEC MENU_BIND @USER_CODE='" . $user_code . "' ";
        $query = $this->db->query($procedure);
        $data = [];
        do {
            $resultArray = [];
            while ($row = sqlsrv_fetch_array($query->resultID, SQLSRV_FETCH_ASSOC)) {
                $resultArray[] = $row;
            }

            if ($resultArray) {
                $data[] = $resultArray;
            }
        } while (sqlsrv_next_result($query->resultID));

        return $data;

    }
    public function role_master_pageload_data()
    {
        $procedure = "EXEC PAGE_LOAD_ROLE_MASTER";
        $query = $this->db->query($procedure);
        $data = [];
        do {
            $resultArray = [];
            while ($row = sqlsrv_fetch_array($query->resultID, SQLSRV_FETCH_ASSOC)) {
                $resultArray[] = $row;
            }

            if ($resultArray) {
                $data[] = $resultArray;
            }
        } while (sqlsrv_next_result($query->resultID));
        return $data;

    }
    public function save_role_master($postdata)
    {
        $user_code = session()->get('user_info')['USER_CODE'];
        $page_info_array = [];
        foreach ($postdata['page_name'] as $page_id) {
            $page_info_array[] = [
                'PAGE_ID' => $page_id
            ];
        }
        $privilege_array = [];
        foreach ($postdata['privilege'] as $privilege_id) {
            $privilege_array[] = [
                'PRIVILEDGE_CODE' => $privilege_id
            ];
        }
        $page_info = json_encode(['PAGE_INFO' => $page_info_array]);
        $privilege = json_encode(['PRIVILEDGE' => $privilege_array]);
        $procedure = "EXEC INSERT_ROLE_MASTER @ROLE_NAME='" . $postdata['role_name'] . "', @ENTRY_BY='" . $user_code . "', @PAGE_INFO='" . $page_info . "',@PRIVILEDGE='" . $privilege . "'";
        $query = $this->db->query($procedure);
        $data = [];
        do {
            $resultArray = [];
            while ($row = sqlsrv_fetch_array($query->resultID, SQLSRV_FETCH_ASSOC)) {
                $resultArray[] = $row;
            }

            if ($resultArray) {
                $data[] = $resultArray;
            }
        } while (sqlsrv_next_result($query->resultID));
        if ($data[1][0]['STATUS'] == '1') {
            return [
                'status' => 1,
                'message' => 'Successfully inserted.',
            ];
        } else {
            return [
                'status' => 0,
                'message' => 'Something went wrong!',
            ];
        }
    }

    public function role_master_pageload_view()
    {
        $procedure = "EXEC FETCH_ROLE_MASTER_FOR_VIEW";
        $query = $this->db->query($procedure);
        $data = [];
        do {
            $resultArray = [];
            while ($row = sqlsrv_fetch_array($query->resultID, SQLSRV_FETCH_ASSOC)) {
                $resultArray[] = $row;
            }

            if ($resultArray) {
                $data[] = $resultArray;
            }
        } while (sqlsrv_next_result($query->resultID));
        return $data;
    }

}