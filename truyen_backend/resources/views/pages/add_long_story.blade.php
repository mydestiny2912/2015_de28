@extends("pages/admin_main")


@section('rightcontent')
<style type="text/css">
	.nicEdit-main{
		background-color: white;
	}

	label.error {
		color: #c0392b;
	}	
</style>
<div class="bs-example">
	<ul class="nav nav-tabs">
		<li class="active"><a data-toggle="tab" href="#sectionA">Thêm truyện</a></li>
		<li><a data-toggle="tab" href="#sectionB">Thêm chương</a></li>

	</ul>
	<div class="tab-content">
		<div id="sectionA" class="tab-pane fade in active" style="margin-top: 5px; margin-left:5px">
			<form id="add-long-story-form" style="margin:0" method="post" action="{{Asset('admin/main/add-long-story')}}">
				<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
				<div class="form-group">
					<label for="category">*Categoty:</label>
					<select class="form-control" id="cat" name="cat">
						@foreach($categories as $category)
						<option>{{ $category->cname }}</option>
						@endforeach 
					</select>
					<input type="hidden" id="ack" name="ack" value="addlongstory" style="width:250px">
				</div>
				<div class="form-group">
					<label for="tentruyen">*Tên truyện:</label>
					<input type="text" class="form-control" id="ten" name="ten" required>
				</div>
				<div class="form-group">
					<label for="tacgia">*Tác giả:</label>
					<input type="text" class="form-control" id="tacgia" name="tacgia" required>
				</div>
				<div class="form-group">		
					<label for="gioithieu">Giới thiệu:</label>
					<textarea rows="6" cols="50" id="gioithieu" name="gioithieu" style="width:100%; resize: none;" ></textarea>
				</div>
				<div class="form-group">		
					<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Add</button>
				</div>

			</form>
		</div>


		<div id="sectionB" class="tab-pane fade" style="margin-top: 5px; margin-left:5px">
			<form id="add-chuong-form" style="margin:0" method="post" action="{{Asset('admin/main/add-long-story')}}">
				<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
				<div class="form-group">
					<label for="tentruyen">*Tên truyện:</label>
					<select class="form-control" id="tentruyen" name="tentruyen">
						@foreach($truyendais as $truyendai)
						<option>{{ $truyendai->ten.'*'.$truyendai->tacgia }}</option>
						@endforeach 
					</select>
					<input type="hidden" id="ack" name="ack" value="addchuong" style="width:250px">
				</div>
				<div class="form-group">
					<label for="chuong">*Chương:</label>
					<input type="number" class="form-control" id="chuong" name="chuong" required>
				</div>
				<div class="form-group">		
					<label for="gioithieu">Nội dung:</label>
					<textarea rows="10" id="noidung" name="noidung" style="width:930px; height:250px"></textarea>
				</div>
				<div class="form-group">		
					<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Add</button>
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

<script src="{{Asset('assets/js/nicEdit.js')}}" type="text/javascript"></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() {
		var myedit = new nicEditor({
			fullPanel : true,
			iconsPath : "{{Asset('assets/img/nicEditorIcons.gif')}}"
		}).panelInstance('noidung');

	});

		$("#add-chuong-form").validate({
		rules:{
			chuong:{
				maxlength:4,
				number: true				
			}
		},
		messages:{
			chuong:{
				required:"Vui lòng nhập chương!",
				number: "Chương phải là dạng số!",
				maxlength: "Số của chương không được quá 4 ký tự!"
			}

		}
	});	
</script>	
@if(Session::has('admin_act_addlongstory'))
<script>
	// Thông báo nếu phiên trước có add long story
	$(function () {
		<?php
		$ack_data = Session::get('admin_act_addlongstory');
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
<?php Session::forget('admin_act_addlongstory') ?>
@endif

@if(Session::has('admin_act_addchuong'))
<script>
	// Thông báo nếu phiên trước có add long story
	$(function () {
		<?php
		$ack_data = Session::get('admin_act_addchuong');
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
<?php Session::forget('admin_act_addchuong') ?>
@endif
@endsection	