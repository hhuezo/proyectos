
<?php

$timezone='America/El_Salvador';
date_default_timezone_set($timezone);

$proyecto_id= $_GET["proyecto_id"];

class Conexion{
	//Variables Publicas
	public $errorBD;

	//Variables Privadas
	private $objMySQL;

	function __construct(){
		//$this->_servidor = '192.162.3.19';
		$this->_servidor = 'localhost';
		//$this->_usuario = 'root';
		$this->_usuario = 'proyectos_ow';
		//$this->_clave = 'Viatico$-2013';
		$this->_clave = 'proyectos2021';
		//$this->_clave = '';
		$this->_basedatos = 'seguimiento_proyectos';
	}

	//Funci�n que nos indica si la conexi�n a la BD ha sido correcta.
	public function Abrir(){
		$objMySQL = new mysqli($this->_servidor, $this->_usuario,
                               $this->_clave, $this->_basedatos);
		if (mysqli_connect_errno()){
			$this->errorBD="<b>AccesoBD->Abrir: </b>".mysqli_connect_error();
			echo $this->errorBD;
		}
	}

	//Funci�n que nos devuelve True si existe un registro.
	public function ExisteRegistro($sql){
		$contador=0;
		$objMySQL = new mysqli($this->_servidor, $this->_usuario,
                               $this->_clave, $this->_basedatos);
		if ($sentenciaSQL = $objMySQL->query($sql)){
			while ($fila = $sentenciaSQL->fetch_assoc()) {
				$contador=1;
			}
			if ($contador == 1){
				return true;
			}else{
				return false;
			}
		}
	}

	//Devuelve Registros a partir de una sentencia sql
	public function RetornarRS(&$rs, $sql){
  		$objMySQL = new mysqli($this->_servidor, $this->_usuario,
                               $this->_clave, $this->_basedatos);
		if (!$sentenciaSQL = $objMySQL->query($sql)){
			$this->errorBD = "<b>AccesoBD->RetornarRS: </b>".$objMySQL->error;
			echo $this->errorBD;
		}
		$rs = $sentenciaSQL;
	}

	//Devuelve Registros a partir de una sentencia sql
	public function RetornarNumeroRegistrosRS(&$num_reg, $sql){
  		$objMySQL = new mysqli($this->_servidor, $this->_usuario,
                               $this->_clave, $this->_basedatos);
		if (!$sentenciaSQL = $objMySQL->query($sql)){
			$this->errorBD = "<b>AccesoBD->RetornarRS: </b>".$objMySQL->error;
			echo $this->errorBD;
		}
		$rs = $sentenciaSQL;
		$num_reg = $rs->num_rows;
	}

	//Ejecuta una sentencia sql
	public function Ejecutar($sql){
  		$objMySQL = new mysqli($this->_servidor, $this->_usuario,
                               $this->_clave, $this->_basedatos);
		if (!$sentenciaSQL = $objMySQL->query($sql)){
			$this->errorBD = "<b>AccesoBD->Ejecutar: </b>".$objMySQL->error;
			echo $this->errorBD;
		}
	}

    //Cierra conexion a BD
	public function Cerrar(){
  		$objMySQL = new mysqli($this->_servidor, $this->_usuario,
                               $this->_clave, $this->_basedatos);
		if(!$objMySQL->close()){
			$this->errorBD = "<b>AccesoBD->Cerrar: </b>".$objMySQL->error;
			echo $this->errorBD;
		}
	}
}



	  $objCon_sel = new Conexion();


	  $objCon_sel->Abrir();
	  $sql="delete FROM actividades where proyecto_id=1 and id in(
        2100,
        2051,
        2052,
        2055,
        2058,
        2061,
        2064,
        2067,
        2091,
        2073,
        2076,
        2079,
        2082,
        2085,
        2031,
        2034,
        2037,
        2040,
        2007,
        2010,
        2013,
        2019,
        2022,
        2106,
        2109,
        2112)";
	  echo $sql;
	  echo "<br>";	
	  $objCon_sel->Ejecutar($sql);



	  $sql="delete FROM movimiento_actividades where actividad_id in(
        2100,
        2051,
        2052,
        2055,
        2058,
        2061,
        2064,
        2067,
        2091,
        2073,
        2076,
        2079,
        2082,
        2085,
        2031,
        2034,
        2037,
        2040,
        2007,
        2010,
        2013,
        2019,
        2022,
        2106,
        2109,
        2112)";
	  echo $sql;
	  echo "<br>";	
	  $objCon_sel->Ejecutar($sql);





      $objCon_sel->Cerrar();




  ?>
