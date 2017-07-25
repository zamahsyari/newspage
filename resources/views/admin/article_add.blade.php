@extends('admin.layout')
@section('title', 'Tambah Artikel')
@section('content')
<h2>Add Article</h2>
<form action="{{url('admin/article/add')}}" method="POST" enctype="multipart/form-data">
	<div class="form-group">
		<label>Title</label>
	    <input type="text" class="form-control" name="title" id="title" placeholder="title">
	</div>
	<div class="form-group">
		<label>Slug</label>
	    <input type="text" class="form-control" name="slug" id="slug" placeholder="auto generated title">
	</div>
	<div class="form-group">
		<label>Illustration</label><br/>
		<div class="frame-illustration">
			<img id="prev" alt="Illustration">
		</div>
	    <input type="file" name="upload" id="upload">
	</div>
	<div class="form-group">
		<label>Article</label><br/>
	    <textarea name="content" class="tinymce"></textarea>
	</div>
	<br/>
	<div class="form-group">
		<label>Category</label><br/>
	    <select class="form-control" name="category_id">
	    	<?php
	    		foreach($category as $row){
	    			?>
	    			<option value="{{$row->id}}">{{$row->category}}</option>
	    			<?php
	    		}
	    	?>
	    </select>
	</div>
	<div class="form-group">
		<label>Status</label>
	    <table class="table">
	    	<tr>
	    		<td width="10"><input type="radio" name="published" value="1" checked="checked"></td>
	    		<td>PUBLISH</td>
	    	</tr>
	    	<tr>
	    		<td><input type="radio" name="published" value="0"></td>
	    		<td>DRAFT</td>
	    	</tr>
	    </table>
	</div>
	<div class="form-group">
		<label>Show as headline</label>
	    <table class="table">
	    	<tr>
	    		<td width="10"><input type="radio" name="headline" value="1"></td>
	    		<td>YES</td>
	    	</tr>
	    	<tr>
	    		<td><input type="radio" name="headline" value="0" checked="checked"></td>
	    		<td>NO</td>
	    	</tr>
	    </table>
	</div>
	<div class="form-group">
		<label>Show in main slider</label>
	    <table class="table">
	    	<tr>
	    		<td width="10"><input type="radio" name="slider" value="1"></td>
	    		<td>YES</td>
	    	</tr>
	    	<tr>
	    		<td><input type="radio" name="slider" value="0" checked="checked"></td>
	    		<td>NO</td>
	    	</tr>
	    </table>
	</div>
	<input type="hidden" name="_method" value="POST">
	{{ csrf_field() }}
	<br/>
	<button type="submit" class="btn btn-primary">Save</button>
</form>

<script type="text/javascript">
	$('#adm-arti').addClass('active');
	$('#title').change(function(){
		$.ajax({
			url : "{{url('admin/getslug/article')}}?slug="+$(this).val(),
			success: function(data){
				$('#slug').val(data);
			},
			error: function(e){
				console.log(e);
			}
		});
	});

	function readURL(input) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	            $('#prev').attr('src', e.target.result);
	        }
	        reader.readAsDataURL(input.files[0]);
	    }
	}

	$("#upload").change(function(){
	    readURL(this);
	});
</script>
@endsection