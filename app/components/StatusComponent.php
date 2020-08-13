<?php
require_once(__DIR__ . "/../services/ImportService.php");
ImportService::importPhpModules();

/**
 * Componente de Status para exibição de Toastr
 */
class StatusComponent extends Component {
    
    private $code = null;
    const STATUS_LIST = [
        [ "code" => "LOGIN_SUCCESS", "type" => ToastrEnum::SUCCESS, "message" => "Login efetuado com sucesso" ],
        [ "code" => "LOGIN_FAILED", "type" => ToastrEnum::ERROR, "message" => "Usuário e/ou senha inválido(s)" ],
        [ "code" => "SUCCESS", "type" => ToastrEnum::SUCCESS, "message" => "Ação realizada com sucesso" ],
        [ "code" => "FAILED", "type" => ToastrEnum::ERROR, "message" => "Falha ao realizar ação" ],
        // Add more status
    ];

    public function __construct() {
        $this->code = HttpService::get("status");
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