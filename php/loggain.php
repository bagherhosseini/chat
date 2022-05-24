<?php
session_start();
include "dbconn.php";

if(isset($_SESSION['username'], $_SESSION['useremail'])){
    //här hämtar jag data från databasen
    $email = $_SESSION['useremail'];
    $username = $_SESSION['username'];
    $unik_id = rand(time(), 10000000);
    $status ="online";
    $img = $_SESSION['userpic'];
    $roll = 0;
    $sql = mysqli_query ($conn, "SELECT * FROM users where email = '$email';");
    

    //här kollar programmet om kontot finns
    if (mysqli_num_rows($sql) > 0){

        $row = mysqli_fetch_assoc($sql);
        $_SESSION['unik_id'] = $row ['unik_id'];

        if(isset($_SESSION['unik_id'])){
            header("Location: ../home.php");
            exit();    
        }
    }else{
        //här lägger jag till användarens data i databasen
        $sql2 = mysqli_query ($conn,"INSERT INTO users( unik_id, f_och_enamn, email, status, roll, img) VALUES( '$unik_id', '$username', '$email', '$status', '$roll', '$img')");
        $result2 = mysqli_query($conn, $sql2);
        $_SESSION['unik_id'] = $row ['unik_id'];
        header("Location: ../home.php");
        exit();
    }
}
else{
    $erorr = json_decode(file_get_contents("./test.json"),true);
    $location = "Location: ../index.php?error=".$erorr["dw"];

    header($location);
    exit();
}
?>¨´