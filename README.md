# VrbStarterKit
The VrbStarterKit is a pre implemented project with util features for PHP projects that uses the raw PHP programming concept. This kit includes a collections of services, utilities, deafult patterns, configurations and pre defined plugins. 

## VrbSimpleForms
The new update for VrbStarterKit provided a new feature called <b>VrbSimpleForms</b>. This feature was created to give another way to create
simple forms. This new version brought the files below for a specific purpose:

File|Definition
---|---
`config/DynamicFormConfig.php`|Configuration of the auto generated forms pages
`config/DynamicListConfig.php`|Configuration of the auto generated list pages
`pages/DynamicFormPage.php`|Page that will generate the form by identifier
`pages/DynamicListPage.php`|Page that will generate the list by identifier
`actions/DynamicFormAction.php`|Action that will process the data of the form and the list (INSERT, UPDATE and DELETE)

To configure a new form, you need to create a new static function in <b>DynamicFormConfig.php</b> that will return the configuration to create
this form, and set this function in the main configuration method of this class, linked to some identifier (Use the example in the class to create your own form).
For each form, you need to create a list too with the same identifier, in the <b>DynamicListConfig.php</b>. To check the list and the form rendered, just
redirect to the <b>DynamicListPage.php?id=IDENTIFIER</b> where the IDENTIFIER is the key set in the configuration. Click in the <b>INSERT</b> button to check the
form rendered too.

## Installation
To start to use this kit, download or clone this repository in your project diretory. After it, turn on the server and try to access the index.php from any browser. If you get it, your kit installation is finished. If the access gets bad, or some redirect error gets occured, please check the **config.php** file and put the correct configuration in thepre defined keys. Try again and success! Check the section below for configuring instructions. 

## Configuration
When you start the project, the **config.php** file needs to be configured according with project definitions. Some configurations as the title, key-words, responsivity, access data for database, base url, etc... need to be defined correctly. We recommend much to clone this file with production configuration (example: <b>productionConfig.php</b>), and change to the correct config file when the application gets up to prodution environment. 

> The <b>IDIOM</b> configuration can be defined in the configuration file based on the files inside the **/app/translates** directory. If there is a session parameter configured in the <b>$_SESSION['IDIOM']</b>, this configuration will be used as priority and the file that will be used will be the specified file for this key value.

## Patterns
The project uses camel case for any identifier. Every default PHP resources are in the <b>/app</b> folder.
The files use a suffix to define the kind of this file. The table below shows these definitions:

Suffix|Location|Description
---|---|---
`Page`|/app/pages|Pages
`Service`|/app/services|Default functionalities collection
`Enum`|/app/enums|Constants collection
`Action`|/app/actions|Form actions
`Ajax`|/app/ajax|Return services for ajax requests
`Component`|/app/componentes|Components
`Cron`|/app/crons|Cron jobs implementations
`Repository`|/app/repositories|Manager services for database entities
`Template`|/app/templates|Any template type
`Css`|/app/styles|Cascade Stylesheets (CSS)
`Js`|/app/scripts|Scripts with algorithms (JS)
`Eula`|/app/eulas|Files with software policy
`Sql`|/app/sqls|Query language files (SQL)
`Config`|/app/config|Config files for application

## Services
The services are default functionalities for usage. There are different kinds of services that can be used for specified thing. Check the table below for more details:

Service|Definition
---|---
`DatabaseService`|Database connection service
`HeaderService`|HTTP header manipulation
`CookieService`|Cookie manipulation service
`DateService`|Date utilities service
`MailService`|Email sender thats use the PHPMailer library
`EventService`|Application event controller
`HtmlService`|Service to manipulate Tags, attributes, etc... for HTML files
`HttpService`|Variables HTTP controller
`ImportService`|Service to import resource to PHP pages
`IpService`|IP address utilities
`LogService`|Log utilities
`SecurityService`|Security validation service to control the access to PHP pages
`SessionService`|Session manipulation service
`TranslateService`|Translate utilities for application strings
`UploadService`|File upload and directory manipulation utilities
`UrlService`|Redirect and URL manipulation service
`PdfService`|Service for PDF creation with Dompdf plugin
`CurlService`|Service to make requests using CURL lib

## Imports
Any application imports are made using the `ImportService`, except by specified imports. This service is about to make imports files such CSS files, JS files, PHP files, etc. This service reads the application folders to import the files. You can use `Ignore_` key as file prefix to prevent to load this file by the service. Below are some important functions that will import common files to the application:  

Method|Definition
---|---
importCssModules()|Function to import CSS files using the tag: ```<link href="" />```
importJsModules()|Function to import JS files using the tag: ```<script src=""></script>```
importPhpModules()|Function to import PHP files using the method: ```require_once() ```

> The function ```ImportService::importPhpModules() ``` imports any PHP file from the folders <b>/app/components</b>, <b>/app/enums</b>, <b>/app/repositories</b>, <b>/app/services</b> and <b>/app/config</b>. The file <b>/config.php</b> is imported too. Files that have the prefix <b>ignore_</b> will be ignored for importation.

## Components
There is an interface for component creation called as ```Component```. This interface has 3 default methods. Each method is defined for a specified thing:

Method|Definition
---|---
html|Render component's html
script|Render component's script
style|Render component's style
render|Render component

A component is a PHP object, that has the renderization changed by the configured attributes. Check the example below for component creation:

```php
$component = new WelcomeComponent("VrbStarterKit");
$component->render();
```

## Static Components
As the normal components, static is most basic that can be created with a static function only. It doesn't need to be instantiated as an object, and the parameters can be set in the function parameters. 
There is a empty class ```StaticComponent``` just for definition purpose that can be used to create a static component. Check the example bellow to see the difference of a normal component:

```php
FooterStaticComponent::create();
```

## Repositories
The Repository classes are for database entity manipulation. Classes of Repository type usually have CRUD functions.

## Crons
Cron classes have just an execution method to be called by cron jobs from server or other source. 

## Pages
The application pages follows a design pattern. Check below for an example: 

```php
<?php
require_once(__DIR__ . "/../services/ImportService.php");
ImportService::importPhpModules();

// Page event
EventService::page();
?>
<html>
    <head>
        <?php
        HtmlService::title("Basic Template");
        HtmlService::metatags();
        HtmlService::favicon();
        ImportService::importCssModules();
        ImportService::importJsModules();
        ?>
    </head>
    <body>
        <!-- Header -->
        <header></header>
        
        <!-- Main -->
        <main></main>
        
        <!-- Footer -->
        <footer></footer>
    </body>
    <script>
        $(document).ready(function () {

        });
    </script>
</html>
```

## Background image
The background image has been made at https://lonewolfonline.net/geometric-background-generator/. Check the site for more details.

## About
This project was developed in <b>Netbeans 12.0</b> IDE, using PHP language. The XAMPP environment was used for tests. The project is defined with <b>MIT</b> license (Open Source). Thanks and nice codding!
