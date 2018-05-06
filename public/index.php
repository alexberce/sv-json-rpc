<html>
<head>
	<title>SmartValue - Country Viewer</title>
	<script
			src="https://code.jquery.com/jquery-2.2.4.min.js"
			integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
			crossorigin="anonymous"></script>
	
	<link rel="stylesheet" type="text/css" href="assets/css/style.css" />
</head>
<body>
	<div id="app">
		<input placeholder="Country code..." type="text" id="country" name="country" />
		
		<div id="result">
			<div>Country name: <span id="country-name"></span></div>
			<div>Country prefix: <span id="country-prefix"></span></div>
		</div>
		
		<div id="error"></div>
	</div>
	
	<script type="text/javascript" src="assets/js/scripts.js" ></script>
</body>

</html>