
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
 <li><a href="<?php echo SITE_URL;?>admin/messages">Messages</a></li>
 <li><a href="<?php echo SITE_URL;?>admin/exit">Exit</a></li>
 <ul>
	 </nav>
<div class="heading"></div>
	<div class="row">
		
		 <section class="col-xs-12">	
			

 <section class="col-xs-12">
<form   method="POST">
  <div class="form-group">
    <label for="exampleInputChannel1">Edit channel</label>
    <input type="text" class="form-control" name="name" id="exampleInputChannelNamel2" name="ChannelName" placeholder="Channelname" value="<?php echo $content[ 'name']; ?>">
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



