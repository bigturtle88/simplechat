<?php
class Routing {
    protected static $router = array();
    static function execute() {
        $args = self::get_args();
        empty($args[0]) ? $controllerName = 'main' : $controllerName = $args[0];
        empty($args[1]) ? $actionName = 'index' : $actionName = $args[1];
        empty($args[2]) ? $parameter = NULL : $parameter = $args[2];
        $modelName = 'Model_' . $controllerName;
        $controllerName = 'Controller_' . $controllerName;
        $actionName = 'action_' . $actionName;
        $fileWithModel = strtolower($modelName) . '.php';
        $fileWithModelPath = "application/models/" . $fileWithModel;
        if (file_exists($fileWithModelPath)) {
            require_once ($fileWithModelPath);
        } //file_exists( $fileWithModelPath )
        $fileWithController = strtolower($controllerName) . '.php';
        $fileWithControllerPath = "application/controllers/" . $fileWithController;
        if (file_exists($fileWithControllerPath)) {
            require_once ($fileWithControllerPath);
        } //file_exists( $fileWithControllerPath )
        else {
            $controllerName = 'Controller_e404';
            require_once ('application/controllers/controller_e404.php');
        }
        $controller = new $controllerName;
        $action = $actionName;
        if (method_exists($controller, $action) != false) {
            call_user_func(array($controller, $action), $parameter);
        } else {
            require_once ('application/controllers/controller_e404.php');
            $controller = new Controller_e404;
            $action = 'action_index';
            call_user_func(array($controller, $action));
        }
    }
    private function get_args() {
        $prefix_str = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
        if ($prefix_str !== '/') {
            $args = '/' . str_replace($prefix_str, '', $_SERVER['REQUEST_URI']);
        } //$prefix_str !== '/'
        else {
            $args = '/' . $_SERVER['REQUEST_URI'];
        }
        $args = ltrim($args, '/');
        $args = explode('/', $args);
        return $args;
    }
}
?> 
