@extends('admin.layout')
@section('title', 'Edit Halaman')
@section('content')
<h2>Edit Halaman</h2>
<form action="{{url('admin/page/edit/'.$data->id)}}" method="POST" enctype="multipart/form-data">
	<div class="form-group">
		<label>Judul</label>
	    <input type="text" class="form-control" name="title" id="title" placeholder="Judul halaman" value="{{$data->title}}">
	</div>
	<div class="form-group">
		<label>Slug</label>
	    <input type="text" class="form-control" name="slug" id="slug" placeholder="Judul alternatif" value="{{$data->slug}}">
	</div>
	<div class="form-group">
		<label>Pilih Layout</label>
	    <ul class="select-layout">
	    	<li dataCode=1><img src="{{url('layout1.jpg')}}"></li>
	    	<li dataCode=2><img src="{{url('layout2.jpg')}}"></li>
	    	<li dataCode=3><img src="{{url('layout3.jpg')}}"></li>
	    	<li dataCode=4><img src="{{url('layout4.jpg')}}"></li>
	    </ul>
	    <input type="hidden" name="layout_code" id="layout_code" value="{{$data->layout_code}}">
	</div>
	<div class="form-group">
		<label>Konten</label>
	    <textarea name="content" class="tinymce">{{$data->content}}</textarea>
	</div>
	<div class="form-group" id="daftar">
		<label>Buat Daftar</label> <button id="btnAddRow" type="button" class="btn btn-xs btn-success"><i class="fa fa-plus"></i></button>
	    <table class="table" id="tableList">
	    	<?php
	    		$i=1;
	    		foreach($list as $row){
	    			?>
	    			<tr id="listRow{{$i}}">
			    		<td>
			    			<input type="text" class="form-control subtitle" placeholder="Judul" value="{{$row->list}}">
			    		</td>
			    		<td>
			    			<input type="text" class="form-control" placeholder="Penjelasan" value="{{$row->description}}">
			    		</td>
			    		<td>
			    			{{$row->file}}
			    		</td>
			    		<td>
			    			<a class="btn btn-xs btn-default" href="{{url('/').Storage::url('public/files/'.$row->file)}}"><i class="fa fa-download"></i></a>
			    			<button type="button" onclick="deleteFile({{$row->id}},'listRow{{$i}}')" class="btn btn-xs btn-danger"><i class="fa fa-remove"></i></button>
			    		</td>
			    	</tr>
	    			<?php
	    			$i++;
	    		}
	    	?>
	    </table>
	</div>
	<div class="form-group" id="uploadFile">
		<label>Unggah Berkas</label>
		<?php
			if(!empty($data->file)){
				?>
				<hr/>
				<a class="btn btn-xs btn-default" href="{{url('/').Storage::url('public/files/'.$data->file)}}"><i class="fa fa-download"></i></a> {{$row->file}}
				<hr/>
				<?php
			}
		?>
	    <input type="file" name="upload">
	</div>
	<input type="hidden" name="_method" value="PUT">
	{{ csrf_field() }}
	<br/>
	<button type="submit" class="btn btn-primary">Simpan</button>
</form>

<script type="text/javascript">
	var i=<?php echo $i; ?>;
	$('#adm-page').addClass('active');
	$('#daftar').slideUp();
	$('#uploadFile').slideUp();
	initLayout();
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
		showHideExtra();
	});
	function showHideExtra(){
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
	}
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
	// insertNewRow(i);
	function initLayout(){
		if($('#layout_code').val()==1){
			$('[dataCode=1]').addClass('active');
		}else if($('#layout_code').val()==2){
			$('[dataCode=2]').addClass('active');
		}else if($('#layout_code').val()==3){
			$('[dataCode=3]').addClass('active');
		}else{
			$('[dataCode=4]').addClass('active');
		}
		showHideExtra();
	}

	function deleteFile(id,rowId){
		var conf=confirm("Anda yakin ingin menghapus file ini?");
		if(conf){
			$.ajax({
				url:"{{url('admin/list/delete')}}/"+id,
				success:function(data){
					$('#'+rowId).remove();
				},error:function(e){
					console.log(e);
				}
			});
		}else{
			return false;
		}
	}
</script>
@endsection