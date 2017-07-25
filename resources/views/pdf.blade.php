@extends('layout')
@section('title', 'Halaman depan')
@section('content')
<div class="col-md-9 detail">
	<a class="btn btn-info pull-right" href="#">Unduh</a>
	<h1 class="detail-title">Lorem Ipsum</h1>
	<i class="detail-date">Senin, 3 Juli 2017</i>
	<br/><br/>
	<embed src="{{url('Buku Panduan AFIRMASI.pdf')}}" width="100%" height="700" type='application/pdf'/>
	<br/>
</div>
<div class="col-md-3">
	<h2>Berita Terkait</h2>
	<ul class="latest">
		<?php
			for($i=0;$i<5;$i++){
				?>
				<li>
					<ul>
						<li><img src="http://lorempixel.com/100/60/" /></li>
						<li><b>Lorem ipsum</b><br/><p>Lorem ipsum</p></li>
					</ul>
				</li>
				<?php
			}
		?>
	</ul>
	<br/><br/>
	<h2>Direkomendasikan</h2>
	<ul class="latest">
		<?php
			for($i=0;$i<5;$i++){
				?>
				<li>
					<ul>
						<li><img src="http://lorempixel.com/100/60/" /></li>
						<li><b>Lorem ipsum</b><br/><p>Lorem ipsum</p></li>
					</ul>
				</li>
				<?php
			}
		?>
	</ul>
</div>
@endsection