@extends('layout')
@section('title', 'Kontrak')
@section('content')
<div class="col-md-9 detail">
	<h1 class="detail-title">Kontrak</h1>
	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sapien nunc, bibendum eu nisi vitae, tristique consectetur lectus. Sed posuere tempus elit. Nam sit amet ante eu dolor varius euismod quis quis sapien. Curabitur elementum, leo non luctus porttitor, justo leo interdum nisi, eu auctor leo nisi finibus massa. Integer interdum egestas accumsan. Suspendisse at mi in erat porttitor pulvinar. Aenean at condimentum est. Mauris consectetur tortor id justo gravida, tristique gravida urna sollicitudin. Etiam est sem, placerat ut felis id, porta sagittis metus. Curabitur in libero ut sem condimentum vulputate in eget mi. Sed nisl erat, laoreet nec elementum eu, ornare et neque. </p>
	<ul class="kontrak-list">
		<?php
			for($i=0;$i<5;$i++){
				?>
				<li>
					<a class="btn btn-info pull-right" href="#">Unduh</a>
					<b>Lorem Ipsum</b><br/>
					<i class="detail-date">Senin, 3 Juli 2017</i>
				</li>
				<?php
			}
		?>
	</ul>
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
<script type="text/javascript">
	$('#con').addClass('active');
</script>
@endsection