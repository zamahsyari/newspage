@extends('layout')
@section('title', 'Detail')
@section('content')
<div class="col-md-9 detail">
	<h1 class="detail-title">Lorem Ipsum</h1>
	<i class="detail-date">Senin, 3 Juli 2017</i>
	<p class="detail-content">
		<img src="http://lorempixel.com/825/400" />
		Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sapien nunc, bibendum eu nisi vitae, tristique consectetur lectus. Sed posuere tempus elit. Nam sit amet ante eu dolor varius euismod quis quis sapien. Curabitur elementum, leo non luctus porttitor, justo leo interdum nisi, eu auctor leo nisi finibus massa. Integer interdum egestas accumsan. Suspendisse at mi in erat porttitor pulvinar. Aenean at condimentum est. Mauris consectetur tortor id justo gravida, tristique gravida urna sollicitudin. Etiam est sem, placerat ut felis id, porta sagittis metus. Curabitur in libero ut sem condimentum vulputate in eget mi. Sed nisl erat, laoreet nec elementum eu, ornare et neque.

		Vivamus vel auctor mi, sed elementum est. Phasellus mollis vulputate est ac cursus. Suspendisse nec ipsum posuere, vestibulum ipsum nec, iaculis risus. Etiam a dui ac arcu egestas condimentum. Etiam velit velit, aliquam vel congue ac, maximus id nisi. Etiam rutrum, enim sed egestas finibus, elit dui convallis tortor, in suscipit dolor est et sapien. Curabitur lobortis tortor vel vehicula consectetur. Proin sit amet lobortis nisi, vitae iaculis mi. Phasellus ac nibh sit amet nibh pretium convallis a vel diam. Donec rhoncus dui vitae aliquam aliquam. Morbi sed blandit est. Fusce nec orci sed nisi gravida tincidunt. Praesent semper arcu condimentum, ultricies arcu ac, vestibulum risus. Phasellus dolor sapien, sollicitudin sit amet nunc et, lobortis lacinia quam. Aenean blandit, orci ac imperdiet pretium, lorem felis auctor lacus, vitae lobortis lacus est sed libero.

		Suspendisse vitae nisl eu nunc blandit dictum. Ut scelerisque, nunc a dapibus consectetur, nulla magna volutpat nulla, quis iaculis purus quam nec massa. Proin vel tortor sed massa elementum congue. Duis pharetra luctus massa, in efficitur urna. Sed porttitor pulvinar augue sit amet euismod. Nulla aliquet egestas sem vel viverra. Nam bibendum, mauris id sodales posuere, elit enim congue mauris, et commodo risus est commodo elit. Duis vitae scelerisque elit, vel viverra nibh. Fusce eleifend nunc ac est pulvinar vulputate. Maecenas at tristique nulla. Quisque eget metus est.

		Nunc ut elementum turpis. Vivamus commodo lectus enim, in dictum orci dignissim id. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras in venenatis magna, vitae ultricies eros. Pellentesque tincidunt ante ut dolor dictum porttitor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla ornare augue a enim accumsan, sed tincidunt massa venenatis. Pellentesque vitae elit eget velit tristique tincidunt. Sed vitae augue fringilla, placerat magna et, sagittis tellus. Nunc velit dui, hendrerit eu dolor sit amet, finibus dictum justo.

		Aliquam erat felis, dictum non iaculis nec, pharetra in dolor. Donec dictum arcu risus. Ut ac turpis enim. Phasellus viverra a tellus sit amet iaculis. Nam eleifend faucibus ex nec commodo. Duis aliquam arcu odio, non ultrices ipsum ullamcorper vel. Duis mollis tortor in massa pharetra pulvinar id vel lectus. Nam dui ligula, scelerisque vitae interdum eget, imperdiet at ligula. Sed bibendum, magna quis gravida luctus, diam arcu consequat massa, vitae mattis massa quam ut augue. Morbi placerat in magna eu elementum. Donec sollicitudin pharetra ligula, in posuere odio suscipit a. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum eu interdum justo. Donec convallis nec dolor nec aliquet. Nullam lacinia turpis in dapibus finibus. 
	</p>
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
<script id="dsq-count-scr" src="//portalhukum.disqus.com/count.js" async></script>
@endsection