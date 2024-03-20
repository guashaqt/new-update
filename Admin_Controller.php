<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(['form_validation']);
		$this->load->model('Admin_model');
      //  $this->load->library('upload');
        $this->load->helper('form');
        $this->load->helper('url');

	}

	public function login()
{
    if (isset($_POST['login_btn'])) {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $admin_data = $this->Admin_model->authenticate_admin($email, $password);

        if ($admin_data !== 0) {
            $admin_info = [
                'email' => $admin_data[0]->email,
                'password' => $admin_data[0]->password,
            ];
            $adminId = $admin_data[0]->admin_id;
            $adminData = $this->Admin_model->getAdminDataById($adminId);
            $data['admin'] = $adminData;
            
            $this->session->set_userdata('admin', $admin_info);
            
            // Redirect to the dashboard upon successful login
            redirect('admin-dashboard');
            return; // Stop further execution after redirect
        } else {
            $this->session->set_flashdata('msg_login', 'Invalid Email or Password. Please try again.');
        }
    }

    // Load the login view
    $this->load->view('admin/pages/login');
}


	
   
	
public function dashboard() {
    // Check if admin is logged in
    if ($this->session->userdata('admin')) {
        // Get total counts
        $data['total_users'] = count($this->Admin_model->get_all_users());
        $data['total_child'] = count($this->Admin_model->get_all_child());
        $data['total_vaccine'] = count($this->Admin_model->get_all_vaccine());
        $data['total_personnel'] = count($this->Admin_model->get_all_personnel());

        // Get admin data
        $admin_info = $this->session->userdata('admin');
        $adminData = $this->Admin_model->getAdminDataByEmail($admin_info['email']); // Assuming you have a method to get admin data by email
        $data['admin'] = $adminData;

        // Load views
        $this->load->view('admin/include/header');
        $this->load->view('admin/include/nav');
        $this->load->view('admin/pages/dashboard', $data);
        $this->load->view('admin/include/footer');
    } else {
        // Redirect to login page if admin is not logged in
        redirect('login');
    }
}


	


	public function logout()
{
    $this->session->unset_userdata('admin');
    redirect(base_url('index.php/login'));
}


//USER CRUD ---- VIEW_USER//
    public function view_user($user_id) {
        // Load the Users_model
        $this->load->model('Users_model');
        
        // Get user data by user_id
        $user_data = $this->Users_model->get_user_by_id($user_id);
        
        // Check if user data exists
        if ($user_data) {
            // Pass user data to the view
            $data['user'] = $user_data;
            $data['user_id'] = $user_id; // Pass $user_id to the view
    
            // Load the children data
            $this->load->model('Admin_model');
            $child_data = $this->Admin_model->get_children_by_user_id($user_id);
            $data['child'] = $child_data; // Adjusted variable name to 'child'
            $data['vaccines'] = $this->Admin_model->get_vaccines();
            $data['personnel'] = $this->Admin_model->get_personnel();

    
            // Load the view
            $this->load->view('admin/include/header');
            $this->load->view('admin/include/nav');
            $this->load->view('admin/pages/view_user', $data);
            $this->load->view('admin/include/footer');
        } else {
            // Handle case where user data is not found
            echo "User not found.";
        }
    }
    
//USER CRUD ---- DELETE_USER//
    public function delete_user($id){
        $this->db->where('user_id', $id);
        $this->db->delete('user');
    
        redirect(base_url('index.php/registered_users'));
    }

//USER CRUD ---- UPDATE_USER//

