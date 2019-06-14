<html lang="en">

<head>

    <title>Bootstrap Typeahead with Ajax Example</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

</head>

<body>


<div class="row">

	<div class="col-md-12 text-center">

		<br/>

		<h1>Search Dynamic Autocomplete using Bootstrap Typeahead JS</h1>

			<input class="typeahead form-control" style="margin:0px auto;width:300px;" type="text">

	</div>

</div>


<script type="text/javascript">


	$('input.typeahead').typeahead({

	    source:  function (query, process) {

        return $.get('/ajaxpro.php', { query: query }, function (data) {

        		console.log(data);

        		data = $.parseJSON(data);

	            return process(data);

	        });

	    }

	});


</script>

</body>

</html>
