<?
require_once 'administrator/ss-functions.php';

$type_user = $_POST["type_user"];
$gender = $_POST["gender"];
$age = $_POST["age"];
$type_equipo = $_POST["type_equipo"];

if( empty( $type_user ) ){

	$sql_typeUser = '';
}
else{

	$sql_typeUser = ' and u.type_user = "' . $type_user . '" ';
}

if( empty( $gender ) ){

	$sql_gender = '';
}
else{

	$sql_gender = ' and u.gender = "' . $gender . '" ';
}

if( empty( $age ) ){

	$sql_age = '';
}
else{

	$sql_age = ' and u.nacimiento like "' . $age . '%" ';
}

if( empty( $type_equipo ) ){

	$sql_typeEquipo = '';
}
else{

	$sql_typeEquipo = ' and u.type_equipo = "' . $type_equipo . '" ';
}


$sql = 'SELECT u.nombre, u.apellido, u.email, img.ruta FROM '.SSPREFIX.'usuarios as u LEFT JOIN '.SSPREFIX.'imagespost as img on img.usuario = u.id WHERE u.rango = 1 ' . $sql_typeUser . $sql_gender . $sql_age . $sql_typeEquipo . ' order by registro';

$list = users_list( $sql );
$html = '';

for( $u = 0; $u < count( $list ); $u++ ){

	if( empty( $list[$u]["ruta"] ) ){

		$image = "images/profile-default.jpg";
	}
	else{

		$image = $list[$u]["ruta"];
	}

    $html .= '<div class="col-md-3 text-center">
        <div class="widget-user-image">
            <img id="image-profile" class="img-circle changeprofilephoto" width="128" height="128" src="'. $image .'">
        </div>
        <h5>'. $list[$u]["nombre"] . ' ' . $list[$u]["apellido"] .'</h5>
        <h5>'. $list[$u]["email"] .'</h5>
    </div>';
}

echo $html;
?>