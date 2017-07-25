<div class="row footer">
	<div class="container">
		<div class="col-md-3">
			<h2>Logo</h2>
		</div>
		<div class="col-md-9">
			<h2>Sitemap</h2>
			<ul>
				<?php
					for($i=0;$i<5;$i++){
						?>
						<li><a href="#">Menu</a>
							<ul>
								<?php
									for($j=0;$j<5;$j++){
										?>
										<li><a href="#">Sub-Menu</a></li>
										<?php
									}
								?>
							</ul>
						</li>
						<?php
					}
				?>
			</ul>
		</div>
	</div>
</div>
<div class="row copyright">
	<div class="container">
		Copyright 2017
	</div>
</div>