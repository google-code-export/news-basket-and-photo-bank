<div class="search-result">
	<h3>	<?php echo (!empty($images))? " category '$id_categories' shows result ($first_result - $last_result from $count image found) :" : " No Results.";?>
</h3>
</div>
<div class="pagination">
	<ul>
		<li>
			<?php
			if (!empty($pagination) && $key != null) {
				echo '<p>Page : ' . $pagination . "</p>";
			} else {
				echo 'Page : <a style="cursor:auto; color:black;"><strong>1</strong></a>';
			};
			?>
		</li>
	</ul>
</div>
<div id="search-result" style="height:480px; overflow-y:auto ">
	<ul class="hovergallery">
		<div id="container">
			<?php
			$this -> load -> helper('text');
			//$this->load->helper('search');
			if (!empty($images) && $count != 0 && $id_categories != null) {
				foreach ($images as $row) {
					$image = base_url() . "images/galeri/thumbs/" . $row -> thumbnail;
					if ($user_level == 'administrator') {
						$link = site_url('gallery/detail_foto') . '/' . $row -> id_images;
					} else {
						$link = site_url('gallery/detail_foto_user') . '/' . $row -> id_images;
					}
					echo "<a href='$link'><img src='$image'alt='description' /></a>";
				}
			} else {
				echo "<h3 style='font-size:16px; padding:10px> No result,try different keyword</h3>";
			}
			?>
		</div>
	</ul>
</div>
