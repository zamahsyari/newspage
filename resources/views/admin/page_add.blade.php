@extends('admin.layout')
@section('title', 'Tambah Halaman')
@section('content')
<h2>Tambah Halaman</h2>
<form action="{{url('admin/page/add')}}" method="POST" enctype="multipart/form-data">
	<div class="form-group">
		<label>Judul</label>
	    <input type="text" class="form-control" name="title" id="title" placeholder="Judul halaman">
	</div>
	<div class="form-group">
		<label>Slug</label>
	    <input type="text" class="form-control" name="slug" id="slug" placeholder="Judul alternatif">
	</div>
	<div class="form-group">
		<label>Pilih Layout</label>
	    <ul class="select-layout">
	    	<li class="active" dataCode=1><img src="{{url('layout1.jpg')}}"></li>
	    	<li dataCode=2><img src="{{url('layout2.jpg')}}"></li>
	    	<li dataCode=3><img src="{{url('layout3.jpg')}}"></li>
	    	<li dataCode=4><img src="{{url('layout4.jpg')}}"></li>
	    </ul>
	    <input type="hidden" name="layout_code" id="layout_code">
	</div>
	<div class="form-group">
		<label>Konten</label>
	    <textarea name="content" class="tinymce"></textarea>
	</div>
	<div class="form-group" id="daftar">
		<label>Buat Daftar</label> <button id="btnAddRow" type="button" class="btn btn-xs btn-success"><i class="fa fa-plus"></i></button>
	    <table class="table" id="tableList">
	    	
	    </table>
	</div>
	<div class="form-group" id="uploadFile">
		<label>Unggah Berkas</label>
	    <input type="file" name="upload">
	</div>
	<input type="hidden" name="_method" value="POST">
	{{ csrf_field() }}
	<br/>
	<button type="submit" class="btn btn-primary">Simpan</button>
</form>

<script type="text/javascript">
	var i=1;
	$('#adm-page').addClass('active');
	$('#daftar').slideUp();
	$('#uploadFile').slideUp();
	$('#title').change(function(){
		$.ajax({
			url : "{{url('admin/getslug/page')}}?slug="+$(this).val(),
			success: function(data){
				$('#slug').val(data);
			},
			error: function(e){
				console.log(e);
			}
		});
	});
	$('.select-layout li').click(function(){
		$('.select-layout li').removeClass('active');
		$(this).addClass('active');
		$('#layout_code').val($(this).attr('dataCode'));
		if($('#layout_code').val()==1){
			$('#daftar').slideUp();
			$('#uploadFile').slideUp();
		}else if($('#layout_code').val()==4){
			$('#daftar').slideUp();
			$('#uploadFile').slideDown();
		}else{
			$('#daftar').slideDown();
			$('#uploadFile').slideUp();
		}
	});
	$('#btnAddRow').click(function(){
		insertNewRow(i);
	});

	function insertNewRow(j){
		var row= '<tr id="listRow'+j+'">\
		    		<td>\
		    			<input type="text" class="form-control subtitle" name="list[]" placeholder="Judul">\
		    		</td>\
		    		<td>\
		    			<input type="text" class="form-control" name="description[]" placeholder="Penjelasan">\
		    		</td>\
		    		<td>\
		    			<input type="file" name="file[]">\
		    		</td>\
		    		<td>\
		    			<button type="button" onclick="removeRow('+j+')" class="btn btn-xs btn-danger"><i class="fa fa-remove"></i></button>\
		    		</td>\
		    	</tr>';
	    $('#tableList').append(row);
	    i++;
	}
	function removeRow(j){
		$('#listRow'+j).remove();
	}
	insertNewRow(i);
</script>
@endsection