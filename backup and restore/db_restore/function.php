<?php

function restore($server, $username, $password, $dbname, $location){
    //connection
    try{$conn = new mysqli($server, $username, $password, $dbname);}

    catch (Exception $e) {
        $output = array('error' => true, 'message' => 'No se pudo establecer la conexión a la base de datos');
        return $output;
    }

    $conn->query('SET foreign_key_checks = 0'); 

    if ($result = $conn->query("SHOW TABLES"))
{
    while($row = $result->fetch_array(MYSQLI_NUM))
    {
        $conn->query('DROP TABLE IF EXISTS '.$row[0]);
    }

}
    //variable use to store queries from our sql file
    $sql = '';
    
    //get our sql file
    $lines = file($location);

    //return message
    $output = array('error'=>false);
    
    //loop each line of our sql file
    foreach ($lines as $line){

        //skip comments
        if(substr($line, 0, 2) == '--' || $line == ''){
            continue;
        }

        //add each line to our query
        $sql .= $line;

        //check if its the end of the line due to semicolon
        if (substr(trim($line), -1, 1) == ';'){
            //perform our query
            $query = $conn->query($sql);
            if(!$query){
            	$output['error'] = true;
                $output['message'] = $conn->error;
            }
            else{
            	$output['message'] = 'Base de Datos restaurada exitosamente';
            }

            //reset our query variable
            $sql = '';
            
        }
    }

    return $output;
}

?>