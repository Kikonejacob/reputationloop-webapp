<!DOCTYPE html>
<html>

<header>


	<title>ReputationLoop-Kikone-Kiswendsida-Business Informations</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Kiswendsida Kikone">


	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">

	<style>

		body {background-color:lightgrey;}
		h2   {color:blue;}
		.star    {
			color:#E49A29;
		}
		.business-description{

			font-size: medium;
			list-style-type: none;

		}
		.filter-box{ /* Disable filter box */

			pointer-events:none;
			color:#EBEBE4;
		}


	</style>



</header>
<body>

	<div class="container">

		<div class="panel panel-default">
			<div class="panel-heading"><b><span class="glyphicon glyphicon-th-large"> </span> Business</b></div>
			<div class="panel-body">

			 	<div>
				  <div id='bussiness-info'> 
				  		<!--Will hold business informations -->
				  </div>
				</div>

			    <div>
				  <h2>Reviews </h2>
				  <div class="filter-box" disabled="disabled"> <span> <b> Filter :  </b></span>
					  <input type="checkbox" checked onclick="refreshReviews()" id="ck-google" value="google"> <label for="ck-google">Google</label>
					  <input type="checkbox"  checked onclick="refreshReviews()"id="ck-internal" value="internal"> <label for="ck-internal">Internal</label>
					  <input type="checkbox"  checked onclick="refreshReviews()" id="ck-yelp" value="yelp"> <label for="ck-yelp">Yelp</label>

				  </div>

				  <div id='bussiness-reviews'> 
				  		<!--Will hold business reviews -->
				  </div>

				  <div id='pagefooter'>
				  		<!--Will hold page number control -->

				  </div>
				</div>


			   
			  </div>
		</div>

	</div>



</body>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.5/handlebars.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>

<!--Template for business informations -->
 <script id="bussines-info-template" type="x-handlebars-template">​
 	<h2> {{business_name}} </h2>
    <ul class="business-description">
      <li><span>Business name: </span>{{business_name}}</li>
      <li><span>Address: </span>{{business_address}}</li>
      <li><span>Phone: </span>{{business_phone}}</li>
      <li><span>Average rating: </span>{{#stars total_rating.total_avg_rating}}{{/stars}}({{total_rating.total_avg_rating}})</li>
      <li><span>No reviews: </span>{{total_rating.total_no_of_reviews}}</li>

    </ul>
 
   
 </script>

<!--Template for pagination control -->
 <script id="pagination-template" type="x-handlebars-template">​
 
	 <nav>
	  <ul class="pagination">
	 
	    {{#each pages}}
	   		 <li><a href="#" onclick=setReviewsPage({{this}})> {{this}}</a></li>
	    {{/each}}

	    <li><span> Current: {{current}}</span></li>
	    
	  </ul>
	</nav>    
   
 </script>

<!--Template for reviews-->
 <script id="reviews-template" type="x-handlebars-template">​
 	{{#each this}}
 		<div class="panel panel-default comment">
		  <div class="panel-heading commentheader"><span class="glyphicon glyphicon-comment"> </span> {{ date_of_submission}}</div>
		  <div class="panel-body">
		  	  <p><span>Name: </span>{{customer_name}}</p>
              <p><span>Last name: </span>{{customer_lastname}}</p>
		  	  <p><span>Description: </span>{{description}}</p>
		 	  <p><span>Date: </span>{{date_of_submission}}</p>
              <p><span>Rating: </span>{{#stars rating}}{{/stars}}</p>

              <p><span>Review source: </span>{{#from review_from }}{{/from}}</p>
              <p><span>Review from: </span>{{review_source}}</p>
              <p><a href={{customer_url}}> <span class="glyphicon glyphicon-globe" > </span> visit website </a></p>

           </div>
          </div>    
     {{/each}}

             
     
  </script>      

  <script type="text/javascript">

  	//App Default setting
	 var appReg={
	   currentPage:1,
	   maxPages:5,
	   PageCount:1,
	   filter:{},
	   reviews:[],
	   pageReviews:[],
	   bussinesInfo:{},
	   reviewFrom:{internal:0, yelp:1, google:1}


    }
    Handlebars.registerHelper('from', function(context, options) {
    	var review_from = {0: 'internal', 1: 'yelp', 2: 'google'};
	    return review_from[context];
	});

    /* handle bar for star */
	Handlebars.registerHelper('stars', function(context, options) {
	 	var ret="";
	 	var count=Math.round(context)
	 	for (var i=1;i<=count;i++){


	 	  	ret+="<span class='glyphicon glyphicon-star star'> </span>";
			     
	 	}
	 	for (vari=count+1;i<=5;i++){

	 	  	ret+="<span class='glyphicon glyphicon-star-empty'> </span>";
			     
	 	}
	 	
		
		return ret;
	});

	 

	function setReviewsPage(pageNumber){

		var maxPages=appReg.maxPages;


		var begin=(pageNumber*maxPages)-maxPages;
		appReg.pageReviews=appReg.reviews.slice(begin,begin+maxPages+1);
		RenderReviews(appReg.pageReviews);
		appReg.currentPage=pageNumber;


		/** Rendering pagination controls */

		var PageCount=Math.floor(appReg.reviews.length/maxPages);
		var rndPages=[];

		for (var i=1;i<=PageCount;i++){
			rndPages.push(i);
		}
		

		RenderPagination(rndPages,appReg.currentPage);
	
	}

	function refreshReviews(){

		render(appReg);
	}

	
	function render(app){

		var url="api?";
		var params='';

		
		app.reviewFrom.google=$("#ck-google").is(':checked') ?1:0;
		app.reviewFrom.yelp=$("#ck-yelp").is(':checked') ?1:0;
		app.reviewFrom.internal=$("#ck-internal").is(':checked') ?1:0;


		params=params+'google='+app.reviewFrom.google;
		params=params+'&yelp='+app.reviewFrom.yelp;
		params=params+'&internal='+app.reviewFrom.internal;
/*
		params=$("#ck-google").is(':checked') ? params+'google=1':params+'google=0';
		params=$("#ck-yelp").is(':checked') ? params+'&yelp=1':params+'&yelp=0';
		params=$("#ck-internal").is(':checked') ? params+'&internal=1':params+'&internal=0';

*/

		url=url+params;


		$.getJSON( url, function( data ) {

			app.bussinesInfo=data.business_info;
			app.reviews=data.reviews;

			/* Rendering business informations*/

			renderBussinessInfo(app.bussinesInfo);
			
			/** Rendering first page of reviews */

			setReviewsPage(1);

			
	   
		}.bind(this));
	}

	

	function renderBussinessInfo(data){
		var info = $('#bussiness-info');
		var TemplateScript = $("#bussines-info-template").html();
		var Template = Handlebars.compile (TemplateScript);
		info.replaceWith (Template(data));


	} 
	function RenderReviews(data){


		var list = $('#bussiness-reviews');
		var TemplateScript = $("#reviews-template").html();
		var Template = Handlebars.compile (TemplateScript);
		list.empty();
		list.append (Template(data));

	}

	function RenderPagination(data,current){
		var pagelist = $('#pagefooter');
		var TemplateScript = $("#pagination-template").html();
		var Template = Handlebars.compile (TemplateScript);
		pagelist.empty();
		pagelist.append (Template({pages:data,current:current}));

	}

	$(function () {

		render(appReg);

		


	});

</script>



</html>

