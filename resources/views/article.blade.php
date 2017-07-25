@extends('layout')
@section('title', "Artikel")
@section('content')
<div class="col-md-9 detail">
	<h1 class="detail-title">{{$data->title}}</h1>
	<i class="detail-date">{{$data->updated_at}}</i>
	<br/><br/>
	<div class="frame-slider"><img alt="Gambar ilustrasi" src="{{Storage::url('public/images/'.$data->img)}}"/></div>
	<br/>
	<div class="detail-content">
		<?php echo $data->content?>
	</div>
	<br/>
	<div id="disqus_thread"></div>
	<br/>
	<script>

	/**
	*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
	*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
	/*
	var disqus_config = function () {
	this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
	this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
	};
	*/
	(function() { // DON'T EDIT BELOW THIS LINE
	var d = document, s = d.createElement('script');
	s.src = 'https://portalhukum.disqus.com/embed.js';
	s.setAttribute('data-timestamp', +new Date());
	(d.head || d.body).appendChild(s);
	})();
	</script>
	<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
</div>
<div class="col-md-3">
	<h2>Berita Terkait</h2>
	<ul class="latest">
		<?php
			foreach($related as $row){
	  			?>
	  			<li>
	  				<table>
	  					<tr>
	  						<td><div class="frame-latest"><img alt="Gambar ilustrasi" src="{{Storage::url('public/images/'.$row->img)}}"/></div></td>
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
	<br/><br/>
	<h2>Direkomendasikan</h2>
	<ul class="latest">
		<?php
			foreach($headline as $row){
	  			?>
	  			<li>
	  				<table>
	  					<tr>
	  						<td><div class="frame-latest"><img alt="Gambar ilustrasi" src="{{Storage::url('public/images/'.$row->img)}}"/></div></td>
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
<script id="dsq-count-scr" src="//portalhukum.disqus.com/count.js" async></script>
@endsection