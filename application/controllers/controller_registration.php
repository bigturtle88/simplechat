<?php
require_once ("application/models/model_user.php");
require_once ("application/helpers/helper_validation.php");
require_once ("application/helpers/helper_security.php");
require_once ("application/languages/eng.php");
class Controller_registration extends Controller {
    public $model;
    public $view;
    public $data = array();
    function __construct() {
        $this->view = new View();
        $this->model = new Model_user();
        $this->security = new Security();
        $this->validation = new Validation();
    }
    public function action_index() {
        unset($_SESSION['valid_user']);
        $login = $this->security->filter($_REQUEST['login']);
        $userpass = $this->security->filter($_REQUEST['userpass']);
        $repeatPass = $this->security->filter($_REQUEST['repeatpass']);
        $data = $this->validation->validate($login, $userpass, $repeatPass);
        if ($data['result'] == true) {
            $data = $this->model->validation_login($login);
            if ($data['result'] == true) {
                $this->model->add($login, $userpass);
                $session = $this->model->idkey($login);
                $_SESSION['valid_user'] = $session;
                $data['title'] = 'Sign up';
                $data['result'] = REGISTRATION_COMPLETED;
                $this->view->generate($data, 'head.php');
                $this->view->generate($data, 'result.php');
            } else {
                $data['title'] = 'Sign up';
                $data['login'] = $login;
                $data['userpass'] = $userpass;
                $this->view->generate($data, 'head.php');
                $this->view->generate($data, 'registration.php');
            }
        } else {
            $data['title'] = 'Sign up';
            $data['login'] = $login;
            $data['userpass'] = $userpass;
            $this->view->generate($data, 'head.php');
            $this->view->generate($data, 'registration.php');
        }
    }
}
?> 
