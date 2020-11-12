<?php
require_once(__DIR__ . "/../services/ImportService.php");
ImportService::importPhpModules();

// Security
SecurityService::validateLogin(false);

// Page event
EventService::page();
?>
<html>
    <head>
        <?php
        HtmlService::title("Admin");
        HtmlService::metatags();
        HtmlService::favicon();
        ImportService::importCssModules();
        ImportService::importJsModules();
        ?>
    </head>
    <body>
        <!-- Header -->
        <header>
            <?php NavbarComponent::create(); ?>
        </header>

        <!-- Main -->
        <main>
            <div class="container">
                <h5 class="light white-text">Actions</h5>
                <div class="card">
                    <div class="card-content">
                        <a href="#!" class="btn black">Insert</a>
                        <a href="#!" class="btn red">Back</a>
                    </div>
                </div>
                
                <h5 class="light white-text">Data</h5>
                <div class="card">
                    <div class="card-content">
                        <table class="datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Hello World!</td>
                                    <td>This is an example of datatable!</td>
                                    <td><a href="#!">Action</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </main>
        
        <!-- footer -->
        <footer> 
            <?php FooterStaticComponent::create() ?>
        </footer>
    </body>
    <?php
    DataTableComponent::create();
    Select2StaticComponent::create();
    StatusComponent::create();
    ?>
    <script>
        $(document).ready(function () {

        });
    </script>
</html>