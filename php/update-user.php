<?php
session_start();
include "dbconn.php";

if (isset($_POST['email']) && isset($_POST['roll']) && isset($_POST['id-up']) ) {

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

$email = validate($_POST['email']);
$roll = validate($_POST['roll']);
$id = validate($_POST['id-up']);

$sql1 = mysqli_query($conn,"SELECT * From `users` WHERE unik_id = $id ;");
$row1 = mysqli_fetch_assoc($sql1);

if($row1['roll'] === $roll || $roll === "Elev" || $roll === "Lärare" || $roll === "Admin"){
    if($row1['email'] === $email){
        header("location: ../database_for_admin.php?error=Du har inte ändrat något");
    }else{
        $sql = mysqli_query($conn,"UPDATE `users` SET email = '$email' WHERE unik_id = $id ;");
        header("location: ../database_for_admin.php?success=Det gick bra och ändra email");
    }
}else{
    if($row1['email'] === $email){
        $sql3 = mysqli_query($conn,"UPDATE `users` SET roll = $roll WHERE unik_id = $id ;");
        header("location: ../database_for_admin.php?success=Det gick bra och ändra roll");
    }else{
        $sql2 = mysqli_query($conn,"UPDATE `users` SET email = '$email' , roll = $roll WHERE unik_id = $id ;");
        header("location: ../database_for_admin.php?success=Det gick bra och ändra email och roll");
    }
}

?>