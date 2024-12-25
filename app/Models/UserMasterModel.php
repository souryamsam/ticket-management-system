<?php

namespace App\Models;

use CodeIgniter\Model;
ini_set('display_errors', 1);
class UserMasterModel extends Model
{
    /* protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect(); 
    } */

    public function user_master_pageload()
    {

        $procedure = "EXEC PAGE_LOAD_FOR_UESR_MASTER";
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

    public function save_user_master_info($postdata)
    {

        $user_code = session()->get('user_info')['USER_CODE'];
        $choose_project = implode(",", $postdata['project']);
        $choose_role = implode(',', $postdata['choose_role']);

        $procedure = "EXEC INSERT_INTO_MASTER_EMPLOYEE @USER_CODE='', @SALUTATION='', @E_NAME='" . $postdata['user_name'] . "', @GENDER='" . $postdata['choose_gender'] . "' , @ADDRESS='' , @STATE_CODE='', @COUNTRY_CODE='', @PIN_CODE='', @AVATAR='', @DOB='', @EMAIL_ADDRESS='" . $postdata['email_address'] . "', @CONTACT_NUMBER='" . $postdata['contact_number'] . "', @ALT_CONTACT_NUMBER='', @DEPARTMENT='', @DESIGNATION='" . $postdata['designation_val'] . "', @ENABLE_LOGIN='', @CREATED_BY='" . $user_code . "', @USER_GROUP='" . $choose_role . "', @LAB_GROUP ='" . $choose_project . "'";
        // echo $procedure; die;
        $query = $this->db->query($procedure);
        if ($query) {
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

    public function pageload_user_master_view()
    {

        $procedure = "EXEC VIEW_MASTER_EMPLOYEE";
        // echo $procedure; die;
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
        //print_r($data);die;
        return $data;
    }
    public function update_status_user_master($postdata)
    {
        $procedure = "EXEC CHANGE_ACTIVE_STATUS_USER_WITH_USER_ID @USER_CODE='" . $postdata['custom_id'] . "'";
        // echo $procedure;
        // die;
        $query = $this->db->query($procedure);
        if ($query) {
            return [
                'status' => 1,
                'message' => 'Status updated successfully.',
            ];
        } else {
            return [
                'status' => 0,
                'message' => 'Something went wrong!',
            ];
        }
    }
    public function get_user_master_single_data($user_id)
    {
        $procedure = "EXEC SELECT_ALL_MASTER_EMPLOYEE_FOR_EDIT @USER_CODE='" . $user_id . "'";
        // echo $procedure;
        // die;
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
        // print_r($data);
        // die;
        return $data;
    }
}