public function update_user($user_id) {
    // Check if the form is submitted
    if ($this->input->server('REQUEST_METHOD') === 'POST') {
        // Handle form submission to update user data
        $update_data = array(
            'firstname' => $this->input->post('firstname'),
            'middlename' => $this->input->post('middlename'),
            'lastname' => $this->input->post('lastname'),
            'contact' => $this->input->post('contact'),
            'sex' => $this->input->post('sex'),
            'purok' => $this->input->post('purok'),
            'barangay' => $this->input->post('barangay'),
            'municipality' => $this->input->post('municipality'),
            'province' => $this->input->post('province'),
            'bday' => $this->input->post('bday'),
            'birthplace' => $this->input->post('birthplace'),
            'parent_guardian' => $this->input->post('parent_guardian'),
            'civil_status' => $this->input->post('civil_status'),
            'user_status' => $this->input->post('user_status')
        );

        $result = $this->Admin_model->update_user_data($user_id, $update_data);
        
        if ($result) {
            redirect('registered_users'); // Adjust the URL as needed
        } else {
            redirect('update_user/' . $user_id); // Redirect to the update form again
        }
    } else {
        $user_data = $this->Admin_model->get_user_data($user_id);

        if ($user_data) {
            $data['user_data'] = $user_data;
            $this->load->view('admin/pages/update_user', $data);
        } else {
            redirect('registered_users'); // Adjust the URL as needed
        }
    }
}

public function fetch_update_user_form($user_id) {
    // Load the user data using the model
    $user_data = $this->your_model->get_user_data($user_id);

    // Assuming you have a view for the update user form
    // Pass the user data to the view
    $data['user_data'] = $user_data;
    $this->load->view('update_user_form', $data);
}



public function ajax_update_user_form() {
    $user_id = $this->input->post('user_id', true);
    $user_data = $this->db->where('user_id', $user_id)->get('user')->row();
    $data['user_data'] = $user_data;
    $this->load->view('admin/pages/popup/edit_user', $data);
}

