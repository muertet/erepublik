<?php
/**
 * Carga todas las librerias segun son requeridas
 *
 * private loader($class)
 * 		Carga la clase si no existe.
 */
class ClassAutoloader {

	/**
	 * Registra la clase del autoloader en PHP
	 */
    public function __construct() {
        spl_autoload_register(array($this, 'loader'));
    }
    /**
     * Recibe la clase que se necesita y la inlcuye
     * @param  string $class Nombre de la clase
     */
    private function loader($class) {
		global $PATH_ARRAY;
		
		
		$path = $PATH_ARRAY["fisico"].'classes/';
		
		$ClassFile = str_replace('\\', DIRECTORY_SEPARATOR, $class);
		   
		   //si es una de las clases dentro de cssmin usamos ese archivo
		if ( preg_match("/^aCss|^Css/", $ClassFile) ) {
		$ClassFile = 'cssmin';
		}
		
		   //pasar todo a minusculas
		//$ClassFile = strtolower($ClassFile.'.class.php');
		$ClassPath = $path.$ClassFile.'.class.php';
		if (file_exists($ClassPath) && (!class_exists($class)) ) {
			include_once($ClassPath);
		}
	}
}

$autoloader = new ClassAutoloader();
?>