
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
			
<pre>Login: <?php print_r($content[ 'login' ]); ?></pre>


<?php
  foreach($content[ 'channels' ] as $channel){
echo '<div class="row">
<div class="col-xs-12" style="padding:0 0 10px 15px;"> <a href="'.SITE_URL.'chat/room/'.$channel['id'].'"><button type="button" class="btn btn-default col-xs-10">' .$channel['name']. '</button></a>
</div>

</div>'; 
}
?>


<?php
echo "Page: ";
for($page = 0; $page < ($content[ 'pages' ]*10); $page = $page + 10){

if(empty($page)) echo '<a href="' .SITE_URL. 'chat">1</a> '; 
else echo '<a href="' .SITE_URL. 'chat/' .$page. '">' .(($page/10)+1). '</a> ';
									

}
 ?>
			 
	 
  
 
</section>

		</div>

		<footer></footer>
			</div>
</body>
</html>

