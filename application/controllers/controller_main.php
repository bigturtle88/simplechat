<?php
require_once("application/models/model_user.php");
require_once("application/helpers/helper_validation.php");
require_once("application/helpers/helper_security.php");
require_once("application/languages/eng.php");
class Controller_main extends Controller
{
				public $model;
				public $view;
				public $result;
				public $data = array( );
				function __construct( )
				{
								$this->view  = new View();
								$this->model = new Model_user();
								$this->security = new Security();
				}
				public function action_index( )
				{
							
								
						isset($_REQUEST[ 'login' ])?$login = $this->security->filter($_REQUEST[ 'login' ]):$login = NULL;
						isset($_REQUEST[ 'userpass' ])?$userpass = $this->security->filter($_REQUEST[ 'userpass' ]):$userpass = NULL;
						isset($_SESSION[ 'valid_user' ])?$session = $this->security->filter_session($_SESSION[ 'valid_user' ]):$session =  NULL;
						
								if ( !is_null($session)) {
												
												if ( $this->model->validation_user($session['id'],$session['key']) == true ) {
														$data = $this->model->usprint($session['id']);
												$data['admin'] = $this->model->validation_admin( $session);
										
														$data[ 'title' ] = 'Simple chat';
														$this->view->generate( $data,  'head.php' );
														$this->view->generate( $data , 'user.php' );
														$this->view->generate('', 'footer.php' );
												}
												else{
																unset( $_SESSION[ 'valid_user' ] );
																session_destroy();
																$data['url'] = SITE_URL;
																$this->view->generate( $data, 'redirect.php' );
												
												}
												
								} 
								else {
												if ( !is_null( $login ) or !is_null( $userpass ) ) {
																if ( $this->model->in( $login, $userpass ) == true ) {
																				
																				$session = $this->model->idkey( $login ); 
																				
																				$_SESSION[ 'valid_user' ] = $session; 
																				$data = $this->model->usprint( $session['id']);
																				$data[ 'title' ] = 'Simple chat';
																				$this->view->generate( $data, 'head.php' );
																				$this->view->generate($data, 'user.php' );
																				$this->view->generate( '', 'footer.php' );
																} 
																else {	$data[ 'title' ] = 'Simple chat';
																				$data[ 'error' ] = ERROR_LOGIN_OR_PASS;
																				$this->view->generate( $data, 'head.php' );
																				$this->view->generate( $data, 'index.php' );
																				$this->view->generate( '', 'footer.php' );
																}
												} 
												else {$data[ 'title' ] = 'Simple chat';
																$this->view->generate( $data, 'head.php' );
																$this->view->generate( $data, 'index.php' );
																$this->view->generate( '', 'footer.php' );
												}
								}
				}
				public function action_exit( ) 
				{
				isset($_SESSION[ 'valid_user' ])?$session = $this->security->filter_session($_SESSION[ 'valid_user' ]):$session =  NULL;
						
						if ( !is_null($session)) {
						
				if ( $this->model->validation_user($session['id'],$session['key']) == true ) {
				
								$data[ 'title' ] = 'Simple chat';
								
								$this->model->exit_user($session['id']);
								
								unset( $_SESSION[ 'valid_user' ] );
								session_destroy();
								
								
								$this->view->generate( $data, 'head.php' );
								$this->view->generate( '', 'index.php' );
								$this->view->generate( '', 'footer.php' );
								}
								else{
									
									$data[ 'title' ] = 'Simple chat';
									
								unset( $_SESSION[ 'valid_user' ] );
								session_destroy();
								
								$this->view->generate( $data, 'head.php' );
								$this->view->generate( '', 'index.php' );
								$this->view->generate( '', 'footer.php' );
								
								
								
								}}
								else{
									$data[ 'title' ] = 'Simple chat';
									
								unset( $_SESSION[ 'valid_user' ] );
								session_destroy();
								
								$this->view->generate( $data, 'head.php' );
								$this->view->generate( '', 'index.php' );
								$this->view->generate( '', 'footer.php' );
								
								
								}
								
								
								
				}
			
}


?>
