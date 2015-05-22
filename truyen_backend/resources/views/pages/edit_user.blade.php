@extends("pages/admin_main")

@section('rightcontent')

<table class="table table-bordered" >
	<thead>
		<tr >
			<th>ID</th>
			<th>Username</th>
			<th>Lastname</th>
			<th>Firstname</th>
			<th>Email</th>	
			<th>Ngày tạo</th>
			<th>Ngày cập nhật</th>

			<th>Edit</th>
			<th>Delete</th>
		</tr>
	</thead>
	<tbody>
		<?php $dem=0; ?>
		@foreach($users as $user)
		@if (($dem%2)==0)
		<tr class="success">
			<?php $dem++; ?>
			@else
			<tr class="danger">
				<?php $dem++; ?>
				@endif
				<td><p>{{$user->id }}</p></td>
				<td><p>{{$user->username}}</p></td>
				<td><p>{{$user->lastname}}</p></td>
				<td ><p>{{$user->firstname}}</p></td>
				<td ><p>{{$user->email}}</p></td>				
				<td><p>{{$user->create_at}}</p></td>
				<td><p>{{$user->update_at}}</p></td>

				<td style="text-align: center; width:60px;"><a href="{{ route('edituser', $user->id) }}" ><img src="{{ Asset('assets/img/edit-icon.png') }}" style="width:32px; height:32px "></a></td>
				<td style="text-align: center; width:60px;">
					<a href="{{ route('deluser', $user->id) }}" data-toggle="confirm" data-title='Bạn có muốn xóa tài khoản "{{$user->username}}" không?'>
						<img src="{{ Asset('assets/img/delete-icon.png') }}" style="width:32px; height:32px ">
					</a>
				</td>
				@endforeach

			</tr>
		</tbody>
	</table>

	<div class="bb-alert alert alert-info" style="display:none;">
		<img src="{{Asset('assets/img/success-icon.png')}}" style="width:24px; height:24px" >
		<span>thong bao o day ne</span>
	</div>
	<div class="bb-alert-error alert alert-danger" style="display:none;">
		<img src="{{Asset('assets/img/fail-icon.png')}}" style="width:24px; height:24px" >
		<span>thong bao fail o day ne</span>
	</div>


	<script>
		$(function () {
			Example.init({
				"selector": ".bb-alert"
			});
			// Thông báo nếu phiên trước có xóa truyện


		});
		$(document).on("click", "[data-toggle=\"confirm\"]", function(e) {
			e.preventDefault();
			var lHref = $(this).attr('href');
			var lText = this.attributes.getNamedItem("data-title") ? this.attributes.getNamedItem("data-title").value : "Are you sure?";

			bootbox.confirm(lText, function (confirmed) {
				if (confirmed) {

					window.location.href = lHref;
               // Example.show("Hello world callback");
           }
       });
		});

	</script>

	@if(Session::has('admin_act_edituser'))
	<script>
	// Thông báo nếu phiên trước có add long story
	$(function () {
		<?php
		$ack_data = Session::get('admin_act_edituser');
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
<?php Session::forget('admin_act_edituser') ?>
@endif	

@if(Session::has('message_userdeleted'))

<script>
	// Thông báo nếu phiên trước có xóa truyện
	$(function () {
		Example.init({"selector": ".bb-alert"});		
		Example.show("{{Session::get('message_userdeleted')}}");
	});
	
</script>
<?php Session::forget('message_userdeleted') ?>
@endif

@endsection