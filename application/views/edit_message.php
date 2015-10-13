
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
			

 <section class="col-xs-12">
<form   method="POST" action="<?php echo SITE_URL.'admin/savemessage/'.$content['id'] ?>">
  <div class="form-group">
    <label for="exampleInputChannel1">Edit message</label>
    <input type="text" class="form-control" name="message" id="exampleInputMessage2"  placeholder="message" value="<?php echo $content[ 'text']; ?>">
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>
 </section>





			 
	 
  
 
</section>

		</div>

		<footer></footer>
			</div>
</body>
</html>



