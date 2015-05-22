@extends("pages/admin_main")


@section('rightcontent')

<div class="bs-example">
	<ul class="nav nav-tabs">
		<li id="tabsecA" class="active"><a data-toggle="tab" href="#sectionA">Sửa truyện</a></li>
		<li id="tabsecB"><a data-toggle="tab" href="#sectionB">Sửa chương</a></li>

	</ul>
	<div class="tab-content">
		<div id="sectionA" class="tab-pane fade in active" style="margin-top: 5px; margin-left:2px">
			<table class="table table-bordered" >
				<thead>
					<tr >
						<th>ID</th>
						<th>Category</th>
						<th>Tên</th>
						<th>Tác giả</th>
						<th>Giới thiệu</th>
						<th>Lần đọc</th>
						<th>Ngày tạo</th>
						<th>Ngày cập nhật</th>
						<!--<th>View</th>-->
						<th>Edit</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>
					<?php $dem=0; ?>
					@foreach($truyendais as $truyendai)
					@if (($dem%2)==0)
					<tr class="success">
						<?php $dem++; ?>
						@else
						<tr class="danger">
							<?php $dem++; ?>
							@endif
							<td><p>{{$truyendai->tid }}</p></td>
							<td><p>{{$truyendai->cat}}</p></td>
							<td><p>{{$truyendai->ten}}</p></td>
							<td ><p>{{$truyendai->tacgia}}</p></td>

							<td><p>{{ str_limit($truyendai->gioithieu, $limit = 30, $end = '...') }}</p></td>
							<td style="text-align: center;"><p>{{$truyendai->landoc}}</p></td>
							<td><p>{{$truyendai->create_at}}</p></td>
							<td><p>{{$truyendai->update_at}}</p></td>
							<!--<td style="text-align: center; width:60px; "><a href="#" ><img src="{{ Asset('assets/img/view-icon.png') }}" style="width:32px; height:32px "></a></td>-->
							<td style="text-align: center; width:60px;"><a href="{{ route('editlongstory_truyen', $truyendai->tid) }}"  ><img src="{{ Asset('assets/img/edit-icon.png') }}" style="width:32px; height:32px "></a></td>
							<td style="text-align: center; width:60px;">
								<a href="{{ route('dellongstory', $truyendai->tid) }}" data-toggle="confirm" data-title='Bạn có muốn xóa bộ truyện "{{$truyendai->ten}}" không?'>
									<img src="{{ Asset('assets/img/delete-icon.png') }}" style="width:32px; height:32px ">
								</a>
							</td>
							@endforeach

						</tr>
					</tbody>
				</table>


			</div>
			<div id="sectionB" class="tab-pane fade" style="margin-top: 5px; margin-left:2px">
				<table class="table table-bordered" >
					<thead>
						<tr >
							<th>ID</th>
							<th>Truyện ID</th>
							<th>Chương</th>
							<th>Nội dung</th>
							<th>Ngày tạo</th>
							<th>Ngày cập nhật</th>
							<!--<th>View</th>-->
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>
						<?php $dem=0; ?>
						@foreach($truyendai_chuongs as $truyendai_chuong)
						@if (($dem%2)==0)
						<tr class="success">
							<?php $dem++; ?>
							@else
							<tr class="danger">
								<?php $dem++; ?>
								@endif
								<td><p>{{$truyendai_chuong->id }}</p></td>
								<td><p>{{$truyendai_chuong->tid}}</p></td>
								<td><p>{{$truyendai_chuong->chuong}}</p></td>
								<td><p>{{ str_limit($truyendai_chuong->noidung, $limit = 30, $end = '...') }}</p></td>
								<td><p>{{$truyendai_chuong->create_at}}</p></td>
								<td><p>{{$truyendai_chuong->update_at}}</p></td>
								<!--<td style="text-align: center; width:60px; "><a href="#" ><img src="{{ Asset('assets/img/view-icon.png') }}" style="width:32px; height:32px "></a></td>-->
								<td style="text-align: center; width:60px;"><a href="{{ route('editlongstory_chuong', $truyendai_chuong->id) }}"  ><img src="{{ Asset('assets/img/edit-icon.png') }}" style="width:32px; height:32px "></a></td>
								<td style="text-align: center; width:60px;">
									<a href="{{ route('dellongstory_chuong', $truyendai_chuong->id) }}" data-toggle="confirm" data-title='Bạn có muốn xóa Chương "{{$truyendai_chuong->chuong}}" của Truyện ID: "{{$truyendai_chuong->tid}}" không?'>
										<img src="{{ Asset('assets/img/delete-icon.png') }}" style="width:32px; height:32px ">
									</a>
								</td>
								@endforeach

							</tr>
						</tbody>
					</table>

				</div>
			</div>
		</div>

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

		@if(Session::has('admin_act_updatelongstory'))
		<script>
	// Thông báo nếu phiên trước có add long story
	$(function () {
		<?php
		$ack_data = Session::get('admin_act_updatelongstory');
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
<?php Session::forget('admin_act_updatelongstory') ?>
@endif	

@if(Session::has('message_longstorydeleted'))

<script>
	// Thông báo nếu phiên trước có xóa truyện
	$(function () {
		Example.init({"selector": ".bb-alert"});			
		Example.show("{{Session::get('message_longstorydeleted')}}");
	});
	
</script>
<?php Session::forget('message_longstorydeleted') ?>
@endif

@if(Session::has('admin_act_updatechuong'))
<script>

	$(function () {
		$('#sectionA').attr('class','tab-pane fade');
		$('#tabsecA').attr('class','');
		$('#tabsecB').attr('class','active');		
		$('#sectionB').attr('class','tab-pane fade in active');
		<?php
		$ack_data = Session::get('admin_act_updatechuong');
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
<?php Session::forget('admin_act_updatechuong') ?>
@endif

@if(Session::has('message_longstorychuongdeleted'))

<script>
	// Thông báo nếu phiên trước có xóa truyện
	$(function () {
		$('#sectionA').attr('class','tab-pane fade');
		$('#tabsecA').attr('class','');
		$('#tabsecB').attr('class','active');		
		$('#sectionB').attr('class','tab-pane fade in active');		
		Example.init({"selector": ".bb-alert"});			
		Example.show("{{Session::get('message_longstorychuongdeleted')}}");
	});
	
</script>
<?php Session::forget('message_longstorychuongdeleted') ?>
@endif
@endsection