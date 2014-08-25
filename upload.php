<?php
    include('config.php');

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['file']) && isset($_POST['key'])) {
        
        $file = $_POST['file'];
        if(!$file['size'] > MAX_FILE_SIZE) {
            $ext = strtolower(end(explode('.', $file['name'])));
            
            $generated_name = "";
            do{
                $generated_name .= substr(md5(uniqid(rand(), true)), 0, rand(2, 5));
            }while(file_exists(UPLOAD_DIR.$name.'.'.$ext));
            
            move_uploaded_file($file['tmp_name'], UPLOAD_DIR.$generated_name.'.'.$ext);
            
            echo BASE_URL.$generated_name;
        }
    }
?>
