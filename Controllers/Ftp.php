<?php


namespace Hosting_Manager\Controllers;

class Ftp extends \App\Controllers\Security_Controller {

    protected $Hosting_manager_model;
    protected $Ftp_model;

    function __construct() {
        parent::__construct();
        $this->Hosting_manager_model = new \Hosting_Manager\Models\Hosting_manager_model();
        $this->Ftp_model = new \Hosting_Manager\Models\Ftp_model();

    }

    function list_data($hosting_id) {
        $custom_fields = [];

        $options = $this->request->getPost();
        $options["custom_fields"] = $custom_fields;
        $options['hosting_id'] = $hosting_id;
        $result = $this->Ftp_model->get_details($options);

        if (get_array_value($options, "server_side")) {
            $list_data = get_array_value($result, "data");
        } else {
            $list_data = $result->getResult();
            $result = array();
        }

        $result_data = array();
        foreach ($list_data as $data) {
            $result_data[] = $this->_make_row($data, $custom_fields,$hosting_id);
        }

        $result["data"] = $result_data;

        echo json_encode($result);
    }

    private function _make_row($data, $custom_fields,$hosting_id) {

        $action = '';
        $no_permission = 0;
        $permissions = explode(',', get_setting('client_permission'));

        $index_id = $data->id;
        $action = modal_anchor(get_uri("hosting_manager/ftp/modal_form"), "<i data-feather='edit' class='icon-16'></i>", ["class" => "edit", "title" => app_lang('hosting_manager_edit'), "data-post-id" => $data->id,"data-post-host_id"=>$hosting_id])
            . js_anchor("<i data-feather='x' class='icon-16'></i>", ["title" => app_lang('hosting_manager_delete'), "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("hosting_manager/ftp/delete"), "data-action" => "delete-confirmation"]);
    
    
    
        $row_data = [
            $index_id,
            $data->account_name,
            $data->hostname,
            $data->username,
            $data->port,
            $data->protocol,
            '<code>'.$data->root_directory.'</code>',
            $this->Status($data->status),
        ];
        $row_data[] = $action;
        return $row_data;
    }

    function Status($ssl_active){
        if($ssl_active == 'enabled'){
            return '<div class="color-tag border-circle me-2 wh10" style="background-color: #1a8754;"></div>'. app_lang('hosting_manager_'.$ssl_active);
        }else{
            return '<div class="color-tag bg-danger border-circle me-2 wh10"></div>'. app_lang('hosting_manager_'.$ssl_active);
        }
    }
  
    public function modal_form() {

        $host_id = $this->request->getPost('host_id');
        $id = $this->request->getPost('id');
        if ($host_id) {
            $this->Hosting_manager_model->get_one($host_id);
            $view_data['status_dropdown'] = [
                'active'=>app_lang('hosting_manager_active'), 
                'expiring_soon'=>app_lang('hosting_manager_expiring_soon'), 
                'expired'=>app_lang('hosting_manager_expired'), 
                'pending'=>app_lang('hosting_manager_pending')
            ];
            $view_data['host_id'] = $host_id;
            if ($id) {
                $modal_info = $this->Ftp_model->get_one($id);
                $view_data['modal_info'] = $modal_info;
                $view_data['id'] = $id;
                return $this->template->view("Hosting_Manager\Views\\ftp\\edit_modal_form", $view_data);
            }else{
                return $this->template->view("Hosting_Manager\Views\\ftp\\modal_form", $view_data);
            }
        }
        
    }
    public function save() {
      

     
        $id = $this->request->getPost('id');

        $this->validate_submitted_data([
            "name" => "required",
            "hosting_id" => "required",
        ]);

        $data = [
            "account_name"            => $this->request->getPost('name') ?: null,
            "hosting_id"      => $this->request->getPost('hosting_id') ,
            "hostname"        => $this->request->getPost('hostname') ?: null,
            "username"        => $this->request->getPost('username') ?: null,
            "password"        => $this->request->getPost('password') ?: null,
            "port"            => $this->request->getPost('port') ?: null,
            "protocol"        => $this->request->getPost('protocol') ?: 'FTP',
            "root_directory"  => $this->request->getPost('root_directory') ?: null,
            "status"          => $this->request->getPost('status') ?: 'active', 
            "description"     => $this->request->getPost('description') ?: null,
        ];

        $save_id = $this->Ftp_model->ci_save($data, $id);

        if ($save_id) {
            echo json_encode(["success" => true, 'id' => $save_id, 'message' => app_lang('record_saved')]);
        } else {
            echo json_encode(["success" => false, 'message' => app_lang('error_occurred')]);
        }
    }
    function delete() {
        $this->validate_submitted_data(["id" => "required|numeric"]);

        $id = $this->request->getPost('id');

        if ($this->Ftp_model->delete($id)) {
            echo json_encode(["success" => true, 'message' => app_lang('record_deleted')]);
        } else {
            echo json_encode(["success" => false, 'message' => app_lang('record_cannot_be_deleted')]);
        }
    }

   
}
