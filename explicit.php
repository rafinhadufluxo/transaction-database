<?php

    // Parâmetros de conexão com o postgres com super usuario
    $host = "localhost";
    $database = "vintage";
    $user = "rafinha";
    $password = "senha";

    // Iniciando conexão com o banco de dados
    $connection = pg_connect("host=$host dbname=$database user=$user password=$password") 
        or die("Falha ao conectar com o banco de dados ". pg_last_error(). "<br/>");

    // Starting clock time in seconds 
    $startTime = 0;
    $endTime = 0;


	$error = 0;

    if (($handle = fopen("data.csv", "r")) !== FALSE) {
		$startTime = microtime(true);

		pg_query($connection, "BEGIN");

        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            #title,score,id,url,comms_num,created,body,timestamp
            //echo "data $data[0]";
            //$num = count($data);
            $insert["title"] = mb_convert_encoding($data[0], "UTF-8");
            $insert["score"] =  intval(mb_convert_encoding($data[1], "UTF-8"));
            $insert["id"] = intval(mb_convert_encoding($data[2], "UTF-8"));
            $insert["url"] = mb_convert_encoding($data[3], "UTF-8");
            $insert["comms_num"] = mb_convert_encoding($data[4], "UTF-8");

            $insert["created"] = mb_convert_encoding($data[5], "UTF-8");
            $insert["body"] = mb_convert_encoding($data[6], "UTF-8");
            $insert["timestamp"] = mb_convert_encoding($data[7], "UTF-8");
            //echo $insert["title"];
            
            $success = pg_insert($connection, "teste2", $insert);

			if (!$success) $error++;

            
        }

		if ($error > 0) 
			pg_query($connection, "ROLLBACK");
		else
			pg_query($connection, "COMMIT");

        // End clock time in seconds 
        $endTime = microtime(true);

        fclose($handle);
    }

    // Calculate script execution time 
    $executionTime = ($endTime - $startTime); 

    echo "</br></br> Explicit Insert: Execution time of script = " . strval($executionTime) . " sec </br></br>";
       