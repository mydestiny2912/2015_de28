@extends("pages/admin_main")


@section('rightcontent')

<style type="text/css">
	.td-label {
		text-align: right;
	}

	label.error {
		color: #c0392b;
	}

	.borderless tbody tr td {
    border: none;
	}
	.dpinl {
		display: inline;
	}
	.borderless input{
		width: 280px;
	}
</style>
<div id="changepass-admin" style="height:100%; width:100%;">
	<form id="changepass-form" style="margin:0" method="post" action="{{Asset('admin/main/changepass-admin')}}">
		<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
		<table class="table borderless" style="width:550px; margin-left: 50px;">
			<tr>
				<td class="td-label"><label class="dpinl">Tên Admin: </label></td>
				<td>
					@if(Session::has('admin_act_loggedinid'))
					<p class="dpinl" style=" color:#FA5858;" >{{ Session::get('admin_act_loggedinid') }}</p>
					<input type="hidden" id="username_admin" name="username_admin" value="<?php echo Session::get('admin_act_loggedinid') ?>">
					@endif
				</td>
			</tr>
			<tr>
				<td class="td-label"><label class="dpinl">Mật khẩu cũ: </label></td>
				<td >
					<input type="password" class="form-control" id="oldpass" name="oldpass" required>
				</td>
			</tr>
			<tr>
				<td class="td-label"><label>Mật khẩu mới: </label></td>
				<td>
					<input type="password" class="form-control" id="newpass" name="newpass" required>
				</td>
			</tr>
			<tr>
				<td class="td-label"><label>Xác nhận mật khẩu mới: </label></td>
				<td>
					<input type="password" class="form-control" id="confirm_newpass" name="confirm_newpass" required>
				</td>
			</tr>
			<tr style="height: 50px">
				<td></td>
				<td ><button type="submit" class="btn btn-default"><span class="glyphicon glyphicon glyphicon-floppy-disk"></span> Change</button></td>
			</tr>
		</table>
	</form>
</div>	

<div class="bb-alert alert alert-success" style="display:none;">
	<img src="{{Asset('assets/img/success-icon.png')}}" style="width:24px; height:24px" >
	<span>thong bao success o day ne</span>
</div>
<div class="bb-alert-error alert alert-danger" style="display:none;">
	<img src="{{Asset('assets/img/fail-icon.png')}}" style="width:24px; height:24px" >
	<span>thong bao fail o day ne</span>
</div>
<script type="text/javascript">
	$("#changepass-form").validate({
		rules:{
			confirm_newpass:{
				equalTo:"#newpass"
			}
		},
		messages:{
			oldpass:{
				required:"Vui lòng nhập mật khẩu cũ"
			},
			newpass:{
				required:"Vui lòng nhập mật khẩu mới"
			},
			confirm_newpass:{
				required:"Vui lòng nhập xác nhận mật khẩu mới",
				equalTo:"Mật khẩu xác nhận không đúng"
			}
		}
	});	
</script>
@if(Session::has('admin_act_changepass'))

<script>
	// Thông báo nếu phiên trước có xóa truyện
	$(function () {
		if ("{{Session::get('admin_act_changepass')}}" == "success") {
			Example.init({"selector": ".bb-alert"});
			Example.show("Thay đổi mật khẩu thành công!");
		} else {
			Example.init({"selector": ".bb-alert-error"});
			Example.show("Thay đổi mật khẩu không thành công.</br>Mật khẩu cũ không đúng!");			
		}

	});
	
</script>
<?php Session::forget('admin_act_changepass') ?>
@endif

@endsection