@extends('admin.layout')
@section('title', 'Manajemen Kategori')
@section('content')
<h2>Manajemen Kategori</h2>
<table class="table table-hovered">
	<tr>
		<th>Kategori</th>
		<th>Pembaruan terakhir</th>
		<th>Aksi</th>
	</tr>
	<?php
		foreach($data as $row){
			?>
			<tr>
				<td>{{$row->category}}</td>
				<td>{{$row->updated_at}}</td>
				<td width="150">
					<ul class="action-buttons">
						<li><a href="{{url('admin/category/edit/'.$row->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a></li>
						<li>
							<form action="{{url('admin/category/delete/'.$row->id)}}" method="POST">
								<input type="hidden" name="_method" value="DELETE">
								{{ csrf_field() }}
								<button type="submit" class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus?')"><i class="fa fa-remove"></i></button>
							</form>
						</li>
					</ul>
				</td>
			</tr>
			<?php
		}
	?>
</table>
<a href="{{url('admin/category/add')}}" class="btn btn-primary">Tambah</a>
<script type="text/javascript">
	$('#adm-cate').addClass('active');
</script>
@endsection