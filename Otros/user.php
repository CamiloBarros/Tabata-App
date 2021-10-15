<?php

 require_once "conexion.php";
 session_start();

 function login($correo,$pass){
	  $con = new Conexion();

	  $table = $con->ejecutarConsulta("SELECT * FROM tabata.usuario;");
	  $flag = true;

	  foreach ($table as $key => $value) {
	  		if($value["correo"] == $correo && $value["password"] == $pass){
	  			header('Location: ../index.php');
	  			$flag = false;
	  			//$table = $con->ejecutarConsulta("UPDATE tabata.usuario SET token = '3333' WHERE id = ".$value['id'].";");
	  			$_SESSION['id'] = $value['id'];

	  		}
	  }
	  if($flag) {
	  	header('Location: ../login.php');
	  }
	  $con -> cerrarConexion();
 }

 function isLoged(){
 	$con = new Conexion();

 	$id = $_SESSION['id'];
 	if($id==null) {
 		header('Location: login.php');
 	}
	$con -> cerrarConexion();

	// $table = $con->ejecutarConsulta("SELECT * FROM tabata.usuario WHERE id = ".$id.";");

	// foreach ($table as $key => $value) {
	// 	if($value["token"] == null){
	// 		header('Location: ../index.html');
	// 	}
	// }
	// $con -> cerrarConexion();
 }
 
 if(isset($_POST["correo"]) && isset($_POST["pass"])){
 	login($_POST["correo"], $_POST["pass"]);
 }
 
?>