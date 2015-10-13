<?php
session_start();
unset($_SESSION['valid_user']);
session_destroy();
require_once ('head.php');
$title = "Выход";
?>
<body>
<div class="wrapper">

	<header class="header">
	</header><!-- .header-->

	<div class="middle">
		<div class="container">
			<main class="content"> <a href="index.php">Главная</a><p>
			Вы вышли</main><!-- .content -->
		</div><!-- .container-->
		<aside class="left-sidebar"></aside><!-- .left-sidebar -->

		<aside class="right-sidebar">
		</aside><!-- .right-sidebar -->

	</div><!-- .middle-->

<?php 


require_once ('footer.php'); ?>
