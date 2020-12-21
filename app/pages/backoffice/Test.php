<?php
require_once(__DIR__ . "/../../utils/ImportUtil.php");
ImportUtil::importPhpModules();

// Security
SecurityUtil::validateLogin(false);

// Page event
EventUtil::page();

// Get data
$data = ExampleRepository::findAllActive();
?>
<html>
    <head>
        <?php
        HtmlUtil::title("ExampleListPage");
        HtmlUtil::metatags();
        HtmlUtil::favicon();
        ImportUtil::importCssModules();
        ImportUtil::importJsModules();
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
                        <a href="<?=UrlUtil::linkToPage("ExampleFormPage")?>" class="btn black">Insert</a>
                    </div>
                </div>
                
                <h5 class="light white-text">Data</h5>
                <div class="card">
                    <div class="card-content">
                        <table class="datatable">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Active</th>
                                    <th>Age</th>
                                    <th>Description</th>
                                    <th>IdSchool</th>
                                    <th>BirthDate</th>
                                    <th>InsertDateTime</th>
                                    <th>Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = DatabaseUtil::fetchData($data)) { ?>
                                    <tr>
                                       <td><?=$row["id"]?></td>
                                       <td><?=$row["name"]?></td>
                                       <td><?=$row["active"]?></td>
                                       <td><?=$row["age"]?></td>
                                       <td><?=$row["description"]?></td>
                                       <td><?=$row["id_school"]?></td>
                                       <td><?=$row["birth_date"]?></td>
                                       <td><?=$row["insert_date_time"]?></td>
                                       <td>
                                          <a href="<?=UrlUtil::linkToPage("ExampleFormPage")?>?id=<?=$row["id"]?>">Update</a>
                                          / <a href="<?=HtmlUtil::voidHref()?>" onclick="inactivate(<?=$row["id"]?>)">Inactivate</a>
                                       </td>

                                    </tr>
                                <?php } ?>
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
    StatusComponent::create();
    ?>
    <script>
        $(document).ready(function () {
            
        });

        function inactivate(id) {
            if(confirm("Do you really want to do this action?")) {
                window.location.href = "<?=UrlUtil::linkToAction("ExampleAction")?>?action=<?=ActionEnum::INACTIVATE?>&id=" + id;
            }
        }
    </script>
</html>