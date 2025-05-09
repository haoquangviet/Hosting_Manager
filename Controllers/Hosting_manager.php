<?php


namespace Hosting_Manager\Controllers;

class Hosting_manager extends \App\Controllers\Security_Controller {

    protected $Hosting_manager_model;

    function __construct() {
        parent::__construct();
        $this->Hosting_manager_model = new \Hosting_Manager\Models\Hosting_manager_model();

    }

    // Load 3D Studio view
    function index() {
        $data['user'] = $this->login_user;
        if($this->login_user->user_type == 'client' && get_setting('hosting_manager_client_menu_show') != 1){
            app_redirect("forbidden");
        }else{
            return $this->template->rander("Hosting_Manager\Views\index",$data);
        }
    }
    function list_data() {
        $custom_fields = [];

        $options = $this->request->getPost();
        $options["custom_fields"] = $custom_fields;
        if ($this->request->getGet('project_id') && $this->request->getGet('project_id') != '') {
            $options['project_id'] = $this->request->getGet('project_id');
        }
        if ($this->request->getGet('client_id') && $this->request->getGet('client_id') != '') {
            $options['client_id'] = $this->request->getGet('client_id');
        }

        $result = $this->Hosting_manager_model->get_details($options);

        if (get_array_value($options, "server_side")) {
            $list_data = get_array_value($result, "data");
        } else {
            $list_data = $result->getResult();
            $result = array();
        }

        $result_data = array();
        foreach ($list_data as $data) {
            $result_data[] = $this->_make_row($data, $custom_fields);
        }

        $result["data"] = $result_data;

        echo json_encode($result);
    }

