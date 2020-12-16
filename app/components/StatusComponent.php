<?php
require_once(__DIR__ . "/../utils/ImportUtil.php");
ImportUtil::importPhpModules();

/**
 * Component to render Toastr for page status
 */
class StatusComponent extends Component {
    
    private $code = null;
    const STATUS_PARAM_NAME = "status";

    public function __construct() {
        $this->code = HttpUtil::get(self::STATUS_PARAM_NAME);
    }
    
    public function html() {}

    public function style() {}

    public function script() {
        $statusEnumClass = new ReflectionClass("StatusEnum");
        $status = $statusEnumClass->getConstant($this->code);
        if($status != null) {
            $toastr = new ToastrComponent($status["message"], $status["type"]);
            $toastr->script();
        }
    }
    
    public static function create() {
        $component = new StatusComponent();
        $component->script();
    }
}