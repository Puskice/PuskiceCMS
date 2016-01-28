<html>
<head>
	<title>Puškice API Docs</title>
	<link rel="stylesheet" href="//www.puskice.org/assets/frontend/css/bootstrap.min.css">
	<script src="//www.puskice.org/assets/frontend/js/bootstrap.min.js"></script>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-1599707-6', 'puskice.org');
	  ga('send', 'pageview');

	</script>
</head>
<body>
	<div class="container">
	  	<div class="row">
	    	<div class="col-md-9">
	    		<div class="page-header">
					<h1>Puškice API Docs <small>User manual :)</small></h1>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
	    				<a name="homepage"></a>
					    <h3 class="panel-title">Home page</h3>
					</div>
				  	<div class="panel-body">
				  		<ul>
				  			<li>
				    			<code>GET: https://api.puskice.org</code>
				    		</li>
				    	</ul>
				  	</div>
				  	<div class="panel-footer">
				  		Puškice API Docs page.
				  	</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<a name="news"></a>
					    <h3 class="panel-title">News API</h3>
					</div>
				  	<div class="panel-body">
				  		<ul>
				  			<li>
						    	<code>GET: https://api.puskice.org/news?page=1</code> - Same news as home page of site at https://www.puskice.org. Argument <code>page</code> is optional and can be ommited. It represents a pagination
						    </li>
						    <li>
						    	<code>GET: https://api.puskice.org/news/category/{num}?page=1</code> - All news from category with ID of <code>num</code>. Argument <code>page</code> is optional and can be ommited. It represents a pagination
						    </li>
						    <li>
						    	<code>GET: https://api.puskice.org/news/single/{num}</code> - Get a single article with ID of <code>num</code>.
						    </li>
						    <li>
						    	<code>GET: https://api.puskice.org/news/thumbs-up/{num}</code> - Thumb up article with ID of <code>num</code>.
						    </li>
						    <li>
						    	<code>GET: https://api.puskice.org/news/thumbs-down/{num}</code> - Thumb down article with ID of <code>num</code>.
						    </li>
					    </ul>
				  	</div>
				  	<div class="panel-footer">
				  		News API routes
				  	</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<a name="comments"></a>
					    <h3 class="panel-title">Comments API</h3>
					</div>
				  	<div class="panel-body">
				  		<ul>
				  			<li>
						    	<code>GET: https://api.puskice.org/comments?page=1</code> - Get all published comments in backward chronological order. Argument <code>page</code> is optional and can be ommited. It represents a pagination
						    </li>
						    <li>
						    	<code>GET: https://api.puskice.org/comments/news-comments/{num}?page=1</code> - Get paginated comments for article with ID of <code>num</code>. Argument <code>page</code> is optional and can be ommited. It represents a pagination
						    </li>
						    <li>
						    	<code>GET: https://api.puskice.org/comments/thumbs-up/{num}</code> - Thumb up comment with ID of <code>num</code>.
						    </li>
						    <li>
						    	<code>GET: https://api.puskice.org/comments/thumbs-down/{num}</code> - Thumb down comment with ID of <code>num</code>.
						    </li>
						    <li>
						    	<code>POST: https://api.puskice.org/comments/create/{article_id}</code> - Create a comment for article with ID of <code>article_id</code>. Required POST parameters are: <code>commentContent</code> representing content of a comment, <code>username</code> representing author username and <code>email</code> representing valid author email.
						    </li>
					    </ul>
				  	</div>
				  	<div class="panel-footer">
				  		Comment API routes
				  	</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<a name="pages"></a>
					    <h3 class="panel-title">Pages API</h3>
					</div>
				  	<div class="panel-body">
				  		<ul>
				  			<li>
						    	<code>GET: https://api.puskice.org/pages?page=1</code> - All static pages paginated. Argument <code>page</code> is optional and can be ommited. It represents a pagination
						    </li>
						    <li>
						    	<code>GET: https://api.puskice.org/pages/single/{id}</code> - Get a single static page with ID or permalink of <code>id</code> (number or string).
						    </li>
						    <li>
						    	<code>GET: https://api.puskice.org/pages/thumbs-up/{num}</code> - Thumb up static page with ID of <code>num</code>.
						    </li>
						    <li>
						    	<code>GET: https://api.puskice.org/pages/thumbs-down/{num}</code> - Thumb down static page with ID of <code>num</code>.
						    </li>
					    </ul>
				  	</div>
				  	<div class="panel-footer">
				  		Page API routes
				  	</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<a name="subjects"></a>
					    <h3 class="panel-title">Subjects API</h3>
					</div>
				  	<div class="panel-body">
				  		<ul>
				  			<li>
						    	<code>GET: https://api.puskice.org/subjects/specific/{semester?}/{department?}</code> - All subjects for given semester and given department. Arguments <code>semester</code> and <code>department</code> are optional and can be ommited. <br/>
						    	<strong>Important note</strong>: Both arguments are either set or unset. Otherwise they are ignored.
						    </li>
						    <li>
						    	<code>GET: https://api.puskice.org/subjects/single/{num}</code> - Get a single subject page with ID of <code>num</code>. JSON contains all files attached to this page, all lecturers, and all subject info.
						    </li>
						    <li>
						    	<code>GET: https://api.puskice.org/subjects/thumbs-up/{num}</code> - Thumb up subject page with ID of <code>num</code>.
						    </li>
						    <li>
						    	<code>GET: https://api.puskice.org/subjects/thumbs-down/{num}</code> - Thumb down subject page with ID of <code>num</code>.
						    </li>
					    </ul>
				  	</div>
				  	<div class="panel-footer">
				  		Subject API routes
				  	</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<a name="files"></a>
					    <h3 class="panel-title">Files API</h3>
					</div>
				  	<div class="panel-body">
				  		<ul>
				  			<li>
						    	<code>GET: https://api.puskice.org/files/show/{num}</code> - Get file with ID of <code>num</code>
						    </li>
						    <li>
						    	<code>GET: https://api.puskice.org/pages/thumbs-up/{num}</code> - Thumb up file with ID of <code>num</code>.
						    </li>
						    <li>
						    	<code>GET: https://api.puskice.org/pages/thumbs-down/{num}</code> - Thumb down file with ID of <code>num</code>.
						    </li>
					    </ul>
				  	</div>
				  	<div class="panel-footer">
				  		File API routes
				  	</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<a name="contacts"></a>
					    <h3 class="panel-title">Contacts API</h3>
					</div>
				  	<div class="panel-body">
				  		<ul>
				  			<li>
						    	<code>GET: https://api.puskice.org/contacts/single/{num}</code> - Get contact with ID of <code>num</code>
						    </li>
						    <li>
						    	<code>GET: https://api.puskice.org/contacts/marks/{contactId}?page=1</code> - Get marks for contact with ID of <code>contactId</code>. Argument <code>page</code> is optional and can be ommited. It represents a pagination
						    </li>
					    </ul>
				  	</div>
				  	<div class="panel-footer">
				  		Contact API routes
				  	</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<a name="polls"></a>
					    <h3 class="panel-title">Polls API</h3>
					</div>
				  	<div class="panel-body">
				  		<ul>
				  			<li>
						    	<code>GET: https://api.puskice.org/polls/current</code> - Get latest active poll
						    </li>
				  			<li>
						    	<code>GET: https://api.puskice.org/polls/show/{num}</code> - Get poll with ID of <code>num</code>
						    </li>
						    <li>
						    	<code>GET: https://api.puskice.org/polls/poll-results/{num}</code> - Get results for poll with ID of <code>num</code>
						    </li>
						    <li>
						    	<code>POST: https://api.puskice.org/polls/cast-vote</code> - Cast vote at poll. Required POST parameters are: <code>poll_id</code> representing poll ID and <code>option_id</code> representing poll option ID.
						    </li>
					    </ul>
				  	</div>
				  	<div class="panel-footer">
				  		Poll API routes
				  	</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<a name="codebook"></a>
					    <h3 class="panel-title">Code book</h3>
					</div>
				  	<div class="panel-body">
				  		<ul>
				  			<li>
				  				<h4>Departments</h4>
						  		<ol start="0">
						  			<li>Zajedničke osnove</li>
						  			<li>Informacioni sistemi i tehnologije</li>
						  			<li>Menadžment</li>
						  			<li>Operacioni menadžment</li>
						  			<li>Upravljanje kvalitetom</li>
							    </ol>
							</li>
							<li>
				  				<h4>Categories</h4>
						  		<ol start="1">
						  			<li>Info</li>
						  			<li>IT</li>
						  			<li>Biz</li>
						  			<li><em>None</em></li>
						  			<li><em>None</em></li>
						  			<li>Studentske organizacije</li>
						  			<li><em>None</em></li>
						  			<li>Fakultet</li>
						  			<li>Sport</li>
						  			<li>Rezultati</li>
						  			<li>Intervju</li>
						  			<li>Materijali</li>
						  			<li>PentaFON</li>
						  			<li><em>None</em></li>
						  			<li>Stipendija</li>
						  			<li>Gde su, šta rade?</li>
						  			<li>Naš komentar</li>
						  			<li>Magazin</li>
						  			<li>Prva godina</li>
						  			<li>Druga godina</li>
						  			<li>Treća godina</li>
						  			<li>Četvrta godina</li>
						  			<li>Zabava</li>
						  			<li>Prakse i zaposlenje</li>
						  			<li>Slika nedelje</li>
						  			<li>Kultura</li>
						  			<li>Dom Kulture Studentski grad</li>
						  			<li>Madlenianum</li>
						  			<li>Vesti</li>
						  			<li>Da li ste znali?</li>
						  			<li>Priručnik za buduče Beograđane</li>
						  			<li>Bioskop Fontana</li>
						  			<li>Međunarodne prilike by AIESEC</li>
						  			<li>IT devojke</li>
							    </ol>
							</li>
						</ul>
				  	</div>
				  	<div class="panel-footer">
				  		Code book - important parameter values
				  	</div>
				</div>
				
	    	</div>
	    	<div class="col-md-3">
	    		<div class="page-header">
					<h1>API <small>Menu</small></h1>
				</div>
				<div class="panel panel-default col-md-3" style="position:fixed;padding:0px;">
					<div class="panel-heading">
					    <h3 class="panel-title">Navigation</h3>
					</div>
				  	<div class="panel-body">
			    		<ul>
			    			<li><a href="#homepage">Home Page</a></li>
			    			<li><a href="#news">News API</a></li>
			    			<li><a href="#comments">Comments API</a></li>
			    			<li><a href="#pages">Pages API</a></li>
			    			<li><a href="#subjects">Subjects API</a></li>
			    			<li><a href="#files">Files API</a></li>
			    			<li><a href="#contacts">Contacts API</a></li>
			    			<li><a href="#polls">Polls API</a></li>
			    			<li><a href="#codebook">Code Book</a></li>
			    		</ul>
			    	</div>
			    </div>
	    	</div>
	  	</div>
	</div>
</body>
</html>