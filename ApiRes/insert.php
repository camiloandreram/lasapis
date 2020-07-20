<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access ");
header("Access-Control-Allow-Methods:  POST");
header('Content-Type: application/Json; charset=utf-8');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers,Authorization, X-Requested-With");

require 'config.php';
$db_connection = new Database();
$conn = $db_connection->dbConnection();


$data =json_decode(file_get_contents("php://input"));
$msg['message']='';

if(isset($data->identificacion) && isset($data->nombre) && isset($data->curso) && isset($data->nota1) && isset($data->nota2) && isset($data->nota3)){

    if(!empty($data->identificacion) && !empty($data->nombre) && !empty($data->curso) && !empty($data->nota1) && !empty($data->nota2) && !empty($data->nota3)){

        $insert_query = "INSERT INTO `estudiante`(identificacion,nombre,curso,nota1,nota2,nota3)VALUES(:identificacion,:nombre,:curso,:nota1,:nota2,:nota3)";
        $insert_stmt= $conn->prepare($insert_query);

        $insert_stmt->bindValue(':identificacion', htmlspecialchars(strip_tags($data->identificacion)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':nombre',htmlspecialchars(strip_tags($data->nombre)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':curso', htmlspecialchars(strip_tags($data->curso)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':nota1', htmlspecialchars(strip_tags($data->nota1)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':nota2', htmlspecialchars(strip_tags($data->nota2)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':nota3', htmlspecialchars(strip_tags($data->nota3)),PDO::PARAM_STR);

        if($insert_stmt->execute()){
            $msg['message']='Data Insertados Correctamente';
        }else{
            $msg['message']='Datos no insertados';
        }
    }else {
            $msg['message']='Lo sentimos te falta un campo por cumplir, porfavor llenar todos los campos.';
    }
}
else{
            $msg['message']='Lo sentimos te falta campos por cumplir, porfavor llenar todos los campos.';
}
echo Json_encode($msg);
?>