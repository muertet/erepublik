<?php
class Autoloader 
{
	public $path;
	
    public static function init($path=null)
    {		
        $autoloader= new Autoloader();		
		
		if(!empty($path)){			
			$autoloader->path=$path;	
		}
		
        spl_autoload_register(array($autoloader, 'loader'));
    }
    private function loader($class) 
    {
		//check if its a controller class
		$firstChar=substr($class,0,1);
		$oClass=$class;
		
		if($firstChar=='c')
		{
			$class=strtolower(substr($class,1));
			$path = $this->path.'controllers/';
		}else{
			$path = $this->path.'classes/';
		}
		
		
		$ClassFile = str_replace('\\', DIRECTORY_SEPARATOR, $class);

		$ClassFile=$ClassFile.'.php';
		$ClassPath = $path.$ClassFile;
		//echo $ClassPath."-".var_dump(file_exists($ClassPath))."-".var_dump(class_exists($class))." (".$oClass.") <br>";
		
		if (file_exists($ClassPath) && (!class_exists($oClass)) ) {
			include_once($ClassPath);
		}

	}
}

