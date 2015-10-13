<?php
require_once("application/models/model_user.php");
require_once("application/helpers/helper_validation.php");
require_once("application/helpers/helper_security.php");
require_once("application/languages/eng.php");
class Controller_edit extends Controller
{
				public $model;
				public $view;
				public $result;
				public $data = array();
				
				function __construct( )
				{
								$this->view  = new View();
								$this->model = new Model_user();
								$this->validation = new Validation();
								$this->security = new Security();
				}
				public function action_index( )
				{				
								
								
						
						
								
								 isset($_REQUEST[ 'userpass' ])?$userpass = $this->security->filter($_REQUEST[ 'userpass' ]):$userpass = NULL ;
								 isset($_REQUEST[ 'newPass' ])?$newPass   = $this->security->filter($_REQUEST[ 'newPass' ]):$newPass = NULL ;
								 isset($_REQUEST[ 'repeatNewPass' ])?$repeatNewPass  = $this->security->filter($_REQUEST[ 'repeatNewPass' ]):$repeatNewPass = NULL ;
								 isset($_SESSION[ 'valid_user' ])?$session = $this->security->filter_session($_SESSION[ 'valid_user' ]):$session =  NULL;
							
							
							if ( $this->model->validation_user($session['id'],$session['key']) == true ) {
							
												 
														$data = $this->model->usprint($session['id']);
														
														
														
																		 
														if (!is_null($userpass)){
																				$ispass = $this->model->validat_edit_pass($data['id'],$userpass);
																		
																				}
																					
																				
													
														$data =	array_merge($data, $this->validation->validateEditPass($userpass , $newPass, $repeatNewPass, $ispass));
													
													
								if ( $data['result'] == true)  {
								
														$this->model->update($data['id'],$newPass);
														
														$data[ 'title' ] = 'Edit password';
														$data['result'] = EDIT_PASSWORD;
														
														$this->view->generate( $data, 'head.php' );
														$this->view->generate( $data, 'result.php' );
														$this->view->generate('', 'footer.php' );
														
														
														
														}
														
														else {
														
														$data[ 'title' ] = 'Edit password';
														
														$this->view->generate( $data, 'head.php' );
														$this->view->generate( $data, 'edit.php' );
														$this->view->generate('', 'footer.php' );
														
														}
														
														
														
														
														
												
												}					 
							//( $this->model->validation_cookie( $_SESSION[ 'valid_user' ] ) == true ) && isset( $userpass )
								else{
								
												$this->view->generate( $data, 'head.php' );
												$this->view->generate( $data, 'index.php' );
												$this->view->generate('', 'footer.php' );
												
												}
				}
}
?>
