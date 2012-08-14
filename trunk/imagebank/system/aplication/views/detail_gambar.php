



<div class="content">
	<div class="metadata" id="metadata">
         <?php foreach ($images as $row ) {
             
          ;?>    
         <h3 style="text-align: center">Image Information</h3>
            <table class="datainfo" width="100%"  cellpadding="0" cellspacing="0" >
            <tr><td ><table width="100%" border="1" align="center" cellpadding="0" cellspacing="1" class="maintable ">
              <tr>
                <td class="meta"  valign="top">Title:</td>
                <td ><?php echo "$row->title"; ?></td>
              </tr>
              <tr>
                <td class="meta"  valign="top">Caption:</td>
                <td ><?php echo "$row->caption"; ?></td>
              </tr>
              <tr>
                <td  class="meta" valign="top" >Filename:</td>
                <td  ><?php echo "$row->image_name"; ?></td>
              </tr>
              <tr>
                <td class="meta"  valign="top">Keywords:</td>
                <td ><?php echo $tag; ?></td>
              </tr>
              <tr>
                <td  class="meta" valign="top">Filesize:</td>
                <td ><?php echo "$row->filesize"; ?> kb</td>
              </tr>
              <tr>
                <td class="meta" valign="top">Date added:</td>
                <td ><?php echo "$row->update_at"; ?></td>
              </tr>
              <tr>
                <td class="meta" valign="top">Dimensions:</td>
                <td ><?php echo "$row->image_height"; ?>x<?php echo "$row->image_width"; ?> pixel</td>
              </tr>
              <tr>
                <td  class="meta" valign="top">Category</td>
                <td ><?php echo "$category";?></td>
              </tr>
            </table></td></tr></table>
  	
         <?php } ; ?>
    </div>
      
	  <div id="image" >
     
		<?php
		foreach ($images as $row) {
			$image = base_url() . "images/galeri/" . $row -> image_name;

			echo " <a href='$image' ><img src='$image' width='640px'    title=$row->thumbnail></a>";

		}
		 ?>
		</div>
		
           
		 <div class="action" >
             <table border="0">
               <tr>
               	 <td ><img src="../../images/gallery.png" width="25" height="25" alt="gallery" align="center"><a class="info" href="<?php echo site_url("gallery/tampil_foto"); ?>">Back To gallery</a></td>
               	 <td ><img src="../../images/list_remove.png" width="25" height="25" alt="remove"align="center"><a  class="info" href="<?php echo site_url("gallery/deleteImage/$row->id_images"); ?>"onclick="return confirm('Are you sure you want to delete this image?')">Delete</a></td>
                 <td ><img src="../../images/download.png" width="20" height="18" alt="download" align="center"><a class="info"  href="<?php echo site_url("gallery/download/$row->id_images"); ?> ">download</a></td>
                 <td><img src="../../images/edit_image.png" width="20" height="16" alt="edit" align="center"><a class="info" href="<?php echo site_url("gallery/updateImage/$row->id_images"); ?>"> edit properties</td>
                 
               </tr>
             </table>
             </div>
          </div>
<p>&nbsp; </p>
<p>&nbsp; </p>

