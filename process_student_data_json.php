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



if (!empty($data['sr_no']) && !empty($data['name'])) {
    $sr_no = $data['sr_no'];
    $name = $data['name'];
    $class = $data['class'];
    $grade = $data['grade'];

    $query = "INSERT INTO students VALUES (null, $sr_no, '$name' , '$class', '$grade');";

    $result = mysqli_query($con, $query);

    echo json_encode(['success' => true, 'message' => "Student added successfully"]);
    die();

} else {
    echo json_encode(['success' => false, 'message' => 'please fill out all the fields']);
}

?>