<?php

require_once("application/models/model_user.php");

class Controller_delete extends Controller
{
				public $model;
				public $view;
				public $data = array( );
				function __construct( )
				{
								$this->view  = new View();
								$this->model = new Model_user();
				}
				public function action_index( )
				{
								$login = $_SESSION[ 'valid_user' ];
								$this->model->delete( $login );
								unset( $_SESSION[ 'valid_user' ] );
								session_destroy();
								$data[ 'result' ] = 'Пользователь удален!';
								$this->view->generate( $data, 'head.php' );
								$this->view->generate( $data, 'result.php' );
								$this->view->generate( $data, 'footer.php' );
				}
}
?>
