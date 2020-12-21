<?php

require_once(__DIR__ . "/../utils/ImportUtil.php");
ImportUtil::importPhpModules();

class DataTableComponent extends Component {

    const DEFAULT_CONFIG = "{'bLengthChange': false, 'pageLength': 20, 'order': [[0, 'asc']], 'scrollX': true}";
    const SELECTOR = ".datatable";
    private $configJson;
    
    function __construct($configJson = self::DEFAULT_CONFIG) {
        $this->configJson = $configJson;
    }
    
    public function html() {
        
    }

    public function script() {
        ?>
        <script>
            $("<?= self::SELECTOR ?>").dataTable(<?= $this->configJson ?>);
            $("select").formSelect();
            $("input[type=search]").attr("placeholder", "Search");
        </script>    
        <?php

    }

    public function style() {
        
    }
    
    public static function create($config = self::DEFAULT_CONFIG) {
        $component = new DataTableComponent($config);
        $component->script();
    }

}
