<?php
class User {
    public function getUsersListing(){		
		
        $whereQuery = '';
        if($_SESSION['user_type'] == 2) {
            $whereQuery = "WHERE id ='".$_SESSION['userid']."'";
        }		
        
        $sqlQuery = "
            SELECT id, first_name, last_name, email, type, deleted
            FROM ".$this->userTable."  
            $whereQuery ";
        
        if(!empty($_POST["search"]["value"])){
            $sqlQuery .= ' first_name LIKE "%'.$_POST["search"]["value"].'%" ';
            $sqlQuery .= ' OR last_name LIKE "%'.$_POST["search"]["value"].'%" ';
            $sqlQuery .= ' OR email LIKE "%'.$_POST["search"]["value"].'%" ';
            $sqlQuery .= ' OR type LIKE "%'.$_POST["search"]["value"].'%" ';			
        }
        if(!empty($_POST["order"])){
            $sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' 
    '.$_POST['order']['0']['dir'].' ';
        } else {
            $sqlQuery .= 'ORDER BY id DESC ';
        }
        if($_POST["length"] != -1){
            $sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
    
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        $result = $stmt->get_result();	
        
        $stmtTotal = $this->conn->prepare("SELECT * FROM ".$this->userTable);
        $stmtTotal->execute();
        $allResult = $stmtTotal->get_result();
        $allRecords = $allResult->num_rows;
        
        
        $displayRecords = $result->num_rows;
        $users = array();		
        while ($user = $result->fetch_assoc()) { 				
            $rows = array();	
            $status = '';
            if($user['deleted'])	{
                $status = '<span class="label 
    label-danger">Inactive</span>';
            } else {
                $status = '<span class="label 
    label-success">Active</span>';
            }
            
            $type = '';
            if($user['type'] == 1){
                $type = '<span class="label label-danger">Admin</span>';
            } else if($user['type'] == 2){
                $type = '<span class="label label-warning">Author</span>';
            }
            
            $rows[] = ucfirst($user['first_name'])." ".$user['last_name'];
            $rows[] = $user['email'];
            $rows[] = $type;			
            $rows[] = $status;				
            $rows[] = '<a href="add_users.php?id='.$user["id"].'" 
    class="btn btn-warning btn-xs 
    update">Edit</a>';
            $rows[] = '<button type="button" name="delete" 
    id="'.$user["id"].'"
     class="btn btn-danger btn-xs delete"
     >Delete</button>';
            $users[] = $rows;
        }
        
        $output = array(
            "draw"	=>	intval($_POST["draw"]),			
            "iTotalRecords"	=> 	$displayRecords,
            "iTotalDisplayRecords"	=>  $allRecords,
            "data"	=> 	$users
        );
        
        echo json_encode($output);	
    }
}