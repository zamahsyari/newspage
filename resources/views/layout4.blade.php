@extends('layout')
@section('title', "Halaman")
@section('content')
<div class="col-md-9 detail">
	<a class="btn btn-info pull-right" href="{{url('/').Storage::url('public/files/'.$data->file)}}">Unduh</a>
	<h1 class="detail-title">{{$data->title}}</h1>
	<i class="detail-date">{{$data->updated_at}}</i>
	<?php echo $data->content?>
	<br/><br/>
	<embed src="{{url('/').Storage::url('public/files/'.$data->file)}}" width="100%" height="700" type='application/pdf'/>
	<br/>
</div>
<div class="col-md-3">
	<h2>Direkomendasikan</h2>
	<ul class="latest">
		<?php
			foreach($headline as $row){
	  			?>
	  			<li>
	  				<table>
	  					<tr>
	  						<td><div class="frame-latest"><img alt="Gambar ilustrasi" src="{{url('/').Storage::url('public/images/'.$row->img)}}"/></div></td>
	  						<td>
	  							<a href="{{url('article/'.$row->slug)}}"><b>{{$row->title}}</b></a>
	  						</td>
	  					</tr>
	  				</table>
				</li>
	  			<?php
	  		}
		?>
	</ul>
</div>
@endsection