<?php
session_start();
include 'params.php';
include 'classes/GenerateURL.php';
include 'classes/EncryptUrl.php';
 
if (isset($_POST['generate'])) {
    $_SESSION['length'] = rand(5,20);
    $rand_keys = array_rand($params, $_SESSION['length']);    
    $_SESSION['url'] = GenerateURL::genereteURL($rand_keys,$params, $_SESSION['length']);
}  

$encryptedUrl = '';
if (isset($_POST['encode'])) {   
  $encryptedUrl = Encrypt::encryptUrl($_SESSION['url'], $params);
}   
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "styles/styles.css">
    <title>Шифратор</title>
</head>
<body>  

    <div class = "container">
    <h1>Шифратор</h1>
        <div class = "annotation">                    
            <p>При генерации URL используются следующие Get-Параметры:</p>

            <p>
                <?php
                $counter = 0;
                 foreach($params as $param) {
                    $counter++;
                    echo ($counter!=count($params)) ?  $param.", " :  $param.".";                                       
                 }
                ?>
            </p>

        </div>
        <div class = "content">
            <div class = "elm">
                <div class = "row">
                    <p>Исходный URL</p>          
                    <form action = "" method = "post">
                        <input type = "submit" value = "Сгенерировать" class = "btn" name = "generate">
                    </form>
                </div>
                <div>        
                  <div class = "url" id = "generated" disabled><?php echo (isset($_SESSION['url'])) ? $_SESSION['url'] : ""; ?></div>
                </div>
            </div>   
            <div class = "elm">
                <div class = "row">
                    <p>Зашифрованный URL</p>
                    <form action = "" method = "post">
                        <input type = "submit" value = "Зашифровать" class = "btn" name = "encode">
                    </form>
                </div>
                <div>
                    <div class = "url" id = "encrypted" readonly><?php echo $encryptedUrl; ?></div>
                </div>
                </div>   
            </div>   
        </div>   
    </div>
</body>
</html>