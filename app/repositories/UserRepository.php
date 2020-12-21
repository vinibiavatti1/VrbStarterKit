<?php
require_once(__DIR__ . "/../utils/ImportUtil.php");
ImportUtil::importPhpModules();

/**
 * User Repository implementation
 */
class UserRepository {
    
    /**
     * Check user active. 
     * <b>Maybe this method needs to be modified to correspond of your
     * database structure!</b>
     * @param type $userId
     */
    public static function checkUserActive($userId) {
        $sql = "SELECT id FROM `user` WHERE id = $userId AND active = 1";
        $rs = DatabaseUtil::executeSql($sql);
        return DatabaseUtil::getNumRows($rs) > 0;
    }
    
}