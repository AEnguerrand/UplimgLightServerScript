<!DOCTYPE html>
<html>
    <head>
        <title>Gallerie</title>
    </head>
    <body>
        <ul>
            <?php
            include('config.php');

            if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['key'])) {
                if (array_search($_GET['key'], explode(",", ALLOWED_KEYS)) !== false) {
                    if ($folder = opendir(UPLOAD_DIR)) {
                        while (false !== ($file = readdir($folder))) {
                            if ($file != '.' && $file != '..' && $file != '.htaccess') {
                                $ext = explode('.', $file);
                                $ext = strtolower(end($ext));
                                $file = str_replace("." . $ext, "", $file);
                                echo "<li><a href='" . BASE_URL . $file . "'>" . BASE_URL . $file . "</a></li>";
                            }
                        }
                    }
                }
            }
            ?>
        </ul>
    </body>
</html>
