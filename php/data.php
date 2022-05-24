<?php

while($row = mysqli_fetch_assoc($sql)){

            $output .= '<a href="chat.php?user_id='. $row['unik_id'] .'">
                        <div class="content"> 
                        <div class="details">
                            <span>'. $row['f_och_enamn'] .'</span>
                        </div>
                        </div>
                        <div class="status-dot '. $offline .'"><i class="fas fa-circle"></i></div>
                    </a>';
}
?>