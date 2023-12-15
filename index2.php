<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/css.css?">
    <!-- <script src="js/script.js"></script> -->
</head>
<body>
    <header>
                <?php
                require_once ("config.php");
                    $connect = mysqli_connect($host, $user, $pass, $db);
                        if(!$connect) {
                        die();
                     }
                 ?>
       <section class="header_container">
       <div class="container">
            <div class="menu">
                <div class="logo">
                    <img src="img/foto_logo.png" alt="">
                    <div class="btn"> 
                    <?php
                    require_once("config.php");
                    $connect = mysqli_connect($host, $user, $pass, $db);
                    if (!$connect) {
                          die();
                    }

                    session_start();
                        if (isset($_SESSION["username"])) {
                            $username = $_SESSION["username"];
                                  echo "<div class='usname'>
                                  <h1>Вы авторизованы:</h1>
                                  <p>$username</p>
                                  
                                  </div>";
                        } else {
                        echo "Пользователь не зарегистрирован.";
                        }
                    ?>
                    <form action='logout.php' method='POST'>
                        <button type='submit' class='btn2'>Выйти</button>
                    </form>
                    </div>
                </div>

            </div>
       </div>
       </section>
    </header>
    <main>
       <div class="container">
                <a href="./index2.php?sort=date_added" class="btn3" ><p>Сортировка по дате обновления</p></a> 
                <?php
                $result = mysqli_query($connect, "SELECT id_category, name FROM categories");
                echo "<form method='GET' action='./index2.php'>";
                echo "<input type='hidden' name='sort' value='category'>";
                echo "<select name='category' id='category' class='btn3' onchange='this.form.submit()'>";
                echo "<option value=''>Выберите категорию</option>";
    
                // Выводим список категорий в выпадающем списке
                while($row = mysqli_fetch_array($result)) {
                    echo "<option value='".$row['id_category']."'>".$row['name']."</option>";
                }

                echo "</select>";
                echo "</form>";
                ?> 
            <div class="img1">
            <?php
               
            
            if (empty($_GET['sort'])){
                $sort = 'simple';
            }        
            else {
                $sort = $_GET['sort'];
            }
            
            if ($sort == 'simple') {
                $result = mysqli_query($connect, "SELECT id_photo, img_path, name_photo, date_added, download_count, category_id, author_id FROM photos;");
                while ($row = mysqli_fetch_array($result)) {
                    $authorID = $row['author_id'];
                    $authorQuery = mysqli_query($connect, "SELECT username FROM users WHERE id_user = '$authorID'");
                    $authorRow = mysqli_fetch_array($authorQuery);
                    $author = $authorRow['username'];

                    $category = $row['category_id'];
                    $categoryQuery = mysqli_query($connect, "SELECT name FROM categories WHERE id_category = '$category'");
                    $categoryRow = mysqli_fetch_array($categoryQuery);
                    $category = $categoryRow['name'];

                    echo "<div class='card'>
                        <a class='popup_open' href='#' data-modal-id='".$row['id_photo']."'><img src='".$row['img_path']."' alt='".$row['name_photo']."'></a>
                        
                        <div class='popup_fade' id='modal_".$row['id_photo']."'>
                            <div class='popup'>
                                <a class='popup_close' href='#'>X</a>
                                <img src='".$row['img_path']."' alt='".$row['name_photo']."'>
                                <p>".'Название: '.$row['name_photo']."</p>
                                <p>".'Дата добавления: '.$row['date_added']."</p>
                                <p>".'Автор: '.$author."</p>
                                <p>".'Категория: '.$category."</p>
                                <p>".'Скачиваний: '.$row['download_count']."</p>
                                <br><a href='".$row['img_path']."' download='".$row['name_photo']."'><button onclick='updateDownloadCount(\"".$row['id_photo']."\");'>Скачать</button></a>
                            </div>
                        </div>
                        
                    </div>";
                }
                echo "<div class='knopka'><a href='add_photo.php' class='btn3'>Добавить фото</a></div>";
            }
            if($sort == 'date_added'){
            
            $result = mysqli_query($connect, "SELECT id_photo, img_path, name_photo, date_added, download_count, category_id, author_id FROM photos ORDER BY date_added desc;");
            while($row = mysqli_fetch_array($result)){
                $authorID = $row['author_id'];
                    $authorQuery = mysqli_query($connect, "SELECT username FROM users WHERE id_user = '$authorID'");
                    $authorRow = mysqli_fetch_array($authorQuery);
                    $author = $authorRow['username'];

                    $category = $row['category_id'];
                    $categoryQuery = mysqli_query($connect, "SELECT name FROM categories WHERE id_category = '$category'");
                    $categoryRow = mysqli_fetch_array($categoryQuery);
                    $category = $categoryRow['name'];

                    echo "<div class='card'>
                        <a class='popup_open' href='#' data-modal-id='".$row['id_photo']."'><img src='".$row['img_path']."' alt='".$row['name_photo']."'></a>
                        
                        <div class='popup_fade' id='modal_".$row['id_photo']."'>
                            <div class='popup'>
                                <a class='popup_close' href='#'>X</a>
                                <img src='".$row['img_path']."' alt='".$row['name_photo']."'>
                                <p>".'Название: '.$row['name_photo']."</p>
                                <p>".'Дата добавления: '.$row['date_added']."</p>
                                <p>".'Автор: '.$author."</p>
                                <p>".'Категория: '.$category."</p>
                                <p>".'Скачиваний: '.$row['download_count']."</p>
                                <br><a href='".$row['img_path']."' download='".$row['name_photo']."'><button onclick='updateDownloadCount(\"".$row['id_photo']."\");'>Скачать</button></a>
                            </div>
                        </div>
                        
                    </div>";
            }
                    
                    echo "<div class='knopka'><a href='./index2.php?sort=simple' class='btn4'><p>Назад</p></a></div>";       
            }   
            if ($sort == 'category') {
                
                
                // Проверяем, была ли выбрана категория
                if (isset($_GET['category'])) {
                    $selectedCategory = $_GET['category'];
                    
                    // Запрос для получения картинок выбранной категории
                    $query = "SELECT * FROM photos WHERE category_id = '$selectedCategory'";
                    $result = mysqli_query($connect, $query);
                    
                    // Выводим картинки
                    while ($row = mysqli_fetch_array($result)) {
                        $authorID = $row['author_id'];
                    $authorQuery = mysqli_query($connect, "SELECT username FROM users WHERE id_user = '$authorID'");
                    $authorRow = mysqli_fetch_array($authorQuery);
                    $author = $authorRow['username'];

                    $category = $row['category_id'];
                    $categoryQuery = mysqli_query($connect, "SELECT name FROM categories WHERE id_category = '$category'");
                    $categoryRow = mysqli_fetch_array($categoryQuery);
                    $category = $categoryRow['name'];

                    echo "<div class='card'>
                        <a class='popup_open' href='#' data-modal-id='".$row['id_photo']."'><img src='".$row['img_path']."' alt='".$row['name_photo']."'></a>
                        
                        <div class='popup_fade' id='modal_".$row['id_photo']."'>
                            <div class='popup'>
                                <a class='popup_close' href='#'>X</a>
                                <img src='".$row['img_path']."' alt='".$row['name_photo']."'>
                                <p>".'Название: '.$row['name_photo']."</p>
                                <p>".'Дата добавления: '.$row['date_added']."</p>
                                <p>".'Автор: '.$author."</p>
                                <p>".'Категория: '.$category."</p>
                                <p>".'Скачиваний: '.$row['download_count']."</p>
                                <br><a href='".$row['img_path']."' download='".$row['name_photo']."'><button onclick='updateDownloadCount(\"".$row['id_photo']."\");'>Скачать</button></a>
                            </div>
                        </div>
                        
                    </div>";
                    }
                } else {
                    echo "Выберите категорию.";
                }
                echo "<div class='knopka'><a href='./index2.php?sort=simple' class='btn4'><p>Назад</p></a></div>";
            }       
                 ?>
            </div>
            <script src="https://yandex.st/jquery/2.1.1/jquery.min.js"></script>
                    <script>
                    $(document).ready(function($) {
                        $('.popup_open').click(function() {
                            var modalId = $(this).data('modal-id');
                            $('#modal_' + modalId).fadeIn();
                            return false;
                        });    

                        $('.popup_close').click(function() {
                         $(this).parents('.popup_fade').fadeOut();
                         return false;
                     });     

                    $(document).keydown(function(e) {
                            if (e.keyCode === 27) {
                               e.stopPropagation();
                              $('.popup_fade').fadeOut();
                           }
                     });
    
                     $('.popup_fade').click(function(e) {
                         if ($(e.target).closest('.popup').length == 0) {
                             $(this).fadeOut();                  
                         }
                     });
                    });

                    function updateDownloadCount(photoId) {
                    // Отправка AJAX-запроса для обновления счетчика download_count
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'update_download_count.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                    // Обработка ответа от сервера, если необходимо
                    }
                    };
                    xhr.send('id_photo=' + photoId);
                    }
                    </script>
           
        </div>
    </main>
    <footer>
      
    </footer>
</body>
</html>