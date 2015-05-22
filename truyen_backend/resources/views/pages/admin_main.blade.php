<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<!--
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
		<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>-->
	<link rel="stylesheet" href="{{Asset('assets/css/bootstrap.min.css')}}">
	<script src="{{Asset('assets/js/jquery-2.1.4.min.js')}}"></script>
	<script src="{{Asset('assets/js/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{Asset('assets/js/jquery-validate/jquery.validate.js')}}"> </script>

	<script src="{{Asset('assets/js/bootbox.min.js')}}"></script>
	<script src="{{Asset('assets/js/example.js')}}"></script>

	<title>{{ $title_top }} </title>
	<style type="text/css">
		#container {
			margin-left: auto;
			margin-right: auto;
			width: 1200px;
		}
		#header {
			background-color: #40474A;
			margin-left: auto;
			margin-right: auto;
			width: 1200px;
			height: 100px;
		}
		#footer {
			clear: both;
			background-color: #40474A;
			margin-left: auto;
			margin-right: auto;
			width: 1200px;
			height: 100px;
		}
		#navigation {
			background-color: #5C6467;
			margin-left: auto;
			margin-right: auto;
			width: 1200px;
			height: 30px;

		}

		body {
			font-family: Tahoma; 
			background-color: #F5F5F0;
			margin: 0;
			padding: 0;

		}
		#namepage h1 {
			margin:0;

			padding:0; color:white; 
			/*font: 20px "Lucida Grande", Arial, Verdana, sans-serif;*/
			font-family: Tahoma;
			display:table-cell; 
			vertical-align:middle

		}
		#namepage {
			margin-left: 30px;
			display: table;
			height:100px;
			width:600px;
		}
		#body_er{
			margin-left: auto;
			/*margin-right: 30px;*/
			margin-right: auto;
			width: 1200px;
		}
		#left_content {
			width: 250px;
			float: left;

		}
		#right_content {
			width: 940px;
			margin-left: 10px;
			float: left;

		}
		.panel-body ul{
			margin-top: 0;
			margin-bottom: 0;
			margin-left:-15px;
			margin-right: -15px;
			/*list-style-type: none;*/

		}
		.panel.panel-default {
			margin-bottom:5px;
		}
		.panel-body {
			padding-bottom: 0;
			padding-top: 0;
		}

		.bb-alert,.bb-alert-error
		{
			position: fixed;
			bottom: 25%;
			right: 0;
			margin-bottom: 0;
			font-size: 1.2em;
			padding: 1em 1.3em;
			z-index: 2000;
		}
		.nav-pills .active{
			background-color: red;
		}

	</style>

</head>
<body>
	<div id="container">
		<div id="header">
			<div id="namepage">
				<h1 style=""><a href="{{Asset('admin/main')}}" style="color: white">Administrator Control Panel</a></h1>
			</div>
		</div>
		<div id="navigation">
			<div id="navi_left" style="float:left; color: white; margin-top: 5px; margin-left:5px">
				@if (isset($time_now_vietnam))
				<p> {{ $time_now_vietnam}}</p>
				@endif
			</div>
			<div id="navi_right" style=" display: inline; float:right; color: white; margin-top: 5px; margin-right:5px">
				<p style=" display: inline;">Logged in as: </p>
				<b>
					@if(Session::has('admin_act_loggedinid'))
					<p style=" color:#FA5858; display: inline;" >{{ Session::get('admin_act_loggedinid') }}</p>
					@endif
					<p style="display: inline;">[ </p><a href="{{ Asset('admin/logout') }}" style=" color:#CEA527; display: inline;" >Logout</a><p style="display: inline;"> ]</p>
				</b>
			</div>
		</div>
		<div id="body_er" style="min-height: 800px">
			<h2 style="text-align: right; border-bottom-style: groove; padding-right: 20px;">{{ $title_name }}</h2>
			<div id="left_content">

			<div class="panel-group">

				<div class="panel panel-default" >
					<div class="panel-heading" style="background-color:#3A4043; color:white">Quản lý User</div>
					<div class="panel-body" >
						<ul class="nav nav-pills nav-stacked">
							<li><a href="{{Asset('admin/main/add-user')}}"><img src="{{Asset('assets/img/ios7-pricetags-outline.png')}}" alt="a picture" width="14px" height="14px" style="margin-right:5px">Tạo User</a></li>
							<li><a href="{{Asset('admin/main/edit-user')}}"><img src="{{Asset('assets/img/ios7-pricetags-outline.png')}}" alt="a picture" width="14px" height="14px" style="margin-right:5px">Chỉnh sửa User</a></li>
						</ul>
					</div>
				</div>				
				<div class="panel panel-default">
					<div class="panel-heading" style="background-color:#3A4043; color:white">Quản lý truyện</div>
					<div class="panel-body">
						<ul class="nav nav-pills nav-stacked">
							<li><a href="{{Asset('admin/main/manage-category')}}"><img src="{{Asset('assets/img/ios7-pricetags-outline.png')}}" alt="a picture" width="14px" height="14px" style="margin-right:5px">Manage Category</a></li>
							<li><a href="{{Asset('admin/main/add-story')}}"><img src="{{Asset('assets/img/ios7-pricetags-outline.png')}}" alt="a picture" width="14px" height="14px" style="margin-right:5px">Thêm truyện lẻ</a></li>
							<li><a href="{{Asset('admin/main/edit-story')}}"><img src="{{Asset('assets/img/ios7-pricetags-outline.png')}}" alt="a picture" width="14px" height="14px" style="margin-right:5px">Chỉnh sửa truyện lẻ</a></li>
							<li><a href="{{Asset('admin/main/add-long-story')}}"><img src="{{Asset('assets/img/ios7-pricetags-outline.png')}}" alt="a picture" width="14px" height="14px" style="margin-right:5px">Thêm truyện bộ</a></li>
							<li><a href="{{Asset('admin/main/edit-long-story')}}"><img src="{{Asset('assets/img/ios7-pricetags-outline.png')}}" alt="a picture" width="14px" height="14px" style="margin-right:5px">Chỉnh sửa truyện bộ</a></li>						
						</ul>
					</div>
				</div>
					<div class="panel panel-default" >
					<div class="panel-heading" style="background-color:#3A4043; color:white">Quản lý Adminstrator</div>
					<div class="panel-body" >
						<ul class="nav nav-pills nav-stacked">
							<li><a href="{{Asset('admin/main/changepass-admin')}}"><img src="{{Asset('assets/img/ios7-pricetags-outline.png')}}" alt="a picture" width="14px" height="14px" style="margin-right:5px">Đổi mật khẩu</a></li>
							<li><a href="{{Asset('admin/main/edit-comment')}}"><img src="{{Asset('assets/img/ios7-pricetags-outline.png')}}" alt="a picture" width="14px" height="14px" style="margin-right:5px">Quản lý Comment</a></li>
							
						</ul>
					</div>
				</div>							
			</div>			
		</div>
		<div id="right_content">
			@yield('rightcontent')

		</div>


	</div>	
	<div id="footer">

	</div>

</div>

<script>

</script>
</body>
</html>