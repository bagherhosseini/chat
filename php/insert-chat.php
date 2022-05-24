<?php 
    session_start();
    if(isset($_SESSION['unik_id'])){
        include_once "dbconn.php";

        $outgoing_id = $_SESSION['unik_id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);

        $sql1 = mysqli_query($conn, "SELECT * FROM users WHERE unik_id = $outgoing_id");
        $row1 = mysqli_fetch_assoc($sql1);

        $img = $row1['img'];
        $namn = $row1['f_och_enamn'];

        if(!empty($message)){
            $sql = mysqli_query($conn, "INSERT INTO meddelande (inkommande_msg_id, utgaende_msg_id, msg, user_pic, user_namn)
            VALUES ({$incoming_id}, {$outgoing_id}, '{$message}', '{$img}', '{$namn}')") or die();
            if ($sql){
                header("Location: ../home.php");
            } else {
                echo "Error creating table: " . mysqli_error($conn);
            }
        }
    }else{
        header("location: ../index.php");
    }


    
?>