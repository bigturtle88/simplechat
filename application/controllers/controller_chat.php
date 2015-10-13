<?php
require_once("application/models/model_user.php");
require_once("application/helpers/helper_validation.php");
require_once("application/helpers/helper_security.php");
class Controller_chat extends Controller
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
				
				public function action_index($page)
				{
			
				isset($page)?$page = (int)$page:$page = 0;
				is_numeric($page)?$page = $page:$page =  0;
				
				isset($_SESSION[ 'valid_user' ])?$session = $this->security->filter_session($_SESSION[ 'valid_user' ]):$session =  NULL;		 
				
								
				
			
						
												
				if ( !is_null($session)) {
												
												if ($this->model->validation_user($session['id'],$session['key']) == true) {
														
														$data = $this->model->usprint($session['id']);
																					
														
												if(!is_null($id)){
													
												
												$data['channels'] = $this->model->all_channels($page);
												
																$data['url'] = SITE_URL.'admin/chat/';
																$this->view->generate( $data, 'redirect.php' );
												
												}
												elseif (is_null($id)){
												
													$data['channels'] = $this->model->all_channels($page);
												 $data['channels'] = $this->model->all_channels($page);
												 
													if(is_null($data['channels'])) $data['channels'] = array();
													
													$count_channels = $this->model->count_channels();
													
												 	$data['pages'] = ceil($count_channels['count_channels']/10);
														$data[ 'title' ] = 'Chat';
													$this->view->generate( $data, 'head.php' );
													$this->view->generate( $data, 'channels_chat_user.php' );
													$this->view->generate( '', 'footer.php' );
												}
												else{
																
																$data['url'] = SITE_URL.'chat/';
																$this->view->generate( $data, 'redirect.php' );
												
												}


																
																
														
											
										
											
												}
												
								} 
									else {	$data[ 'title' ] = 'Chat';
																$this->view->generate( $data, 'head.php' );
																$this->view->generate( $data, 'index.php' );
																$this->view->generate( '', 'footer.php' );
												}
				
				
				
				}
				public function action_room($id)
				{
		 
				 
				isset($id)?$id = (int)$id:$id = 0;
				is_numeric($id)?$id = $id:$id =  0;
				
				isset($_SESSION[ 'valid_user' ])?$session = $this->security->filter_session($_SESSION[ 'valid_user' ]):$session =  NULL;		 
				$data[ 'title' ] = 'Room';
				
				isset($_REQUEST[ 'message' ])?$message = $this->security->filter($_REQUEST[ 'message' ]):$message  = NULL;
				isset($_REQUEST[ 'recipient' ])?$recipient = $this->security->filter($_REQUEST[ 'recipient' ]):$recipient = 0;
				is_numeric($recipient)?$recipient = $recipient:$recipient =  0;
 
				
						if ( !is_null($session)) {
												
												if ( $this->model->validation_user($session['id'],$session['key']) == true ) {
														
														$data = $this->model->usprint($session['id']);
																					
														
												if(is_null($id)){
													
												
												
												
																$data['url'] = SITE_URL.'chat/';
																$this->view->generate( $data, 'redirect.php' );
												
												}
												elseif (!is_null($id)){
												
												
												if(!is_null($message)){
												$this->model->add_message($session['id'],$id,$message,$recipient);
												
												}
													$data['messages'] = $this->model->all_messages($id,$session['id']);
								 
												 
											
					 
												 if(is_null($data['messages'])){$data['messages'] = array();}
													$data['url'] = SITE_URL.'room/'.$id;
														 $data['room'] = $this->model->room($session['id'],$id);
													$this->view->generate( $data, 'head.php' );
													$this->view->generate( $data, 'room.php' );
													$this->view->generate( '', 'footer.php' );
												}
												else{
																
																$data['url'] = SITE_URL.'chat/';
																$this->view->generate( $data, 'redirect.php' );
												
												}


																
																
														
											
										
											
												}
												
								} 
									else {
																$this->view->generate( $data, 'head.php' );
																$this->view->generate( $data, 'index_admin.php' );
																$this->view->generate( '', 'footer.php' );
												}
				
				
				
				
				}
				
				public function action_room_ajax()
				{
		 
				 
				
				
				isset($_SESSION[ 'valid_user' ])?$session = $this->security->filter_session($_SESSION[ 'valid_user' ]):$session =  NULL;		 
				
				
			
				isset($_REQUEST['message'])?$message = $this->security->filter($_REQUEST[ 'message' ]):$message = NULL;
				
			
				
				
						if ( !is_null($session)) {
												
												if ( $this->model->validation_user($session['id'],$session['key']) == true ) {
														
														 
																
														
												if(is_numeric($message)){
													
												
												  
												$data['messages'] =  $this->model->messages_ajax($session['id'],$message);
												$data['users'] =  $this->model->room_ajax($session['id']);
											
											 
												
												$data = json_encode($data);
											
										
											echo $data;
			 
							
										
										 
															 
												
												}
										


																
																
														
											
										
											
												}
												
								} 
								
				
				
				
				}
				public function action_exit( ) 
				{
								unset( $_SESSION[ 'valid_user' ] );
								session_destroy();
								$this->view->generate( $data, 'head.php' );
								$this->view->generate( '', 'index.php' );
				}
				public function action_registration( )
				{
								$data[ 'title' ] = 'Sign up';
								$this->view->generate( $data, 'head.php' );
								$this->view->generate( '', 'registration.php' );
				}
}


?>
