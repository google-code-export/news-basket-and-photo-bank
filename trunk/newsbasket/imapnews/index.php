<?php
	include_once( 'libs/getMails.php' );
	include_once( 'header.php' );
?>
		<div class="grids clearfix">
			<div class="well"><h2><?php echo $search_for; ?></h2></div>
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
					<div class="subject inner"><?php echo $value->subject; ?>
						<br />
						<a href="single.php?id=<?php echo $value->mId;?>"> Read More </a>
					</div>
				</div><!-- end mails_header -->
				<?php } ?>
			</div><!-- end span4 -->
		</div><!-- end grids -->
	 </div><!-- end container -->	
	</div><!-- end bodyWrapper -->
</body>
</html>
