<?php
/**
 * Template to create Repository classes with default methods. This is not 
 * required to create Repository classes, but this follow the default way using 
 * common actions to object persistence.
 */
interface Repository {
    
    /**
     * Get record by identifier
     * @param type $id
     */
    public static function get($id);
    
    /**
     * List records. You can pass some filters to filter the correct data
     * @param type $filters
     */
    public static function list($filters = null);
    
    /**
     * Insert a new record
     * @param type $data
     */
    public static function insert($data);
    
    /**
     * Delete record by identifier
     * @param type $id
     */
    public static function delete($id);
    
    /**
     * Update record
     * @param type $id
     * @param type $data
     */
    public static function update($id, $data);
    
}