    // Prepare a row of 3D studio list table
    private function _make_row($data, $custom_fields) {

        $action = '';
        $no_permission = 0;
        $permissions = explode(',', get_setting('client_permission'));

        $index_id = $data->id;
        $title = anchor(get_uri("hosting_manager/view/".$data->id), $data->title, ["title" => app_lang('hosting_manager_view'), "data-post-id" => $data->id]);

        if($this->login_user->user_type == 'client'){
            if(!empty($permissions) && in_array('edit',$permissions)){
                $action .= modal_anchor(get_uri("hosting_manager/modal_form"), "<i data-feather='edit' class='icon-16'></i>", ["class" => "edit", "title" => app_lang('hosting_manager_edit'), "data-post-id" => $data->id]);
            }
    
            if(!empty($permissions) && in_array('delete',$permissions)){
                $action .= js_anchor("<i data-feather='x' class='icon-16'></i>", ["title" => app_lang('hosting_manager_delete'), "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("hosting_manager/delete"), "data-action" => "delete-confirmation"]);
            }

            $client_name = "-";
            if(!empty($data->client_id)){
                $op['id'] = $data->client_id;
                $client =  $this->Clients_model->get_clients_id_and_name($op)->getRow();
                if($client && isset($client->name)) {
                    $client_name = $client->name;
                }
            }

            if(!empty($permissions) && in_array('show',$permissions)){
            }else{
                $title = $data->title;
            }
    
        }else{

            $purl = '';
            if(!empty($data->provider_url)){
                $purl = anchor($data->provider_url, "<i data-feather='link' class='icon-16'></i>", ["class" => "edit", "title" => app_lang('hosting_manager_provider_url'), "data-post-id" => $data->id]);
            }
            $action = $purl
            .modal_anchor(get_uri("hosting_manager/modal_form"), "<i data-feather='edit' class='icon-16'></i>", ["class" => "edit", "title" => app_lang('hosting_manager_edit'), "data-post-id" => $data->id])
            . js_anchor("<i data-feather='x' class='icon-16'></i>", ["title" => app_lang('hosting_manager_delete'), "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("hosting_manager/delete"), "data-action" => "delete-confirmation"]);
    
            $client_name = "-";
            if(!empty($data->client_id)){
                $op['id'] = $data->client_id;
                $client =  $this->Clients_model->get_clients_id_and_name($op)->getRow();
                if($client && isset($client->name)) {
                    $client_name = anchor(get_uri("clients/view/" . $data->client_id), $client->name);
                }
            }
        }
    
        $row_data = [
            $data->id,
            $index_id,
            $title,
            $data->provider,
            $client_name,
            $data->start_date != '0000-00-00' ? format_to_date($data->start_date, false):'-',
            $this->expiryDate($data->expiry_date),
            $this->Status($data->status),
        ];

        foreach ($custom_fields as $field) {
            $cf_id = "cfv_" . $field->id;
            $row_data[] = $this->template->view("custom_fields/output_" . $field->field_type, ["value" => $data->$cf_id]);
        }

        $row_data[] = $action;
        return $row_data;
    }


    function Status($status){
        if($status == 'active'){
            return '<div class="color-tag border-circle me-2 wh10" style="background-color: #1a8754;"></div>'. app_lang('hosting_manager_'.$status);
        }else{
            return '<div class="color-tag bg-danger border-circle me-2 wh10"></div>'. app_lang('hosting_manager_'.$status);
        }
    }

    function expiryDate($date) {
        // Check for a "no expiry" case
        if ($date == '0000-00-00') {
            return " - ";
        }
    
        // Convert the date string to a timestamp
        $expiryTime = strtotime($date);
        $currentTime = time();
        // Calculate timestamp for one month from now
        $oneMonthAhead = strtotime("+1 month", $currentTime);
    
        // If the expiry date is in the past, it's expired
        if ($expiryTime < $currentTime) {
            return "<span class='text-danger'>".format_to_date($date, false)."</span>";
        }
        // If the expiry date is within the next month, it's expiring soon
        elseif ($expiryTime <= $oneMonthAhead) {
            return "<span class='text-warning'>".format_to_date($date, false)."</span>";
        }
        // Otherwise, it's still active
        else {
            return "<span class='text-success'>".format_to_date($date, false)."</span>";
        }
    }

    public function modal_form() {

        $id = $this->request->getPost('id');
        if ($id) {
            $view_data['model_info'] = $this->Hosting_manager_model->get_one($id);
            $view_data['id'] = $id;
        }
        $view_data["custom_fields"] = $this->Custom_fields_model->get_combined_details("domain_manager", $view_data['model_info']->id ?? '', $this->login_user->is_admin, $this->login_user->user_type)->getResult();

       $options = array();

       if($this->login_user->user_type == 'client'){
            $options = array(
                "client_id" => $this->login_user->client_id,
            );
       }else{
            if (!$this->can_manage_all_projects()) {
                $options["user_id"] = $this->login_user->id;
            } 
        }
        $projects = $this->Projects_model->get_details($options)->getResult();

        $view_data['user'] =  $this->login_user;

        //get projects dropdown
        $projects_dropdown = array( "" => "- " . app_lang("project") . " -");
        foreach ($projects as $project) {
            $projects_dropdown[$project->id] = $project->title;
        }
        $view_data['projects_dropdown'] = $projects_dropdown;
        $view_data['clients_dropdown'] = $this->_get_clients_dropdown_with_permission();
        $view_data['status_dropdown'] = [
            'active'=>app_lang('domain_manager_active'), 
            'domain_manager_expiring_soon'=>app_lang('domain_manager_expiring_soon'), 
            'expired'=>app_lang('domain_manager_expired'), 
            'pending'=>app_lang('domain_manager_pending')
        ];
        if ($id) {

            return $this->template->view("Hosting_Manager\Views\\edit_modal_form", $view_data);
        }else{
            return $this->template->view("Hosting_Manager\Views\modal_form", $view_data);
        }
    }
     //get clients dropdown
     private function _get_clients_dropdown_with_permission() {
        $clients_dropdown = array();

        if ($this->login_user->is_admin || get_array_value($this->login_user->permissions, "client")) {
            $access_client = $this->get_access_info("client");
            
            $clients = $this->Clients_model->get_details(array("show_own_clients_only_user_id" => $this->show_own_clients_only_user_id(), "client_groups" => $access_client->allowed_client_groups))->getResult();
            $clients_dropdown = array( "" => "- " . app_lang("client") . " -");
            foreach ($clients as $client) {
                $clients_dropdown[$client->id] = $client->company_name;
            }
        }

        return $clients_dropdown;
    }

    public function save() {
      
        $id = $this->request->getPost('id');

        $this->validate_submitted_data([
            "title" => "required",
        ]);

        $data = [
            "title"             => $this->request->getPost('title'),
            "provider"          => $this->request->getPost('provider') ?: null,
            "provider_url"      => $this->request->getPost('provider_url') ?: null,
            "provider_user"     => $this->request->getPost('provider_username') ?: null,
            "provider_password" => $this->request->getPost('provider_password') ?: null,
            "plan"              => $this->request->getPost('provider_plan') ?: null,
            "price"             => $this->request->getPost('price') ?: null,
            "start_date"        => $this->request->getPost('start_date') ?: null,
            "expiry_date"       => $this->request->getPost('expiry_date') ?: null,
            "status"            => $this->request->getPost('status') ?: 'active', // Default to 'active'
            "project_id"        => $this->request->getPost('project_id') ?: null,
            "client_id"         => $this->request->getPost('client_id') ?: null,
            "description"       => $this->request->getPost('description') ?: null,
        ];

        $save_id = $this->Hosting_manager_model->ci_save($data, $id);

        if ($save_id) {
            echo json_encode(["success" => true, 'id' => $save_id, 'message' => app_lang('record_saved')]);
        } else {
            echo json_encode(["success" => false, 'message' => app_lang('error_occurred')]);
        }
    }

    function view($id){
        validate_numeric_value($id);

        if ($id) {
            $info = $this->Hosting_manager_model->get_one($id);

            if ($info) {

                $project=$this->Projects_model->get_one($info->project_id);
                $client=$this->Clients_model->get_one($info->client_id);


                $tab = 'info';  
                $view_data["account_info"] = $info;
                $view_data["project"] = $project;
                $view_data["client"] = $client;
                $view_data["tab"] = $tab;
                return $this->template->rander("Hosting_Manager\Views\\view", $view_data);
            } else {
                show_404();
            }
        }

    }


    function delete() {
        $this->validate_submitted_data(["id" => "required|numeric"]);

        $id = $this->request->getPost('id');

        if ($this->Hosting_manager_model->delete($id)) {
            echo json_encode(["success" => true, 'message' => app_lang('record_deleted')]);
        } else {
            echo json_encode(["success" => false, 'message' => app_lang('record_cannot_be_deleted')]);
        }
    }


     // Load project-related domains
     function projects($project_id) {
        $data['project_id'] = $project_id;
        return $this->template->view('Hosting_Manager\Views\projects\hosting', $data);
    }
    function clients($client_id) {
        $data['client_id'] = $client_id;
        return $this->template->view('Hosting_Manager\Views\client\hosting', $data);
    }

    public function setting(){
        $view_data["login_user_id"] = $this->login_user->id;
        return $this->template->rander("Hosting_Manager\Views\\settings\index", $view_data);
    }

    function save_setting(){
        $value = $this->request->getPost();

        $settings = array(
            "client_permission", 
            "hosting_manager_client_menu_show"
        );
        foreach ($settings as $setting) {
            $value = $this->request->getPost($setting);
            if (!$value) {
                $value = "";
            }
            $this->Settings_model->save_setting($setting, $value);

        }
        echo json_encode(array("success" => true, 'message' => app_lang('settings_updated')));
    }



    public function tab($type,$id){

        if ($id) {
            $info = $this->Hosting_manager_model->get_one($id);

        
            if($type == 'info'){

               $view_data['id'] = $id;
               $options = array();
        
               if($this->login_user->user_type == 'client'){
                    $options = array(
                        "client_id" => $this->login_user->client_id,
                    );
               }else{
                    if (!$this->can_manage_all_projects()) {
                        $options["user_id"] = $this->login_user->id;
                    } 
                }
                $projects = $this->Projects_model->get_details($options)->getResult();
        
                $view_data['user'] =  $this->login_user;
        
                //get projects dropdown
                $projects_dropdown = array( "" => "- " . app_lang("project") . " -");
                foreach ($projects as $project) {
                    $projects_dropdown[$project->id] = $project->title;
                }
                $view_data['projects_dropdown'] = $projects_dropdown;
                $view_data['clients_dropdown'] = $this->_get_clients_dropdown_with_permission();
                $view_data['status_dropdown'] = [
                    'active'=>app_lang('domain_manager_active'), 
                    'domain_manager_expiring_soon'=>app_lang('domain_manager_expiring_soon'), 
                    'expired'=>app_lang('domain_manager_expired'), 
                    'pending'=>app_lang('domain_manager_pending')
                ];

                $view_data['model_info'] = $info;

                return $this->template->view('Hosting_Manager\Views\tabs\info_tab', $view_data);

            }elseif($type == 'domains'){

        
                $view_data['account_info'] = $info;
                return $this->template->view("Hosting_Manager\Views\\tabs\domain_tab", $view_data);


            }elseif($type == 'database'){

        
                $view_data['account_info'] = $info;
                return $this->template->view("Hosting_Manager\Views\\tabs\database_tab", $view_data);


            }elseif($type == 'ftp'){

        
                $view_data['account_info'] = $info;
                return $this->template->view("Hosting_Manager\Views\\tabs\\ftp_tab", $view_data);


            }
        }
    }
}
