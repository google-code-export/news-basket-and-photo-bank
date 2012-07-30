<?php $flashmessage = $this->session->flashdata('message')?>
	
<h2>My Galleries</h2>
	
	
	<?php echo ! empty($flashmessage) ? '<p class="success">' . $flashmessage . '</p>': '';?>
	
<table width="597" border="1">
  <tr>
    <td width="317">Name</td>
    <td width="129">Photos</td>
    <td width="129"><form id="Create New Album" name="Create New Album" method="post" action="<?php echo site_url('album/create');?>">
      <input type="submit" name="new album" id="new album" value="Create New Album" />
    </form></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

</body>
<script type="text/javascript">
var deleteUrl;
$(document).ready(function() {
  $('.album-delete-btn').click(function() {
    deleteUrl = $(this).attr('rel');
  });
  
  $('#album-modal').on('show', function() {
    $('#album-modal-delete-btn').attr('href', deleteUrl);
  });
});
</script>