public function get_child_details($child_id) {
    // Load the Admin_model
    $this->load->model('Admin_model');

    // Fetch the child's information from the model
    $child_info = $this->Admin_model->get_child_details($child_id);

    // Return the child's information as JSON
    echo json_encode($child_info);
}


    public function view_immunization() {


        $this->load->model('Admin_model'); 
 
        // Call the model function to get registered users
    
        $immunization_data = $this->Admin_model->get_immunization(); 
        // Pass the user data to the view
        $data = ['immunizations' => $immunization_data];
   
        // Load the view
        $this->load->view('admin/include/header');
        $this->load->view('admin/include/nav');
        $this->load->view('admin/pages/immunization', $data);
        $this->load->view('admin/include/footer');


    

    }
    


    public function add_immunization() {
        if ($this->input->post()) {
            // Retrieve form data
            $child_id = $this->input->post('child_id');
            $vaccine_id = $this->input->post('vaccine_id');
            $personnel_id = $this->input->post('personnel_id');
            $date = $this->input->post('date');
            $description = $this->input->post('description');
            $status = $this->input->post('status');
    
            // Prepare data for insertion
            $data = array(
                'child_id' => $child_id,
                'vaccine_id' => $vaccine_id,
                'personnel_id' => $personnel_id,
                'date' => $date,
                'description' => $description,
                'status' => $status
            );
    
            // Load the Admin_model
            $this->load->model('Admin_model');
    
            // Insert data into database
            $result = $this->Admin_model->add_immunization($data);
    
            if ($result) {
                // Redirect to the immunization view after successful insertion
                redirect('immunization');
            } else {
                // Error message
                echo "Failed to add immunization.";
            }
        } else {
            // Handle the case when the form is not submitted
            show_error('Invalid request');
        }
    }
    



	public function register_admin()
		{
			if (isset($_POST['adminbtn']))
			{
		    $data['firstname']=$this->input->post('firstname');
			$data['middlename']=$this->input->post('middlename');
			$data['lastname']=$this->input->post('lastname');
			$data['sex']=$this->input->post('sex');
			$data['contact']=$this->input->post('contact');
			$data['email']=$this->input->post('email');
			$data['password']=$this->input->post('password');
			
			$response=$this->Admin_model->insertdata($data);
            
            
			if($response==true){
                $this->session->set_flashdata('message', 'Records Saved Successfully');
			}
			else{
                $this->session->set_flashdata('message', 'Insert Error!');
			}
        
        
        // Redirect to the login page after registration
        redirect('login');
    
		
		}
		$this->load->view('admin/pages/login');
		
			

		}




		public function register_user() {
			/* if(!isset($_SESSION['user'])){
				 $this->session->set_flashdata('msg_login','You are not logged in. Please Login First');
				 redirect(base_url('index.php/admin'));
			 }*/
			 $this->form_validation->set_rules('firstname','First Name','trim|required|min_length[2]|max_length[50]');
			 $this->form_validation->set_rules('middlename','Middle Name','trim|required|min_length[2]|max_length[50]');
			 $this->form_validation->set_rules('lastname','Last Name','trim|required|min_length[2]|max_length[50]');
			 $this->form_validation->set_rules('sex','Sex','trim|required');
			 $this->form_validation->set_rules('contact','Contact','trim|required');
			 $this->form_validation->set_rules('bday','Birthday','trim|required');
			 $this->form_validation->set_rules('birthplace','Birthplace','trim|required');
			 $this->form_validation->set_rules('purok','Purok','trim|required');
			 $this->form_validation->set_rules('barangay','Barangay','trim|required|min_length[2]|max_length[50]');
			 $this->form_validation->set_rules('municipality','Municipality','trim|required|min_length[2]|max_length[50]');
			 $this->form_validation->set_rules('province','Province','trim|required');
			 $this->form_validation->set_rules('parent_guardian','Parent or Guardian','trim|required');
			 $this->form_validation->set_rules('email','Email','trim|required|min_length[2]|max_length[50]');
			 $this->form_validation->set_rules('password','Password','trim|required|min_length[2]|max_length[50]');
			 $this->form_validation->set_rules('civil_status','Civil Status','trim|required|min_length[2]|max_length[50]');
			 $this->form_validation->set_rules('user_status','User Status','trim|required|min_length[2]|max_length[50]');
	 
			 $this->form_validation->set_error_delimiters('<p style="color:red;">','<p>');
	 
			 if($this->form_validation->run()==FALSE){
	 
				 $this->load->view('admin/include/header');
				 $this->load->view('admin/include/nav');
				 $this->load->view('admin/pages/register_user');
				 $this->load->view('admin/include/footer');
	 
	 
			 }else{
				
				 $user_data = [ 
			
					 'firstname' => $this->input->post('firstname',TRUE),
					 'middlename' => $this->input->post('middlename',TRUE),
					 'lastname' => $this->input->post('lastname',TRUE),
					 'sex' => $this->input->post('sex',TRUE),
					 'contact' => $this->input->post('contact',TRUE),
					 'bday' => $this->input->post('bday',TRUE),
					 'birthplace' => $this->input->post('birthplace',TRUE),
					 'purok' => $this->input->post('purok',TRUE),
					 'barangay' => $this->input->post('barangay',TRUE),
					 'municipality' => $this->input->post('municipality',TRUE),
					 'province' => $this->input->post('province',TRUE),
					 'parent_guardian' => $this->input->post('parent_guardian',TRUE),
					 'email' => $this->input->post('email',TRUE),
					 'password' => $this->input->post('password',TRUE),
					 'civil_status' => $this->input->post('civil_status',TRUE),
					 'user_status' => $this->input->post('user_status',TRUE)
				 ];
				 // Load the User_Model
				 $this->load->model('Admin_model');
				 $inserted = $this->Admin_model->register_user($user_data);
	 
				 if ($inserted) {
					 $this->session->set_flashdata('success', 'Successfully Added!');
					 redirect(base_url('index.php/registered_users'));
				 } else {
					 $this->session->set_flashdata('error', 'Added Failed!');
					 redirect('register');
					 // Handle the case when insertion fails
				 }
		 }

         
	 }
	 
	 public function registered_users() {
		 // Load the model
		 $this->load->model('Admin_model'); // Replace 'Your_model_name' with the actual name of your model
	 
		 // Call the model function to get registered users
		 $users_data = $this->Admin_model->get_registered_users(); // Replace 'Your_model_name' with the actual name of your model
	 
		 // Pass the user data to the view
		 $data = ['users_data' => $users_data];
	 
		 // Load the views
		 $this->load->view('admin/include/header');
		 $this->load->view('admin/include/nav');
		 $this->load->view('admin/pages/registered_users', $data);
		 $this->load->view('admin/include/footer');
		 }
	 

         
         public function register_child() {
            /* if(!isset($_SESSION['user'])){
                 $this->session->set_flashdata('msg_login','You are not logged in. Please Login First');
                 redirect(base_url('index.php/admin'));
             }*/
        
            $this->form_validation->set_rules('child_fn','First Name','trim|required|min_length[2]|max_length[50]');
            $this->form_validation->set_rules('child_mn','Middle Name','trim|required|min_length[2]|max_length[50]');
            $this->form_validation->set_rules('child_ln','Last Name','trim|required|min_length[2]|max_length[50]');
            $this->form_validation->set_rules('child_sex','Sex','trim|required');
            $this->form_validation->set_rules('child_bday','Birthday','trim|required');
            $this->form_validation->set_rules('child_bplace','Birthplace','trim|required');
            $this->form_validation->set_rules('child_mother','Mother','trim|required|min_length[2]|max_length[50]');
            $this->form_validation->set_rules('child_father','Father','trim|required|min_length[2]|max_length[50]');
            $this->form_validation->set_rules('child_status','User Status','trim|required|min_length[2]|max_length[50]');
        
            $this->form_validation->set_error_delimiters('<p style="color:red;">','<p>');
        
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('admin/include/header');
                $this->load->view('admin/include/nav');
                $this->load->view('admin/pages/register_child');
                $this->load->view('admin/include/footer');
            } else {
                // Get user_id from the form input
                $user_id = $this->input->post('user_id');
        
                $child_data = [ 
                    'user_id' => $user_id,
                    'child_id' => $child_id,
                    'child_fn' => $this->input->post('child_fn',TRUE),
                    'child_mn' => $this->input->post('child_mn',TRUE),
                    'child_ln' => $this->input->post('child_ln',TRUE),
                    'child_sex' => $this->input->post('child_sex',TRUE),
                    'child_bday' => $this->input->post('child_bday',TRUE),
                    'child_bplace' => $this->input->post('child_bplace',TRUE),
                    'child_mother' => $this->input->post('child_mother',TRUE),
                    'child_father' => $this->input->post('child_father',TRUE),
                    'child_status' => $this->input->post('child_status',TRUE),
                ];
        
                // Load the User_Model
                $this->load->model('Admin_model');
                $inserted = $this->Admin_model->register_child($child_data);
        
                if ($inserted) {
                    $this->session->set_flashdata('success', 'Successfully Added!');
                    redirect(base_url('index.php/registered_children'));
                } else {
                    $this->session->set_flashdata('error', 'Added Failed!');
                    redirect('register_child');
                    // Handle the case when insertion fails
                }
            }
        }
        
 public function registered_children() {
     // Load the model
     $this->load->model('Admin_model'); // Replace 'Your_model_name' with the actual name of your model
 
     // Call the model function to get registered users
     $child_data = $this->Admin_model->get_registered_children(); // Replace 'Your_model_name' with the actual name of your model
 
     // Pass the user data to the view
     $data = ['child_data' => $child_data];
 
     // Load the views
     $this->load->view('admin/include/header');
     $this->load->view('admin/include/nav');
     $this->load->view('admin/pages/registered_children', $data);
     $this->load->view('admin/include/footer');
     }
 

