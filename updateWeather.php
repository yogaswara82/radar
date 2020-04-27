<?php
try {
    
            // Try Connect to the DB with new MySqli object - Params {hostname, userid, password, dbname}
    
    $x = file_get_contents("php://input");

     // ...and decode it into a PHP array.
    $json = json_decode($x);
    
    
 
    $link = mysqli_connect("localhost", "root", "", "sisnav");

    $check = "SELECT * FROM `loc` WHERE 1";
    $result = mysqli_query($link, $check);
    $row = mysqli_fetch_assoc($result);
    
    

        foreach ($json->data->cuaca as $data) {

            if ($data->id==$row['id']) {

                $sql = "UPDATE cuaca SET klorofil = ' $data->klorofil ',temp = '$data->temp',windspeed='$data->windspeed',winddir='$data->winddir',humidity='$data->humidity',wave='$data->wave',sigWave='$data->sigWave',`waveperiod`='$data->waveperiod',watertemp='$data->watertemp',description='$data->description' WHERE id = '$data->id'";

                if(mysqli_query($link, $sql)){
                    echo "Records were updated successfully.";
                } else {
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                }
                break;
               
            }

        }

       

        foreach ($json->data->target_cuaca as $key) {

            if ($key->id==$row['id']) {

                $sql = "UPDATE target_cuaca SET klorofil = ' $key->klorofil ',temp = '$key->temp',windspeed='$key->windspeed',winddir='$key->winddir',humidity='$key->humidity',wave='$key->wave',sigWave='$key->sigWave',`waveperiod`='$key->waveperiod',watertemp='$key->watertemp',description='$key->description' WHERE id = '$key->id'";

                if(mysqli_query($link, $sql)){
                    echo "Records were updated successfully.";
                } else {
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                }

              
            }

        }
    
    



    } catch (mysqli_sql_exception $e) { // Failed to connect? Lets see the exception details..
            //echo "MySQLi Error Code: " . $e->getCode() . "<br />";
            //echo "Exception Msg: " . $e->getMessage();
        $json = array('error' => true
            , 'message' => $e->getMessage()
            ,'data' => null  );
            echo json_encode(($json)); // Parse to JSON and print.

            exit(); // exit and close connection.
        }
