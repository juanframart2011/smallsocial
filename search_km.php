<?
// Incluimos Archivo de Conexion a Base de Datos
require_once 'administrator/includes/login.class.php';
require_once 'administrator/includes/resize.php';
require_once 'administrator/includes/class.inputfilter.php';
require_once 'administrator/phpmailer/PHPMailerAutoload.php'; 

$conexion = Conexion::singleton_conexion();

$user = $_SESSION['ssid'];
$SQL = 'SELECT * FROM jhss_usuarios WHERE id = ' . $user;
$sentence = $conexion -> prepare($SQL);
$sentence->execute();
$result = $sentence -> fetchAll();

$latitude = $result[0]["lat"];
$longitude = $result[0]["lng"];

$distance = $_POST["km"];
#$query = "SELECT *, (((acos(sin((".$latitude."*pi()/180)) * sin((lat*pi()/180))+cos((".$latitude."*pi()/180)) * cos((lat*pi()/180)) * cos(((".$longitude."- lng)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance FROM jhss_usuarios WHERE distance >= ".$distance."";

if( $_POST["see"] == 0 ){

    #$query = "SELECT *, (((acos(sin((".$latitude."*pi()/180)) * sin((lat*pi()/180))+cos((".$latitude."*pi()/180)) * cos((lat*pi()/180)) * cos(((".$longitude."- lng)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance FROM jhss_usuarios as u LEFT JOIN jhss_imagespost as img on img.usuario = u.id";
    $query = "SELECT id, nombre, (6371 * ACOS( 
                                SIN(RADIANS(lat)) * SIN(RADIANS(".$latitude.")) 
                                + COS(RADIANS(lng - ".$longitude.")) * COS(RADIANS(lat)) 
                                * COS(RADIANS(".$latitude."))
                                )
                   ) AS distance
                FROM jhss_usuarios
                HAVING distance < ".$distance ."
                ORDER BY distance ASC";
}
else{

    $query = "SELECT * FROM jhss_usuarios as u LEFT JOIN jhss_imagespost as img on img.usuario = u.id";
}

#echo $query;
#echo $query;
#$SQL = 'SELECT u.nombre, u.permalink, u.apellido, u.email, img.ruta FROM '.SSPREFIX.'usuarios as u LEFT JOIN '.SSPREFIX.'imagespost as img on img.usuario = u.id WHERE u.rango = 1 order by registro';

$sentence = $conexion -> prepare($query);
$sentence->execute();
$list = $sentence -> fetchAll();

$html = null;
for( $u = 0; $u < count( $list ); $u++ ){

    $html .= include( "tmp_userSearch.php" );
}

echo $html;
/*
 * Formula para sacar distancia entre dos puntos dada la latitud y longitud de dos puntos.
 * Esta distancia tiene que estar dada en notación DECIMAL y no en SEXADECIMAL (Grados, minutos... etc)
 * @param type $latitud 1
 * @param type $longitud 1
 * @param type $latitud 2
 * @param type $longitud 2
 * @return type, Distancia en Kms, con 1 decimal de precisión
*/
function harvestine($lat1, $long1, $lat2, $long2){ 
    //Distancia en kilometros en 1 grado distancia.
    //Distancia en millas nauticas en 1 grado distancia: $mn = 60.098;
    //Distancia en millas en 1 grado distancia: 69.174;
    //Solo aplicable a la tierra, es decir es una constante que cambiaria en la luna, marte... etc.
    $km = 111.302;
    
    //1 Grado = 0.01745329 Radianes    
    $degtorad = 0.01745329;
    
    //1 Radian = 57.29577951 Grados
    $radtodeg = 57.29577951; 
    //La formula que calcula la distancia en grados en una esfera, llamada formula de Harvestine. Para mas informacion hay que mirar en Wikipedia
    //http://es.wikipedia.org/wiki/F%C3%B3rmula_del_Haversine
    $dlong = ($long1 - $long2); 
    $dvalue = (sin($lat1 * $degtorad) * sin($lat2 * $degtorad)) + (cos($lat1 * $degtorad) * cos($lat2 * $degtorad) * cos($dlong * $degtorad)); 
    $dd = acos($dvalue) * $radtodeg; 
    return round(($dd * $km), 2);
}