<?php
    include('config.php');
    
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['image'])) {
    
        $file = $_POST['file'];
        $matched = glob (UPLOAD_DIR.$file.'.*');
        
        if(!empty($matched)) {
            $matched = $matched[0];
            $mime = array_search(strtolower(end(explode('.', $matched))), explode(",", ALLOWED_EXTS_DOWNLOAD);
            
            if($mime === false) {
                header('Content-type: ' . $mime);
            }
            
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            
            ob_clean();
            flush();
            
            echo file_get_contents($matched);
        }
        
    } else {
        header('HTTP/1.0 404 not found');
        die();
    }
?>
