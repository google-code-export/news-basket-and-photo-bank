<?php
	include_once( 'libs/getIndividual.php' );
	include_once( 'header.php' );
?>
		<div class="grids clearfix">
			<div class="span11">
				<?php foreach($mails as $key => $value)
				{ ?>
				<div class="mails_header">
					<div class="from inner"><strong><?php echo $value->fromName; ?></strong> <i><?php echo $value->fromAddress; ?></i>
					<span class="time"><i><?php echo $value->date; ?></i></span>
					</div>
					<div class="headers">
						<?php
							$headers = '<div><i>from:</i> '.$value->fromAddress.'</div>
										<div><i>to:</i> '.$value->toString.'</div>
										<div><i>date:</i> '.$value->date.'</div>
										<div><i>subject:</i> '.$value->subject.'</div>
										';
						?>
						<strong>to </strong><i><?php echo $value->toString; ?></i> <a href="#" rel="tooltip" title="Email Headers" data-content="<?php echo $headers; ?>"><i class="icon-circle-arrow-right"></i></a>
					</div><!-- end header -->
					<div class="subject inner" style="color:#0088da"><?php echo $value->subject; ?><i class="icon-chevron-down"></i></div>
					<div class="mail_info">
					<div class="attachments"><?php if(!empty($value->attachments)) {
							echo '<h4> Attachments </h4>';
							foreach($value->attachments as $key => $v){
								echo '<a href="download.php?item='.base64_encode($key).'"target="_blank"><i class="icon-download-alt"></i> '.$key.'</a>';
							}
						} ?></div>
						<h4> Mail Body </h4>
						<?php echo $value->textHtml; ?>
					</div><!-- end mail_info -->
				</div><!-- end mails_header -->
				<?php } ?>
			</div><!-- end span4 -->
		</div><!-- end grids -->
	 </div><!-- end container -->
	</div><!-- end bodyWrapper -->
</body>

</html>
