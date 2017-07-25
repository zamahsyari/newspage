@extends('admin.layout')
@section('title', 'Manajemen Artikel')
@section('content')
<h2>Manajemen Artikel</h2>
<table class="table table-hovered">
	<tr>
		<th>Judul</th>
		<th>Slug</th>
		<th>Status</th>
		<th>Berita utama</th>
		<th>Slider utama</th>
		<th>Pembaruan terakhir</th>
		<th>Aksi</th>
	</tr>
	<?php
		foreach($data as $row){
			?>
			<tr>
				<td>{{$row->title}}</td>
				<td>{{$row->slug}}</td>
				<td>{{isPublished($row->published)}}</td>
				<td>{{isHeadline($row->headline)}}</td>
				<td>{{isSlider($row->slider)}}</td>
				<td>{{$row->updated_at}}</td>
				<td width="150">
					<ul class="action-buttons">
						<li><a href="{{url('admin/article/edit/'.$row->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a></li>
						<li>
							<form action="{{url('admin/article/delete/'.$row->id)}}" method="POST">
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
<?php
	function isPublished($num){
		if($num==1){
			return 'PUBLISHED';
		}else{
			return 'DRAFT';
		}
	}
	function isHeadline($num){
		if($num==1){
			return 'YA';
		}else{
			return 'TIDAK';
		}
	}
	function isSlider($num){
		if($num==1){
			return 'YA';
		}else{
			return 'TIDAK';
		}
	}
?>
<a href="{{url('admin/article/add')}}" class="btn btn-primary">Tambah</a>
<script type="text/javascript">
	$('#adm-arti').addClass('active');
</script>
@endsection