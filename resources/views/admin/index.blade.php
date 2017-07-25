@extends('admin.layout')
@section('title', 'Manajemen Halaman')
@section('content')
<h2>Manajemen Halaman</h2>
<table class="table table-hovered">
	<tr>
		<th>Judul</th>
		<th>Slug</th>
		<th>URL</th>
		<th>Pembaruan terakhir</th>
		<th>Aksi</th>
	</tr>
	<?php
		foreach($data as $row){
			?>
			<tr>
				<td>{{$row->title}}</td>
				<td>{{$row->slug}}</td>
				<td>{{url('page/'.$row->slug)}}</td>
				<td>{{$row->updated_at}}</td>
				<td width="150">
					<ul class="action-buttons">
						<li><a href="{{url('admin/page/edit/'.$row->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a></li>
						<li>
							<form action="{{url('admin/page/delete/'.$row->id)}}" method="POST">
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
<a href="{{url('admin/page/add')}}" class="btn btn-primary">Tambah</a>
<script type="text/javascript">
	$('#adm-page').addClass('active');
</script>
@endsection