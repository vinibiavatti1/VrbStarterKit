# Kit Inicial Vrb
The VrbStarterKit is a pre implemented project with util features for PHP projects that uses the raw PHP programming concept. This kit includes a collections of services, utilities, deafult patterns, configurations and pre defined plugins. 

## Installing
To start to use this kit, download or clone this repository in your project diretory. After it, turn on the server and try to access the index.php from any browser. If you get it, your kit installation is finished. If the access gets bad, or some redirect error gets occured, please check the **config.php** file and put the correct configuration in thepre defined keys. Try again and success! Check the section below for configuring instructions. 

## Configuring
When you start the project, the **config.php** file needs to be configured according with project definitions. Some configurations as the title, key-words, responsivity, access data for database, base url, etc... need to be defined correctly. We recommend much to clone this file with production configuration (example: <b>productionConfig.php</b>), and change to the correct config file when the application gets up to prodution environment. 

> The <b>MATERIAL_DESIGN</b> is about the CSS framework kind you will use. By default, the bootstrap is set to the project, but you can change it to use the Material Design if you want. If you chose the material design, some util components can stop to work, and these components need to be reimplemented.

> The <b>IDIOM</b> configuration can be defined in the configuration file based on the files inside the **/app/translates** directory. If there is a session parameter configured in the <b>$_SESSION['IDIOMA']</b>, this configuration will be used as priority and the file that will be used will be the specified file for this key value.

## Patterns
The project uses camel case for any identifier. Every default PHP resources are in the <b>/app</b> folder.
The files use a suffix to define the kind of this file. The table below shows these definitions:

Suffix|Location|Description
---|---|---
Page|/app/pages|Páginas
Service|/app/services|Default functionalities collection
Types|/app/types|Constants collection
Action|/app/actions|Form actions
Ajax|/app/ajax|Return services for ajax requests
Component|/app/componentes|Components
Cron|/app/crons|Cron jobs implementations
Crud|/app/cruds|Manager services for database entities
Template|/app/templates|Any template type
Css|/app/styles|Cascade Stylesheets (CSS)
Js|/app/scripts|Scripts with algorithms (JS)
Eula|/app/eulas|Files with software policy
Sql|/app/sqls|Query language files (SQL)

## Serviços
Os serviços se tratam de funcionalidades padrões da aplicação. Abaixo seguem os serviços pré existentes no projeto, e sua definição:

Serviço|Definição
---|---
serv_banco_dados|Serviço de conexão e comandos de banco de dados
serv_cabecalho|Serviço de manipulação de cabeçalho HTTP
serv_cookie|Serviço para tratamento de cookies
serv_data|Serviço para tratamentos de datas
serv_email|Serviço de envio de e-mail com PHPMailer
serv_evento|Serviço de controle de eventos da aplicação
serv_html|Serviço de tratamento de Tags, atributos, etc... para arquivos HTML
serv_http|Serviço de controle de variáveis HTTP
serv_importacao|Serviço de importação de módulos
serv_ip|Serviço de endereço de IP
serv_log|Serviço de Log da aplicação
serv_seg|Serviço com validações de segurança para páginas, ações, ajax, etc
serv_sessao|Serviço de manipulação de sessões de usuário
serv_traducao|Serviço de Tradução de aplicação
serv_upload|Serviço para manipulação de arquivos e tratamento de diretórios
serv_url|Serviço de tratamento de URL e redirecionamento
serv_pdf|Serviço de criação de documentos Pdf com plugin Dompdf

## Importação
Qualquer importação da aplicação é realizada pelo serviço de importação <b>Serv_Importacao</b>, exceto por importações muito específicas. Este serviço tem como função realizar a importação de arquivos css, arquivos js, plugins e classes PHP. Quando qualquer recurso novo é adicionado na aplicação, este recurso deve ser adicionado neste serviço para que seja importado. Abaixo seguem as funções de importação deste serviço:

Rotina|Definição
---|---
importar_modulos_css()|Função de importação de arquivos CSS utilizando tags ```<link href="" />```
importar_modulos_js()|Função de importação de arquivos JS utilizando tags ```<script src=""></script>```
importar_modulos_php()|Função de importação de arquivos PHP utilizando a função ```require_once() ```

> A função ```Serv_Importacao::importar_classes_php() ``` realiza a importação de qualquer arquivo com extenção PHP das pastas <b>/app/componentes</b>, <b>/app/constantes</b>, <b>/app/cruds</b> e <b>/app/servicos</b>. O arquivo <b>/config.php</b> também é importado. Arquivos que contenham o prefixo <b>ignorar_</b> serão ignorados na rotina de importação.

## Componentes
Existem uma interface para criação de componentes na qual possui 3 métodos padrões que podem ou não ser implementados:

Método|Definição
---|---
html|Renderizar conteúdo HTML do componente
script|Renderizar Script JS do componente
estilo|Renderizar estilo CSS do componente
renderizar|Renderizar componente

Um componente é um objeto PHP, que possui seus atributos na qual manipulam a renderização do HTML, Script ou Estilo. Abaixo segue um exemplo de criação de um componente:

```php
$comp = new Comp_Bem_Vindo("Kit Inicial Vrb");
$comp->renderizar();
```

## Crud
As classes Crud servem para manipular entidades na base de dados. A interface disponibiliza 5 métodos para implementação:

Método|Definição
---|---
get($id)|Obter um registro do banco de dados pelo ID
listar($filtros)|Listar todos os regitros do banco de dados ou com base em um filtro especificado
inserir($dados)|Inserir registro no banco de dados
deletar($id)|Deletar registro do banco de dados pelo ID
atualizar($id, $dados)|Atualizar registro do banco de dados

## Cron
Classes Cron focam em uma execução através de algum trabalho cron (Cronjob). A interface cron possui somente o método <b>executar()</b> para ser implementado com base em sua função.

## Páginas
As páginas da aplicação seguem um padrão para organização. Abaixo segue um exemplo de página PHP:

```php
<?php
// Importação
require_once(__DIR__ . "/../servicos/serv_importacao.php");
Serv_Importacao::importar_classes_php();

// Evento de Página
Serv_Evento::pagina();
?>
<html>
    <head>
        <?php
        Serv_Html::titulo("Bem Vindo");
        Serv_Html::metatags();
        Serv_Importacao::importar_modulos_css();
        Serv_Importacao::importar_modulos_js();
        ?>
    </head>
    <body>
        <?php
        $comp = new Comp_Bem_Vindo("Kit Inicial Vrb");
        $comp->renderizar();
        ?>
    </body>
    <script>
        $(document).ready(function () {

        });
    </script>
</html>
```
## Sobre
O projeto foi desenvolvido na plataforma <b>Netbeans 8.1</b>, com a linguagem de programação PHP. O ambiente XAMPP foi utilizado para seu desenvolvimento. Ele utiliza a licença <b>MIT</b> de software livre. Seu autor foi Vinícius Reif Biavatti.
