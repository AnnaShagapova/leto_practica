<?php  
    $result = mysqli_query($connect, "SELECT img_path, name_photo, date_added, download_count FROM photos;");
    while($row = mysqli_fetch_array($result)){
        echo "<div class='card'>
                <img src='".$row['img_path']."' alt='".$row['name_photo']."'>
                <p>".$row['name_photo']."</p>
              </div>";
    }
?>