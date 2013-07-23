<html>
<head>
	<title>CodeIgniter Shoutbox</title>
	<link href="/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<style type="text/css">
		#messagewindow {
			height: 250px;
			border: 1px solid;
			padding: 5px;
			overflow: auto;
		}
		#wrapper {
			margin: auto;
			width: 438px;
		}
	</style>	
	<script type="text/javascript" src="/js/jquery-1.4.2.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			
			loadMsg();			
			hideLoading();
						
			$("form#chatform").submit(function(){
											
				$.post("/chat/update",{
							message: $("#content").val(),
							name: $("#name").val(),
							action: "postmsg"
						}, function() {
					
					$("#messagewindow").prepend("<b>"+$("#name").val()+"</b>: "+$("#content").val()+"<br />");
					
					$("#content").val("");					
					$("#content").focus();
				});		
				return false;
			});
			
			
		});

		function showLoading(){
			$("#contentLoading").show();
			$("#txt").hide();
			$("#author").hide();
		}
		function hideLoading(){
			$("#contentLoading").hide();
			$("#txt").show();
			$("#author").show();
		}
		
		function addMessages(xml) {
			
			$(xml).find('message').each(function() {
				
				author = $(this).find("author").text();
				msg = $(this).find("text").text();
				
				$("#messagewindow").append("<b>"+author+"</b>: "+msg+"<br />");
			});
			
		}
		
		function loadMsg() {
			$.get("/chat/backend", function(xml) {
				$("#loading").remove();				
				addMessages(xml);
			});
			
			//setTimeout('loadMsg()', 4000);
		}
	</script>

</head>
<body>
	<div class="container">
	<p id="messagewindow"><span id="loading">Loading...</span></p>
	<form id="chatform">
  
  <input class="input-block-level" type="text" id="name" placeholder="Name:" />
	<input class="input-block-level" type="text" id="content" placeholder="Message:" />
	
	<div id="contentLoading" class="contentLoading">  
	<img src="/images/blueloading.gif" alt="Loading data, please wait...">  
	</div><br />
	
	<button class="btn btn-large btn-primary" type="submit">Ok</button>

	</form>
	</div>
</body>
</html>