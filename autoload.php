<?php
spl_autoload_register(function ($class) {
    $baseNamespace = 'projet2_Mailhiot\\';

    $baseDir = __DIR__ . '/';

    $len = strlen($baseNamespace);
    if (strncmp($baseNamespace, $class, $len) !== 0) {

        return;
    }

    $relativeClass = substr($class, $len);



    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';


    if (file_exists($file)) {
        require $file;
    }
});
