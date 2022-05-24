<?php
include "dbconn.php";
session_start();

$skapare_unik_id = $_SESSION['unik_id'];
$klass_id = $_SESSION['klass_id'];
$kategori = $_SESSION['kategori'];

$sql = "SELECT unik_id FROM users";
$result = mysqli_query($conn, $sql);

$AR = array_values($_GET);
$query = "(";
$user_id = 0;

if(!empty($_GET)){
    $nu = count($_GET);
    if($nu >= 1){
        for($i = 0; $i <$nu; $i++){
            $user_id = $AR[$i];
            $num = $nu - 1;
            if($i == $num){
                $query = $query."'".$user_id."', $klass_id, $kategori)";
            }else{
                $query = $query."'".$user_id."', $klass_id, $kategori), (";
            }
        }
    }else{
        $query = $query."'".$AR[0]."')";
    }
    var_dump($query);
    $sql1 = "INSERT INTO `klass_users` (users_unik_id, users_klass_id, Kategori) VALUES $query, ($skapare_unik_id, $klass_id, $kategori) ;";
    $result1 = mysqli_query($conn, $sql1);
    if ($result1){
        header("Location: ../home.php");
    } else {
        echo "Error creating table: " . mysqli_error($conn);
    }

}else{

}



?>