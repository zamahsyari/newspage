@extends('layout')
@section('title', 'Halaman depan')
@section('content')
<div class="col-md-9">
	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
	  <!-- Indicators -->
	  <ol class="carousel-indicators">
	  	<?php
	  		$i=0;
	  		foreach($slider as $row){
	  			if($i==0){
	  				?>
	  				<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
	  				<?php
	  			}else{
	  				?>
	  				<li data-target="#carousel-example-generic" data-slide-to="{{$i}}"></li>
	  				<?php
	  			}
	  			$i++;
	  		}
	  	?>
	  </ol>

	  <!-- Wrapper for slides -->
	  <div class="carousel-inner" role="listbox">
	  	<?php
	  		$i=0;
	  		foreach($slider as $row){
	  			if($i==0){
	  				?>
	  				<div class="item active">
	  				<?php
	  			}else{
	  				?>
	  				<div class="item">
	  				<?php
	  			}
	  			?>
			      <div class="frame-slider"><img alt="Gambar ilustrasi" src="{{url('/').Storage::url('public/images/'.$row->img)}}"/></div>
			      <div class="carousel-caption">
			        <a href="{{url('article/'.$row->slug)}}"><b>{{$row->title}}</b></a>
			        <p>
			        <?php
			        	$article=$row->content;
			        	if(strlen($article) > 200){
			        		echo substr($article, 0, 200)."...";
			        	}else{
			        		echo $article;
			        	}
			        ?>
			        </p>
			      </div>
			    </div>
	  			<?php
	  			$i++;
	  		}
	  	?>
	  </div>
	  <!-- Controls -->
	  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
	    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
	    <span class="sr-only">Previous</span>
	  </a>
	  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
	    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
	    <span class="sr-only">Next</span>
	  </a>
	</div>
	<br/>
	<ul class="latest latest-main">
		<?php
			foreach ($headline as $row) {
				?>
				<li><a href="{{url('article/'.$row->slug)}}">
					<table>
						<tr>
							<td><div class="frame-headline"><img alt="Gambar ilustrasi" src="{{url('/').Storage::url('public/images/'.$row->img)}}"/></div></td>
							<td><b>{{$row->title}}</b><br/><i>{{$row->updated_at}}</i><br/><p><?php echo htmlspecialchars_decode(substr($row->content,0,200))?></p></td>
						</tr>
					</table></a>
				</li>
				<?php
			}
		?>
	</ul>
	<div class="more">
		<a href="#">More...</a>
	</div>
</div>
<div class="col-md-3">
	<h2>Latest News</h2>
	<ul class="latest">
		<?php
			foreach($latest as $row){
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
<script type="text/javascript">
	$('#home').addClass('active');
</script>
@endsection