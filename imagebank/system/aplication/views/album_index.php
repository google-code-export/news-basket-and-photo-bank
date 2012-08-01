<?php $flashmessage = $this->session->flashdata('message')?>
	
<h2>My Galleries</h2>
	
	
	<?php echo ! empty($flashmessage) ? '<p class="alert alert-success">' . $flashmessage . '</p>': '';?>
	
<table width="597" border="1">
  <tr>
    <td width="317">Name</td>
    <td width="129">Photos</td>
    <td width="129"><a class="btn btn-primary" href="<?php echo site_url('album/create');?>">Create New Album </a>
     </td>
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

