

# VrbStarterKit
The VrbStarterKit is a "pre implemented" project with util features for PHP projects that follow the raw PHP programming concept (PHP HTML renderization). This kit includes a collections of utilities, default patterns, configurations, and pre defined plugins. You can also find a dynamic form renderer and internationalization classes in the kit. The purpose of the kit is to facilitate our development and give it to us as a base for our projects. It is not a framework, it is just a library to help us a lot!

## Installation
To start to use this kit, download or clone this repository in your project diretory. After it, turn on the server and try to access the index.php from any browser. If you get it, your kit installation is finished. If the access gets bad, or some redirect error gets occured, please check the **config.php** file and put the correct configuration in thepre defined keys. Try again and success! Check the section below for configuring instructions. 

## Configuration
When you start the project, the **config.php** file needs to be configured according with project definitions. Some configurations as the title, key-words, responsivity, access data for database, base url, etc... need to be defined correctly. We recommend much to clone this file with production configuration (example: **productionConfig.php**), and change to the correct config file when the application gets up to prodution environment.

## VrbSimpleForms
The **VrbSimpleForms** is a new feature introduced in the kit that allows you to configure a form data that will be used by the application to create a dynamic form. This feature was created to give you another way to create
simple forms. This new version brought the files below for a specific purpose:

File|Definition
---|---
`configs/DynamicFormConfig.php`|Configuration of the auto generated forms pages
`configs/DynamicListConfig.php`|Configuration of the auto generated list pages
`pages/DynamicFormPage.php`|Page that will generate the form by the identifier
`pages/DynamicListPage.php`|Page that will generate the list by the identifier
`actions/DynamicFormAction.php`|Action that will process the data of the form (INSERT, UPDATE and DELETE)

To configure a new form, you will have to create a new static function in `DynamicFormConfig.php` that needs to return the configuration of the form will be created. After this, you have to define this function in the main configuration method of this class, linked to some identifier (I recommend you to use the example in the class to create your own form). 

```php
public static function configuration() {
    return [
        "myForm" => self::myForm(),
    ];
}

private static function myForm() {
        return /* configuration */;
}
```
For each form, you can define a configuration to a list with the same identifier, in `DynamicListConfig.php`. To confgure it just follow the same way of the form (use the example too). To check the list and the form rendered, just open the `DynamicListPage.php?id=<identifier>`. Click in the **INSERT** button to check the form rendered too. 

## Internationalization

The `TranslationUtil` is responsible to translate the texts in the application that ware rendered by the function `__("")`. You can define your dectionaries in `app/translations` folder. The util will load the dictionary by the key present in `IdiomEnum`. To set the idiom of the application, you can use two ways:

1. **Query param**: Define the idiom of the page in the query param of the access URL. Just set the idiom using `page.php?idiom=en_US` for example. You can change the param key in `TranslationUtil` if you want.
2. **Session key**: Define the `IDIOM` key in the `$_SESSION`, and the util will get this key to load the dictionary, and translate the application.

> NOTE: The sequece indicates the priority to set the idiom.

To create a new dictionary, you must create a file with the idiom identifier in the `app/translations` folder. 
```php
/* Portuguese dictionary */
define("DICTIONARY", [
    "Welcome!" => "Bem vindo!";
]);
```
After it, you need to register this idiom in `IdiomEnum`, and that is it! If you set a query param, or the session key, the application will load your dictionary with the identifier. So now, to translate the words, just render these with the `__("example")` function.
```php
<h1> <?=__("Welcome!")?> </h1>
```

## Patterns
The project uses **Pascal Case** for the class names and file names, and **Camel Case**  for others identifiers. Every default PHP resources are localizated in the **/app** folder. To outside folders contain other kind of resources, like backups, images, etc.
The **/app** folder is the main folder of the project. You can find some folders inside it organized by the concept of the resource.  The files use a suffix to determinate its type. You can check the table below to discover the kind of the project files, and the description of these:

