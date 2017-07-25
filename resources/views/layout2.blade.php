@extends('layout')
@section('title', "Halaman")
@section('content')
<div class="col-md-9 detail">
	<h1 class="detail-title">{{$data->title}}</h1>
	<?php echo $data->content?>
	<ul class="faq-list">
		<?php
			foreach($list as $row){
				?>
				<li>
					<a class="btn btn-info pull-right" href="{{url('/').Storage::url('public/files/'.$row->file)}}">Unduh</a>
					{{$row->list}}
				</li>
				<?php
			}
		?>
	</ul>
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