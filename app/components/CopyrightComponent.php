<?php
require_once(__DIR__ . "/../services/ImportService.php");
ImportService::importPhpModules();

/**
 * Copyright component
 */
class CopyrightComponent extends Component {
    
    private $company;
    private $year;
    
    /**
     * Contruct copyright component
     */
    public function __construct($company = Config::COMPANY, $year = null) {
        $this->company = $company;
        $this->year = $year == null ? date("Y") : $year;
    }
    
    public function style() {
        ?>
        <style></style>    
        <?php
    }

    public function script() {
        ?>
        <script></script>
        <?php
    }

    public function html() {
        ?>
        <div>Copyright &copy; <?= $this->company . " " . $this->year ?></div>
        <?php
    }

}