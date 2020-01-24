<?php
/**
 * template to create components
 */
abstract class Component {
    
    /**
     * Render component style
     */
    abstract function style();
    
    /**
     * Render component structure
     */
    abstract function html();
    
    /**
     * Render component script 
     */
    abstract function script();
    
    /**
     * Render component<br>
     * <code>
     * $this->style();
     * $this->html();
     * $this->script();
     * </code>
     */
    public function render() {
        $this->style();
        $this->html();
        $this->script();
    }
}
