
	<title><?$page_title;?></title>
	<h2>Create New Album</h2>
		<?php $flashmessage = $this->session->flashdata('message')?>
		
			
		
	
		<?php  echo form_open('album/add');?>
	
	<p> <?php echo form_input('album'); ?> </p>	<?php echo ! empty($flashmessage) ? '<p class="failed">' . $flashmessage . '</p>': '';?>
		<p><?php echo form_submit('submit','save','id="submit"');?></p>
	<?php echo form_close();?>
	
	
	
	
