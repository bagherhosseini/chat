<?php 
    session_start();
    if(isset($_SESSION['unik_id'])){
        include "dbconn.php";
        $outgoing_id = $_SESSION['unik_id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $output = "";
        $sql1 = "SELECT * FROM meddelande WHERE (utgaende_msg_id = {$outgoing_id} AND inkommande_msg_id = {$incoming_id})
        OR (utgaende_msg_id = {$incoming_id} AND inkommande_msg_id = {$outgoing_id}) ORDER BY msg_id";
        
        $query1 = mysqli_query($conn, $sql1);
        $row1 = mysqli_fetch_assoc($query1);
        
        if(mysqli_num_rows($query1) > 0){
            if(isset($_SESSION['$user_id'])){
                if($_SESSION['$user_id']=== $incoming_id){
                    //det här är chat för en och en
                    $sql = "SELECT * FROM meddelande LEFT JOIN users ON users.unik_id = meddelande.utgaende_msg_id
                    WHERE (utgaende_msg_id = {$outgoing_id} AND inkommande_msg_id = {$incoming_id}) OR (utgaende_msg_id = {$incoming_id} AND inkommande_msg_id = {$outgoing_id}) ORDER BY msg_id";
                    $query = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($query) > 0){
                        while($row = mysqli_fetch_assoc($query)){
                            if($row['utgaende_msg_id'] === $outgoing_id){
                                $output .= '<div class="chat outgoing">
                                                <div class="details">
                                                    <label><img class="profilepic_chat" src="'. $row['user_pic'] .'" width="50px" height="50px"></label>
                                                    <p class="user_namn_chat"><strong> '. $row['user_namn'] .'</strong> <small class="lowopacity_text_chat"> '. $row['tid'] .' </small> </p>
                                                    <a class="tabort_msg_chat" href="php/remove_msg_1.php?msg_id='. $row['msg_id'] .'"><img src="https://cdn4.iconfinder.com/data/icons/social-messaging-ui-coloricon-1/21/52-512.png" alt="tabortbild" width="25" height="25"></a>
                                                    <p class="msg_chat_style">'. $row['msg'] .'</p>
                                                    <hr style="height:1px;border-width:0;color:gray;background-color:black">
                                                </div>
                                            </div>';
                            }else{
                                $output .= '<div class="chat incoming">
                                                <div class="details">
                                                    <label><img class="profilepic_chat" src="'. $row['user_pic'] .'" width="50px" height="50px"></label>
                                                    <p class="user_namn_chat"><strong> '. $row['user_namn'] .'</strong> <small class="lowopacity_text_chat"> '. $row['tid'] .' </small> </p>
                                                    <p class="msg_chat_style">'. $row['msg'] .'</p>
                                                    <hr style="height:1px;border-width:0;color:gray;background-color:black">
                                                </div>
                                            </div>';
                            }
                        }
                    }else{
                        $output .= '<div class="text">Inga meddelanden är tillgängliga. När du skickar meddelande kommer de att visas här.</div>';
                    }
                }
            }elseif(isset($_SESSION['$klass_id'])){
                //det här är chat för grupp
                $sql2 = "SELECT * FROM meddelande LEFT JOIN klass ON klass.klass_id = meddelande.inkommande_msg_id WHERE (inkommande_msg_id = {$incoming_id}) OR (utgaende_msg_id = {$incoming_id}) ORDER BY msg_id";
                $query2 = mysqli_query($conn, $sql2);
                if(mysqli_num_rows($query2) > 0){
                        while($row2 = mysqli_fetch_assoc($query2)){
                            if($row2['utgaende_msg_id'] == $outgoing_id){
                                $output .= '<div class="chat outgoing">
                                                <div class="details">
                                                    <label><img class="profilepic_chat" src="'. $row2['user_pic'] .'" width="50px" height="50px"></label>
                                                    <p class="user_namn_chat"><strong> '. $row2['user_namn'] .'</strong> <small class="lowopacity_text_chat"> '. $row2['tid'] .' </small> </p>
                                                    <a class="tabort_msg_chat" href="php/remove_msg.php?msg_id='. $row2['msg_id'] .'"><img src="https://cdn4.iconfinder.com/data/icons/social-messaging-ui-coloricon-1/21/52-512.png" alt="tabortbild" width="25" height="25"></a>
                                                    <p class="msg_chat_style">'. $row2['msg'] .'</p>
                                                    <hr style="height:1px;border-width:0;color:gray;background-color:black">
                                                </div>
                                            </div>';
                            }else{
                                $sql3 = "SELECT * FROM users WHERE unik_id = $outgoing_id";
                                $query3 = mysqli_query($conn, $sql3);
                                $row3 = mysqli_fetch_assoc($query3);
                                if($row3['roll'] >= 1){
                                    $output .= '<div class="chat incoming">
                                                <div class="details">
                                                    <label><img class="profilepic_chat" src="'. $row2['user_pic'] .'" width="50px" height="50px"></label>
                                                    <p class="user_namn_chat"><strong> '. $row2['user_namn'] .'</strong> <small class="lowopacity_text_chat"> '. $row2['tid'] .' </small> </p>
                                                    <a class="tabort_msg_chat" href="php/remove_msg.php?msg_id='. $row2['msg_id'] .'"><img src="https://cdn4.iconfinder.com/data/icons/social-messaging-ui-coloricon-1/21/52-512.png" alt="tabortbild" width="25" height="25"></a>
                                                    <p class="msg_chat_style">'. $row2['msg'] .'</p>
                                                    <hr style="height:1px;border-width:0;color:gray;background-color:black">
                                                </div>
                                            </div>';
                                }else{
                                    $output .= '<div class="chat incoming">
                                                <div class="details">
                                                    <label><img class="profilepic_chat" src="'. $row2['user_pic'] .'" width="50px" height="50px"></label>
                                                    <p class="user_namn_chat"><strong> '. $row2['user_namn'] .'</strong> <small class="lowopacity_text_chat"> '. $row2['tid'] .' </small> </p>
                                                    <p class="msg_chat_style">'. $row2['msg'] .'</p>
                                                    <hr style="height:1px;border-width:0;color:gray;background-color:black">
                                                </div>
                                            </div>';
                                }
                                
                            }
                        }
                }else{
                    $output .= '<div class="text">Inga meddelanden är tillgängliga. När du skickar meddelande kommer de att visas här.</div>';
                }

            }
            
        }else{
            $output .= '<div class="text">Inga meddelanden är tillgängliga. När du skickar meddelande kommer de att visas här.</div>';
        }
        

        echo $output;
    }else{
        header("location: ../index.php");
    }

?>