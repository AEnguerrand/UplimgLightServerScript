<?php
    include('config.php');
    
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES["uplimgFile"]) && isset($_POST['uplimgKey'])) {
        
        $file = $_FILES["uplimgFile"];
        
        if($file['size'] <= MAX_FILE_SIZE && array_search($_POST['uplimgKey'], explode(",", ALLOWED_KEYS)) !== false) {
            $ext = explode('.', $file['name']);
            $ext = strtolower(end($ext));
            
            $generated_name = substr(md5(uniqid(rand(), true)), 0, 4);
            do{
                $generated_name .= substr(md5(uniqid(rand(), true)), 0, rand(2, 5));
            } while(file_exists(UPLOAD_DIR.$generated_name.'.'.$ext));
            
            move_uploaded_file($file['tmp_name'], UPLOAD_DIR.$generated_name.'.'.$ext);
            
            echo BASE_URL.$generated_name;
        } else {
            echo "ERROR FILE TOO BIG OR WRONG KEY ";
        }
    } else {
        echo "ERROR NO FILE SENDED OR NO KEY";
    }