public function add_vaccine() {
    /* if(!isset($_SESSION['user'])){
         $this->session->set_flashdata('msg_login','You are not logged in. Please Login First');
         redirect(base_url('index.php/admin'));
     }*/
     $this->form_validation->set_rules('vaccine_name','Vaccine Name','trim|required|min_length[2]|max_length[50]');
     $this->form_validation->set_rules('manufacturer','Manufacturer','trim|required|min_length[2]|max_length[50]');
     $this->form_validation->set_rules('dose_number','Dose Number','trim|required|min_length[2]|max_length[50]');
     $this->form_validation->set_rules('recommended_age','Recommended Age','trim|required');
     $this->form_validation->set_rules('expiration_date','Expiration Date','trim|required');
     $this->form_validation->set_rules('description','Description','trim|required|min_length[2]|max_length[1000] ');
     $this->form_validation->set_error_delimiters('<p style="color:red;">','<p>');

     if($this->form_validation->run()==FALSE){

         $this->load->view('admin/include/header');
         $this->load->view('admin/include/nav');
         $this->load->view('admin/pages/add_vaccine');
         $this->load->view('admin/include/footer');


     }else{

         $vax_data = [ 
    
             'vaccine_name' => $this->input->post('vaccine_name',TRUE),
             'manufacturer' => $this->input->post('manufacturer',TRUE),
             'dose_number' => $this->input->post('dose_number',TRUE),
             'recommended_age' => $this->input->post('recommended_age',TRUE),
             'expiration_date' => $this->input->post('expiration_date',TRUE),
             'description' => $this->input->post('description',TRUE),
             
         ];
         // Load the User_Model
         $this->load->model('Admin_model');
         $inserted = $this->Admin_model->add_vaccine($vax_data);

         if ($inserted) {
             $this->session->set_flashdata('success', 'Successfully Added!');
             redirect(base_url('index.php/vaccine_info'));
         } else {
             $this->session->set_flashdata('error', 'Added Failed!');
             redirect('add_vaccine');
             // Handle the case when insertion fails
         }
    }
}

