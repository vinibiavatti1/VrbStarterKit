<?php
require_once(__DIR__ . "/../utils/ImportUtil.php");
ImportUtil::importPhpModules();

/**
 * Json response error template
 */
class JsonResponseErrorComponent extends Component {
    
    private $code;
    private $message;
    private $details;
    
    public function __construct($code, $message, $details = null) {
        $this->code = $code;
        $this->message = $message;
        $this->details = $details;
    }
    
    public function html() {
        $structure = [
            "code" => $this->code,
            "message" => $this->message
        ];
        if($this->details != null) {
            $structure["details"] = $this->details;
        }
        $json = json_encode($structure);
        echo($json);
    }

    public function script() {
        
    }

    public function style() {
        
    }

}
