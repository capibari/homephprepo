<?php


    use core\DBConnector;
    use model\UserModel;
    use model\PostModel;
    use core\AuthModel;
    use core\Templater;
    use core\UrlManager;
    use core\Request;
    use controller\ErrorController;

    function __autoload($classname){
        include_once __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $classname). '.php';
    }


    session_start();

    $controller = UrlManager::getController();
    $action = UrlManager::getAction();
    if(UrlManager::getId()){
        $_GET['id'] = UrlManager::getId();
    }

    $request = new Request($_GET, $_POST, $_SERVER, $_COOKIE, $_SESSION, $_FILES);
try{
    if(file_exists(sprintf('%s%s%s.php', __DIR__,DIRECTORY_SEPARATOR, $controller))){

        $controller = new $controller($request);

        if(method_exists($controller, $action)){
            $controller->$action();
            $controller->build();
        } else {
            $error = new ErrorController($request);
            $error->getError404($action);
            $error->build();
        }
    } else {
        $error = new ErrorController();
        $error->getError404($controller);
        $error->build();
    }
} catch (\core\Exception\ValidateException $e){
    echo '<pre>';
    var_dump($e->getErrors());
}
