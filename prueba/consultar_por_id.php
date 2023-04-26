
<?php

$timezone='America/El_Salvador';
date_default_timezone_set($timezone);

$esq_id= $_GET["esq_id"];




$now = date('Y-m-d H:i:s', time());  



//$con=new mysqli('172.31.65.26:3306','esquelas_ow','esquelas2021','esquelas');
$con=new mysqli('localhost','root','','esquelas');
$con->set_charset('utf-8');

$sel=$con->prepare("SELECT esq_id,
esq_fecha,
esq_direccion,
con_nit,
esq_ade_oni,
esq_latitud,
esq_longitud,
esq_uge_codigo,
esq_con_ausente,
esq_observaciones,
esq_niega_firma,
esq_vce_vehid,
esq_nombre_responsable_acc,
esq_dui_responsable_acc,
esq_grado_alcohol,
esq_excesiva_velocidad,
esq_con_id,
esq_json,
esq_pais_placa_ext,
esq_pais_lic_ext
 FROM esquelas e where esq_id='$esq_id'");
$sel->execute();
$res=$sel->get_result();


 while ($row = $res->fetch_assoc()) {
	 	echo "<b>DATOS DE ESQUELA</b>";
		echo "<br>";
		
		
		
		echo "esq_id= ".$row['esq_id']."<br>";
		echo "esq_fecha= ".$row['esq_fecha']."<br>";
		echo "esq_direccion= ".$row['esq_direccion']."<br>";
		$con_nit=$row['con_nit'];
		echo "con_nit= ".$row['con_nit']."<br>";
		echo "esq_ade_oni= ".$row['esq_ade_oni']."<br>";
		echo "esq_latitud= ".$row['esq_latitud']."<br>";
		echo "esq_longitud= ".$row['esq_longitud']."<br>";
		echo "esq_uge_codigo= ".$row['esq_uge_codigo']."<br>";
		echo "esq_con_ausente= ".$row['esq_con_ausente']."<br>";
		echo "esq_observaciones= ".$row['esq_observaciones']."<br>";
		echo "esq_niega_firma= ".$row['esq_niega_firma']."<br>";
		$esq_vce_vehid=$row['esq_vce_vehid'];
		echo "esq_vce_vehid= ".$row['esq_vce_vehid']."<br>";
		echo "esq_nombre_responsable_acc= ".$row['esq_nombre_responsable_acc']."<br>";
		echo "esq_dui_responsable_acc= ".$row['esq_dui_responsable_acc']."<br>";
		echo "esq_grado_alcohol= ".$row['esq_grado_alcohol']."<br>";
		echo "esq_excesiva_velocidad= ".$row['esq_excesiva_velocidad']."<br>";
		echo "esq_con_id= ".$row['esq_con_id']."<br>";
		echo "esq_pais_placa_ext= ".$row['esq_pais_placa_ext']."<br>";
		echo "esq_pais_lic_ext= ".$row['esq_pais_lic_ext']."<br>";
		
	  
		//echo "esq_vce_vehid=".$esq_vce_vehid;
		//echo "<br>";
		//echo "con_nit=".$con_nit;
		//echo "<br>";
		
		echo "<hr>";
		
		$sel1=$con->prepare("select con_id,
con_nit,
con_dui,
con_pasaporte,
con_carnet,
con_nombre,
con_apellidop,
con_apellidom,
con_apecasada,
con_tipo_licencia,
con_nro_control from conductores_con_esquelas where con_nit='$con_nit'");
$sel1->execute();
$res1=$sel1->get_result();
		 if ($res1 != null){
			 ?>
				<b>conductores_con_esquelas</b>
				<table border='1'>
				<tr>
				<td>con_id</td>
				<td>con_nit</td>
				<td>con_dui</td>
				<td>con_pasaporte</td>
				<td>con_carnet</td>
				<td>con_nombre</td>
				<td>con_apellidop</td>
				<td>con_apellidom</td>
				<td>con_apecasada</td>
				<td>con_tipo_licencia</td>
				<td>con_nro_control</td>
				</tr>			 
			 <?php
			while ($row1 = $res1->fetch_assoc()) {
				$con_id=$row1['con_id'];
				$con_nit=$row1['con_nit'];
				$con_dui=$row1['con_dui'];
				$con_pasaporte=$row1['con_pasaporte'];
				$con_carnet=$row1['con_carnet'];
				$con_nombre=$row1['con_nombre'];
				$con_apellidop=$row1['con_apellidop'];
				$con_apellidom=$row1['con_apellidom'];
				$con_apecasada=$row1['con_apecasada'];
				$con_tipo_licencia=$row1['con_tipo_licencia'];
				$con_nro_control=$row1['con_nro_control'];				
				?>
			<tr>
				<td><?php echo $con_id; ?></td>
				<td><?php echo $con_nit; ?></td>
				<td><?php echo $con_dui; ?></td>
				<td><?php echo $con_pasaporte; ?></td>
				<td><?php echo $con_carnet; ?></td>
				<td><?php echo $con_nombre; ?></td>
				<td><?php echo $con_apellidop; ?></td>
				<td><?php echo $con_apellidom; ?></td>
				<td><?php echo $con_apecasada; ?></td>
				<td><?php echo $con_tipo_licencia; ?></td>
				<td><?php echo $con_nro_control; ?></td>
			</tr>			
			<?php
			}?>
			</table>
			<?php	
			}	 
		 else{
			 echo "No existen registros para conductores_con_esquelas";
		 }	
 
 
		
 
 echo "<br>";
 
 
 		$sel2=$con->prepare("select vce_veh_id,
vce_chasis_vin,
vce_placa,
vce_clase,
vce_marca,
vce_modelo,
vce_color,
vce_poliza_vin,
vce_num_poliza,
vce_anio,
vce_foto,
emision,
titular,
fecha_vencimiento from vehiculos_con_esquelas where vce_veh_id='$esq_vce_vehid'");
$sel2->execute();
$res2=$sel2->get_result();
		 if ($res2 != null){
			 ?>
				<b>vehiculos_con_esquelas</b>
				<table border='1'>
				<tr>
				<td>vce_veh_id</td>
				<td>vce_chasis_vin</td>
				<td>vce_placa</td>
				<td>vce_clase</td>
				<td>vce_marca</td>
				<td>vce_modelo</td>
				<td>vce_color</td>
				<td>vce_poliza_vin</td>
				<td>vce_anio</td>
				<td>vce_foto</td>
				<td>emision</td>
				<td>titular</td>
				<td>fecha_vencimiento</td>
				</tr>			 
			 <?php
			while ($row2 = $res2->fetch_assoc()) {
				$vce_veh_id=$row2['vce_veh_id'];
				$vce_chasis_vin=$row2['vce_chasis_vin'];
				$vce_placa=$row2['vce_placa'];
				$vce_clase=$row2['vce_clase'];
				$vce_marca=$row2['vce_marca'];
				$vce_modelo=$row2['vce_modelo'];
				$vce_color=$row2['vce_color'];
				$vce_poliza_vin=$row2['vce_poliza_vin'];
				$vce_anio=$row2['vce_anio'];
				$vce_foto=$row2['vce_foto'];
				$emision=$row2['emision'];				
				$titular=$row2['titular'];				
				$fecha_vencimiento=$row2['fecha_vencimiento'];				
				?>
			<tr>
				<td><?php echo $vce_veh_id; ?></td>
				<td><?php echo $vce_chasis_vin; ?></td>
				<td><?php echo $vce_placa; ?></td>
				<td><?php echo $vce_clase; ?></td>
				<td><?php echo $vce_marca; ?></td>
				<td><?php echo $vce_modelo; ?></td>
				<td><?php echo $vce_color; ?></td>
				<td><?php echo $vce_poliza_vin; ?></td>
				<td><?php echo $vce_anio; ?></td>
				<td><?php echo $vce_foto; ?></td>
				<td><?php echo $emision; ?></td>
				<td><?php echo $titular; ?></td>
				<td><?php echo $fecha_vencimiento; ?></td>
			</tr>			
			<?php
			}?>
			</table>
			<?php	
			}	 
		 else{
			 echo "No existen registros para vehiculos_con_esquelas";
		 }	
 
		

		
		echo "<br>";
		
		

		$sel3=$con->prepare("select not_esq_id,
not_email,
not_telefono,
not_enviada,
not_fecha_envio,
not_usuario_envio,
esq_id from notificaciones_de_esquelas where not_esq_id='$esq_id'");
$sel3->execute();
$res3=$sel3->get_result();
		 if ($res3 != null){
			 ?>
				<b>notificaciones_de_esquelas</b>
				<table border='1'>
				<tr>
				<td>not_esq_id</td>
				<td>not_email</td>
				<td>not_telefono</td>
				<td>not_enviada</td>
				<td>not_fecha_envio</td>
				<td>not_usuario_envio</td>
				<td>esq_id</td>
				</tr>			 
			 <?php
			while ($row3 = $res3->fetch_assoc()) {
				$not_esq_id=$row3['not_esq_id'];
				$not_email=$row3['not_email'];
				$not_telefono=$row3['not_telefono'];
				$not_enviada=$row3['not_enviada'];
				$not_fecha_envio=$row3['not_fecha_envio'];
				$not_usuario_envio=$row3['not_usuario_envio'];
				$esq_id=$row3['esq_id'];
				
				?>
			<tr>
				<td><?php echo $not_esq_id; ?></td>
				<td><?php echo $not_email; ?></td>
				<td><?php echo $not_telefono; ?></td>
				<td><?php echo $not_enviada; ?></td>
				<td><?php echo $not_fecha_envio; ?></td>
				<td><?php echo $not_usuario_envio; ?></td>
				<td><?php echo $esq_id; ?></td>
				
			</tr>			
			<?php
			}?>
			</table>
			<?php	
				 
		 }else{
			 echo "No existen registros para notificaciones_de_esquelas<br>";
		 }	
 		
		
		
		
		
		
		
		echo "<br>";
		echo "<br>";
		
		

		$sel4=$con->prepare("select tfa_codigo,
esq_id from faltas_de_esquelas where esq_id='$esq_id'");
$sel4->execute();
$res4=$sel4->get_result();
		 if ($res4 != null){
			 ?>
				<b>faltas_de_esquelas</b>
				<table border='1'>
				<tr>
				<td>tfa_codigo</td>
				<td>esq_id</td>
				</tr>			 
			 <?php
			while ($row4 = $res4->fetch_assoc()) {
				$tfa_codigo=$row4['tfa_codigo'];
				$esq_id=$row4['esq_id'];
				
				?>
			<tr>
				<td><?php echo $tfa_codigo; ?></td>
				<td><?php echo $esq_id; ?></td>
				
			</tr>			
			<?php
			}?>
			</table>
			<?php	
			}	 
		 else{
			 echo "No existen registros para faltas_de_esquelas";
		 }	
		 
		 
		 
		 
		 
		 		echo "<br>";
		echo "<br>";
		
		

		$sel5=$con->prepare("select acc_esq_id,
acc_tda_codigo,
esq_id from accidentes_de_esquelas where esq_id='$esq_id'");
$sel5->execute();
$res5=$sel5->get_result();
		 if ($res5 != null){
			 ?>
				<b>accidentes_de_esquelas</b>
				<table border='1'>
				<tr>
				<td>acc_esq_id</td>
				<td>acc_tda_codigo</td>
				<td>esq_id</td>
				</tr>			 
			 <?php
			while ($row5 = $res5->fetch_assoc()) {
				$acc_esq_id=$row5['acc_esq_id'];
				$acc_tda_codigo=$row5['acc_tda_codigo'];
				$esq_id=$row5['esq_id'];
				
				?>
			<tr>
				<td><?php echo $acc_esq_id; ?></td>
				<td><?php echo $acc_tda_codigo; ?></td>
				<td><?php echo $esq_id; ?></td>
			</tr>			
			<?php
			}?>
			</table>
			<?php	
			}	 
		 else{
			 echo "No existen registros para accidentes_de_esquelas";
		 }	
 		
 		
		
		
		
		
 
		 		echo "<br>";
		echo "<br>";
		
		

		$sel6=$con->prepare("select dec_esq_id,
decoesq_id,
dec_tdd_codigo,
vce_veh_id from decomisos_de_esquelas where dec_esq_id='$esq_id'");
$sel6->execute();
$res6=$sel6->get_result();
		 if ($res6 != null){
			 ?>
				<b>decomisos_de_esquelas</b>
				<table border='1'>
				<tr>
				<td>dec_esq_id</td>
				<td>decoesq_id</td>
				<td>dec_tdd_codigo</td>
				<td>vce_veh_id</td>
				</tr>			 
			 <?php
			while ($row6 = $res6->fetch_assoc()) {
				$dec_esq_id=$row6['dec_esq_id'];
				$decoesq_id=$row6['decoesq_id'];
				$dec_tdd_codigo=$row6['dec_tdd_codigo'];
				$vce_veh_id=$row6['vce_veh_id'];
				
				
				?>
			<tr>
				<td><?php echo $dec_esq_id; ?></td>
				<td><?php echo $decoesq_id; ?></td>
				<td><?php echo $dec_tdd_codigo; ?></td>
				<td><?php echo $vce_veh_id; ?></td>
			</tr>			
			<?php
			}?>
			</table>
			<?php	
			}	 
		 else{
			 echo "No existen registros para decomisos_de_esquelas";
		 }			

		 
		 
		 
		 
		 
		 
		 		 		echo "<br>";
		echo "<br>";
		
		

		$sel7=$con->prepare("select acf_id,
acf_esq_id,
acf_nombre,
acf_dui,
acf_menor_edad from accidentes_fallecidos where acf_esq_id='$esq_id'");
$sel7->execute();
$res7=$sel7->get_result();
		 if ($res7 != null){
			 ?>
				<b>accidentes_fallecidos</b>
				<table border='1'>
				<tr>
				<td>acf_id</td>
				<td>acf_esq_id</td>
				<td>acf_nombre</td>
				<td>acf_dui</td>
				<td>acf_menor_edad</td>
				</tr>			 
			 <?php
			while ($row7 = $res7->fetch_assoc()) {
				$acf_id=$row7['acf_id'];
				$acf_esq_id=$row7['acf_esq_id'];
				$acf_nombre=$row7['acf_nombre'];
				$acf_dui=$row7['acf_dui'];
				$acf_menor_edad=$row7['acf_menor_edad'];
				
				
				?>
			<tr>
				<td><?php echo $acf_id; ?></td>
				<td><?php echo $acf_esq_id; ?></td>
				<td><?php echo $acf_nombre; ?></td>
				<td><?php echo $acf_dui; ?></td>
				<td><?php echo $acf_menor_edad; ?></td>
			</tr>			
			<?php
			}?>
			</table>
			<?php	
			}	 
		 else{
			 echo "No existen registros para accidentes_fallecidos";
		 }			

		 
		 
		 
		 
		 
		 
		 
		 
		 		 		echo "<br>";
		echo "<br>";
		
		

		$sel8=$con->prepare("select acl_id,
acl_esq_id,
acl_nombre,
acl_dui,
acl_menor_edad from accidentes_lesionados where acl_esq_id='$esq_id'");
$sel8->execute();
$res8=$sel8->get_result();
		 if ($res8 != null){
			 ?>
				<b>accidentes_lesionados</b>
				<table border='1'>
				<tr>
				<td>acl_id</td>
				<td>acl_esq_id</td>
				<td>acl_nombre</td>
				<td>acl_dui</td>
				<td>acl_menor_edad</td>
				</tr>			 
			 <?php
			while ($row8 = $res8->fetch_assoc()) {
				$acl_id=$row8['acl_id'];
				$acl_esq_id=$row8['acl_esq_id'];
				$acl_nombre=$row8['acl_nombre'];
				$acl_dui=$row8['acl_dui'];
				$acl_menor_edad=$row8['acl_menor_edad'];
				
				
				?>
			<tr>
				<td><?php echo $acl_id; ?></td>
				<td><?php echo $acl_esq_id; ?></td>
				<td><?php echo $acl_nombre; ?></td>
				<td><?php echo $acl_dui; ?></td>
				<td><?php echo $acl_menor_edad; ?></td>
			</tr>			
			<?php
			}?>
			</table>
			<?php	
			}	 
		 else{
			 echo "No existen registros para accidentes_lesionados";
		 }			


	//   $objCon_sel->Ejecutar($sql);
	//   $objCon_sel->Cerrar();
 }
$res->close();
$con->close();
  ?>
