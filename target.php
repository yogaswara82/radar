<?php
try {

    $data = json_decode($_POST['json']);
    if(empty($data)){
        $x = file_get_contents("php://input");

     // ...and decode it into a PHP array.
        $data = json_decode($x);
    }
    $id =$data ->id;
    $lat =$data->lat;
    $lon =$data->lon;
    





// ubah string JSON menjadi array

    $link = mysqli_connect("localhost", "root", "", "sisnav");
    $sql = "UPDATE target SET lat = '$lat',lon = '$lon' WHERE id = '$id'";
    if(mysqli_query($link, $sql)){
        echo "Target updated.";
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
    

}
    catch (mysqli_sql_exception $e) { // Failed to connect? Lets see the exception details..
            //echo "MySQLi Error Code: " . $e->getCode() . "<br />";
            //echo "Exception Msg: " . $e->getMessage();
        $json = array('error' => true
            , 'message' => $e->getMessage()
            ,'data' => null  );
            echo json_encode(($json)); // Parse to JSON and print.

            exit(); // exit and close connection.
        }