Suffix|Location|Description
---|---|---
`Page`|/app/pages|Application pages
`Util`|/app/utils|Utilities for the application
`Service`|/app/services|Classes with business logic
`Enum`|/app/enums|Constants collection
`Action`|/app/actions|Form actions
`Ajax`|/app/ajax|Ajax operations (Async actions)
`Component`|/app/componentes|Components and static components
`Cron`|/app/crons|Cron jobs implementations
`Repository`|/app/repositories|Database entities management
`Template`|/app/templates|Any template type (it doesn't need to have only PHP files)
`Css`|/app/styles|Cascade Stylesheets (CSS)
`Js`|/app/scripts|Scripts with algorithms (JS)
`Eula`|/app/eulas|Files with software policy
`Sql`|/app/sqls|Query language files (SQL)
`Config`|/app/configs|Configuration files (VrbSimpleForms configuration files can be found here)
`Model`|/app/models|Model and structural classes

You can create any file or change the organization of the folders if you want. It is up to you. 

## Utils
The util classes have default functionalities for usage in entire of application. There are different kinds of utils that can be used for specified operation. Check the table below for more details:

Util|Definition
---|---
`DatabaseUtil`|Database connection utilities
`HeaderUtil`|HTTP header manipulation
`CookieUtil`|Cookie manipulation utilities
`DateUtil`|Date utilities
`MailUtil`|Mail sender using the PHPMailer library
`EventUtil`|Application event manipulator
`HtmlUtil`|Utilities to manipulate or render tags, attributes, etc. for HTML files
`HttpUtil`|HTTP POST and GET data manipulator
`ImportUtil`|Resource importer that is used to load PHP, CSS, JS and plugins to the application
`IpUtil`|IP address utilities
`LogUtil`|Log utilities
`SecurityUtil`|Security validation utilities to control the access to PHP resources
`SessionUtil`|Session manipulation utilities
`TranslationUtil`|Translation utilities for application strings (Internationalization)
`UploadUtil`|Upload and directory manipulation utilities
`UrlUtil`|Operations for redirecting and URL manipulation
`PdfUtil`|Utilities for PDF creation with Dompdf plugin
`CurlUtil`|Utilities to make requests using CURL lib

## Imports
Any application imports are made by `ImportUtil`, except by specified imports. This class is responsible to import files such CSS files, JS files, PHP files, etc. It reads the application folders inside the `app/` to import the files of determinated content. You can use `Ignore_` key as file prefix to prevent to load this file by the import function. Below you can find the functions that are used to make the imporation:  

Method|Definition
---|---
importCssModules()|Function to import CSS files using the tag: ```<link href="" />```
importJsModules()|Function to import JS files using the tag: ```<script src=""></script>```
importPhpModules()|Function to import PHP files using the method: ```require_once() ```

The function `ImportUtil::importPhpModules()` imports any PHP file from the folders `/app/components`, `/app/enums`, `/app/repositories`, `/app/services`, `/app/configs`, `/app/utils` and `/app/models`. The file `/config.php` localizated in the root will be imported too. Files that have the prefix `Ignore_` will be ignored for importation.

## Components
There are two interfaces for component creation. The first one, called  `Component` is to create components as class objects. This interface has 3 default methods. Each method is defined for a specified operation:

Method|Definition
---|---
`html()`|Render the component's html
`script()`|Render the component's script
`style()`|Render the component's style
`render()`|Execute the three functions as a whole

A component is a PHP object, that has the renderization changed by the configured attributes. The example below shows how a object based component is rendered:

```php
$component = new WelcomeComponent("VrbStarterKit");
$component->render();
```

## Static Components
The second interface to create components is `StaticComponent`. Statics components are more basic then the object based component. There kind of components don't need to be instanciated, and to render it, you just need to call the render function. To change the state of the component, just set the parameters of the function. The empty class `StaticComponent` is only for definition purpose, to determinate which are the static components. Check the example bellow to see the difference of an object based component and a static component:

```php
FooterStaticComponent::create();
```

Check the component files in the repository for examples, if you want.
 
## Models
The model classes are localizated in the `app/models` folder. These classes just represent models of data. You can use these to follow some MVC patterns, or as database entities.

```php
class CustomerModel {
	private $id;
	private $name;
	/* constructor */
	/* get and set */
}
```

## Repositories
The Repository classes are made for manipulate the entities in database. Classes of repository type usually have CRUD functions. In the functions, you can ask for a model as parameter, or ask the raw data basically. It is up to you.

```php
class CustomerRepository {
	public static function update($id, $name) {
		$sql = "UPDATE customer SET name = '$name' WHERE id = $id";
		return DatabaseUtil::executeSql($sql);
    }
}
```

## Services
The Service classes provides business logics for the application. This kind of class is used for encapsulating business logic in a unique class of determinated purpose. Below there is an example of a service class:

```php
class CustomerService {
	public static function checkCustomerIsPrimary($customer) {
		/* ... */
	}
}
```

## Crons
Cron classes have just an execution method to be called by cron jobs from server or other source. The `Cron` interface can be used to define some class as a cron job.

## Pages
The application pages follow a design pattern to organization. The structure uses the HTML5 tags `<header> <main> <footer>` to represent the sections of the page.  The importation is localizated on the top of the page, and the script execution, on the bottom. Check the template below for an example of organization: 

```php
<?php
require_once(__DIR__ . "/../utils/ImportUtil.php");
ImportUtil::importPhpModules();

// Page event
EventUtil::page();
?>
<html>
    <head>
        <?php
        HtmlUtil::title("Basic Template");
        HtmlUtil::metatags();
        HtmlUtil::favicon();
        ImportUtil::importCssModules();
        ImportUtil::importJsModules();
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
The default pages of VrbStarterKit uses a background image that has been made at https://lonewolfonline.net/geometric-background-generator/. Check the site for more details. The library just has it for illustration and you can change it if you want.

## Manifest
The purpose of this project is to facilitate the applications or web sites development. This is not a framework, it is just a library to help you and to supply some common utilities. You don't need to follow the patterns, or keep the project like its initial design. Enjoy this, and create your projects faster! And thanks since now for everything!

## About
This project was developed in **Netbeans 12.0** IDE, using PHP language. The **XAMPP** environment was used for the application. As SGBD, I prefered to use **HeidiSQL**. This project is defined with **MIT** license (Open Source). Thanks and nice codding!
