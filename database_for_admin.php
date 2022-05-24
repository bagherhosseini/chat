<!DOCTYPE html>
<?php
session_start();
include_once "dbconn.php";
?>

<html>
<head>
	<title></title> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/darkly/bootstrap.min.css">
</head>
<body>

    <?php
    include "dbconn.php";
    $unik_id_user = $_SESSION['unik_id'];
    
    $sql = mysqli_query($conn,"SELECT * From `users` WHERE unik_id = $unik_id_user ;");
    $row = mysqli_fetch_assoc($sql);
    
    if($row['roll'] >= 1){
    ?>   

    <section class="content">
    <a href="home.php"> <img class="back-icon-db" src="https://cdn.discordapp.com/attachments/500025553915478058/974457794570883072/white-back-icon-back-arrow-icon-white-text-number-symbol-alphabet-transparent-png-2608792-removebg-preview.png" width="43px" height="23px"> </a>
        <div class="message_läggtill">
            <h3>Redigera eller ta bort användarens uppgifter</h3>
            <hr style="height:1px;border-width:0;color:gray;background-color:#797979">
            <h4 class ="info_add_user">Här kan du redigera användarens uppgiter genom att ändra de här nedan och trycka på uppdatera eller ta bort användare genom att trycka på "Ta bort" knappen. </h4>
        </div>

        <?php if (isset($_GET['error'])) { ?>
     		<p class="error-db"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

        <?php if (isset($_GET['success'])) { ?>
     		<p class="success-db"><?php echo $_GET['success']; ?></p>
     	<?php } ?>

        <div class="database_admin">
            <?php 
            $roll="";
            $sql = "select * from users";
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result)) {?>
                <table class="table table-edit-user">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Namn</th>
                            <th scope="col">Roll</th>
                            <th scope="col">Id</th>
                            <th scope="col">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php
                            $i = 0;
                            while($rows = mysqli_fetch_assoc($result)){
                                $i++;
                                if($rows['roll'] == 0){
                                    $roll="Elev";
                                }elseif ($rows['roll'] == 1) {
                                    $roll="Lärare";
                                }elseif ($rows['roll'] == 2){
                                    $roll="Admin";
                                }
                                
                            ?>
                        <tr>
                            <form action="php/update-user.php" method="post">
                                <td> <img class="profilepic_add_db" src="<?=$rows['img'];?>" width="100px" height="100px"> </td>
                                <td> <?=$rows['f_och_enamn']?></td> 
                                <td> 
                                    
                                    <select name="roll" class = "select-roll-db">
                                        <option selected><?=$roll?></option>
                                        <option value = 0 >Elev</option>
                                        <option value = 1 >Lärare</option>
                                        <option value = 2 >Admin</option>
                                    </select>
                                
                                </td>
                                <td> <input type="text" class = "input-id-db" name="id-up" value=<?=$rows['unik_id']?> readonly> </td>
                                <td> <input type="text" class = "input-email-db" name="email" value=<?=$rows['email']?>> </td>
                                <td> <input type="submit" value="Uppdatera" class="btn btn-success"></td>
                                <td> <a href="php/tabort-user.php?id=<?=$rows['unik_id']?>"class="btn btn-danger"> Ta bort </a></td>
                            </form>
                        </tr>
                            <?php 
                            } 
                            ?>
                    </tbody>
                </table>
            <?php } ?>

        </div>

    </section>
    
    <?php
    }else{
        header("location: home.php");
    }
    ?>
</body>
</html>