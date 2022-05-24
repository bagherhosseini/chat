<!DOCTYPE html>
<?php 
session_start();
require "dbconn.php";
include "dbconn.php";
?>
<html>
<head>
	<title>home</title> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>    
    <header> 
        <div class="sec-center" onselectstart="return false">
            
            <input class="dropdown" type="checkbox" id="dropdown" name="dropdown"/>
            <label class="label_dropdown" for="dropdown"><img class="pic" src="<?=$_SESSION['userpic'];?>" width="50px" height="50px" ></label>
            <div class="section-dropdown"> 
                <a href="profil.php">Profil<i class="uil uil-arrow-right"></i></a>
                <?php
                    $unik_id_user = $_SESSION['unik_id'];
                    
                    $sql = mysqli_query($conn,"SELECT * From `users` WHERE unik_id = $unik_id_user ;");
                    $row = mysqli_fetch_assoc($sql);
                    
                    if($row['roll'] > 1){
                ?>  
                <a href="database_for_admin.php"> Användare <i class="uil uil-arrow-right"></i></a>
                <?php
                    }
                ?>
                <a href="instruktion.php">Instruktioner <i class="uil uil-arrow-right"></i></a>
                <a href="php/loggaut.php">Logga ut <i class="uil uil-arrow-right"></i></a>
            </div>
            
            <input class="dropdown_add" type="checkbox" id="dropdown_add" name="dropdown_add"/>
            <label class="btn_add" for="dropdown_add"><strong> + </strong></label>
            <div class="for_blur">
            <div class="section-dropdown_add"> 
                <?php 
                $sql = mysqli_query($conn, "SELECT roll FROM users WHERE unik_id = {$_SESSION['unik_id']}");
                if(mysqli_num_rows($sql) > 0){ ?>
                    <?php $row = mysqli_fetch_assoc($sql);
                    $roll = $row['roll']; ?>
                    <?php if($roll > 0){ ?>
                        <div class="konto_box">
                            <h3 class= "text_add">Du är inloggad som</h3>
                            <div class= "info_add_box">
                                <img class="profilepic_add" src="<?=$_SESSION['userpic'];?>" width="100px" height="100px">
                                <label class="info_add" > <?php echo $_SESSION['username']; ?> </label> <br><br>
                                <label class="text_add_email" > <?php echo $_SESSION['useremail']; ?> </label>
                                
                            </div>
                        </div>

                        <form method="post" enctype="multipart/form-data" class="" name="formskapa" action="php/Skapa_grupp_back.php">
                            <div class="create_klass_elev">
                                <div class= add_klass_elev_box>
                                    <h2>Skapa grupp </h2>
                                    <label class="text_add">Välj ett namn för chatgruppen och tryck skapa </label><br><br><br>
                                    <input class = "grupp_input" id="gruppnamn" type="text" onfocus="this.value=''" name="gruppnamn" placeholder="Gruppens namn" autocomplete="off">
                                    <div class = "select_file">
                                        <select name="kategori" id="kategori">
                                            <option selected>Kategori</option>
                                            <option value = 1 >Hjälp</option>
                                            <option value = 2 >Kurser</option>
                                            <option value = 3 >Skolpersonal</option>
                                            <option value = 4 >Nyheter</option>
                                            <option value = 5 >Övriga</option>
                                        </select>
                                        <input type = "file" class ="upload_img" id = "upload_img" name="record_image" accept = "image/*">
                                    </div>
                                    
                                    <button type="submit" class="add_btn_klass" id = "add_btn_klass" disabled>Skapa</button>
                                </div>
                            </div>
                        </form>
                        
                        <form class="" name="formgomed" action="php/go_med.php" method="post">
                            <div class="join_klass_elev">
                                <div class= add_klass_elev_box>
                                    <h2>Kurskod</h2>
                                    <label class="text_add">Du kan få koden från en admin eller lärare </label><br><br><br>
                                    <input class = "grupp_input" id="gruppid" type="text" onfocus="this.value=''" name="gruppid" placeholder="Gruppens kod" autocomplete="off">
                                    <button class="add_btn_klass" type="submit" id = "join_btn_klass" disabled>Gå med</button>
                                </div>
                            </div>
                        </form>
                    <?php }else{ ?>

                        <div class="konto_box">
                        <h3 class= "text_add">Du är inloggad som</h3>
                            <div class= "info_add_box">
                                <img class="profilepic_add" src="<?=$_SESSION['userpic'];?>" width="100px" height="100px">
                                <label class="info_add" > <?php echo $_SESSION['username']; ?> </label> <br><br>
                                <label class="text_add_email" > <?php echo $_SESSION['useremail']; ?> </label>
                            </div>
                        </div>

                        <form class="" name="formgomed" action="php/go_med.php" method="post">
                            <div class="join_klass_elev">
                                <div class= add_klass_elev_box>
                                    <h2>Kurskod</h2>
                                    <label class="text_add">Du kan få koden från en admin eller lärare </label><br><br><br>
                                    <input class = "grupp_input" id="gruppid" type="text" onfocus="this.value=''" name="gruppid" placeholder="Gruppens kod" autocomplete="off">
                                    <button class="add_btn_klass" type="submit" id = "join_btn_klass" disabled>Gå med</button>
                                </div>
                            </div>
                        </form>

                    <?php } ?>

                <?php }else{
                    header("location: index.php");
                } ?>
            </div>
            </div>
        </div>
    </header>




    <section class="content" onselectstart="return false" >
        <div class ="content_hem">
            
            <div class="kategori">
                <div class = "center_kategori">
                    <label for="checkbox_kategori" class="kategori_btn">
                    <span>Hjälp</span>
                    <div class="liquid"></div></label>
                    <input type="radio" class="checkbox_kategori"  name = "checkbox_kategori" id = "checkbox_kategori" checked = "checked">


                    <label for="checkbox_kategori2" class="kategori_btn">
                    <span>Kurser</span>
                    <div class="liquid"></div></label>
                    <input type="radio"  class="checkbox_kategori"  name = "checkbox_kategori" id = "checkbox_kategori2">


                    <label for="checkbox_kategori3" class="kategori_btn">
                    <span>Skolpersonal</span>
                    <div class="liquid"></div></label>
                    <input type="radio"  class="checkbox_kategori"  name = "checkbox_kategori" id = "checkbox_kategori3">


                    <label for="checkbox_kategori4" class="kategori_btn">
                    <span>Nyheter</span>
                    <div class="liquid"></div></label>
                    <input type="radio"  class="checkbox_kategori"  name = "checkbox_kategori" id = "checkbox_kategori4">


                    <label for="checkbox_kategori5" class="kategori_btn">
                    <span>Övriga</span>
                    <div class="liquid"></div></label>
                    <input type="radio"  class="checkbox_kategori"  name = "checkbox_kategori" id = "checkbox_kategori5">

                    
                    
                    <div class="checked_kategori">
                        <ol class= chatroomlist>
                            <?php
                            $user_id_unik = $_SESSION['unik_id'];
                            $sql1 = mysqli_query($conn,"SELECT users_klass_id FROM `klass_users` WHERE users_unik_id = $user_id_unik ");            
                            $i = 0;
                            while($row1 = mysqli_fetch_assoc($sql1)){
                                $i++;
                                $users_klass_id = $row1['users_klass_id'];
                                $sql2 = mysqli_query($conn,"SELECT * FROM `klass` WHERE klass_id = $users_klass_id ");
                                $row2 = mysqli_fetch_assoc($sql2);
                                if ($row2['Kategori'] ==="1"){           
                                ?>
                                    <li class="chatbox"> <img src="<?=$row2['img'];?>" width="180px" height="100px" class = "klass-img" > <a href="chat_grupp.php?klass_id=<?=$row2['klass_id']?>" class = "title_home"> 
                                    <span class="underline-on-hover"><?=$row2['title']?></span> <br> <span class = "kategori-home-chatroom">Hjälp</span></a></li>
                                <?php
                                }
                            }
                            $sql3 = mysqli_query($conn,"SELECT users_klass_id FROM `klass_users` WHERE Kategori = 1 AND users_unik_id = $user_id_unik");
                            if(mysqli_num_rows($sql3) === 0){
                                echo "<p>Det finns inga gruper i detta kategori</p>";
                            }
                            ?>
                        </ol>
                    </div>

                    <div class="checked_kategori2">
                    <ol class= chatroomlist>
                            <?php
                            $user_id_unik = $_SESSION['unik_id'];
                            $sql1 = mysqli_query($conn,"SELECT users_klass_id FROM `klass_users` WHERE users_unik_id = $user_id_unik ");            
                            $i = 0;
                            while($row1 = mysqli_fetch_assoc($sql1)){
                                $i++;
                                $users_klass_id = $row1['users_klass_id'];
                                $sql2 = mysqli_query($conn,"SELECT * FROM `klass` WHERE klass_id = $users_klass_id ");
                                $row2 = mysqli_fetch_assoc($sql2);
                                if($row2['Kategori'] === "2"){           
                            ?>
                                <li class="chatbox"> <img src="<?=$row2['img'];?>" width="180px" height="100px" class = "klass-img" > <a href="chat_grupp.php?klass_id=<?=$row2['klass_id']?>" class = "title_home"> 
                                <span class="underline-on-hover"><?=$row2['title']?></span> <br> <span class = "kategori-home-chatroom">Kurser</span></a></li>
                            <?php
                                }
                            }
                            
                            $sql3 = mysqli_query($conn,"SELECT users_klass_id FROM `klass_users` WHERE Kategori = 2 AND users_unik_id = $user_id_unik");
                            if(mysqli_num_rows($sql3) === 0){
                                echo "<p>Det finns inga gruper i detta kategori</p>";
                            }?>
                        </ol>
                    </div>


                    <div class="checked_kategori3">
                        <ol class= chatroomlist>
                            <?php
                            $user_id_unik = $_SESSION['unik_id'];
                            $sql1 = mysqli_query($conn,"SELECT users_klass_id FROM `klass_users` WHERE users_unik_id = $user_id_unik ");            
                            $i = 0;
                            while($row1 = mysqli_fetch_assoc($sql1)){
                                $i++;
                                $users_klass_id = $row1['users_klass_id'];
                                $sql2 = mysqli_query($conn,"SELECT * FROM `klass` WHERE klass_id = $users_klass_id ");
                                $row2 = mysqli_fetch_assoc($sql2);
                                if($row2['Kategori'] === "3"){           
                            ?>
                                <li class="chatbox"> <img src="<?=$row2['img'];?>" width="180px" height="100px" class = "klass-img" > <a href="chat_grupp.php?klass_id=<?=$row2['klass_id']?>" class = "title_home"> 
                                <span class="underline-on-hover"><?=$row2['title']?></span> <br> <span class = "kategori-home-chatroom">Skolpersonal</span></a></li>
                            <?php
                                }
                            }
                            
                            $sql3 = mysqli_query($conn,"SELECT users_klass_id FROM `klass_users` WHERE Kategori = 3 AND users_unik_id = $user_id_unik");
                            if(mysqli_num_rows($sql3) === 0){
                                echo "<p>Det finns inga gruper i detta kategori</p>";
                            }?>
                        </ol>
                    </div> 

                    <div class="checked_kategori4">
                        <ol class= chatroomlist>
                            <?php
                            $user_id_unik = $_SESSION['unik_id'];
                            $sql1 = mysqli_query($conn,"SELECT users_klass_id FROM `klass_users` WHERE users_unik_id = $user_id_unik ");            
                            $i = 0;
                            while($row1 = mysqli_fetch_assoc($sql1)){
                                $i++;
                                $users_klass_id = $row1['users_klass_id'];
                                $sql2 = mysqli_query($conn,"SELECT * FROM `klass` WHERE klass_id = $users_klass_id ");
                                $row2 = mysqli_fetch_assoc($sql2);
                                if($row2['Kategori'] === "4"){           
                            ?>
                                <li class="chatbox"> <img src="<?=$row2['img'];?>" width="180px" height="100px" class = "klass-img" > <a href="chat_grupp.php?klass_id=<?=$row2['klass_id']?>" class = "title_home"> 
                                <span class="underline-on-hover"><?=$row2['title']?></span> <br> <span class = "kategori-home-chatroom">Nyheter</span></a></li>
                            <?php
                                }
                            }
                            
                            $sql3 = mysqli_query($conn,"SELECT users_klass_id FROM `klass_users` WHERE Kategori = 4 AND users_unik_id = $user_id_unik");
                            if(mysqli_num_rows($sql3) === 0){
                                echo "<p>Det finns inga gruper i detta kategori</p>";
                            }?>
                        </ol>
                    </div>

                    <div class="checked_kategori5">
                        <ol class= chatroomlist>
                            <?php
                            $user_id_unik = $_SESSION['unik_id'];
                            $sql1 = mysqli_query($conn,"SELECT users_klass_id FROM `klass_users` WHERE users_unik_id = $user_id_unik ");            
                            $i = 0;
                            while($row1 = mysqli_fetch_assoc($sql1)){
                                $i++;
                                $users_klass_id = $row1['users_klass_id'];
                                $sql2 = mysqli_query($conn,"SELECT * FROM `klass` WHERE klass_id = $users_klass_id ");
                                $row2 = mysqli_fetch_assoc($sql2);
                                if($row2['Kategori'] === "5"){           
                            ?>
                                <li class="chatbox"> <img src="<?=$row2['img'];?>" width="180px" height="100px" class = "klass-img" > <a href="chat_grupp.php?klass_id=<?=$row2['klass_id']?>" class = "title_home"> 
                                <span class="underline-on-hover"><?=$row2['title']?></span> <br> <span class = "kategori-home-chatroom">Övriga</span></a></li>
                            <?php
                                }
                            }
                            
                            $sql3 = mysqli_query($conn,"SELECT users_klass_id FROM `klass_users` WHERE Kategori = 5 AND users_unik_id = $user_id_unik");
                            if(mysqli_num_rows($sql3) === 0){
                                echo "<p>Det finns inga gruper i detta kategori</p>";
                            }?>
                        </ol>
                    </div>
            
                
            </div>     
        </div>
    </section>
    
    <script src="javascript/add.js"></script>

    <div class="wave2"></div>
</body>
</html>