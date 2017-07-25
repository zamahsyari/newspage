@extends('admin.layout')
@section('title', 'Edit Artikel')
@section('content')
<h2>Edit Artikel</h2>
<form action="{{url('admin/article/edit/'.$data->id)}}" method="POST">
	<div class="form-group">
		<label>Judul</label>
	    <input type="text" class="form-control" name="title" id="title" placeholder="Judul artikel" value="{{$data->title}}">
	</div>
	<div class="form-group">
		<label>Slug</label>
	    <input type="text" class="form-control" name="slug" id="slug" placeholder="Judul alternatif" value="{{$data->slug}}">
	</div>
	<div class="form-group">
		<label>Ilustrasi</label><br/>
		<div class="frame-illustration">
			<img id="prev" alt="Gambar ilustrasi" src="{{url('/').Storage::url('public/images/'.$data->img)}}">
		</div>
	    <input type="file" name="upload" id="upload">
	</div>
	<div class="form-group">
		<label>Artikel</label><br/>
	    <textarea name="content" class="tinymce">{{$data->content}}</textarea>
	</div>
	<br/>
	<div class="form-group">
		<label>Kategori</label>
	    <select class="form-control" name="category_id">
	    	<?php
	    		foreach($category as $row){
	    			if($row->id == $data->category_id){
	    				?>
	    				<option selected="selected" value="{{$row->id}}">{{$row->category}}</option>
	    				<?php
	    			}else{
	    				?>
	    				<option value="{{$row->id}}">{{$row->category}}</option>
	    				<?php
	    			}
	    		}
	    	?>
	    </select>
	</div>
	<div class="form-group">
		<label>Status</label>
		<?php
			if($data->published=='0'){
				?>
				<table class="table">
			    	<tr>
			    		<td width="10"><input type="radio" name="published" value="1"></td>
			    		<td>PUBLISH</td>
			    	</tr>
			    	<tr>
			    		<td><input type="radio" name="published" value="0" checked="checked"></td>
			    		<td>DRAFT</td>
			    	</tr>
			    </table>
				<?php
			}else{
				?>
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
				<?php
			}
		?>
	</div>
	<div class="form-group">
		<label>Tampilkan sebagai berita utama</label>
		<?php
			if($data->headline=='0'){
				?>
				<table class="table">
			    	<tr>
			    		<td width="10"><input type="radio" name="headline" value="1"></td>
			    		<td>YA</td>
			    	</tr>
			    	<tr>
			    		<td><input type="radio" name="headline" value="0" checked="checked"></td>
			    		<td>TIDAK</td>
			    	</tr>
			    </table>
				<?php
			}else{
				?>
				<table class="table">
			    	<tr>
			    		<td width="10"><input type="radio" name="headline" value="1" checked="checked"></td>
			    		<td>YA</td>
			    	</tr>
			    	<tr>
			    		<td><input type="radio" name="headline" value="0"></td>
			    		<td>TIDAK</td>
			    	</tr>
			    </table>
				<?php
			}
		?>
	</div>
	<div class="form-group">
		<label>Tampilkan di slider utama</label>
		<?php
			if($data->slider=='0'){
				?>
				<table class="table">
			    	<tr>
			    		<td width="10"><input type="radio" name="slider" value="1"></td>
			    		<td>YA</td>
			    	</tr>
			    	<tr>
			    		<td><input type="radio" name="slider" value="0" checked="checked"></td>
			    		<td>TIDAK</td>
			    	</tr>
			    </table>
				<?php
			}else{
				?>
				<table class="table">
			    	<tr>
			    		<td width="10"><input type="radio" name="slider" value="1" checked="checked"></td>
			    		<td>YA</td>
			    	</tr>
			    	<tr>
			    		<td><input type="radio" name="slider" value="0"></td>
			    		<td>TIDAK</td>
			    	</tr>
			    </table>
				<?php
			}
		?>
	</div>
	<input type="hidden" name="_method" value="PUT">
	{{ csrf_field() }}
	<br/>
	<button type="submit" class="btn btn-primary">Simpan</button>
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
</script>
@endsection