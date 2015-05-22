@extends("pages/admin_main")


@section('rightcontent')
<style type="text/css">


	label.error {
		color: #c0392b;
	}


</style>

<div id="add-user">
	<form id="add-user-form" style="margin:0" method="post" action="{{Asset('admin/main/add-user')}}">
		<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
		<div class="form-group">
			<label for="username">*Tên đăng nhập:</label>
			<input type="text" class="form-control" id="username" name="username" required>
		</div>		
		<div class="form-group">
			<label for="password">*Mật khẩu:</label>
			<input type="password" class="form-control" id="password" name="password" required>
		</div>
		<div class="form-group">
			<label for="repassword">*Xác nhận mật khẩu:</label>
			<input type="password" class="form-control" id="repassword" name="repassword" required>
		</div>		
		<div class="form-group">
			<label for="lastname">*Last Name:</label>
			<input type="text" class="form-control" id="lastname" name="lastname" required>
		</div>
		<div class="form-group">
			<label for="firstname">*First Name:</label>
			<input type="text" class="form-control" id="firstname" name="firstname" required>
		</div>
		<div class="form-group">		
			<label for="email">Email:</label>
			<input type="email" class="form-control" id="email" name="email" placeholder="Email">	
		</div>
		<div class="form-group">		
			<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Add</button>
		</div>

	</form>
</div>

<div class="bb-alert alert alert-info" style="display:none;">
	<img src="{{Asset('assets/img/success-icon.png')}}" style="width:24px; height:24px" >
	<span>thong bao o day ne</span>
</div>
<div class="bb-alert-error alert alert-danger" style="display:none;">
	<img src="{{Asset('assets/img/fail-icon.png')}}" style="width:24px; height:24px" >
	<span>thong bao fail o day ne</span>
</div>

<script type="text/javascript">
	$("#add-user-form").validate({
		rules:{
			username:{
				required:true
			},
			password:{
				required:true
			},
			repassword:{
				required:true,
				equalTo:"#password"
			},
			lastname:{
				required:true,
			},
			firstname:{
				required:true,
			},
			email:{
				email:true,
			},															
		},
		messages:{
			username:{
				required:"Vui lòng nhập username"
			},
			password:{
				required:"Vui lòng nhập mật khẩu"
			},
			repassword:{
				required:"Vui lòng nhập xác nhận mật khẩu",
				equalTo:"Mật khẩu xác nhận không đúng!!!"
			},
			lastname:{
				required:"Vui lòng nhập Lastname",
			},
			firstname:{
				required:"Vui lòng nhập Firstname",
			},
			email:{
				email:"Định dạng email không đúng!!!",
			},

		}
	});	
</script>

@if(Session::has('admin_act_adduser'))
<script>
	// Thông báo nếu phiên trước có add long story
	$(function () {
		<?php
		$ack_data = Session::get('admin_act_adduser');
		?>
		if ("<?php echo $ack_data[0] ?>" == "success") {
			Example.init({"selector": ".bb-alert"});
			Example.show('<?php echo $ack_data[1] ?>');
		} else {
			Example.init({"selector": ".bb-alert-error"});
			Example.show('<?php echo $ack_data[1] ?>');			
		}

	});
	
</script>
<?php Session::forget('admin_act_adduser') ?>
@endif	

@endsection