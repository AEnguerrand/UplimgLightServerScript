<?php

define('BASE_DIR', __DIR__ . '/');
define('UPLOAD_DIR', BASE_DIR . 'uploads/');
define('BASE_URL', 'http://my.website.net/');
define('ALLOWED_KEYS', 'myKey,friendKey,anotherFriendKey');
define('ALLOWED_EXTS_DOWNLOAD', 'jpg,jpeg,png,gif,bmp');

function convertPHPSizeToBytes($sSize) {
    if (is_numeric($sSize)) {
        return $sSize;
    }
    $sSuffix = substr($sSize, -1);
    $iValue = substr($sSize, 0, -1);
    switch (strtoupper($sSuffix)) {
        case 'P':
            $iValue *= 1024;
        case 'T':
            $iValue *= 1024;
        case 'G':
            $iValue *= 1024;
        case 'M':
            $iValue *= 1024;
        case 'K':
            $iValue *= 1024;
            break;
    }
    return $iValue;
}

define('MAX_FILE_SIZE', min(convertPHPSizeToBytes(ini_get('post_max_size')), convertPHPSizeToBytes(ini_get('upload_max_filesize'))));
