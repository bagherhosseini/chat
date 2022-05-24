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
<div class="wave2"></div>
    <header> 
    </header>

    <section class="content">
        <div class="message_läggtill">
            <?php 
            $klass_id = $_SESSION['klass_id']; 
            $sql1 = mysqli_query($conn,"SELECT * FROM `klass` WHERE klass_id = $klass_id");            
            $rows1 = mysqli_fetch_assoc($sql1)
            ?>
            <h3>Lägg till användare i gruppen <?php echo $rows1['title']?> </h3>
            <hr style="height:1px;border-width:0;color:gray;background-color:#797979">
            <h4 class ="info_add_user">Här väljer du vilka personer du vill lägga till i denna grupp</h4>
        </div>
        
        <div class="database_admin">

            <?php 
            if(isset($_SESSION['unik_id'])){
                $roll="";
                $sql = "select * from users";
                $result = mysqli_query($conn, $sql);
                
                if (mysqli_num_rows($result)) {?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"></th>
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

                                    if($rows['unik_id'] !== $_SESSION['unik_id']){
                                ?>
                                <form action="php/add_users_grupp_back.php" method = "get">
                            <tr>
                                <td> 
                                    <label class="container"> 
                                    <input type="checkbox" name = "<?=$rows['f_och_enamn']?>" value = "<?=$rows['unik_id']?>"> 
                                    <span class="checkmark"></span>
                                    </label> 
                                </td>
                                <td> <img class="profilepic_add_db" src="<?=$rows['img'];?>" width="100px" height="100px"></td>
                                <td> <?=$rows['f_och_enamn']?> </td>
                                <td> <?=$roll?> </td>
                                <td> <label name = <?=$rows['unik_id']?>> </label><?=$rows['unik_id']?> </th>
                                <td> <?=$rows['email']?> </td>
                                <td> </td>
                            </tr>
                                <?php
                                    }
                                } 
                                ?>
                        </tbody>
                    </table>
            <?php   }
                }else{
                    header("location: ../home.php");
                } ?>

        </div>

        <button class="submit_btn_addusers" type="submit">Lägg till</button>
        </form>
    
    </section>
    
</body>
</html>