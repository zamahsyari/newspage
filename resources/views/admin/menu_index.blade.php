@extends('admin.layout')
@section('title', 'Manajemen Artikel')
@section('content')
<a class="btn btn-primary pull-right" data-toggle="modal" href="#myModalAdd">Tambah</a>
<h2>Manajemen Menu</h2>
<div class="admin-edit-menu">
<?php
	function printChild($result){
		$output='<ul>';
		foreach($result as $row){
			$output.='<li>('.$row['id'].') '.$row['menu'].' <a onclick="loadData('.$row['id'].')" data-toggle="modal" href="#myModal"><i class="fa fa-edit"></i></a> <a onclick="deleteData('.$row['id'].')"><i class="fa fa-remove"></i></a>';
			if(!empty($row['child'])){
				$output.=printChild($row['child']);
			}
			$output.='</li>';
		}
		return $output.'</ul>';
	}
	echo printChild($data);
?>
</div>
<div class="modal fade" id="myModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="{{url('admin/menu/add')}}" method="POST">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Tambah Menu</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Posisi menu</label>
						<select name="parent_id" class="form-control">
							<option value="0">Menu Utama</option>
							<?php
								foreach($menu as $row){
									?>
									<option value="{{$row->id}}">Anak dari menu ({{$row->id}}) {{$row->menu}}</option>	
									<?php
								}
							?>
						</select>
					</div>
		        	<div class="form-group">
						<label>Nama menu</label>
						<input type="text" class="form-control" name="menu">
					</div>
					<div class="form-group">
						<label>URL</label>
						<input type="text" class="form-control" name="url">
					</div>
					<input type="hidden" name="_method" value="POST">
					{{ csrf_field() }}
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        	<button type="submit" class="btn btn-primary">Save changes</button>
		      	</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form id="form" method="POST">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Tambah Menu</h4>
				</div>
				<div class="modal-body">
		        	<div class="form-group">
						<label>Nama menu</label>
						<input type="text" id="menu" class="form-control" name="menu">
					</div>
					<div class="form-group">
						<label>URL</label>
						<input type="text" id="url" class="form-control" name="url">
					</div>
					<input type="hidden" name="_method" value="PUT">
					{{ csrf_field() }}
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        	<button type="submit" class="btn btn-primary">Save changes</button>
		      	</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('#adm-menu').addClass('active');
	function loadData(id){
		$('#form').attr('action',"{{url('admin/menu/edit')}}/"+id);
		$.ajax({
			url:"{{url('admin/menu/edit')}}/"+id,
			success:function(data){
				var obj=$.parseJSON(data);
				if(obj.status=200){
					$('#menu').val(obj.data.menu);
					$('#url').val(obj.data.url);
				}
			},error:function(e){
				console.log(e);
			}
		});
	}
	function deleteData(id){
		var conf=confirm("Anda yakin ingin menghapus ini?");
		if(conf){
			$.ajax({
				url:"{{url('admin/menu/delete')}}/"+id,
				success:function(data){
					var obj=$.parseJSON(data);
					if(obj.status=200){
						location.reload();
					}
				},error:function(e){
					console.log(e);
				}
			});	
		}
	}
</script>
@endsection