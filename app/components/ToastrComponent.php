<?php
require_once(__DIR__ . "/../services/ImportService.php");
ImportService::importPhpModules();

/**
 * Toastr component. This component uses the toastr plugin.
 */
class ToastrComponent extends Component {

    private $message;
    private $type;
    
    public function __construct($message, $type = ToastrEnum::INFO) {
        $this->tipo = $type;
        $this->mensagem = $message;
    }
    
    public function html() {
        ?>
        <div></div>
        <?php
    }

    public function style() {
        ?>
        <style></style>    
        <?php
    }

    public function script() {
        ?>
        <script>
            $(document).ready(function() {
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                toastr["<?=$this->tipo?>"]("<?=$this->mensagem?>");
            });
        </script>    
        <?php
    }
    
    public static function create($message, $type = ToastrEnum::INFO) {
        $component = new ToastrComponent($message, $type);
        $component->script();
    }
}

