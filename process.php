<?php
require_once('config.php');

if(isset($_POST['register'])){

    $firstName      = $_POST['firstName'];
    $lastName       = $_POST['lastName'];        
    $userEmail      = $_POST['userEmail'];
    $password       = md5($_POST['password']);
    $return         = array();

    $query = "SELECT * FROM tb_users WHERE userEmail = '$userEmail'";
    $result = mysqli_query( $conn, $query);
    if( mysqli_num_rows($result) > 0 )
	{
        $return['type'] = 1;
        $return['msg']  = "There are already same user. \r\n Please register with another email address.";
        echo json_encode($return);
    }
    else{
        $sql = "INSERT INTO tb_users (firstName, lastName, userEmail, password ) VALUES('$firstName', '$lastName', '$userEmail', '$password')";
        
        if (mysqli_query($conn, $sql)) {
            $return['type'] = 2;
            $return['msg']  = 'Successfully saved.';
            echo json_encode($return);
        } else {
            $return['type'] = 3;
            $return['msg']  = "Error creating user: " . mysqli_error($conn);
            echo json_encode($return);            
        }    
    }
    
    mysqli_close($conn);        
}

if(isset($_POST['signin'])){

    $userEmail      = $_POST['userEmail'];
    $password       = md5($_POST['password']);

    $query = "SELECT * FROM tb_users WHERE userEmail = '$userEmail' and password = '$password'";
    
        
    $result = mysqli_query( $conn, $query);

    if (!$result) 
	{
        die("No results found");
        //die($query);
    }

    $member = mysqli_fetch_assoc($result);
    
    //echo $member['password'];
	if( mysqli_num_rows($result) > 0 )
	{
        session_start();
        $_SESSION['user_id']    = $member['id'];
        $_SESSION['user_email'] = $member['userEmail'];
        $_SESSION['user_name']  = $member['firstName']. " " . $member['lastName'];
        $_SESSION['loggedin']   = true;
        echo 'valid';
    }
    else 
	{
        echo 'invalid';
    }
}

if(isset($_POST['shared']) && $_POST['shared'] == true){
    session_start();
    $youtubeLink    = $_POST['youtubeLink'];
    $userId         = $_SESSION['user_id'];

    $query = "SELECT * FROM tb_movies WHERE userid = '$userId' and move_link = '$youtubeLink';";
    $result = mysqli_query( $conn, $query);
    if( mysqli_num_rows($result) > 0 )
	{
        $return['type'] = 1;
        $return['msg']  = "There is already same movie. Please share another movie.";
        echo json_encode($return);
    }
    else{
        $sql = "INSERT INTO tb_movies ( userid, move_link ) VALUES('$userId', '$youtubeLink')";
        
        if (mysqli_query($conn, $sql)) {
            $return['type'] = 2;
            $return['msg']  = 'Successfully saved.';
            echo json_encode($return);
        } else {
            $return['type'] = 3;
            $return['msg']  = "Error creating user: " . mysqli_error($conn);
            echo json_encode($return);            
        }    
    }
    
    mysqli_close($conn);        
    
}


function getAllMovies($link){
    $query = "SELECT tb_users.id as userid, tb_users.userEmail, tb_movies.id as movieid, tb_movies.move_link FROM `tb_movies` inner join `tb_users` WHERE tb_users.id = tb_movies.userid;";
    $result = mysqli_query( $link, $query);
    // if( mysqli_num_rows($result) > 0 )
	// {
        
    //     return $result;
    // }else{
    //     return false;
    // }

    $table = array();

    if (mysqli_num_rows($result) > 0)
	{
		while($row = ($row = mysqli_fetch_assoc($result)))
			$table[] = $row;
		return $table;
		
    } 
	else 
	{
        return false;
	}
}
?>