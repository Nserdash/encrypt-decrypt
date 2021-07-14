<?php
session_start();
include 'params.php';
include 'classes/Decrypt.php';

$encryptedUrl = '';
if (isset($_POST['encode'])) { 
    $_SESSION['url']  = $_POST['url'];  
    $encryptedUrl = Decrypt::decryptUrl($_SESSION['url'], $params);
}   
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "styles/styles.css">
    <title>Дешифратор</title>
</head>
<body>  

    <div class = "container">
    <h1>Дешифратор</h1>
        <div class = "content">
            <div class = "elm">
                <div class = "row">
                    <p>Вставьте URL</p>          
                    <form action = "" method = "post">                    
                    <input type = "submit" value = "Декодировать" class = "btn" name = "encode">                    
                </div>
                <div>        
                    <textarea class = "url" id = "" name = "url"><?php echo (isset($_SESSION['url'])) ? $_SESSION['url'] : ""; ?></textarea>
                    </form>
                </div>
            </div>   
            <div class = "elm">
                <div class = "row">
                    <p>Расшифрованный URL</p>
                </div>
                <div>
                    <div class = "url" id = "encrypted" ><?php echo $encryptedUrl; ?></div>
                </div>
                </div>   
            </div>   
        </div>   
    </div>
</body>
</html>