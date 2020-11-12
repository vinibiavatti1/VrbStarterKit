<?php
require_once(__DIR__ . "/../services/ImportService.php");
ImportService::importPhpModules();

/**
 * Component to render Toastr for page status
 */
class StatusComponent extends Component {
    
    private $code = null;
    const STATUS_PARAM_NAME = "status";
    const STATUS_LIST = [
        [ "code" => "LOGIN_SUCCESS", "type" => ToastrEnum::SUCCESS, "message" => "Login successfull" ],
        [ "code" => "LOGIN_FAILED", "type" => ToastrEnum::ERROR, "message" => "Invalid user and/or password" ],
        [ "code" => "SUCCESS", "type" => ToastrEnum::SUCCESS, "message" => "Action successfull" ],
        [ "code" => "FAILED", "type" => ToastrEnum::ERROR, "message" => "Action failed" ],
        [ "code" => "DATA_NOT_FOUND", "type" => ToastrEnum::ERROR, "message" => "Data not found" ],
        [ "code" => "NO_DATA", "type" => ToastrEnum::ERROR, "message" => "No data available for this action" ],
        [ "code" => "NO_FORM_FOUND", "type" => ToastrEnum::ERROR, "message" => "The form for this action was not found" ],
        [ "code" => "NO_LIST_FOUND", "type" => ToastrEnum::ERROR, "message" => "The list for this action was not found" ],
        // Add more status
    ];

    public function __construct() {
        $this->code = HttpService::get(self::STATUS_PARAM_NAME);
    }
    
    public function html() {}

    public function style() {}

    public function script() {
        foreach (StatusComponent::STATUS_LIST as $status) {
            if($status["code"] == $this->code) {
                $toastr = new ToastrComponent($status["message"], $status["type"]);
                $toastr->script();
                return;
            }
        }
    }
    
    public static function create() {
        $component = new StatusComponent();
        $component->script();
    }
}