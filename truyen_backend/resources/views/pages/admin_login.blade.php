<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="{{Asset('assets/css/bootstrap.min.css')}}">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="{{Asset('assets/js/bootstrap.min.js')}}"></script>

	<script type="text/javascript" src="{{Asset('assets/js/jquery-validate/jquery.validate.js')}}"> </script>
	<title>LOGIN</title>
	<style type="text/css">
		body {
			margin:0;
			font-family: Tahoma; 

			color: #000000;
		}

		table {
			width: 483px;
			margin: auto;
		}

		#font_bule {
			font-family:Tahoma;
			font-size: 14px;
			font-weight: bold;
			color: #006699;
		}
		.pd_input {
			padding-left: 25px;
			padding-right: 25px;
		}
		#loginform {
			width: 484px;
			margin-top: 100px;
			margin-right: auto;
			margin-left: auto;
			margin-bottom: auto;
			border: 1px solid #a1a1a1;
			-webkit-border-radius: 10px;
			-moz-border-radius: 10px;
			border-radius: 10px;

		}
	</style>
</head>
<body>

	<div id="loginform" >
		<form class="form-signin" method="post" action="{{Asset('admin')}}">
		<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
			<table>
				<tr> 
					<td rowspan="4" style="padding-left: 20px; padding-right: 20px;  border-right: 1px solid #a1a1a1;">

						<h2 id="font_bule" class="form-signin-heading">Administrator Login</h2>
						<center><img src="{{Asset('assets/img/lock.jpg')}}"></center>
					</td>
					<td class="pd_input" style="padding-top:15px">    
						<div class="form-group">
							<label style="color: #666666">Username:</label>
							<input type="text" class="form-control" id="inputid" name="inputid"  required autofocus style="width:250px">
						</div>
					</td>
				</tr>
				<tr>
					<td class="pd_input">
						<div class="form-group">
						<!--for="inputpw"-->
							<label  style="color: #666666">Password:</label>
							<input type="password" class="form-control" id="inputpw" name="inputpw" required style="width:250px">
						</div>
					</td>
				</tr>

				<tr><td class="pd_input">
				@if(Session::has('admin_act_loginfail'))
				<?php Session::forget('admin_act_loginfail') ?>
				<p style=" color: red;" > Wrong Username or Password!</p>
				@endif
					<div class="checkbox">
						<label>
							<input type="checkbox" value="remember-me"> Remember me
						</label>
					</div>
				</td>
			</tr>
			<tr><td class="pd_input" style="padding-bottom:15px">
				<center><button class="btn btn-lg btn-primary btn-block" type="submit" style="width:100px; ce">Sign in</button></center>
			</td>
		</tr>
	</table>
</form>

</div> 
</body>
</html>