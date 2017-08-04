<?php

require_once 'conexion.class.php';
session_start();
class Login
{

    private static $instancia;
    private $dbh;
 
    private function __construct()
    {

        $this->dbh = Conexion::singleton_conexion();

    }
 
    public static function singleton_login()
    {

        if (!isset(self::$instancia)) {

            $miclase = __CLASS__;
            self::$instancia = new $miclase;

        }

        return self::$instancia;

    }
	
	public function login_users($email,$password)
	{
		
		try {

			$crypt = sha1(SALT.$password.PEPER);
			
			$sql = "SELECT * FROM  ".SSPREFIX."usuarios WHERE email = ? AND password = ? AND activo = 2";
			$query = $this->dbh->prepare($sql);
			$query->bindParam(1,$email);
			$query->bindParam(2,$crypt);
			$query->execute();
			#$this->dbh = null;

			//si existe el usuario
			if($query->rowCount() == 1)
			{
				 
				$fila  = $query->fetch();
				$_SESSION['ssid'] = $fila['id'];
				$_SESSION['ssrango'] = $fila['rango'];	

				$update_sql = "UPDATE ".SSPREFIX."usuarios set activo = 1 WHERE email = ? AND password = ? ";
				$update_sql = $this->dbh->prepare( $update_sql );
				$update_sql->bindParam(1,$email);
				$update_sql->bindParam(2,$crypt);
				$update_sql->execute();
				#$this->dbh = null;
                 
				 return TRUE;
	
			}else

			return FALSE;
			
		}catch(PDOException $e){
			
			print "Error!: " . $e->getMessage();
			
		}		
		
	}
    

     // Evita que el objeto se pueda clonar
    public function __clone()
    {

        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);

    }

}