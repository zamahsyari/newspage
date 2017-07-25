@extends('admin.layout')
@section('title', 'Tambah Kategori')
@section('content')
<h2>Tambah Kategori</h2>
<form action="{{url('admin/category/add')}}" method="POST">
	<div class="form-group">
		<label>Kategori</label>
	    <input type="text" class="form-control" name="category" placeholder="Nama kategori">
	</div>
	<input type="hidden" name="_method" value="POST">
	{{ csrf_field() }}
	<br/>
	<button type="submit" class="btn btn-primary">Simpan</button>
</form>

<script type="text/javascript">
	$('#adm-cate').addClass('active');
</script>
@endsection