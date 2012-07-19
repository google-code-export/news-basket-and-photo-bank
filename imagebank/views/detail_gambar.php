<html>
<head>
<title>CI Gallery</title>
	        <style>
	        @import url("../css/table.css");


            /* Demo styles */
            html,body{background:#222;margin:0;}
            body{border-top:4px solid #000;}
            .content{color:#777;font:12px/1.4 "helvetica neue",arial,sans-serif;width:620px;margin:20px auto;}
            h1{font-size:12px;font-weight:normal;color:#ddd;margin:0;}
            p{margin:0 0 20px}
            a {color:#22BCB9;text-decoration:none;}
            .cred{margin-top:20px;font-size:11px;}

            /* This rule is read by Galleria to define the gallery height: */
            #galleria{height:320px}

        .metadata {
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	position: relative;
	height: 200px;
	width: 525;
	left: 100px;
	top: 30;
	background-color: #000000;
	margin: 5;
}
            .image {
	height: 500px;
	width: 700px;
}
            </style>
<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/colorbox.css"/>
	
			
		)

	<style>

            /* Demo styles */
            html,body{background:#222;margin:0;}
            body{border-top:4px solid #000;}
            .content{color:#777;font:12px/1.4 "helvetica neue",arial,sans-serif;width:620px;margin:20px auto;}
            h1{font-size:12px;font-weight:normal;color:#ddd;margin:0;}
            p{margin:0 0 20px}
            a {color:#22BCB9;text-decoration:none;}
            .cred{margin-top:20px;font-size:11px;}

            /* This rule is read by Galleria to define the gallery height: */
            #galleria{
	height:700px
}

    #sidebar {
	font-family: Georgia, "Times New Roman", Times, serif;
	position: absolute;
	height: 200px;
	width: 100px;
}
    #action {
}
    .action {
	font-family: "Courier New", Courier, monospace;
	height: 40px;
	width: 700px;
	top: 30px;
	margin-top: 30px;
	margin-right: 10px;
	margin-bottom: auto;
	margin-left: 39px;
}
    </style>
	
</head>

<body>
<div class="content">
<h1>&nbsp;</h1>
		<div id="galleria">
        <div id="image" >
        
       
        
		<?php
			foreach ($images as $row) {
				$image = base_url()."images/galeri/".$row->image_name;
				
				echo " <a href='$image' ><img src='$image' width='400px'  height ='200px' title=$row->thumbnail></a>";		

			} 
		 ?>

        </div>
		 <div class="action" id="action" align="center">
             <table width="81%" border="0">
               <tr>
                 <td width="30%"><img src="../images/download.png" width="16" height="16" alt="download"><a href="../application/views/download.php">download</a></td>
                 <td width="34%"><img src="../images/edit.png" width="16" height="16" alt="edit">edit properties</td>
                 <td width="36%">&nbsp;</td>
               </tr>
             </table>
           </div>
           <div class="metadata" id="metadata">
          <div align="center">
            <table width="100%" border="1" align="center" cellpadding="0" cellspacing="1" class="maintable ">
            <tr><td class="tableb tableb_alternate"><table width="100%" border="1" align="center" cellpadding="0" cellspacing="1" class="maintable ">
              <tr>
                <td class="tableb tableb_alternate" valign="top">Title:</td>
                <td class="tableb tableb_alternate"><?php echo "$row->title";?></td>
              </tr>
              <tr>
                <td class="tableb tableb_alternate" valign="top">Caption:</td>
                <td class="tableb tableb_alternate"><?php echo "$row->caption";?></td>
              </tr>
              <tr>
                <td width="34%" valign="top" class="tableb tableb_alternate">Filename:</td>
                <td width="66%" class="tableb tableb_alternate"><?php echo "$row->image_name";?></td>
              </tr>
              <tr>
                <td class="tableb tableb_alternate" valign="top">Keywords:</td>
                <td class="tableb tableb_alternate">&nbsp;</td>
              </tr>
              <tr>
                <td class="tableb tableb_alternate" valign="top">Filesize:</td>
                <td class="tableb tableb_alternate"><?php echo "$row->filesize";?> kb</td>
              </tr>
              <tr>
                <td class="tableb tableb_alternate" valign="top">Date added:</td>
                <td class="tableb tableb_alternate"><?php echo "$row->update_at"; ?></td>
              </tr>
              <tr>
                <td class="tableb tableb_alternate" valign="top">Dimensions:</td>
                <td class="tableb tableb_alternate"><?php echo"$row->image_height";?>x<?php echo "$row->image_width";?> pixel</td>
              </tr>
              <tr>
                <td class="tableb tableb_alternate" valign="top">location</td>
                <td class="tableb tableb_alternate"><?php echo "$row->path";?></td>
              </tr>
            </table></td></tr></table>
          </div>
		
	</div>
		  </div>
           
		 
           
         
    </div>
<p>&nbsp; </p>
<p>&nbsp; </p>

<script>
	 Galleria.loadTheme('../../themes/classic/galleria.classic.min.js');

    // Initialize Galleria
    Galleria.run('#galleria');
		  </script>
</body>
	


</html>