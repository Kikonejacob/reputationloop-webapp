<!DOCTYPE html>
<html>

<header>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">

</header>
<body>


<div class="container">
	<div class="panel panel-default">
		  <div class="panel-heading">Business</div>
		  <div class="panel-body">

		  <h2>Information </h2>
		  <div id='bussiness-info'> 
		  </div>
		  <div>

			  <h2>Reviews </h2>
			  <div> <span> <b> Filter :  </b></span>
				  <input type="checkbox" checked onclick="refreshReviews()" id="ck-google" value="google"> <label for="ck-google">Google</label>
				  <input type="checkbox"  checked onclick="refreshReviews()"id="ck-internal" value="internal"> <label for="ck-internal">Internal</label>
				  <input type="checkbox"  checked onclick="refreshReviews()" id="ck-yelp" value="yelp"> <label for="ck-yelp">Yelp</label>

			  </div>

			  <div id='bussiness-reviews'> 
			  </div>

			  <div id='pagefooter'>
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

 
             <ul class="business-description">
              <li><span>Bussiness: </span>{{business_name}}</li>
              <li><span>Address: </span>{{business_addres}}</li>
              <li><span>Phone: </span>{{business_phone}}</li>
              <li><span>Average rating: </span>{{total_rating.total_avg_rating}}</li>
              <li><span>No reviews: </span>{{total_rating.total_no_reviews}}</li>

            </ul>
     
   
 </script>

<!--Template for pagination control -->
 <script id="pagination-template" type="x-handlebars-template">​
 
	 <nav>
	  <ul class="pagination">
	    
	    {{#each pages}}
	   		 <li><a href="#" onclick=setReviewsPage({{this}})> {{this}}</a></li>
	    {{/each}}

	    <li><span align=right> current: {{current}}</span></li>
	    
	  </ul>
	</nav>    
   
 </script>

<!--Template for reviews-->
 <script id="reviews-template" type="x-handlebars-template">​
 		{{#each this}}
 		<div class="panel panel-default">
		  <div class="panel-heading">{{date_of_submission}}</div>
		  <div class="panel-body">
		  	  <p><span>Name: </span>{{customer_name}}</p>
              <p><span>Last name: </span>{{customer_lastname}}</p>
		  	  <p><span>Description: </span>{{description}}</p>
		 	  <p><span>Date: </span>{{date_of_submission}}<</p>
              <p><span>Rating: </span>{{rating}}</p>

              <p><span>Review: </span>{{review_source}}</p>
              <p><a href={{customer_url}}> visit website </a></p>

           </div>
          </div>    
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


			var begin=(pageNumber*maxPages)-maxPages;
			appReg.pageReviews=appReg.reviews.slice(begin,begin+maxPages+1);
			RenderReviews(appReg.pageReviews);
			appReg.currentPage=pageNumber;


			/** Rendering pagination controls */

			var PageCount=Math.floor(appReg.reviews.length/maxPages);
			var rndPages=[];

			for (i=1;i<=PageCount;i++){
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

