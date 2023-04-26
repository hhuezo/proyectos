
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
		$this->_usuario = 'root';
		//$this->_usuario = 'proyectos_ow';
		//$this->_clave = 'Viatico$-2013';
		//$this->_clave = 'proyectos2021';
		$this->_clave = '';
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




$now = date('Y-m-d H:i:s', time());  



//$con=new mysqli('localhost','proyectos_ow','proyectos2021','seguimiento_proyectos');
$con=new mysqli('localhost','root','','seguimiento_proyectos');
$con->set_charset('utf-8');

$sel=$con->prepare("SELECT
id, tiempo_desarrollo
FROM actividades WHERE proyecto_id IN( '9','28') and estado_id = 4
and month(fecha_liberacion)='10'
and month(fecha_liberacion) is not null
order by month(fecha_liberacion)");
$sel->execute();
$res=$sel->get_result();


 while ($row = $res->fetch_assoc()) {
	  
	//   $objCon_sel = new Conexion();
	//   $objCon_sel->Abrir();
	  $sql="update actividades set tiempo_desarrollo='".$row['tiempo_desarrollo']."' where id='".$row['id']."';";
	  echo $sql;
	  echo "<br>";	
	
	//   $objCon_sel->Ejecutar($sql);
	//   $objCon_sel->Cerrar();
 }
$res->close();
$con->close();
  ?>
