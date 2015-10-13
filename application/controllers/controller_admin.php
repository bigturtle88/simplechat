<?php
require_once("application/models/model_user.php");
require_once("application/helpers/helper_validation.php");
require_once("application/helpers/helper_security.php");
require_once("application/languages/eng.php");
class Controller_admin extends Controller
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
								$data[ 'title' ] = 'Simple chat';
								
						isset($_REQUEST[ 'login' ])?$login = $this->security->filter($_REQUEST[ 'login' ]):$login = NULL;
						isset($_REQUEST[ 'userpass' ])?$userpass = $this->security->filter($_REQUEST[ 'userpass' ]):$userpass = NULL;
						isset($_SESSION[ 'valid_user' ])?$session = $this->security->filter_session($_SESSION[ 'valid_user' ]):$session =  NULL;
						
								if ( !is_null($session)) {
												
												if ( ($this->model->validation_user($session['id'],$session['key']) == true) and ($this->model->validation_admin($session['id']) == true) ) {
														
														$data = $this->model->usprint($session['id']);
																					
																		
											
												
												
														$this->view->generate( $data,  'head.php' );
														$this->view->generate( $data , 'admin.php' );
														$this->view->generate('', 'footer.php' );
												}
												
										else {
																
																$data['url'] = SITE_URL;
																$this->view->generate( $data, 'redirect.php' );
												}
								
								
								
								
								} 
								else {
												if ( !is_null( $login ) or !is_null( $userpass ) ) {
												
																				
																if ( $this->model->in_admin( $login, $userpass ) == true ) {
																				
																				
																				$session = $this->model->idkey( $login ); 
																				unset( $_SESSION[ 'valid_user' ] );
																				$_SESSION[ 'valid_user' ] = $session; 
																				$data = $this->model->usprint( $session['id']);
																				
																				$this->view->generate( $data, 'head.php' );
																				$this->view->generate($data, 'admin.php' );
																				$this->view->generate( '', 'footer.php' );
																} 
																else {
																				$data[ 'error' ] = ERROR_LOGIN_OR_PASS;
																				$this->view->generate( $data, 'head.php' );
																				$this->view->generate( $data, 'index_admin.php' );
																}
												} 
												else {
																$this->view->generate( $data, 'head.php' );
																$this->view->generate( $data, 'index_admin.php' );
																$this->view->generate( '', 'footer.php' );
												}
								}
				}
				
				public function action_users($page) 
				{
								
						isset($page)?$page = (int)$page:$page = 0;
					
						is_numeric($page)?$page = $page:$page =  0;
						
						
								$data[ 'title' ] = 'Users';
								
								isset($_SESSION[ 'valid_user' ])?$session = $this->security->filter_session($_SESSION[ 'valid_user' ]):$session =  NULL;
								
								
								
								if ( !is_null($session)) {
												
												if ( ($this->model->validation_user($session['id'],$session['key']) == true) and ($this->model->validation_admin($session['id']) == true) ) {
														
														$data = $this->model->usprint($session['id']);
																					
																		
											
										
											
													$data['users'] = $this->model->all_users($page);
													if(is_null($data['users'])) $data['users'] = array();
													
													$count_users = $this->model->count_users();
													
												 	$data['pages'] = ceil($count_users['count_users']/10);
													 
														$this->view->generate( $data,  'head.php' );
														$this->view->generate( $data , 'users.php' );
														$this->view->generate('', 'footer.php' );
												}
												
								} 
									else {
																$this->view->generate( $data, 'head.php' );
																$this->view->generate( $data, 'index_admin.php' );
																$this->view->generate( '', 'footer.php' );
												}
																
				}
				public function action_channels($page)
				{
				isset($page)?$page = (int)$page:$page = 0;
					
						is_numeric($page)?$page = $page:$page =  0;
						
						$data[ 'title' ] = 'Channels';
						
				isset($_REQUEST[ 'ChannelName' ])?$ChannelName = $this->security->filter($_REQUEST[ 'ChannelName' ]):$ChannelName = NULL;
				
				isset($_SESSION[ 'valid_user' ])?$session = $this->security->filter_session($_SESSION[ 'valid_user' ]):$session =  NULL;
								
				if ( !is_null($session)) {
												
												if ( ($this->model->validation_user($session['id'],$session['key']) == true) and ($this->model->validation_admin($session['id']) == true) ) {
														
														$data = $this->model->usprint($session['id']);
																					
														
												if(!is_null($ChannelName)){
												$this->model->add_channels($ChannelName);
												
												}


														
											
										
											
													$data['channels'] = $this->model->all_channels($page);
													if(is_null($data['channels'])) $data['channels'] = array();
													
													$count_channels = $this->model->count_channels();
													
												 	$data['pages'] = ceil($count_channels['count_channels']/10);
													 
														$this->view->generate( $data,  'head.php' );
														$this->view->generate( $data , 'channels.php' );
														$this->view->generate('', 'footer.php' );
												}
												
								} 
									else {
																$this->view->generate( $data, 'head.php' );
																$this->view->generate( $data, 'index_admin.php' );
																$this->view->generate( '', 'footer.php' );
												}
				
				
				
				}
				public function action_dellchannel($id)
				{
			
				isset($id)?$id = (int)$id:$id = NULL;
				is_numeric($id)?$id = $id:$id =   NULL;
				
								isset($_SESSION[ 'valid_user' ])?$session = $this->security->filter_session($_SESSION[ 'valid_user' ]):$session =  NULL;		 
				$data[ 'title' ] = 'Dell channel';
						
												
				if ( !is_null($session)) {
												
												if ( ($this->model->validation_user($session['id'],$session['key']) == true) and ($this->model->validation_admin($session['id']) == true) ) {
														
														$data = $this->model->usprint($session['id']);
																					
														
												if(!is_null($id)){
													
												$this->model->dell_channel($id);
												
												
												
												}


																$data['url'] = SITE_URL.'admin/channels/';
																$this->view->generate( $data, 'redirect.php' );
																
														
											
										
											
												}
												
								} 
									else {
																$this->view->generate( $data, 'head.php' );
																$this->view->generate( $data, 'index_admin.php' );
																$this->view->generate( '', 'footer.php' );
												}
				
				
				
				}
				public function action_editchannel($id)
				{
			
				isset($id)?$id = (int)$id:$id = NULL;
				is_numeric($id)?$id = $id:$id =   NULL;
				
								isset($_SESSION[ 'valid_user' ])?$session = $this->security->filter_session($_SESSION[ 'valid_user' ]):$session =  NULL;		 
				
								isset($_REQUEST[ 'name' ])?$name = $this->security->filter($_REQUEST[ 'name' ]):$name  = NULL;
				
				$data[ 'title' ] = 'Edit channel';
						
												
				if ( !is_null($session)) {
												
												if ( ($this->model->validation_user($session['id'],$session['key']) == true) and ($this->model->validation_admin($session['id']) == true) ) {
														
														$data = $this->model->usprint($session['id']);
																					
														
												if(!is_null($id) and !is_null($name) and $this->model->valid_channel( $id) == true){
													
												$this->model->edit_channel($id,$name);
												
												
																$data['url'] = SITE_URL.'admin/channels/';
																$this->view->generate( $data, 'redirect.php' );
												
												}
												elseif (!is_null($id) and is_null($name) and $this->model->valid_channel( $id) == true ){
												
													$data = $this->model->name_channel($id);
												
													$this->view->generate( $data, 'head.php' );
													$this->view->generate( $data, 'edit_channel.php' );
													$this->view->generate( '', 'footer.php' );
												}
												else{
																
																$data['url'] = SITE_URL.'admin/channels/';
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
				public function action_chat($page)
				{
			
				isset($page)?$page = (int)$page:$page = 0;
				is_numeric($page)?$page = $page:$page =  0;
				
				isset($_SESSION[ 'valid_user' ])?$session = $this->security->filter_session($_SESSION[ 'valid_user' ]):$session =  NULL;		 
				
								
				
				$data[ 'title' ] = 'Edit channel';
						
												
				if ( !is_null($session)) {
												
												if ( ($this->model->validation_user($session['id'],$session['key']) == true) and ($this->model->validation_admin($session['id']) == true) ) {
														
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
													
													$this->view->generate( $data, 'head.php' );
													$this->view->generate( $data, 'channels_chat.php' );
													$this->view->generate( '', 'footer.php' );
												}
												else{
																
																$data['url'] = SITE_URL.'admin/chat/';
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
				public function action_room($id)
				{
				isset($id)?$id = (int)$id:$id = 0;
				is_numeric($id)?$id = $id:$id =  0;
				isset($_SESSION[ 'valid_user' ])?$session = $this->security->filter_session($_SESSION[ 'valid_user' ]):$session =  NULL;		 
				$data[ 'title' ] = 'Room';
				isset($_REQUEST[ 'message' ])?$message = $this->security->filter($_REQUEST[ 'message' ]):$message  = NULL;
				
if ( !is_null($session)) {
												
												if ( ($this->model->validation_user($session['id'],$session['key']) == true) and ($this->model->validation_admin($session['id']) == true) ) {
														
														$data = $this->model->usprint($session['id']);
																					
														
												if(is_null($id)){
													
												
												
												
																$data['url'] = SITE_URL.'admin/chat/';
																$this->view->generate( $data, 'redirect.php' );
												
												}
												elseif (!is_null($id)){
												
												
												if(!is_null($message)){
												$this->model->add_message($session['id'],$id,$message);
												
												}
													$data['messages'] = $this->model->all_messages($id,$session['id']);
												 //var_dump($data);die();
												 if(is_null($data['messages'])){$data['messages'] = array();}
													$data['url'] = SITE_URL.'admin/room/'.$id;
													$this->view->generate( $data, 'head.php' );
													$this->view->generate( $data, 'room_admin.php' );
													$this->view->generate( '', 'footer.php' );
												}
												else{
																
																$data['url'] = SITE_URL.'admin/chat/';
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
				public function action_dellmessage($id)
				{
				isset($id)?$id = (int)$id:$id = 0;
				is_numeric($id)?$id = $id:$id =  0;
				isset($_SESSION[ 'valid_user' ])?$session = $this->security->filter_session($_SESSION[ 'valid_user' ]):$session =  NULL;		 
				$data[ 'title' ] = 'Room';
				isset($_REQUEST[ 'message' ])?$message = $this->security->filter($_REQUEST[ 'message' ]):$message  = NULL;
				
if ( !is_null($session)) {
												
												if ( ($this->model->validation_user($session['id'],$session['key']) == true) and ($this->model->validation_admin($session['id']) == true) ) {
														
														$data = $this->model->usprint($session['id']);
																					
														
												if(is_null($id)){
													
												
												
												
																$data['url'] = SITE_URL.'admin/chat/';
																$this->view->generate( $data, 'redirect.php' );
												
												}
												elseif (!is_null($id)){
												
												$data =	$this->model->dell_message($id);
													//	var_dump($data[0]['channel']);die();
												
												
													
												
											
													$data['url'] = SITE_URL.'admin/room/'.$data['channel'];
											
															//var_dump($data);die();
													$this->view->generate( $data, 'head.php' );
													$this->view->generate( $data, 'redirect.php' );
													$this->view->generate( '', 'footer.php' );
												}
												else{
																
																$data['url'] = SITE_URL.'admin/chat/';
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
				

				public function action_editmessage($id)
				{
				isset($id)?$id = (int)$id:$id = 0;
				is_numeric($id)?$id = $id:$id =  0;
				
				isset($_SESSION[ 'valid_user' ])?$session = $this->security->filter_session($_SESSION[ 'valid_user' ]):$session =  NULL;		 
				$data[ 'title' ] = 'Room';
				isset($_REQUEST[ 'message' ])?$message = $this->security->filter($_REQUEST[ 'message' ]):$message  = NULL;
				
if ( !is_null($session)) {
												
												if ( ($this->model->validation_user($session['id'],$session['key']) == true) and ($this->model->validation_admin($session['id']) == true) ) {
														
														$data = $this->model->usprint($session['id']);
																					
														
												if(is_null($id)){
													
												
												
												
																$data['url'] = SITE_URL.'admin/chat/';
																$this->view->generate( $data, 'redirect.php' );
												
												}
												elseif (!is_null($id)){
												
												$data =	$this->model->message($id);
													 
												
									 
												
											
												//	$data['url'] = SITE_URL.'admin/room/'.$data['channel'];
											
													
													$this->view->generate( $data, 'head.php' );
													$this->view->generate( $data, 'edit_message.php' );
													$this->view->generate( '', 'footer.php' );
												}
												else{
																
																$data['url'] = SITE_URL.'admin/chat/';
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
				public function action_savemessage($id)
				{
				isset($id)?$id = (int)$id:$id = 0;
				is_numeric($id)?$id = $id:$id =  0;
				
				isset($_SESSION[ 'valid_user' ])?$session = $this->security->filter_session($_SESSION[ 'valid_user' ]):$session =  NULL;		 
				$data[ 'title' ] = 'Room';
				isset($_REQUEST[ 'message' ])?$message = $this->security->filter($_REQUEST[ 'message' ]):$message  = NULL;
				
if ( !is_null($session)) {
												
												if ( ($this->model->validation_user($session['id'],$session['key']) == true) and ($this->model->validation_admin($session['id']) == true) ) {
														
														$data = $this->model->usprint($session['id']);
																					
														
												if(is_null($id)){
													
												
												
												
																$data['url'] = SITE_URL.'admin/chat/';
																$this->view->generate( $data, 'redirect.php' );
												
												}
												elseif (!is_null($id) and !is_null($message)){
												
												
												
												$data =	$this->model->save_message($id,$message);
													 
												
									 
												
											
												$data['url'] = SITE_URL.'admin/room/'.$data['channel'];
											
													
													$this->view->generate( $data, 'head.php' );
													$this->view->generate( $data, 'redirect.php' );
													$this->view->generate( '', 'footer.php' );
												}
												else{
																
																$data['url'] = SITE_URL.'admin/chat/';
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
					
				
				public function action_exit() 
				{
								unset( $_SESSION[ 'valid_user' ] );
								session_destroy();
								$this->view->generate( $data, 'head.php' );
								$this->view->generate( '', 'index.php' );
				}
			
}


?>
