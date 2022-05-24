<?php 
  session_start();
  include_once "dbconn.php";
  if(!isset($_SESSION['unik_id'])){
    header("location: index.php");
  }
  $unik_id_user = $_SESSION['unik_id'];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<html>
<body>
<div class="wave2"></div>
  <section class= "conntent">
    <div class="wrapper">
      <section class="chat-area">
        <header>
          <?php 
            $klass_id = mysqli_real_escape_string($conn, $_GET['klass_id']);
            $sql = mysqli_query($conn, "SELECT * FROM klass WHERE klass_id = {$klass_id}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
              $_SESSION['$klass_id'] = $klass_id;
            }else{
              echo "Error creating table: " . mysqli_error($conn);
            }
          ?>
          <div class="back_home_chat">
            <p class="title-grupp-chat"><?=$row['title']?></p>
            <a href="home.php" class="back-icon"> <img src="https://cdn.discordapp.com/attachments/500025553915478058/974457794570883072/white-back-icon-back-arrow-icon-white-text-number-symbol-alphabet-transparent-png-2608792-removebg-preview.png" width="43px" height="23px"> </a>
          </div>

        </header>
        <div class="chat-box">
        </div>
            <form action="#" class="typing-area">
              <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $klass_id; ?>" hidden>
              <input type="text" class="input-field" name="message" placeholder="Skriv i <?=$row['title']?>" autocomplete="off">
              <button><i class="fab fa-telegram-plane"></i></button>
            </form>
        </section>
          <div id="layout">
            <a href="#menu" id="menuLink" class="menu-link"><i class="fas fa-bars" style="font-size:20px;" ></i></a>

            <div id="menu">
              <p class ="roll_sidabr-text">Medlemmar</p>
              <hr style="height:1px;border-width:0;color:gray;background-color:#797979">
              <p class ="roll_chat"><strong>• Lärare och Moderator</strong></p>
              <ul>
                <?php
                  $sql1 = mysqli_query($conn,"SELECT * FROM `klass_users` WHERE users_klass_id = $klass_id ");
                  $i = 0;
                  while($row1 = mysqli_fetch_assoc($sql1)){
                    $i++;
                    $user_unik_id = $row1['users_unik_id'];
                    $sql2 = mysqli_query($conn,"SELECT * FROM `users` WHERE unik_id = $user_unik_id ");
                    $row2 = mysqli_fetch_assoc($sql2);
                    if($row2['roll'] >= 1){
                  ?>
                  <div class= "hover_chat">
                      <div class="discussion message-active">
                          <div class="desc-contact">
                            <label><img class="profilepic_chat" src= <?=$row2['img']?> width="50px" height="50px"></label>
                            <?php
                            if($user_unik_id == $unik_id_user){
                            ?>
                              <p class="name"><?=$row2['f_och_enamn']?></p>
                            <?php }else{ ?>
                              <p class="name"><?=$row2['f_och_enamn']?>
                              <a href="chat.php?user_id=<?=$row2['unik_id'] ?>" class = "ban_user_chat"><i class='far fa-comment-alt' style='font-size:20px;color:white'></i></a></p>
                            <?php
                            }
                            ?>
                          </div>
                      </div>
                  </div>
                  <?php 
                    }
                  }
                ?>
              </ul>

              <?php
              $sql3 = mysqli_query($conn,"SELECT * FROM `users` WHERE unik_id = $unik_id_user");
              $row3 = mysqli_fetch_assoc($sql3);
              if($row3['roll'] >= 1){
              ?>
                <hr style="height:1px;border-width:0;color:gray;background-color:#797979">
                <p class ="roll_chat"><strong>• Elever</strong></p>
                <ul>
                  <?php
                    $sql1 = mysqli_query($conn,"SELECT * FROM `klass_users` WHERE users_klass_id = $klass_id ");            
                    $i = 0;
                    while($row1 = mysqli_fetch_assoc($sql1)){
                      $i++;
                      $user_unik_id = $row1['users_unik_id'];
                      $sql2 = mysqli_query($conn,"SELECT * FROM `users` WHERE unik_id = $user_unik_id ");
                      $row2 = mysqli_fetch_assoc($sql2);
                      if($row2['roll'] < 1){
                    ?>
                    <div class= "hover_chat">
                        <div class="discussion message-active">
                            <div class="desc-contact">
                              <label><img class="profilepic_chat" src= <?=$row2['img']?> width="50px" height="50px"></label>
                              <?php
                                if($user_unik_id == $unik_id_user){
                                ?>
                                  <p class="name"><?=$row2['f_och_enamn']?></p>
                                <?php }else{ ?>
                                  <p class="name"><?=$row2['f_och_enamn']?>
                                  <a href="php/tabort.php?user_id=<?=$row2['unik_id']?>&klass_id=<?=$klass_id?>" class = "ban_user_chat"><img src="https://cdn.discordapp.com/attachments/500025553915478058/955229895196291092/4756541.png" alt="ban_icon" width="20px" height="20px"></a>
                                  <a href="chat.php?user_id=<?=$row2['unik_id'] ?>" class = ""><i class='far fa-comment-alt' style='font-size:20px;color:white;float:right;'></i></a></p>
                                <?php
                                }
                              ?>
                            </div>
                        </div>
                    </div>
                    
                    <?php 
                      }
                    }
                  ?>
                </ul>
              <?php
              }else{
              ?>
              <hr style="height:1px;border-width:0;color:gray;background-color:#797979">
                <p class ="roll_chat"><strong>• Elever</strong></p>
                <ul>
                  <?php
                    $sql1 = mysqli_query($conn,"SELECT * FROM `klass_users` WHERE users_klass_id = $klass_id ");            
                    $i = 0;
                    while($row1 = mysqli_fetch_assoc($sql1)){
                      $i++;
                      $user_unik_id = $row1['users_unik_id'];
                      $sql2 = mysqli_query($conn,"SELECT * FROM `users` WHERE unik_id = $user_unik_id ");
                      $row2 = mysqli_fetch_assoc($sql2);
                      if($row2['roll'] < 1){
                    ?>
                    <div class= "hover_chat">
                        <div class="discussion message-active">
                            <div class="desc-contact">
                              <label><img class="profilepic_chat" src= <?=$row2['img']?> width="50px" height="50px"></label>
                              <?php
                                if($user_unik_id == $unik_id_user){
                                ?>
                                  <p class="name"><?=$row2['f_och_enamn']?></p>
                                <?php }else{ ?>
                                  <p class="name"><?=$row2['f_och_enamn']?>
                              <a href="chat.php?user_id=<?=$row2['unik_id'] ?>" class = "ban_user_chat"><i class='far fa-comment-alt' style='font-size:20px;color:white'></i></a></p>
                                <?php
                                }
                              ?>
                            </div>
                        </div>
                    </div>
                    
                    <?php 
                      }
                    }
                  ?>
                </ul>

              <?php
              }
              ?>
            </div>
            
          </div>
          <script src="javascript/sidebar.js"></script>

        </div>
      </div>
    </div>
    <script src="javascript/chat.js"></script>
  </section>
  
</body>
</html>