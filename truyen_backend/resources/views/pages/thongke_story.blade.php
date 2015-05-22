@extends("pages/admin_main")


@section('rightcontent')
<table class="table table-bordered">
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
			<td>{{$content->id }}</td>
			<td>{{$content->cat}}</td>
			<td>{{$content->ten}}</td>
			<td>{{$content->tacgia}}</td>
			<td>{{$content->noidung}}</td>
			<td>{{$content->xem}}</td>
			<td>{{$content->create_at}}</td>
			<td>{{$content->update_at}}</td>
			<td>{{$content->nguoidang}}</td>			
		</tr>
		@endforeach
		<!--<tr class="success" >
			<td>1</td>
			<td>Doe</td>
			<td>john@example.com</td>
		</tr>
		<tr class="danger">
			<td>2</td>
			<td>Moe</td>
			<td>mary@example.com</td>
		</tr>
		<tr class="success">
			<td>3</td>
			<td>Dooley</td>
			<td>july@example.com</td>
		</tr>
		<tr class="danger">
			<td>4</td>
			<td>Moe</td>
			<td>mary@example.com</td>
		</tr>-->
	</tbody>
</table>

@endsection