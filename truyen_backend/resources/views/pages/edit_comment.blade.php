@extends("pages/admin_main")


@section('rightcontent')

<table class="table table-bordered" >
	<thead>
		<tr >
			<th>ID</th>
			<th>Post by UserID</th>
			<th>Nội dung</th>
			<th>Post in CID</th>
			<th>Ngày tạo</th>
			<th>Ngày cập nhật</th>

			<th>Edit</th>
			<th>Delete</th>
		</tr>
	</thead>
	<tbody>
		<?php $dem=0; ?>
		@foreach($comments as $comment)
		@if (($dem%2)==0)
		<tr class="success">
			<?php $dem++; ?>
			@else
			<tr class="danger">
				<?php $dem++; ?>
				@endif
				<td><p>{{$comment->id }}</p></td>
				<td><p>{{$comment->postby_uid}}</p></td>
				<td><p>{{ $comment->noidung }}</p></td>
				<td ><p>{{$comment->postin_cid}}</p></td>

				<td><p>{{$comment->create_at}}</p></td>
				<td><p>{{$comment->update_at}}</p></td>

				<td style="text-align: center; width:60px;"><a href="#" ><img src="{{ Asset('assets/img/edit-icon.png') }}" style="width:32px; height:32px "></a></td>
				<td style="text-align: center; width:60px;">
					<a href="#" data-toggle="confirm" data-title='Bạn có muốn xóa Comment "{{$comment->noidung}}" đăng bởi UserID:"{{$comment->postby_uid}}" không?'>
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

	@if(Session::has('message_deleted'))

	<script>
	// Thông báo nếu phiên trước có xóa truyện
		$(function () {
			Example.show("{{Session::get('message_deleted')}}");
		});
	
	</script>
		<?php Session::forget('message_deleted') ?>
	@endif

	@endsection