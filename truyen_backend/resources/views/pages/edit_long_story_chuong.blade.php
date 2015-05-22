@extends("pages/admin_main")

@section('rightcontent')
<style type="text/css">
	.nicEdit-main{
		background-color: white;
	}
</style>
<div id="update-long-story-chuong">
			<form id="edit-chuong-form" style="margin:0" method="post" action="{{ route('editlongstory_chuong_post', $truyendai_chuong->id) }}">
				<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
				<div class="form-group">
					<label for="tentruyen">Tên truyện:</label>


						<input type="text"  disabled value="{{ $truyendai->ten }}">
						<input type="hidden" id="tentruyen" name="tentruyen"  value="{{ $truyendai->ten }}">
				</div>
				<div class="form-group">
					<label for="chuong">*Chương:</label>
					<input type="number" class="form-control" id="chuong" name="chuong" required value="{{ $truyendai_chuong->chuong }}">
				</div>
				<div class="form-group">		
					<label for="gioithieu">Nội dung:</label>
					<textarea rows="10" id="noidung" name="noidung" style="width:930px; height:250px"><?php echo $truyendai_chuong->noidung; ?> </textarea>
				</div>
				<div class="form-group">		
					<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
				</div>

			</form>
</div>
<script src="{{Asset('assets/js/nicEdit.js')}}" type="text/javascript"></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() {
		var myedit = new nicEditor({
			fullPanel : true,
			iconsPath : "{{Asset('assets/img/nicEditorIcons.gif')}}"
		}).panelInstance('noidung');

	});

		$("#edit-chuong-form").validate({
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
@endsection	