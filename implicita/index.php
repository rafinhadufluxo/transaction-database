<?php

try{

    $conn        = new PDO('pgsql:host=localhost;dbname=vintage', 'rafinha', 'senha');
    $file_csv    = fopen("reddit.csv", "r"); 
    $num_invalid = 0;
    $num_success = 0;
    $num         = 0;
    
    $time_start = microtime(true);
    sleep(1);

    if ($file_csv !== false){

        $stmt = $conn->prepare("INSERT INTO usuarios (id,nome,curso,classificacao,modalidade) VALUES (?, ?, ?,?,?)");

        while(!feof($file_csv)){
            
            $data = fgetcsv($file_csv);

            if (is_array($data) and count($data) == 5){   
                $user = array_map(function($value){
                    return trim($value);
                }, $data);

                $stmt->execute([...$user]);
                $num_success++;
            }
            else {
                $num_invalid++;
            }

            $num++;
        }

        fclose($file_csv);
    }

    $time_end = microtime(true);
    $time = $time_end - $time_start;    
    echo ("Process Time:  {$time} <br>");
    

    echo implode(PHP_EOL, [
        "\n Número de linhas processadas:  " . $num, 
        "<br> Número de linhas invalidos:    " . $num_invalid,
        "<br> Número de usuários cadastrados: " . $num_success
    ]);
    
    die();

}catch (Exception $e){
    echo 'Ocorreu uma falha: ' .$e->getMessage();
}