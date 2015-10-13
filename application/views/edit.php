<body>

<div class="container-fluid col-md-8 col-md-offset-2">


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

<div class="heading"> <h3> <span class="label label-danger"><?php echo $content['error'];?></span></h3></div>
	<div class="row">
	<aside class="col-md-17"></aside>
 <section class="col-md-10">
<pre>Login: <?php echo  $content[ 'login' ]; ?></pre>

	 
	 <form action="edit"  method="POST">
	    <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="userpass"  id="exampleInputPassword1" placeholder="Password">
  </div>
   <div class="form-group">
    <label for="exampleInputPassword2">New password</label>
    <input type="password" class="form-control" name="newPass"  id="exampleInputPassword2" placeholder="New password">
  </div>
   <div class="form-group">
    <label for="exampleInputPassword3">Repeat new password</label>
    <input type="password" class="form-control" name="repeatNewPass"  id="exampleInputPassword3" placeholder="Repeat new password">
  </div>

   <button type="submit" class="btn btn-default">Submit</button>
</form>

  
 
</section>

		</div>

		<footer></footer>
			</div>
</body>
</html>
