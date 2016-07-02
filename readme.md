#ReputationLoop Code 

##by Kiswensida Kikone

Instructions : https://docs.google.com/document/d/1qTeB4KvUjIs8q_oMvHZXJclI-hNgWZf3nTTcluNNONE/edit#



GitHub Repository: https://github.com/Kikonejacob/reputationloop-webapp
Web application: https://rploop-app.herokuapp.com/

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