<?php
//class AutoLoader {
//
//    private static $_instance;
//
//    private function __construct(){
//
//    }
//
//    public function register()
//    {
//        spl_autoload_register(array($this, 'loadClass'));
//    }
//
//    public static function singleton(){
//        if(!isset(self::$_instance))
//            self::$_instance = new self;
//
//        return self::$_instance;
//    }
//
//    private function __clone(){
//
//    }
//
//    private function loadClass($class){
//
//        $root = dirname(dirname(dirname(__FILE__)));
//        $path = $root.'/facom/Lib/'.str_replace('\\', DIRECTORY_SEPARATOR, $class).'.php';
//        if(file_exists($path))
//        {
//
//            require_once $path;
//        }
//    }
//
//}

function __autoload($className) {
    loadClass($className);
}

function loadClass($className) {
    global $imports;
    if (isset($imports[$className])) {
        include_once($imports[$className]);
    }
}

$imports = array();
function import($import) {
    global $imports;

    // seperate import into a package and a class
    $lastDot = strrpos($import, '.');
    $class = $lastDot ? substr($import, $lastDot + 1) : $import;
    $package = substr($import, 0, $lastDot);

    // if this import has already happened, return true
    if (isset($imports[$class]) || isset($imports[$package.'.*'])) return true;

    // create a folder path out of the package name
    $folder = '' . ($package ? str_replace('.', '/', $package) : '');
    $file = "$folder/$class.php";

    // make sure the folder exists
    if (!file_exists($folder)) {
        $back = debug_backtrace();
        return trigger_error("There is no such package <strong>'$package'</strong> -- Checked folder <strong>'$folder'</strong><br />
            Imported from <strong>'{$back[0]['file']}'</strong> on line <strong>'{$back[0]['line']}'</strong><br />", E_USER_WARNING);
    } elseif ($class != '*' && !file_exists($file)) {
        $back = debug_backtrace();
        return trigger_error("There is no such Class <strong>'$import'</strong> -- Checked for file <strong>'$file'</strong><br />
            Imported from <strong>'{$back[0]['file']}'</strong> on line <strong>'{$back[0]['line']}'</strong><br />", E_USER_WARNING);
    }

    if ($class != '*') {
        // add the class and it's file location to the imports array
        $imports[$class] = $file;
    } else {
        // add all the classes from this package and their file location to the imports array
        // first log the fact that this whole package was alread imported
        $imports["$package.*"] = 1;
        $dir = opendir($folder);
        while (($file = readdir($dir)) !== false) {
            if (strrpos($file, '.php')) {
                $class = str_replace('.php', '', $file);
                // put it in the import array!
                $imports[$class] = "$folder/$file";
            }
        }
    }
}
?>
