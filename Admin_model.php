<?php
class Admin_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }


   
    public function authenticate_admin($email , $password){
        $query = $this->db->query("SELECT *  FROM `admin` where email='$email' AND password = '$password' ");

        if ($query->num_rows() > 0) {
            return $query->result();
        }
            return 0;

    }



    public function getAdminDataById($adminId) {
        // Query the database to fetch user's information based on user_id
        $query = $this->db->get_where('admin', array('admin_id' => $adminId));
        
        // Check if the query returned a row
        if ($query->num_rows() == 1) {
            // Return the user's data
            return $query->row();
        } else {
            // Return false if user not found
            return false;
        }
    }




    public function getAdminDataByEmail($email) {
        // Query to retrieve admin data by email
        $query = $this->db->get_where('admin', array('email' => $email));
        return $query->row(); // Return admin data if found, otherwise return false
    }


    public function insertdata($data)
{
    $this->db->insert('admin', $data);
    if ($this->db->affected_rows() > 0) {
        return true;
    } else {
        // Log database errors
        log_message('error', 'Database Error: ' . $this->db->error()['message']);
        return false;
    }
}





    public function register_user($data) {
        // Insert user data into the database
        $this->db->insert('user', $data);
        
        // Check if insertion was successful
        return $this->db->affected_rows() > 0;
    }





    public function get_registered_users() {
        // Fetch registered users from the database
        $query = $this->db->get('user');
        $result_array = $query->result_array();
        // Add this line for debugging
        return $result_array;
    }




    public function insert_data($data)
     {
            $this->db->insert('user', $data);
            $afftectedRows = $this->db->affected_rows();
            if ($afftectedRows > 0) {
                 return TRUE;
             } else {
                     return FALSE;
            }
    }
   


    
    public function get_child_by_id($child_id) {
        // Assuming you have a method to retrieve child data by ID in your model
        return $this->db->get_where('child', ['child_id' => $child_id])->row_array();
    }



    
    public function register_child($data) {
        // Insert user data into the database
        $this->db->insert('child', $data);
        
        // Check if insertion was successful
        return $this->db->affected_rows() > 0;
    }




    public function get_children_by_user_id($user_id) {
        // Query to fetch children data by user_id
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('child');

        // Check if any children data is found
        if ($query->num_rows() > 0) {
            // Return children data as an array of rows
            return $query->result_array();
        } else {
            // Return empty array if no children found
            return array();
        }
    }




    
    public function get_registered_children() {
        // Fetch registered users from the database
        $query = $this->db->get('child');
        $result_array = $query->result_array();
        // Add this line for debugging
        return $result_array;
    }




    public function get_user_data($user_id) {
        // Assuming you have a table named 'users' in your database
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('user');

        if ($query->num_rows() > 0) {
            return $query->row_array(); // Return the user data as an associative array
        } else {
            return false; // Return false if user is not found
        }
    }



    
    public function get_personnel_data() {
        // Query your database to retrieve personnel data
        $query = $this->db->get('personnel'); // Replace 'personnel' with your actual table name
        
        // Check if query was successful
        if ($query->num_rows() > 0) {
            // Return personnel data as an array
            return $query->result_array();
        } else {
            // If no data found, return an empty array or handle the error as needed
            return array();
        }
    }




    public function add_vaccine($data) {
        // Insert user data into the database
        $this->db->insert('vaccine_info', $data);
        
        // Check if insertion was successful
        return $this->db->affected_rows() > 0;
    }





    public function get_vaccine_info() {
        // Fetch registered users from the database
        $query = $this->db->get('vaccine_info');
        $result_array = $query->result_array();
        // Add this line for debugging
        return $result_array;
    }




    public function add_personnel($data) {
        // Insert user data into the database
        $this->db->insert('personnel', $data);
        
        // Check if insertion was successful
        return $this->db->affected_rows() > 0;
    }




    public function get_personnel_info() {
        // Fetch registered users from the database
        $query = $this->db->get('personnel');
        $result_array = $query->result_array();
        // Add this line for debugging
        return $result_array;
    }




    public function add_medicine($data) {
        // Insert user data into the database
        $this->db->insert('medication', $data);
        
        // Check if insertion was successful
        return $this->db->affected_rows() > 0;
    }




    public function get_medicine_info() {
        // Fetch registered users from the database
        $query = $this->db->get('medication');
        $result_array = $query->result_array();
        // Add this line for debugging
        return $result_array;
    }
    



    public function get_all_users(){
        $query = $this->db->get('user');
        return $query->result();
    }




    public function get_all_child() {
        $query = $this->db->get('child');
        if ($query) {
            return $query->result();
        } else {
            // Log or display the database error
            $error = $this->db->error();
            log_message('error', 'Database Error: ' . $error['message']);
            return false;
        }
    }




    public function get_all_vaccine(){
        $query = $this->db->get('vaccine_info');
        return $query->result();
    }



    public function get_all_personnel(){
        $query = $this->db->get('personnel');
        return $query->result();
    }




    public function edit_user($user_id)
    {
        $query = $this->db->get_where('user', array('user_id' => 1));
        return $query->row_array();
    }

    public function edit_child($child_id)
    {
        $query = $this->db->get_where('child', array('child_id' => 1));
        return $query->row_array();
    }




    public function add_immunization($data) {
        // Insert data into database
        return $this->db->insert('immunization', $data);
    }




    public function get_immunizations_by_child_id($child_id) {
        // Query to fetch immunization records based on the child's ID
        $this->db->where('child', $child_id);
        $query = $this->db->get('immunization');
        
        // Check if any records were found
        if ($query->num_rows() > 0) {
            // Return the immunization records
            return $query->result_array();
        } else {
            // Return an empty array if no records were found
            return array();
        }
    }

    
    public function get_immunization() {
        // Select immunization records along with the child's data, vaccine name, and personnel information
        $this->db->select('immunization.*, child.child_fn, child.child_mn, child.child_ln, vaccine_info.vaccine_name, personnel.firstname, personnel.middlename, personnel.lastname');
        $this->db->join('child', 'child.child_id = immunization.child_id');
        $this->db->join('vaccine_info', 'vaccine_info.vaccine_id = immunization.vaccine_id');
        $this->db->join('personnel', 'personnel.personnel_id = immunization.personnel_id');
        $query = $this->db->get('immunization');
        
        // Check if any records were found
        if ($query->num_rows() > 0) {
            // Return the immunization records
            return $query->result_array();
        } else {
            // Return an empty array if no records were found
            return array();
        }
    }
    
    


    public function get_vaccines() {
        $this->db->select('vaccine_id, vaccine_name');
        $query = $this->db->get('vaccine_info');
        return $query->result_array();
    }
    



    public function get_personnel() {
        $this->db->select('personnel_id, firstname, middlename, lastname');
        $query = $this->db->get('personnel');
        return $query->result_array();
    }
    
/* USER CRUD */
    public function update_user($user_id, $data) {
        $this->db->where('user_id', $user_id);
        $this->db->update('user', $data);
        return $this->db->affected_rows() > 0;
    }
    

    public function get_child_details($child_id)
    {
        // Fetch child details from the database
        $query = $this->db->get_where('child', array('child_id' => $child_id));
        
        // Return the result as an array
        return $query->row_array();
    }
    


}







    
    