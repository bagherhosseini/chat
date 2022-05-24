<?php
    session_start();
    include "dbconn.php";
    $offline = "offline";
    $outgoing_id = $_SESSION['unik_id'];
    $sql = "SELECT * FROM users WHERE NOT unik_id = {$_SESSION['unik_id']} ORDER BY user_id DESC";
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "Inga användare finns här";
    }elseif(mysqli_num_rows($query) > 0){
        while($row = mysqli_fetch_assoc($query)){

            $output .= '<a href="chat.php?user_id='. $row['unik_id'] .'">
                        <div class="content"> 
                            <div class="details">
                                <span>'. $row['f_och_enamn'] .'</span>
                            </div>
                        </div>
                        <div class="status-dot '. $offline .'"><i class="fas fa-circle"></i></div>
                    </a>';
        }
    }
    echo $output;
?>