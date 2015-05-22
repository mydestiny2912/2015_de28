@extends("pages/admin_main")


@section('rightcontent')

<table class="table table-bordered" >
	<thead>
		<tr >
			<th>ID</th>
			<th>Category</th>
			<th>Tên</th>
			<th>Tác giả</th>
			<th>Nội dung</th>
			<th>Lượt xem</th>
			<th>Ngày tạo</th>
			<th>Ngày cập nhật</th>
			<th>Người đăng</th>
			<th>View</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
	</thead>
	<tbody>
		<?php $dem=0; ?>
		@foreach($contents as $content)
		@if (($dem%2)==0)
		<tr class="success">
			<?php $dem++; ?>
			@else
			<tr class="danger">
				<?php $dem++; ?>
				@endif
				<td><p>{{$content->id }}</p></td>
				<td><p>{{$content->cat}}</p></td>
				<td><p>{{$content->ten}}</p></td>
				<td ><p>{{$content->tacgia}}</p></td>

				<td><p>{{ str_limit($content->noidung, $limit = 30, $end = '...') }}</p></td>
				<td style="text-align: center;"><p>{{$content->xem}}</p></td>
				<td><p>{{$content->create_at}}</p></td>
				<td><p>{{$content->update_at}}</p></td>
				<td><p>{{$content->nguoidang}}</p></td>
				<td style="text-align: center; width:60px; "><a href="{{ route('viewstory', $content->id) }}"  data-toggle="view"><img src="{{ Asset('assets/img/view-icon.png') }}" style="width:32px; height:32px "></a></td>
				<td style="text-align: center; width:60px;"><a href="{{ route('editstory', $content->id) }}" ><img src="{{ Asset('assets/img/edit-icon.png') }}" style="width:32px; height:32px "></a></td>
				<td style="text-align: center; width:60px;">
					<a href="{{ route('delstory', $content->id) }}" data-toggle="confirm" data-title='Bạn có muốn xóa truyện "{{$content->ten}}" không?'>
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

//////////////////////////////view
$(document).on("click", "[data-toggle=\"view\"]", function(e) {
	e.preventDefault(); 
	var lHref = $(this).attr('href');
	$.ajax({
		type: 'GET',
		dataType: 'json',
		url : lHref,
		success: function(data) {
			if(data.success === false)
			{
				Example.init({"selector": ".bb-alert-error"});
				Example.show('Đã có lỗi xảy ra !!!! không xem được truyện.');
			} else {

				bootbox.dialog({
					title: 'Truyện: '+data.content['ten']+' - Tác giả: '+data.content['tacgia'],
					message: '<div class="row" style="margin-left:3px; margin-right:3px">  ' + data.content['noidung']
					+'</div>',
					buttons: {
						success: {
							label: "Đóng",
							className: "btn-success",
							callback: function () {
	
							}
						}
					}
				}
				);
}
},
error: function(xhr, textStatus, thrownError) {
	alert('Something went wrong. Please Try again later...');
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