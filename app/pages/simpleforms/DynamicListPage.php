<?php
/* VrbSimpleForms Feature */

require_once(__DIR__ . "/../../utils/ImportUtil.php");
ImportUtil::importPhpModules();

// Security
SecurityUtil::validateLogin(false);

// Session
$user = SessionUtil::get(SessionEnum::USER_ID);

// Http
$id = HttpUtil::get("id");

// Get list
if (!isset(DynamicListConfig::configuration()[$id])) {
    ?>
    The list <?= $id ?> was not found!<br><br>
    <a href="javascript:history.back()">Back</a>
    <?php
    exit;
}
$list = DynamicListConfig::configuration()[$id];
$sql = $list["sql"];

// Get data from database
$dataRs = DatabaseUtil::executeSql($sql);
?>
<html>
    <head>
        <?php
        HtmlUtil::title("Dynamic List");
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
                        <a href="<?= UrlUtil::linkToPage("simpleforms/DynamicFormPage.php?id=$id") ?>" class="btn black">Insert</a>
                    </div>
                </div>

                <h5 class="light white-text">Data</h5>
                <div class="card">
                    <div class="card-content">
                        <table class="datatable">
                            <thead>
                                <tr>
                                    <?php
                                    /* Table header */
                                    foreach ($list["columns"] as $key => $value) {
                                        $label = $value["label"];
                                        echo("<th>$label</th>");
                                    }
                                    if($list["actionsColumn"]) {
                                        echo("<th>Actions</th>");
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php
                                    /* Table body */
                                    while($row = DatabaseUtil::fetchData($dataRs)) {
                                        echo("<tr>");
                                        foreach($row as $key => $value) {
                                            $function = $list["columns"][$key]["function"] ?? function($par){return $par;};
                                            echo("<td>");
                                            echo($function($value));
                                            echo("</td>");
                                        }
                                        if($list["actionsColumn"]) {
                                            echo("<td>");
                                            $separator = "";
                                            if($list["actions"]["update"]) {
                                                $link = UrlUtil::linkToPage("simpleforms/DynamicFormPage.php?id=$id&recordId=" . $row["id"]);
                                                echo("<a href='$link'>Update</a>");
                                                $separator = " / ";
                                            }
                                            if($list["actions"]["delete"]) {
                                                $link = UrlUtil::linkToAction("simpleforms/DynamicFormAction.php?id=$id&action=" . ActionEnum::DELETE . "&recordId=" . $row["id"] . "&table=" . $list["table"]);
                                                echo("$separator<a href='#!' onclick=\"deleteBtn('$link')\">Delete</a>");
                                                $separator = " / ";
                                            }
                                            echo("</td>");
                                        }
                                        echo("</tr>");
                                    }
                                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                </form>
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
        function deleteBtn(link) {
            if(confirm("Do you really want to delete this record?")) {
                window.location.href = link;
            }
        }
    </script>
</html>