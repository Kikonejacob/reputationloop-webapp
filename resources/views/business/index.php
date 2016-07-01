<!DOCTYPE html>
<html>

<header>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">

</header>
<body>
<div class="container">
	<div class="panel panel-default">
	  <div class="panel-heading">Panel heading without title</div>
	  <div class="panel-body">

	  <h2>Information </h2>
	  <div id='bussiness-info'> 
	  </div>

	  <h2>Reviews </h2>
	  <div> <span> <b> Filter :  </b></span>
		  <input type="checkbox" onclick="refreshReviews()" id="ck-google" value="google"> <label for="ck-google">Google</label>
		  <input type="checkbox" onclick="refreshReviews()"id="ck-internal" value="internal"> <label for="ck-internal">Internal</label>
		  <input type="checkbox" onclick="refreshReviews()" id="ck-yelp" value="yelp"> <label for="ck-yelp">Yelp</label>

	  </div>

	  <div id='bussiness-reviews'> 
	  </div>

	  <div id='pagefooter'>
	  <div>


	   
	  </div>
	</div>
</div>



</body>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.5/handlebars.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>


 <script id="bussines-info-template" type="x-handlebars-template">​

 
             <ul class="product-description">
              <li><span>Bussiness: </span>{{business_name}}</li>
              <li><span>Adress: </span>{{specs.storage}} GB</li>
              <li><span>Phone: </span>{{business_phone}}</li>

            </ul>
     
   
 </script>

 <script id="pagination-template" type="x-handlebars-template">​
 
	 <nav>
	  <ul class="pagination">
	    
	    {{#each this}}
	   		 <li><a href="#" onclick=setReviewsPage({{this}})> {{this}}</a></li>
	    {{/each}}
	    
	  </ul>
	</nav>    
   
 </script>


 <script id="reviews-template" type="x-handlebars-template">​
 		{{#each this}}
 		<ul class="product-description">
              <li><span>Bussiness: </span>{{date_of_submission}}<</li>
              <li><span>Adress: </span>{{customer_last_name}} GB</li>
              <li><span>Phone: </span>{{description}}</li>
              <li><span>Review: </span>{{review_source}}</li>
              <li><span>Url: </span>{{customer_url}}</li>

            </ul>       
          {{/each}}

             
     
      </script>         

  <script type="text/javascript">

    


	
	

		var appReg={
		   currentPage:1,
		   maxPages:5,
		   PageCount:1,
		   filter:{},
		   reviews:[],
		   pageReviews:[],
		   bussinesInfo:{}


	    }

		function setReviewsPage(pageNumber){

			var maxPages=appReg.maxPages;


			var begin=appReg.currentPage*maxPages-maxPages;
			appReg.pageReviews=appReg.reviews.slice(begin,begin+maxPages);
			RenderReviews(appReg.pageReviews);
		
		}

		function refreshReviews(){

			render(appReg);
		}

		
		function render(app){

			var url="api?";
			var params='';

			
			
			params=$("#ck-google").is(':checked') ? params+'google=1':params+'google=0';
			params=$("#ck-yelp").is(':checked') ? params+'&yelp=1':params+'&yelp=0';
			params=$("#ck-internal").is(':checked') ? params+'&internal=1':params+'&internal=0';

			url=url+params;


			$.getJSON( url, function( data ) {

				app.bussinesInfo=data.business_info;
				app.reviews=data.reviews;

				/* Rendering business informations*/

				renderBussinessInfo(app.bussinesInfo);
				
				/** Rendering first page of reviews */

				setReviewsPage(1);

				/** Rendering pagination controls */

				var PageCount=Math.floor(app.reviews.length/app.maxPages);
				var rndPages=[];

				for (i=1;i<=PageCount;i++){
					rndPages.push(i);
				}
				console.log(rndPages);

				RenderPagination(rndPages);
		   
			}.bind(this));
		}

		

		function renderBussinessInfo(data){
			var info = $('#bussiness-info');
			var TemplateScript = $("#bussines-info-template").html();
    		//Compile the template​
    		var Template = Handlebars.compile (TemplateScript);
    		console.log(info);
    		info.replaceWith (Template(data));


		} 
		function RenderReviews(data,page,reviews){

			var list = $('#bussiness-reviews');
			var TemplateScript = $("#reviews-template").html();
    		//Compile the template​
    		var Template = Handlebars.compile (TemplateScript);
    		console.log(list);
    		list.replaceWith (Template(data));

		}

		function RenderPagination(data){
			var list = $('#pagefooter');
			var TemplateScript = $("#pagination-template").html();
    		//Compile the template​
    		var Template = Handlebars.compile (TemplateScript);
    		console.log(list);
    		list.replaceWith (Template(data));

		}

	$(function () {

		render(appReg);

		


	});

</script>



</html>

