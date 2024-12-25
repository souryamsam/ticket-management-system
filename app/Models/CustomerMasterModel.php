<?php

namespace App\Models;

use CodeIgniter\Model;
ini_set('display_errors', 1);
class CustomerMasterModel extends Model
{
    public function customer_master_pageload()
    {
        $procedure = "EXEC PAGE_LODE_FOR_CUTSOMER_MASTER";
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
    public function save_customer_master_info($postdata)
    {
        $user_code = session()->get('user_info')['USER_CODE'];
        $user_info = [];
        foreach ($postdata['contact_person'] as $key => $contact_person) {
            $user_info[] = [
                'CONTACT_PERSON' => $contact_person,
                'CONTACT_NO' => $postdata['contact_number'][$key]
            ];
        }
        $user_info_json = json_encode(['CONTACT_DETAILS' => $user_info]);
        $project_mapping = implode(",", $postdata['project_mapping']);
        $procedure = "EXEC INSERT_UPDATE_CUSTOMER_DATA @CUSTOMER_ID='', @NAME='" . $postdata['c_name'] . "', @ADDRESS='" . $postdata['address'] . "', @COUNTRY='NULL', @STATE='" . $postdata['state'] . "', @DISTRICT='NULL',@MAPP_PROJECT='" . $project_mapping . "', @ENTRY_BY='" . $user_code . "', @CONTACT_DETAILS='" . $user_info_json . "'";
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

    public function pageload_customer_master_view()
    {

        $procedure = "EXEC VIEW_CUSTOMER_DETAILS";
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
        // print_r($data);die;
        return $data;
    }
}