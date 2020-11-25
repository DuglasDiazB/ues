<?php 
class Reports extends MainController{


	function __construct(){

		$this->error = FALSE;
		sessionAdmin();
		$this->ModeloReportes = $this->model('ModeloReportes');

	}

	public function index(){
		//$manipuladores = $this->ModeloReportes->obtenerManipuladores();


		$parameters =[
			'title'=> 'Reports',

			/*'menu' => 'manipuladores',
			'rutaContrBusqueda' => $rutaContrBusqueda,
			'respuesta' => $respuesta,
			'busqueda' => $busqueda,
			'manipulador' => $manipulador,
			'manipuladores' => $manipuladores,*/

		];

		$this->view('reportes/index', $parameters); 

	}


	public function reporteManipuladores(){
		$manipuladores = $this->ModeloReportes->obtenerManipuladores();

		$parameters = [
			'title'=> 'Active Manipulators Report',
			'manipuladores'=>$manipuladores,
		];
		$this->view('reportes/manipuladores', $parameters);
	}


	public function reporteManipuladoresActivos(){
		$manipuladores = $this->ModeloReportes->reporteManipuladoresActivos();

		$parameters = [
			'title'=> 'Active Manipulators Report',
			'manipuladores'=>$manipuladores,
		];
		$this->view('reportes/manipuladores_activos', $parameters);
	}

	public function reporteManipuladoresInactivos(){
		$manipuladores = $this->ModeloReportes->reporteManipuladoresInactivos();

		$parameters = [
			'title'=> 'Deactivated Manipulators Report',
			'manipuladores'=>$manipuladores,
		];
		$this->view('reportes/manipuladores_inactivos', $parameters);
	}

	public function reporteManipuladoresFormales(){
		$manipuladores = $this->ModeloReportes->reporteManipuladoresFormales();

		$parameters = [
			'title'=> 'Formal Manipulators Report',
			'manipuladores'=>$manipuladores,
		];
		$this->view('reportes/manipuladores_formales', $parameters);
	}


	public function reporteManipuladoresInformales(){
		$manipuladores = $this->ModeloReportes->reporteManipuladoresInformales();

		$parameters = [
			'title'=> 'Informal Manipulators Report',
			'manipuladores'=>$manipuladores,
		];
		$this->view('reportes/manipuladores_informales', $parameters);
	}

	public function copiaSeguridad(){
		
		$regresar = ROUTE_URL.'/Reports/index/';

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
			
			$errores['password']['text'] = $_POST['password'];
			
			if ($errores['password']['text'] == '') {
				
				$errores['password']['form-control'] = 'error';
				$errores['password']['small'] = 'No ha digitado ninguna contraseña';
				
			}else{

				$usuario = ucwords($_SESSION['user']->username);
				
				$pass = sanitize(hash('sha512',  $errores['password']['text']));

				if($this->ModeloReportes->comprobarUser($usuario, $pass)){
					
					// $host = DB_HOST;
					// $database_name = DB_NAME;
					// $username = DB_USER;
					// $password = DB_PASS;
					$arrayDbConf['host'] = DB_HOST;
					$arrayDbConf['user'] = DB_USER;
					$arrayDbConf['pass'] = DB_PASS;
					$arrayDbConf['name'] = DB_NAME;
					
					$fecha = date("Ymd-His");

					
					$bck = new MySqlBackupLite($arrayDbConf);
					$bck->backUp();
					$bck->setFileDir('C:\backups/');
					$bck->setFileName($arrayDbConf['name'].'_'.$fecha.'.sql');
					$bck->saveToFile();
					$errores['password']['form-control'] = 'success';
					
					$mensaje = 'La base de datos fue generada correctamente <i style = "color: #008f39;"class="fas fa-check-circle"></i>';

					// $fecha = date("Ymd-His");
					// $salida_sql = $db_name.'_'.$fecha.'.sql';
					// $dump = "mysqldump --h$db_host -u$db_user -p$db_pass --opt $db_name > $salida_sql";
					// system($dump, $output);

					// $zip = new ZipArchive();

					// $salida_zip = $db_name.'_'.$fecha.'.zip';					
					
					// if($zip->open($salida_zip, ZIPARCHIVE::CREATE) == true){
					// 	$zip->addFile($salida_sql);
					// 	$zip->close();
					// 	unlink($salida_sql);
					// 	header("Location: ../../public/".$salida_zip);
					// 	unlink($salida_zip);
					// }else {
					// 	echo 'error';
					// }
										
				// 	$conn=mysqli_connect($host,$username,$password,$database_name);

				// 	$tables=array();
				// 	$sql="SHOW TABLES";
				// 	$result=mysqli_query($conn,$sql);

				// 	while($row=mysqli_fetch_row($result)){
				// 	$tables[]=$row[0];
				// 	}

				// 	$backupSQL="";
				// 	foreach($tables as $table){
				// 	$query="SHOW CREATE TABLE $table";
				// 	$result=mysqli_query($conn,$query);
				// 	$row=mysqli_fetch_row($result);
				// 	$backupSQL.="\n\n".$row[1].";\n\n";

				// 	$query="SELECT * FROM $table";
				// 	$result=mysqli_query($conn,$query);

				// 	$columnCount=mysqli_num_fields($result);

				// 	for($i=0;$i<$columnCount;$i++){
				// 	while($row=mysqli_fetch_row($result)){
				// 	$backupSQL.="INSERT INTO $table VALUES(";
				// 	for($j=0;$j<$columnCount;$j++){
				// 	$row[$j]=$row[$j];

				// 	if(isset($row[$j])){
				// 	$backupSQL.='"'.$row[$j].'"';
				// 	}else{
				// 	$backupSQL.='""';
				// 	}
				// 	if($j<($columnCount-1)){
				// 	$backupSQL.=',';
				// 	}
				// 	}
				// 	$backupSQL.=");\n";
				// 	}
				// 	}
				// 	$backupSQL.="\n";
				// 	}

				// 	if(!empty($backupSQL)){
				// 	$backup_file_name=$database_name.'_backup_'.time().'.sql';
				// 	$fileHandler=fopen($backup_file_name,'w+');
				// 	$number_of_lines=fwrite($fileHandler,$backupSQL);
				// 	fclose($fileHandler);

				// 	header('Content-Description: File Transfer');
				// 	header('Content-Type: application/octet-stream');
				// 	header('Content-Disposition: attachment; filename='.basename($backup_file_name));
				// 	header('Content-Transfer-Encoding: binary');
				// 	header('Expires: 0');
				// 	header('Cache-Control: must-revalidate');
				// 	header('Pragma: public');
				// 	header('Content-Length: '.filesize($backup_file_name));
				// 	ob_clean();
				// 	flush();
				// }

					
				}else{
					$mensaje = 'Ha ocurrido un error al procesar la contraseña';
					$errores['password']['form-control'] = 'error';
					$errores['password']['small'] = 'Contraseña invalida';
				}
			
			}
		}else{

			$mensaje = 'Digite su contraseña de administrador para descargar una copia de la base de datos';
			$errores['password']['form-control'] = '';
			$errores['password']['text'] = '';
			$errores['password']['small'] = '';

		}

		$parameters = [
			'title' => 'Copia de Seguridad',
			'mensaje' => $mensaje,
			'errores' => $errores, 
			'regresar' => $regresar

		];

		

		$this->view('reportes/copia_seguridad', $parameters);
	}
}


?>