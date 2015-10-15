<?php
require_once ("application/models/model_user.php");
class Controller_delete extends Controller {
    public $model;
    public $view;
    public $data = array();
    function __construct() {
        $this->view = new View();
        $this->model = new Model_user();
    }
    public function action_index() {
        $login = $_SESSION['valid_user'];
        $this->model->delete($login);
        unset($_SESSION['valid_user']);
        session_destroy();
        $data['result'] = '&#1055;&#1086;&#1083;&#1100;&#1079;&#1086;&#1074;&#1072;&#1090;&#1077;&#1083;&#1100; &#1091;&#1076;&#1072;&#1083;&#1077;&#1085;!';
        $this->view->generate($data, 'head.php');
        $this->view->generate($data, 'result.php');
        $this->view->generate($data, 'footer.php');
    }
}
?>
