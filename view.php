<?php
    include('config.php');
    
    function mime_type($filename) {
        $mime_types = array(
            'txt' => 'text/plain',
            'htm' => 'text/html',
            'html'=> 'text/html',
            'php' => 'text/html',
            'css' => 'text/css',
            'js'  => 'application/javascript',
            'json'=> 'application/json',
            'xml' => 'application/xml',
            'swf' => 'application/x-shockwave-flash',
            'flv' => 'video/x-flv',
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg'=> 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff'=> 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz'=> 'image/svg+xml',
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
            'exe' => 'application/x-msdownload',
            'msi' => 'application/x-msdownload',
            'cab' => 'application/vnd.ms-cab-compressed',
            'mp3' => 'audio/mpeg',
            'qt'  => 'video/quicktime',
            'mov' => 'video/quicktime',
            'pdf' => 'application/pdf',
            'psd' => 'image/vnd.adobe.photoshop',
            'ai'  => 'application/postscript',
            'eps' => 'application/postscript',
            'ps'  => 'application/postscript',
            'doc' => 'application/msword',
            'rtf' => 'application/rtf',
            'xls' => 'application/vnd.ms-excel',
            'ppt' => 'application/vnd.ms-powerpoint',
            'odt' => 'application/vnd.oasis.opendocument.text',
            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
        );

        $ext = strtolower(array_pop(explode('.',$filename)));
        if (array_key_exists($ext, $mime_types)) {
            return $mime_types[$ext];
        }
        elseif (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME);
            $mimetype = finfo_file($finfo, $filename);
            finfo_close($finfo);
            return $mimetype;
        }
        else {
            return 'application/octet-stream';
        }
    }
    
    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['file'])) {
    
        $file = $_GET['file'];
        $matched = glob(UPLOAD_DIR.$file.'.*');
        if(!empty($matched)) {
            $matched = $matched[0];
            
            header('Content-type: ' . mime_type($matched));
            
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            
            ob_clean();
            flush();
            
            echo file_get_contents($matched);
            die();
        }
    }
    header('HTTP/1.0 404 not found');
?>
