<?php 
  session_start();
  include_once "dbconn.php";
  if(!isset($_SESSION['unik_id'])){
    header("location: index.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
</head>
<html>
<body>
  <div class="wrapper">
    <section class="chat-area">
      <header>
        <?php 
          $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
          $sql = mysqli_query($conn, "SELECT * FROM users WHERE unik_id = {$user_id}");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
            $_SESSION['$user_id'] = $user_id;
          }else{
            echo "Error creating table: " . mysqli_error($conn);
          }
        ?>
        <div class="back_home_chat">
        <a href="php/tillbaka_home.php" class="back-icon"> <img src="https://cdn.discordapp.com/attachments/500025553915478058/974457794570883072/white-back-icon-back-arrow-icon-white-text-number-symbol-alphabet-transparent-png-2608792-removebg-preview.png" width="43px" height="23px"> </a>
        </div>
      </header>
      
      <div class="chat-box">
      </div>
          <form action="#" class="typing-area">
            <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
            <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
            <button><i class="fab fa-telegram-plane"></i></button>
          </form>

          <div id="menu">
              <p class ="roll_sidabr-text">Medlemmar</p>
              <hr style="height:1px;border-width:0;color:gray;background-color:#797979">
              <ul>
                <?php
                  $your_unik_id = $_SESSION['unik_id'];
                  $sql1 = mysqli_query($conn,"SELECT * FROM `users` WHERE unik_id IN ({$user_id} , {$your_unik_id})");
                  $i = 0;
                  while($row1 = mysqli_fetch_assoc($sql1)){
                    $i++;
                  ?>
                  <div class= "hover_chat">
                      <div class="discussion message-active">
                          <div class="desc-contact">
                            <label><img class="profilepic_chat" src= <?=$row1['img']?> width="50px" height="50px"></label>
                            <p class="name"><?=$row1['f_och_enamn']?></p>
                          </div>
                      </div>
                  </div>
                  <?php 
                  }
                ?>
              </ul>
            
          </div>

      </section>
  </div>

  <script src="javascript/chat.js"></script>

</body>
</html>