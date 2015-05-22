@extends("pages/admin_main")


@section('rightcontent')
<style type="text/css">
	.nicEdit-main{
		background-color: white;
	}
</style>


<div id="update-story">
	<form id="update-story-form" style="margin:0" method="POST" action="#">
		<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
		<div class="form-group">
			<label for="category">*Categoty:</label>
			<select class="form-control" id="cat" name="cat">
				@foreach($categories as $category)
				<option>{{ $category->cname }}</option>
				@endforeach 
			</select>
		</div>
		<div class="form-group">
			<label for="tentruyen">*Tên truyện:</label>
			<input type="text" class="form-control" id="ten" name="ten" required value="{{ $content->ten }}">
		</div>
		<div class="form-group">
			<label for="tacgia">*Tác giả:</label>
			<input type="text" class="form-control" id="tacgia" name="tacgia" required value="{{ $content->tacgia }}">
		</div>
		<div class="form-group">		
			<label for="noidung">Nội dung:</label>
			<textarea rows="10" cols="50" id="area2" style="width:100%;"></textarea>
			<!--<input type="textarea" style="width:900px;" rows="5" id="area2">
			<input type="textarea"  style="width:200px; height:100px" type="hidden" name="noidung" id="noidung">-->
			
		</div>
		<div class="form-group">		
			<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
		</div>

	</form>
</div>

<div class="error alert alert-danger" style="font-weight: bold; width:350px;"><img src="{{Asset('assets/img/fail-icon.png')}}" style="width:24px; height:24px" > </div>
<div class="success alert alert-success" style="font-weight: bold; width:300px;"><img src="{{Asset('assets/img/success-icon.png')}}" style="width:24px; height:24px" > </div>

<script src="{{Asset('assets/js/nicEdit.js')}}" type="text/javascript"></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() {
		var myedit = new nicEditor({
			fullPanel : true,
			iconsPath : "{{Asset('assets/img/nicEditorIcons.gif')}}"
		}).panelInstance('area2');
		myedit.instanceById('area2').setContent('<?php echo $content->noidung;?>');	

	});



	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	
	$('.error').hide();
	$('.success').hide();
	$('#cat').val("<?php echo $content->cat;?>");
	//var nicInstance = nicEditors.findEditor('area2');

	$('#update-story-form').on('submit',function(e) {
  	// lấy giá trị
  	e.preventDefault(); 
  	var nicInstance = nicEditors.findEditor('area2');
  	var _noidung = nicInstance.getContent();
  	var _cat = $('#cat').val();
  	var _ten = $('#ten').val();
  	var _tacgia = $('#tacgia').val();

  	$.ajax({
  		type: 'POST',
  		dataType: 'json',
  		url : "{{ route('editstory_post', $content->id) }}",
  		data: { ten:_ten, cat:_cat, tacgia:_tacgia, noidung:_noidung },
  		success: function(data) {
  			if(data.success === false)
  			{
  				$('.error').append(data.message);
  				$('.error').show();
  			} else {
  				$('.success').append(data.message);
  				$('.success').show();
  				setTimeout(function() {
  					window.location.href = "{{Asset('admin/main/edit-story')}}";
  				}, 2000);
  			}
  		},
  		error: function(xhr, textStatus, thrownError) {
  			alert('Something went wrong. Please Try again later...');
  		}
  	});

  });		




</script>


@endsection