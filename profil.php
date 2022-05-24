<!DOCTYPE html>
<?php 
session_start();
?>
<html>
<head>
	<title></title> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header> 
        <div class="sec-center">
        <div class="back_home_chat">
            <a href="home.php" class="back-icon-profile"> <img src="https://cdn.discordapp.com/attachments/500025553915478058/974457794570883072/white-back-icon-back-arrow-icon-white-text-number-symbol-alphabet-transparent-png-2608792-removebg-preview.png" width="43px" height="23px"> </a>
          </div>
        </div>
    </header>

    <section class="content">
        <div class="gg1">
        <img class="profilepic_sidaprofile" src="<?=$_SESSION['userpic'];?>" width="100px" height="100px"><br>
        <div class= "profileinfo_box">
            <h1>  
                <br>
                Namn : <?php echo $_SESSION['username']; ?><br>
                Email : <?php echo $_SESSION['useremail']; ?><br>
                <?php echo $_SESSION['userhd'];?>
            </h1>
        </div>
        </div>
    </section>
    
</body>
</html> 