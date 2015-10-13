
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
			
<pre>Login: <?php print_r($content[ 'login' ]); ?></pre>
 <section class="col-xs-12">
<form action="channels" method="POST">
  <div class="form-group">
    <label for="exampleInputChannel1">Add channel</label>
    <input type="text" class="form-control" id="exampleInputChannelNamel2" name="ChannelName" placeholder="Channel name">
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>
 </section>

<?php
  foreach($content[ 'channels' ] as $channel){
echo '<div class="row">
<div class="col-xs-9"><pre>Channel name: ' .$channel['name']. '</pre></div>
<div>
<a href="'.SITE_URL.'admin/editchannel/'.$channel['id'].'"><button type="button" class="btn btn-default">Edit name</button></a>
<a href="'.SITE_URL.'admin/dellchannel/'.$channel['id'].'"><button type="button" class="btn btn-danger">Delete</button></a>
</div>
</div>'; 
}
?>


<?php
echo "Page: ";
for($page = 0; $page < ($content[ 'pages' ]*10); $page = $page + 10){

if(empty($page)) echo '<a href="' .SITE_URL. 'admin/channels">1</a> '; 
else echo '<a href="' .SITE_URL. 'admin/channels/' .$page. '">' .(($page/10)+1). '</a> ';
									

}
 ?>
			 
	 
  
 
</section>

		</div>

		<footer></footer>
			</div>
</body>
</html>



