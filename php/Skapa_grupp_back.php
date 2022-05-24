<?php
include "dbconn.php";
session_start();

if(isset($_SESSION['unik_id'])){?>
    <?php
    if(isset($_POST['gruppnamn'])){
    ?>

        <?php
            $_SESSION['gruppnamn1'] = $_POST['gruppnamn'];
            $gruppnamn = $_SESSION['gruppnamn1'];

            $_SESSION['kategori'] = $_POST['kategori'];
            $kategori = $_SESSION['kategori'];

            $_SESSION['upload_img'] = $_POST['record_image'];
            $upload_img = $_SESSION['upload_img'];

            $unikid= $_SESSION['unik_id'];

            $klass_id = rand(time(), 10000000);
            $_SESSION['klass_id'] = $klass_id;

            $sql = mysqli_query ($conn,"INSERT INTO klass ( klass_id, title, skapare_id, Kategori, img) VALUES( '$klass_id', '$gruppnamn', '$unikid', '$kategori', '$upload_img')");
            if ($sql) {

                header("location: ../add_users_grupp.php");
                function save_record_image($image,$name = null){
                    $API_KEY = '137758b5a11b73290cc7975092df6faa';
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, 'https://api.imgbb.com/1/upload?key='.$API_KEY);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    $extension = pathinfo($image['name'],PATHINFO_EXTENSION);
                    $file_name = ($name)? $name.'.'.$extension : $image['name'] ;
                    $data = array('image' => base64_encode(file_get_contents($image['tmp_name'])), 'name' => $file_name);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    $result = curl_exec($ch);
                    if (curl_errno($ch)) {
                        return 'Error:' . curl_error($ch);
                    }else{
                        return json_decode($result, true);
                    }
                    curl_close($ch);
                }
                
                if (!empty($_FILES['record_image'])) {
                    $return = save_record_image($_FILES['record_image'],'test');
                    $img_upload = $return['data']['url'];
                    $sql1 = mysqli_query ($conn,"UPDATE klass SET img = '$img_upload' WHERE klass_id = '$klass_id';");
                    if ($sql1) {
                        echo "bilden har skickats till databasen";
                    } else {
                        echo "Error creating table: " . mysqli_error($conn);
                    }
                }
            } else {
                echo "Error creating table: " . mysqli_error($conn);
            }
            mysqli_close($conn);
        ?>
    
    <?php
    }else{
        header("location: ../home.php");
    }
    ?>


    
<?php    
}else{
    header("location: ../index.php");
}
?>
