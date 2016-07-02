# Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).


#ReputationLoop Code 

#by Kiswensida Kikone

Instructions : (https://docs.google.com/document/d/1qTeB4KvUjIs8q_oMvHZXJclI-hNgWZf3nTTcluNNONE/edit#)



GitHub Repository: (https://github.com/Kikonejacob/reputationloop-webapp)
Web application: (https://rploop-app.herokuapp.com/)

##Description:

I decided to use these frameworks:
	Laravel for Php programming
	Boostrap for css
	Handlebarjs for template and jquery for javascript

First, I created a backend  API which makes a request to the original API  server and returns the response. My backend API allows user to define filter like reviews from google,internal or yelp. This structure allows me to resolve Cross-Origin problem in the browser. I have two routes in my Laravel application: / which give access to the application and /api which give access to the API.

Second, I created the user interface using HTML,  CSS  and JavaScript. The index file is stored in laravel folder “/ressources/views/business/index.php” . Since I’m building a single page application that loads once I decided to use JavaScript for pagination and templates.  I created template for reviews items and also for business informations using handlebars. 

Last, I enhance a little bit the design and deployed it into heroku.  I add icons and star images bu still keep a simple design.   I created an app in heroku called rploop-app and use git to deploy the app on heroku. 

I had many other ways to implement this project like using Reactjs for template or render the template using blade in laravel , etc.  It took me around 3hours to complete this project.



For any question about my work , don’t hesitate to contact me. 
Thank you