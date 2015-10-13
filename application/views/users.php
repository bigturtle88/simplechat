
<body>

<div class="container-fluid col-md-8 col-md-offset-2">

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
		<aside class="col-md-17"></aside>
		 <section class="col-md-10">	
			
<pre>Login: <?php print_r($content[ 'login' ]); ?></pre>


<?php

  foreach($content[ 'users' ] as $user){
echo "<pre>User: " .$user['login']. "</pre> ";
}

echo "Page: ";
for($page = 0; $page < ($content[ 'pages' ]*10); $page = $page + 10){

if(empty($page)) echo '<a href="' .SITE_URL. 'admin/users">1</a> '; 
else echo '<a href="' .SITE_URL. 'admin/users/' .$page. '">' .(($page/10)+1). '</a> ';
									

}
 ?>
			 
			 
  
 
</section>

		</div>

		<footer></footer>
			</div>
</body>
</html>




