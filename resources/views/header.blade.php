<div class="row header">
	<div class="container">
		<div class="col-md-9">
			<ul class="nav navbar-nav">
				<li><a href="#">Masuk</a></li>
				<li><a href="#">Daftar</a></li>
		     </ul>
		</div>
		<div class="col-md-3">
			<form class="navbar-form navbar-right">
		        <div class="form-group">
		        	<input type="text" class="form-control" placeholder="Pencarian">
		        </div>
				<button type="submit" class="btn btn-info">Cari</button>
		    </form>
		</div>
	</div>
</div>
<br/>
<div class="row">
	<div class="container main-menu">
		<h2>Logo</h2>
		<?php
			function printChild($result){
				$output='<ul>';
				foreach($result as $row){
					$output.='<li><a href="'.$row['url'].'">'.$row['menu'].'</a>';
					if(!empty($row['child'])){
						$output.=printChild($row['child']);
					}
					$output.='</li>';
				}
				return $output.'</ul>';
			}
			echo printChild($menu);
		?>
	</div>
</div>
<script type="text/javascript">
	$(".main-menu ul li").hover(function() {
	    $(this).children('ul').slideDown();
	},function(){
	     $(this).children('ul').slideUp();
	});
</script>