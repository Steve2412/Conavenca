<?php

// Conectando a la base de datos usando PDO
try {
  $db = new PDO('mysql:host=localhost;dbname=tesis', 'root', '');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Error al conectar a la base de datos: " . $e->getMessage());
}



$get_codigo = $_POST['code'];
$zoom = 10;

$comprobar_dispositivo = "SELECT package_id,dispositivos.longitud,dispositivos.latitud
FROM paquetes 
inner join dispositivos on dispositivo_id = dispositivos.id_dispositivo
WHERE package_id = '$get_codigo' ";

$comp_paquete_gps = $db->prepare($comprobar_dispositivo);

$comp_paquete_gps->execute();



if ($comp_paquete_gps->rowCount() == 0) {
  $longitud = '';
  $latitud = '';
} else {
  $fetch_data_gps = $comp_paquete_gps->fetch(PDO::FETCH_ASSOC);
  $longitud = $fetch_data_gps['longitud'];
  $latitud = $fetch_data_gps['latitud'];
}

$comp_paquete_gps->closeCursor();

$prueba = "SELECT package_id,package_description,package_status,
origen.nombre_sucursal as sucursal_origen, origen.direccion as direccion_origen,
destino.nombre_sucursal as sucursal_destino, destino.direccion as direccion_destino,
remitente.nombre as nombre_r, remitente.apellido as apellido_r, 
destinatario.nombre as nombre_d, destinatario.apellido as apellido_d
FROM paquetes 
INNER JOIN sucursales AS origen ON package_sucursal_origen_id = origen.id_sucursal
INNER JOIN clientes as remitente on package_remitente_id = remitente.cedula
INNER JOIN clientes as destinatario on package_consignatario_id = destinatario.cedula 
INNER join sucursales as destino on package_sucursal_destino_id = destino.id_sucursal 
WHERE package_id = '$get_codigo' ";

$stmt = $db->prepare($prueba);
$stmt->execute();

if ($stmt->rowCount() == 0) {
  echo "No existe el paquete, intente de nuevo.";
  exit();
}

$fetch_data = $stmt->fetch(PDO::FETCH_ASSOC);

$nombre_sucursal_origen = $fetch_data['sucursal_origen'];
$nombre_sucursal_destino = $fetch_data['sucursal_destino'];



$package_descripcion = $fetch_data['package_description'];
$direccion_sucursal_origen = $fetch_data['direccion_origen'];
$direccion_sucursal_destino = $fetch_data['direccion_destino'];
$package_status = $fetch_data['package_status'];
$remitente = $fetch_data['nombre_r'] . " " . $fetch_data['apellido_r'];
$destinatario = $fetch_data['nombre_d'] . " " . $fetch_data['apellido_d'];

$mostrat_status;

switch ($package_status) {
  case 1:
    $mostrar_status = "En sucursal Origen " . $nombre_sucursal_origen;
    break;
  case 2:
    $mostrar_status = "En proceso de envio ";
    break;
  case 3:
    $mostrar_status =  "En sucursal Destino " . $nombre_sucursal_origen;
    break;
  default:
    # code...
    break;
}



echo "
<table class='table'>
<thead>
  <tr>
    <th scope='col' colspan='2' style='text-align:center;'> Información del paquete </th>
  </tr>
</thead>
<tbody>
  <tr>
      <td> Descripcion del paquete: </td>
      <td>" . $package_descripcion . "</td>
  </tr>
  <tr>
      <td> Remitente: </td>
      <td>" . $remitente . "</td>
  </tr>
  <tr>
    <td>Destinatario </td>
    <td>" . $destinatario . "</td>
  </tr>
  <tr>
    <td> Ciudad de origen </td>
    <td>" . $nombre_sucursal_origen . "</td>
  </tr>
  <tr>
    <td> Direccion de Sucursal origen </td>
    <td>" . $direccion_sucursal_origen . "</td>
  </tr>
  <tr>
      <td> Ciudad de destino </td>
      <td>" . $nombre_sucursal_destino . "</td>
  </tr>
  <tr>
    <td> Direccion de Sucursal origen </td>
    <td>" . $direccion_sucursal_destino . "</td>
</tr>
<tr>
<td> Status</td>
<td>" . $mostrar_status . "</td>
</tr>
</tbody>
</table>
<script>
map.setView([" . $longitud . ", " . $latitud . "], 15);
L.marker([" . $longitud . ", " . $latitud . "]).addTo(map)
.bindPopup('Ubicacion actual').openPopup();
</script>
";





/* $check_distance = "SELECT * FROM paquete WHERE codigo_unico_paquete = '$get_codigo'";

$stmt = $db->prepare($check_distance);
$stmt->bindParam(':get_codigo', $get_codigo, PDO::PARAM_STR);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $fetch_data = $stmt->fetch(PDO::FETCH_ASSOC);
    $descripcion = $fetch_data['descripcion'];
    $remitente = $fetch_data['remitente'];
    $destinatario = $fetch_data['destinatario'];
    $Estado = $fetch_data['status'];
    $ciudad_origen = $fetch_data['estado_rem'];
    $ciudad_destino = $fetch_data['estado_dest'];
    $longitud = $fetch_data['longitud'];
    $latitud = $fetch_data['latitud'];

    echo "
    <table class='table'>
    <thead>
      <tr>
        <th scope='col' colspan='2' style='text-align:center;'> Información del paquete </th>
      </tr>
    </thead>
    <tbody>
      <tr>
          <td> Código del paquete: </td>
          <td>".$get_codigo ."</td>
      </tr>
      <tr>
          <td> Descripcion del paquete: </td>
          <td>". $descripcion ."</td>
      </tr>
      <tr>
          <td> Remitente: </td>
          <td>". $remitente ."</td>
      </tr>
      <tr>
        <td>Destinatario </td>
        <td>". $destinatario ."</td>
      </tr>
      <tr>
        <td> Ciudad de origen </td>
        <td>". $ciudad_origen . "</td>
      </tr>
      <tr>
          <td> Ciudad de destino </td>
          <td>". $ciudad_destino . "</td>
      </tr>
  </tbody>
</table>
<script>
map.setView([".$longitud.", ".$latitud."], 15);
L.marker([".$longitud.", ".$latitud."]).addTo(map)
.bindPopup('Ubicacion actual').openPopup();
</script>
";
} else {
    echo "¡error";
}
 */