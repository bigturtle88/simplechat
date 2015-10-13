<script type="text/javascript" src="<?php echo SITE_URL;?>application/views/js/client.js"></script>

<body>
 
<div class="container-fluid col-xs-8 col-md-offset-2">

<header><a href="<?php echo SITE_URL;?>"><img id="logo" src="<?php echo SITE_URL;?>application/views/img/logo.jpg" alt="Whitesquare logo"></a>
	

	</header>

	
		 <nav class="navbar navbar-default">

<ul class="nav navbar-nav">
 
  <li><a href="<?php echo SITE_URL;?>">Home</a> </li> 
 <li><a href="<?php echo SITE_URL;?>edit">Edit</a></li> 
  
 <li><a href="<?php echo SITE_URL;?>chat">Chat</a></li>
 <li><a href="<?php echo SITE_URL;?>main/exit">Exit</a></li>
 <ul>
	 </nav>
<div class="heading"></div>
	<div class="row">
		
		 <section class="col-xs-12">	
 		
<pre>Login: <?php echo $content[ 'login' ]  ?></pre>
 <section >
<form method="POST" >
  <div class="form-group" class="col-xs-8" >
    <label for="exampleInputChannel1">Message</label>
    <input type="text" class="form-control" id="exampleInputChannelNamel2" name="message" placeholder="Text">
 

 </div>  <div class="form-group col-xs-8">

  <select class="form-control" name="recipient" id="recipient">
 
  <option value="0">For all</option>
 
  <?php   
  foreach($content['room'] as $room){ 

 echo '<option value="'.$room['idInRoom'].'" >'.$room['loginInRoom'].'</option>';
}?>
  
</select> </div>
  <button type="submit" class="btn btn-default">Send</button>
</form>
 </section>
 <div class="row"><div class="col-xs-9">
<pre  class="messages">
<?php
  foreach($content[ 'messages' ] as $message){
echo '<p id="'.$message['id'].'" class="message">'.substr($message['date'],11,8).' '.$message['login'].': ' .$message['text'].'</p>';


 
}
?>
</pre></div>
</div>
 
			 
	 
  
 
</section>

		</div>

		<footer></footer>
			</div>
</body>
</html>



