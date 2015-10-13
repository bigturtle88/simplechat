
<body>

<div class="container-fluid col-xs-8 col-md-offset-2">

<header><a href="<?php echo SITE_URL;?>"><img id="logo" src="<?php echo SITE_URL;?>application/views/img/logo.jpg" alt="Whitesquare logo"></a>
	

	</header>

	
	 	 <nav class="navbar navbar-default">

<ul class="nav navbar-nav">
<li><a href="<?php echo SITE_URL;?>admin" style="color:red;">Admin</a> </li> 
  <li><a href="<?php echo SITE_URL;?>">Home</a> </li> 
 <li><a href="<?php echo SITE_URL;?>edit">Edit</a></li> 
 <li><a href="<?php echo SITE_URL;?>admin/users">Users</a></li> 
 <li><a href="<?php echo SITE_URL;?>admin/channels">Channels</a></li>
 <li><a href="<?php echo SITE_URL;?>admin/chat">Chat</a></li>
 <li><a href="<?php echo SITE_URL;?>main/exit">Exit</a></li>
 <ul>
	 </nav>
<div class="heading"></div>
	<div class="row">
		
		 <section class="col-xs-12">	
			
<pre>Login: <?php echo $content[ 'login' ]  ?></pre>
 <section class="col-xs-12">
<form method="POST">
  <div class="form-group">
    <label for="exampleInputChannel1">Message</label>
    <input type="text" class="form-control" id="exampleInputChannelNamel2" name="message" placeholder="Text">
  </div>
  <button type="submit" class="btn btn-default">Send</button>
</form>
 </section>
 <div class="row"><div class="col-xs-9">
<pre>
<?php
  foreach($content[ 'messages' ] as $message){
echo '<p>'.substr($message['date'],11,8).' '.$message['login'].': ' .$message['text'].' <a href="'. SITE_URL.'admin/editmessage/'.$message['id'].'" style="red">Edit</a> <a href="'.SITE_URL.'admin/dellmessage/'.$message['id'].'" style="red">Dell</a></p>';


 
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



