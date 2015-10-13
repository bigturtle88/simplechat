
<body>

<div class="container-fluid col-md-8 col-md-offset-2">


	<header><a href="<?php echo SITE_URL;?>"><img id="logo" src="<?php echo SITE_URL;?>application/views/img/logo.jpg" alt="Whitesquare logo"></a>
	

	</header>
	
	<nav class="navbar navbar-default">
	   <ul class="nav navbar-nav">
	 <li><a href="<?php echo SITE_URL;?>">Home</a> </li>
	  <li> <a href="<?php echo SITE_URL.'registration';?>">Sign up</a></li>
	  
	   <ul>
	 </nav>
<div class="heading">


<h3> <span class="label label-danger"><?php echo $content['error'];?></span></h3></div>
	<div class="row">
		
			<aside class="col-md-17"></aside>
			
		

 <section class="col-md-4">
 


			
 <form action="admin" method="POST">
  <div class="form-group">
    <label for="exampleInputLogin1">Login</label>
    <input type="text" class="form-control"  name="login" id="exampleInputLogin1" placeholder="Login"  value="">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="userpass"  id="exampleInputPassword1" placeholder="Password" value="">
  </div>
   <button type="submit" class="btn btn-default">Submit</button>
</form>
 


</section>
	</div><div>




