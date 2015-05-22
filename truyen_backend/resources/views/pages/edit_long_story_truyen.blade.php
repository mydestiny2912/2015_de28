@extends("pages/admin_main")


@section('rightcontent')
<div id="update-long-story">
<form id="edit-long-story-form" style="margin:0" method="post" action="{{ route('editlongstory_truyen_post', $truyendai->tid) }}">
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
		<input type="text" class="form-control" id="ten" name="ten" required value="{{ $truyendai->ten }}">
	</div>
	<div class="form-group">
		<label for="tacgia">*Tác giả:</label>
		<input type="text" class="form-control" id="tacgia" name="tacgia" required value="{{ $truyendai->tacgia }}">
	</div>
	<div class="form-group">		
		<label for="gioithieu">Giới thiệu:</label>
		<textarea rows="6" cols="50" id="gioithieu" name="gioithieu" style="width:100%; resize: none;" ><?php echo $truyendai->gioithieu; ?></textarea>
	</div>
	<div class="form-group">		
		<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
	</div>

</form>
</div>
<script>
		$(function () {
	$('#cat').val("<?php echo $truyendai->cat;?>");			

		});
</script>
@endsection	