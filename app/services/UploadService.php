<?php
require_once(__DIR__ . "/../services/ImportService.php");
ImportService::importPhpModules();

/**
 * Service that provides util functions for upload resources.
 */
class UploadService {
    
    /**
     * Create directory
     * @param string $dir
     * @param boolean $replace
     */
    public static function createDir($dir, $replace = false) {
        if (file_exists($dir) && $replace) {
            UploadService::deleteDir($dir);
        }
        mkdir($dir, 0777, true);
    }
    
    /**
     * Delete directory
     * @param string $dir
     * @return boolean
     */
    public static function deleteDir($dir) {
        $files = array_diff(scandir($dir), array('.', '..'));
        foreach ($files as $file) {
            is_dir("$dir/$file") ? delTree("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }
    
    /**
     * Delete directory content
     * @param string $dir
     */
    public static function deleteDirContent($dir) {
        $files = array_diff(scandir($dir), array('.', '..'));
        foreach ($files as $file) {
            is_dir("$dir/$file") ? delTree("$dir/$file") : unlink("$dir/$file");
        }
    }
    
    /**
     * Delete file
     * @param string $url
     */
    public static function deleteFile($url){
        unlink($url);
    }

    /**
     * Generate file name.
     * @param string $extension
     * @return string
     */
    public static function generateFileName($extension) {
        return uniqid() . $extension;
    }
    
    /**
     * Upload file
     * @param string $file
     * @param string $dir
     * @param string $extension
     * @return string
     */
    public static function uploadFile($file, $dir, $extension) {
        UploadService::createDir($dir);
        $name = UploadService::generateFileName($extension);
        move_uploaded_file($file, "$dir/$name");
        return $name;
    }
    
}

