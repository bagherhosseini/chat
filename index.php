<!DOCTYPE html>
<html>
<head>
	<title></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="wave2"></div>

<?php 
  if(isset($_SESSION['unik_id'])){
      header("location:home.php");
  }else{
  ?>
  <header>
  </header>

  <section class="content">
      <div class="login_box">
        <h2>LOGGA IN</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <a class = "login_btn" href="php/loggaingoogle.php">
          <span>logga in med google</span>
          <div class="liquid"></div>
        </a>
      </div>
  </section>

<?php }?>

</body>
</html>