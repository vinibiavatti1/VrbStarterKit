<?php
require_once(__DIR__ . "/../services/ImportService.php");
ImportService::importPhpModules();

/**
 * Example component
 */
class WelcomeComponent extends Component {
    
    private $project;
    
    public function __construct($project) {
        $this->project = $project;
    }
    
    public function html() {
        ?>
        <div class="container-fluid">
            <br>
            <h4 class="alert-heading"><?= __("Welcome!") ?></h4>
            <p>Thanks for use <?=$this->project?>!
                <br>
                <br>
                <b>Tips</b><br>
                The main logic content of the kit is in the <code>/app</code> directory, where are present the pages, services, components...<br>
                Start configuring the project at <code>/config.php</code>.<br>
                With the configuration done, look at <code>/app/services/ImportService.php</code> and check the files that will be imported. It is up to you for changes!
                <br>If you want to add more plugins or see the already available plugins, check <code>/plugins</code>.<br>
                <br>
                <b>Examples</b><br>
                <a target="_blank" href="<?= UrlService::addBaseUrl("app/pages/ChartPage.php");?>">Charts</a><br>
                <a target="_blank" href="<?= UrlService::addBaseUrl("app/pages/PdfPage.php");?>">Pdf</a><br>
                <a target="_blank" href="<?= UrlService::addBaseUrl("app/pages/LoginPage.php");?>">Login</a>
            </p>
            <hr>
            <p class="mb-0"><b>Author:</b> Vinícius Reif Biavatti</p>
        </div>
        <?php
    }

    public function style() {
        ?>
        <style></style>    
        <?php
    }

    public function script() {
        ?>
        <script></script>    
        <?php
    }

}

