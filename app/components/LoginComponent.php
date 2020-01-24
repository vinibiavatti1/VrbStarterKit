<?php
require_once(__DIR__ . "/../services/ImportService.php");
ImportService::importPhpModules();

/**
 * Login component
 */
class LoginComponent extends Component {

    private $action;
    
    public function __construct($action) {
        $this->action = $action;
    }
    
    public function html() {
        ?>
        <form action="<?= $this->action ?>" method="POST">
            <div class="login-panel shadow-sm card">
                <h3>Login</h3>
                <hr>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Email" name="email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%">Submit</button>
            </div>
        </form>
        <?php
    }

    public function script() {
        
    }

    public function style() {
        ?>
        <style>
            .login-panel {
                width: 100%;
                padding: 20px;
            }
        </style>
        <?php
    }

}
