<?php

namespace App\Models;

use CodeIgniter\Model;
ini_set('display_errors', 1);
class ProjectMasterModel extends Model
{
    public function save_project_master_info($postdata, $filePath)
    {

        $user_code = session()->get('user_info')['USER_CODE'];
        $procedure = "EXEC SP_INSERT_UPDATE_PROJECT_MASTER @PROJECT_ID='',  @PROJECT_NAME='" . $postdata['project_name'] . "',  @DESCRIPTION='" . $postdata['description'] . "',@PROJECT_ICON='" . $filePath . "', @ENTRY_BY='" . $user_code . "'  ";
        // echo $procedure;
        // die;
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

    public function pageload_project_master_view()
    {

        $procedure = "EXEC VIEW_PROJECT_MASTER";
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

    public function project_master_name_duplicate_check($postdata)
    {
        $procedure = "EXEC PROJECT_NAME_DUPLICATE_CHECKING @PROJECT_NAME='" . $postdata['project_name'] . "'";
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
        if ($data[0][0][''] == 'YES') {
            return ["status" => '1', "message" => "Duplicate project name found"];
        } else {
            return ["status" => '0', "message" => "Somthing Wrrong"];
        }
    }
}