<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title> Calendar Scheduler System</title>
	<link rel="stylesheet" type="text/css" href="view/assets/css/main.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/main.css" />	
	<link href='http://fonts.googleapis.com/css?family=Lato:normal' rel='stylesheet' type='text/css' />
			
	<script type="text/javascript" src="view/assets/js/jquery-1.5.1.min.js"></script>
	<script type="text/javascript" src="assets/js/jquery-1.5.1.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>

	
	<script type="text/javascript">

		function showAjaxLoader(){
			$("#ajax_loader_container").html("<div align=\"center\" style='padding-top: 98px;' ><img src=\"assets/images/ajax-loader.gif\" title=\"Loading...\" id=\"loading\" /></div>");
		} 
		function doLogin() {
			$("#login-container").hide();
			height = Math.round($("#login-container").height()/2);			
			showAjaxLoader();			
			userName = $('#user-name').val();			
			password = $('#user-password').val();
			
			$.ajax({		
				type: "POST",
				url: "controller/LoginController.php",
				data: "userName="+userName+"&password="+password,
				success: function(data) {					
					if($.trim(data) == "OK"){
						window.location.href="view/home.php";
					} else{
						$("#ajax_loader_container").html("");						
						$("#login-container").show();
						showErrorNotice(data);
					}
					
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					alert(XMLHttpRequest.status+" ERROR!");
				}
			}); 
			
		}
		
		
		function showErrorNotice(message) {
			html = 	"<div class='error-notice'>" + message + "</div>";
			$('#notices').html(html);
			notice = $('#notices').find('.error-notice');						
			notice.show('blind', { direction: 'vertical' });	
			/*window.setTimeout(function() {							
				notice.hide('blind', { direction: 'vertical' });
			}, 3000);*/

		}
		function showSuccessNotice(message) {
			html = 	"<div class='success-notice'>" + message + "</div>";
			$('#notices').html(html);
			notice = $('#notices').find('.success-notice');					
			notice.show('blind', { direction: 'vertical' });
			window.setTimeout(function() {							
				notice.hide('blind', { direction: 'vertical' });
			}, 3000);			
				
		}
		function showForgotPassword() {
			$("#login-form-container").hide();
			$("#divForgotPassowrd").show();
		}

		function hideForgotPassword() {			
			$("#divForgotPassowrd").hide();
			$("#login-form-container").show();
		}		
		                      	
		$(document).ready(function() {
			//$('#show_forgot_password').click(showForgotPassword);
			//$('#send_password').click(sendEmailPassword);
			//$('#cancel_password').click(hideForgotPassword);
			$(document).keyup(function(e) {
				if(e.keyCode == 13) {
					doLogin();
					/*if($('#login-form-container').is(':visible')) {
						doLogin();
					}else {
						sendEmailPassword();
					}*/
				}
			});						 
		});
	</script>

		
</head>

<body>
		<div class="success" style="height: 13px; margin-top: 0px;">
		<p>
			Welcome to Calendar Scheduler System!
		</p>
		</div>

<div id="floater"></div>
<div id="content">
	<div id="notices"></div>
	<div class="main">
				
		<div id="login-container">
			<h1 id="login-text">LOGIN</h1>
			<div id="login-form-container" class="login-form-container">
				<div class="login-form">
					<form>

						<div style="float: left; text-align: right; margin-right: 5px;">			
							<div style="margin-bottom: 11px;">Username:</div>

							<div>Password:</div>
							
						</div>
						<div style="float: left;">			
							<input id="user-name" name="user-name" type="text" />
							<br/>
							<input id="user-password" name="user-password" type="password" style="margin-top: 7px;" />			
						</div>		
						<div style="clear: both;"></div>
						<!-- 
						<div class="forgot-password-container">
							<a id="show_forgot_password" href="#">Forgot your Username or Password?  Click here.</a>
						</div>
						-->						
						<div style="clear: both;"></div>
						<input type="button" value="Login" onclick="javascript:doLogin();" 
							style="float: right; margin-right: 15px; margin-top: 5px;" />			
						<div style="clear: both;"></div>
						
					</form>			
				</div>
			</div>
			<!-- 
			<div id="divForgotPassowrd" class="forgot-password" >
				<h2>Forgot password:</h2>				
				<br/>
				<p>Email Address: <input type="text" id="email" name="email" maxlength="100" size="90" /></p>
				<br />			
				<input id="send_password" type="submit" value="Submit" name="submit" />
				<input id="cancel_password" type="submit" value="Cancel" name="submit" />				
			</div>
			-->			
		</div>
		<div id="ajax_loader_container"></div>
	</div>

	<div class="links">
		<!-- 
		<a href="footer/prefaq"><span>faq</span></a>
		<a href="footer/predisclaimer"><span>disclaimer</span></a>
		<a href="footer/preprivacyPolicy"><span>privacy policy</span></a>
		 -->
	</div>
</div>

</body>
</html>