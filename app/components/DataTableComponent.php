<?php

require_once(__DIR__ . "/../services/ImportService.php");
ImportService::importPhpModules();

class DataTableComponent extends Component {

    public function html() {
        
    }

    public function script() {
        ?>
        <script>
            $("table").dataTable({
                "bLengthChange": false,
                "pageLength": 20,
                "language": {
                    "sEmptyTable": "Não foi encontrado nenhum registo",
                    "sLoadingRecords": "A carregar...",
                    "sProcessing": "A processar...",
                    "sLengthMenu": "Mostrar _MENU_ registos",
                    "sZeroRecords": "Não foram encontrados resultados",
                    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registos",
                    "sInfoEmpty": "Mostrando de 0 até 0 de 0 registos",
                    "sInfoFiltered": "(filtrado de _MAX_ registos no total)",
                    "sInfoPostFix": "",
                    "sSearch": "Procurar:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "Primeiro",
                        "sPrevious": "Anterior",
                        "sNext": "Seguinte",
                        "sLast": "Último"
                    },
                    "oAria": {
                        "sSortAscending": ": Ordenar colunas de forma ascendente",
                        "sSortDescending": ": Ordenar colunas de forma descendente"
                    }
                }
            });
            $("select").formSelect();
            $("input[type=search]").attr("placeholder", "Buscar");
        </script>    
        <?php

    }

    public function style() {
        
    }

}
