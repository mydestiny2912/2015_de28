@extends("pages/admin_main")


@section('rightcontent')

<style type="text/css">


	label.error {
		color: #c0392b;
	}


</style>

<div id="update-user">
	<form id="update-user-form" style="margin:0" method="POST" action="{{ route('edituser_post', $users->id) }}">
		<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
		<div class="form-group">
			<label for="username">*Tên đăng nhập:</label>
			<input type="text" class="form-control" id="username" name="username" required value="{{ $users->username }}">
		</div>		
		<div class="form-group">
			<label for="password">*Mật khẩu:</label>
			<input type="password" class="form-control" id="password" name="password" required value="abcd" >
		</div>
		<div class="form-group">
			<label for="repassword">*Xác nhận mật khẩu:</label>
			<input type="password" class="form-control" id="repassword" name="repassword" required value="abcd">
		</div>		
		<div class="form-group">
			<label for="lastname">*Last Name:</label>
			<input type="text" class="form-control" id="lastname" name="lastname" required value="{{ $users->lastname }}">
		</div>
		<div class="form-group">
			<label for="firstname">*First Name:</label>
			<input type="text" class="form-control" id="firstname" name="firstname" required value="{{ $users->firstname }}"
		</div>
		<div class="form-group">		
			<label for="email">Email:</label>
			<input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ $users->email }}">	
		</div>
		<div class="form-group">		
			<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
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
	$("#update-user-form").validate({
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


@endsection