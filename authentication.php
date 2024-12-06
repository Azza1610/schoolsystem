<?php

// 
// echo "{'Username': $username,'Password': $pwd}";
// die();
ini_set("display_errors", 1);

session_start();

include("test_connection.php");


// retrive json data from the request 
// $raw_data = file_get_contents("php://input");


$data = json_decode(file_get_contents("php://input"), true);

if (!empty($data['userName']) && !empty($data['passWord'])) {
    $username = $data['userName'];
    $password = $data['passWord'];

    $query = " SELECT * FROM login WHERE user='$username'";

    $result = mysqli_query($con, $query);

    // print_r($result);

    // $rs = mysqli_fetch_assoc($result);

    // print_r($rs);

    if (mysqli_num_rows($result)== 1) {
        $user = mysqli_fetch_assoc($result);
        
        if (password_verify($password,$user['pass'])) {
            //login successful, set session 
            $_SESSION['username'] = $username;
            echo json_encode(['success' => true, 'message' => 'Login successful!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'invaild username or password']);

        }
    
    } else {
        echo json_encode(['success' => false, 'message' => 'invaild username or password']);
    }


} else {
    echo json_encode(['success' => false, 'message' => 'please provide username or password']);
}

?>