public function vaccine_info() {
    // Load the model
    $this->load->model('Admin_model'); // Replace 'Your_model_name' with the actual name of your model

    // Call the model function to get registered users
    $vax_data = $this->Admin_model->get_vaccine_info(); // Replace 'Your_model_name' with the actual name of your model

    // Pass the user data to the view
    $data = ['vax_data' => $vax_data];

    // Load the views
    $this->load->view('admin/include/header');
    $this->load->view('admin/include/nav');
    $this->load->view('admin/pages/vaccine_info', $data);
    $this->load->view('admin/include/footer');
    }

    public function add_personnel() {
        /* if(!isset($_SESSION['user'])){
             $this->session->set_flashdata('msg_login','You are not logged in. Please Login First');
             redirect(base_url('index.php/admin'));
         }*/
         $this->form_validation->set_rules('firstname','First Name','trim|required|min_length[2]|max_length[50]');
         $this->form_validation->set_rules('middlename','Middle Name','trim|required|min_length[2]|max_length[50]');
         $this->form_validation->set_rules('lastname','Last Name','trim|required|min_length[2]|max_length[50]');
         $this->form_validation->set_rules('birthday','Birthday','trim|required|min_length[2]|max_length[50]');
         $this->form_validation->set_rules('sex','Sex','trim|required|min_length[2]|max_length[50]');
         $this->form_validation->set_rules('role','Role','trim|required|min_length[2]|max_length[50]');
         $this->form_validation->set_rules('contact_number','Contact Number','trim|required');
         $this->form_validation->set_rules('status','Status','trim|required');
    
         if($this->form_validation->run()==FALSE){
    
             $this->load->view('admin/include/header');
             $this->load->view('admin/include/nav');
             $this->load->view('admin/pages/add_personnel');
             $this->load->view('admin/include/footer');
    
    
         }else{
    
             $personnel_data = [ 
        
                 'firstname' => $this->input->post('firstname',TRUE),
                 'middlename' => $this->input->post('middlename',TRUE),
                 'lastname' => $this->input->post('lastname',TRUE),
                 'birthday' => $this->input->post('birthday',TRUE),
                 'sex' => $this->input->post('sex',TRUE),
                 'role' => $this->input->post('role',TRUE),
                 'contact_number' => $this->input->post('contact_number',TRUE),
                 'status' => $this->input->post('status',TRUE),
                 
             ];
             // Load the User_Model
             $this->load->model('Admin_model');
             $inserted = $this->Admin_model->add_personnel($personnel_data);
    
             if ($inserted) {
                 $this->session->set_flashdata('success', 'Successfully Added!');
                 redirect(base_url('index.php/personnel_info'));
             } else {
                 $this->session->set_flashdata('error', 'Added Failed!');
                 redirect('add_personnel');
                 // Handle the case when insertion fails
             }
        }
        
    }
    public function personnel_info() {
        // Load the model
        $this->load->model('Admin_model'); // Replace 'Your_model_name' with the actual name of your model
    
        // Call the model function to get registered users
        $personnel_data = $this->Admin_model->get_personnel_info(); // Replace 'Your_model_name' with the actual name of your model
    
        // Pass the user data to the view
        $data = ['personnel_data' => $personnel_data];
    
        // Load the views
        $this->load->view('admin/include/header');
        $this->load->view('admin/include/nav');
        $this->load->view('admin/pages/personnel_info', $data);
        $this->load->view('admin/include/footer');
        }

        public function add_medicine() {
            /* if(!isset($_SESSION['user'])){
                 $this->session->set_flashdata('msg_login','You are not logged in. Please Login First');
                 redirect(base_url('index.php/admin'));
             }*/
             $this->form_validation->set_rules('medication_name','Medication Name','trim|required|min_length[2]|max_length[50]');
             $this->form_validation->set_rules('med_description','Description','trim|required|min_length[2]|max_length[10000]');
             $this->form_validation->set_rules('med_date','Date','trim|required|min_length[2]|max_length[50]');
             $this->form_validation->set_rules('quantity','Quantity','trim|required|min_length[2]|max_length[50]');
             $this->form_validation->set_rules('user_id','User','trim|required|min_length[2]|max_length[50]');
             $this->form_validation->set_rules('child_id','Child','trim|required|min_length[2]|max_length[50]');
             $this->form_validation->set_rules('personnel_id','Personnel','trim|required');
             $this->form_validation->set_rules('status','Status','trim|required');
             $this->form_validation->set_rules('remarks','Remarks','trim|required|min_length[2]|max_length[50]');
        
             if($this->form_validation->run()==FALSE){
        
                 $this->load->view('admin/include/header');
                 $this->load->view('admin/include/nav');
                 $this->load->view('admin/pages/add_medicine');
                 $this->load->view('admin/include/footer');
        
        
             }else{
        
                 $medicine_data = [ 
            
                     'medication_name' => $this->input->post('medication_name',TRUE),
                     'med_description' => $this->input->post('med_description',TRUE),
                     'med_date' => $this->input->post('med_date',TRUE),
                     'quantity' => $this->input->post('quantity',TRUE),
                     'user_id' => $this->input->post('user_id',TRUE),
                     'child_id' => $this->input->post('child_id',TRUE),
                     'personnel_id' => $this->input->post('personnel_id',TRUE),
                     'status' => $this->input->post('status',TRUE),
                     'remarks' => $this->input->post('remarks',TRUE),
                     
                 ];
                 // Load the User_Model
                 $this->load->model('Admin_model');
                 $inserted = $this->Admin_model->add_medicine($medicine_data);
        
                 if ($inserted) {
                     $this->session->set_flashdata('success', 'Successfully Added!');
                     redirect(base_url('index.php/medicine_info'));
                 } else {
                     $this->session->set_flashdata('error', 'Added Failed!');
                     redirect('add_medicine');
                     // Handle the case when insertion fails
                 }
            }
            
        }
        public function medicine_info() {
            // Load the model
            $this->load->model('Admin_model'); // Replace 'Your_model_name' with the actual name of your model
        
            // Call the model function to get registered users
            $medicine_data = $this->Admin_model->get_medicine_info(); // Replace 'Your_model_name' with the actual name of your model
        
            // Pass the user data to the view
            $data = ['medicine_data' => $medicine_data];
        
            // Load the views
            $this->load->view('admin/include/header');
            $this->load->view('admin/include/nav');
            $this->load->view('admin/pages/medicine_info', $data);
            $this->load->view('admin/include/footer');
            }

            

			public function delete_child($id){
				$this->db->where('child_id', $id);
				$this->db->delete('child');
			
				redirect(base_url('index.php/registered_children'));
			}
			




			public function delete_personnel($id){
				$this->db->where('personnel_id', $id);
				$this->db->delete('personnel');
			
				redirect(base_url('index.php/personnel_info'));
			}
			




			public function delete_vaccine($id){
				$this->db->where('vaccine_id', $id);
				$this->db->delete('vaccine_info');
			
				redirect(base_url('index.php/vaccine_info'));
			}




            public function settings(){

                $this->load->view('admin/include/header');
                $this->load->view('admin/include/nav');
                $this->load->view('admin/pages/settings');
                $this->load->view('admin/include/footer');

            }



            
            
}