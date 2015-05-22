@extends("pages/admin_main")


@section('rightcontent')
<div class="bs-example">
	<ul class="nav nav-tabs">
		<li class="active"><a data-toggle="tab" href="#sectionA">Thêm category</a></li>
		<li><a data-toggle="tab" href="#sectionB">Xóa category</a></li>

	</ul>
	<div class="tab-content">
		<div id="sectionA" class="tab-pane fade in active" style="margin-top: 5px; margin-left:5px">
			<form id="add-category-form" style="margin:0" method="post" action="{{Asset('admin/main/manage-category')}}">
				<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
				<table>
					<tr>
						<td style=" vertical-align: top;">
							<div class="form-group">
								<label for="tencategory">Tên Category:</label>
								<input type="text" class="form-control" id="category_name" name="category_name" required style="width:250px">
								<input type="hidden" id="ack" name="ack" value="addcategory" style="width:250px">
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Add</button>						
							</div>
						</td>
						<td>
							<div class="form-group" style="padding-left: 80px">
								<label for="tentruyen">Danh sách Category</label>
								<table class="table table-bordered" >
									<thead>
										<tr >
											<th>ID</th>
											<th>Category</th>
										</tr>
									</thead>
									<tbody>
										@foreach($categories as $category)
										<tr>
											<td>{{ $category->cid }}</td>
											<td>{{ $category->cname }}</td>
										</tr>
										@endforeach 
									</tbody>
								</table>
							</div>
						</td>
					</tr>

				</table>

			</form>
		</div>
		<div id="sectionB" class="tab-pane fade" style="margin-top: 5px; margin-left:5px">
			<form id="del-category-form" style="margin:0" method="post" action="#">
				<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
				<div class="form-group">
					<label for="category">Chọn category cần xóa:</label>
					<select class="form-control" id="cat" name="cat" style="width:250px">
						@foreach($categories as $category)
						<option>{{ $category->cname }}</option>
						@endforeach 
					</select>
					<input type="hidden" id="ack" name="ack" value="delcategory" style="width:250px">
				</div>
				<div class="form-group">
				<button type="submit" class="btn btn-default" data-toggle="confirm" data-title='Bạn có muốn xóa Category "{{$category->cname}}" không?'><span class="glyphicon glyphicon-remove"></span> Delete</button>						
				</div>				
			</form>
		</div>

	</div>
</div>

<div class="bb-alert alert alert-success" style="display:none;">
	<img src="{{Asset('assets/img/success-icon.png')}}" style="width:24px; height:24px" >
	<span>thong bao success o day ne</span>
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
			//var lHref = $(this).attr('href');
			var lText = this.attributes.getNamedItem("data-title") ? this.attributes.getNamedItem("data-title").value : "Are you sure?";

			bootbox.confirm(lText, function (confirmed) {
				if (confirmed) {
               
                 $('#del-category-form').attr('action', "{{Asset('admin/main/manage-category')}}");
                 $('#del-category-form').trigger('submit');
               // Example.show("Hello world callback");
            }
        });
		});

	</script>

@if(Session::has('admin_act_addcategory'))
<script>
	// Thông báo nếu phiên trước có add category
	$(function () {
		<?php
			$ack_data = Session::get('admin_act_addcategory');
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
<?php Session::forget('admin_act_addcategory') ?>
@endif

@if(Session::has('admin_act_delcategory'))
<script>
	$(function () {
		<?php
			$ack_data = Session::get('admin_act_delcategory');
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
<?php Session::forget('admin_act_delcategory') ?>
@endif
@endsection