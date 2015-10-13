<?php
class Controller_e404 extends Controller
{
				public $model;
				public $view;
				public $data = array( );
				function __construct( )
				{
								$this->view  = new View();
								$this->model = new Model();
				}
				public function action_index( )
				{
								
							//	unset( $_SESSION[ 'valid_user' ] );
							//	session_destroy();
								  $data[ 'result' ] = '404!';
								$this->view->generate( $data, 'head.php' );
								$this->view->generate( $data, 'e404.php' );
								$this->view->generate( $data, 'footer.php' );
				}
}
?>
