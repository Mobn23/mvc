<!--
---
author: mo bn
---
-->

![Symfony image](.img/symfony.png)


This repo is here in order to guide you how to clone, install and get going with Symfony7, and contains a short explanation about MVC and Symfony Full-stack Framework.  
Mainly structure:
#### Config files:
YAML files in Symfony are used for configuration purposes, including defining services, routing, and parameters in a human-readable format.  
XML files are used for configuration purposes. They define various settings such as services, routing, and parameters in a structured format. XML configuration is an alternative to YAML and PHP configuration formats, providing a way to manage Symfony's configuration in a hierarchical and strict format.    
XML files are for actual application configuration, while xml.dist files are templates provided for developers to base their configurations on.    
package.json is for defining project metadata, dependencies, and scripts in Node.js applications.    
package.json is not typically used in Symfony. Symfony projects primarily use composer.json for PHP dependencies and symfony.lock for locking dependencies.    
package-lock.json is a file generated by npm when dependencies are installed in a Node.js project. It ensures deterministic and reproducible builds by locking down the versions of all dependencies and their sub-dependencies.  
composer.json in Symfony is used to define PHP dependencies and configurations for a project. It specifies which packages (libraries or frameworks) are required, their versions, and other settings related to the project's dependencies and autoload configurations. Additionaly, you can define custom scripts in the scripts section of your composer.json file. These scripts can perform tasks like running tests, clearing cache, executing commands, or any custom operations you define.  


#### Assets:
Assets in Symfony are used for managing and serving static files like images, stylesheets (CSS), JavaScript files, fonts, and other resources needed by a web application.  

#### Docs:
Contains the documented code using composer phpdoc(After we sat it in composer.json).  

### Src:
It typically contains the backend or server-side code of the application.Modules(classes) and Controllers(MC).  

### Templates:
It typically contains the frontend or client-side code of the application.Templates or Views(V).  

### Tests:
Contains the unitest files.  

### Tools:
Tools in Symfony are used for various tasks such as managing dependencies (Composer), running commands (Symfony CLI), testing (PHPUnit), ORM interactions (Doctrine CLI), debugging (Symfony Profiler), and generating code (Symfony Maker Bundle).  

### Var:
Contains the Database (SQLITE) and its  Cache and logs.  

### Public:
public directory in Symfony is for serving web-accessible files such as assets (CSS, JavaScript, images) and the front controller (index.php) that handles incoming HTTP requests.  


So Briefly, Models manage data and business logic.  
Controllers handle user requests and interact with models to retrieve or manipulate data.  
Views render data from controllers into user interfaces.  

Det är framförallt följande verktyg som du behöver tillgång till via terminalen. Så här ser det ut för mig:

$ php --version
PHP 8.3.4 (cli) (built: Mar 16 2024 08:40:08) (NTS)

$ composer --version
Composer version 2.4.1 2022-08-20 11:44:50

$ make --version
GNU Make 4.3

Utskriften hos dig kan skilja beroende av vilka versioner du har. Har du nyare versioner så är det bra. Har du äldre versioner så kan det fortfarande fungera, men var uppmärksam om du får bekymmer.

Klona kursrepot
====================

Du behöver uppdatera ditt dbwebb-cli samt klona och initiera kursrepot
Gå till din katalog för dbwebb-kurser

dbwebb selfupdate
dbwebb clone mvc
cd mvc
dbwebb init

Get going with Symfony
====================

https://github.com/dbwebb-se/mvc/tree/main/example/symfony

<!--
Exercise create a form (min, max) that posts to a route generating a random number between min and max.
-->
# mvc

# Scrutinizer my code 
[![Build Status](https://scrutinizer-ci.com/g/Mobn23/mvc/badges/build.png?b=main)](https://scrutinizer-ci.com/g/Mobn23/mvc/build-status/main)
[![Coverage](https://scrutinizer-ci.com/g/Mobn23/mvc/badges/coverage.png?b=main)](https://scrutinizer-ci.com/g/Mobn23/mvc/code-structure/main/code-coverage)
[![Quality](https://scrutinizer-ci.com/g/Mobn23/mvc/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/Mobn23/mvc/?branch=main)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/Mobn23/mvc/badges/code-intelligence.svg?b=main)](https://scrutinizer-ci.com/g/Mobn23/mvc/inspections/main)


## What is Symfony and how does it work?

Symfony is a PHP framework used for building web applications. It provides a set of reusable PHP components and a structured architecture that helps developers build scalable, maintainable, and efficient web applications. Symfony follows the Model-View-Controller (MVC) design pattern, which separates the application logic into three interconnected components: Model, View, and Controller. This separation facilitates the organization of code and promotes a clear division of responsibilities.

### Components of Symfony (MVC):
Model:
The Model represents the data and business logic of the application. It is responsible for retrieving data from the database, processing it, and returning the results to the Controller.
In Symfony, the Model is typically implemented using Doctrine, an Object-Relational Mapper (ORM) that simplifies database interactions.
View:
The View is responsible for rendering the user interface and displaying data to the user. It takes the data provided by the Controller and presents it in a structured format.
In Symfony, the View is often created using the Twig templating engine, which allows for the creation of dynamic and reusable templates.
Controller:
The Controller acts as an intermediary between the Model and the View. It processes user requests, interacts with the Model to fetch data, and passes this data to the View for rendering.
In Symfony, Controllers are typically classes that extend the base AbstractController class and define methods to handle specific routes or actions.
How Symfony Works (MVC Workflow):
Routing:

When a user sends a request (e.g., by accessing a URL), Symfony's routing component matches the request to a predefined route.
Each route is associated with a specific Controller method, which will handle the request.
Controller Action:

The matched Controller method is called.
The Controller may interact with the Model to retrieve or update data based on the request.
The Controller then prepares the data to be displayed and chooses the appropriate View (template) for rendering the response.
Model Interaction:

If data interaction is needed, the Controller calls the Model (or service) to fetch or manipulate data.
The Model handles the business logic and communicates with the database via the ORM (Doctrine).
View Rendering:

The Controller passes the data to the View.
The View (Twig template) renders the data into HTML and returns the final output.
Response:

The rendered HTML is sent back to the user's browser as the response to the initial request.
Example Workflow:
User Request:

User accesses a URL (e.g., /articles).
Routing:

The routing component maps /articles to a method in the ArticleController.
Controller Action:

ArticleController::index method is called.
The Controller retrieves a list of articles from the Model (e.g., ArticleRepository).
Model Interaction:

The ArticleRepository interacts with the database to fetch articles.
The data is returned to the Controller.
View Rendering:

The Controller passes the articles data to a Twig template (e.g., articles/index.html.twig).
The template generates the HTML with the articles list.
Response:

The generated HTML is sent back to the user's browser.
Advantages of Symfony:
Reusability: Components can be reused across different projects.
Scalability: The framework is designed to handle large and complex applications.
Maintainability: Clear separation of concerns (MVC) makes the codebase easier to maintain.
Community and Support: Symfony has a large community and extensive documentation.
Conclusion:
Symfony, with its MVC architecture, provides a robust and flexible framework for developing modern web applications. It encourages best practices in code organization and promotes efficient development workflows, making it a popular choice among PHP developers.
