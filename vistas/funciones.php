<?php
function Login($usuario, $clave){
try{
//importar las credenciales
require '../../config/database.php';
//consulta SQL
$sql = "select Username,nombre,edad,email,telefono 
from usuarios where Username = '".$usuario."' and clave = '".$clave."'  and estado = 1;";
//Realizar la consulta
//echo 'SQL: '.$sql;
$consulta = mysqli_query($db, $sql);
//acceder a los resultados
/*echo "
<pre>";
          var_dump(mysqli_fetch_assoc($consulta));
        echo "</pre>
";*/
//Cerrar la conexion (opcional)
$resp = mysqli_fetch_assoc($consulta);
return $resp;
$resultado = mysqli_close($db);
//echo $resultado;
}catch(\Throwable $th){
var_dump($th);
}
}
function estaAutenticado() :bool {
session_start();
$auth = $_SESSION['login'];
if($auth){
return  true;
}
return false;
}
function CrearUsuario($nombre, $apellido, $edad, $Telefono, $username, $email, $clave){
try{
//importar las credenciales
require '../config/database.php';
//consulta SQL
$sql = "select count(1) as Existe
from usuarios where Username = '".$username."'  and estado = 1;";
$consulta = mysqli_query($db, $sql);
$resp = mysqli_fetch_assoc($consulta);
if($resp['Existe'] == 0){
$sql1 = "insert into  usuarios (Username, nombre, edad, email, clave, telefono, create_time, estado)
values('$username', CONCAT('$nombre',' ','$apellido'), $edad, '$email', '$clave', '$Telefono', NOW(), 1);";
//echo 'count:'.$sql1;
$stmt = mysqli_query($db, $sql1);
$count = mysqli_affected_rows($db);
//var_dump($count);
//if($stmt->row )
//echo 'count:'.$count;
if($count == 1){
$respuesta = 'success';
}else{
$respuesta = 'No se pudo crear el registro';
}
}else{
$respuesta = 'El Username ya existe';
}
return $respuesta;
$resultado = mysqli_close($db);
//echo $resultado;
}catch(\Throwable $th){
var_dump($th);
}
}
function IniciarSesion($username, $password) {
// Database connection
$conn = new mysqli("localhost", "root", "admin", "proyectofinal");
if ($conn->connect_error) {
return "Database connection failed.";
}
// Query user from database
$stmt = $conn->prepare("SELECT clave FROM usuarios WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
$stmt->bind_result($hashedPassword);
$stmt->fetch();
if (($password === $hashedPassword)) {
return "success";
} else {
return "Incorrect password.";
}
} else {
return "User not found.";
}
}
function ConectarBD() {
$host = "localhost";
$dbname = "proyectofinal";
$username = "root";
$password = "admin";
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
return $conn;
}