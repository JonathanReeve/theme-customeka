</div>
<footer id="footer">
<div id="footerContent"> 
	<?php echo get_theme_option('Footer Text'); ?>
	<?php if ((get_theme_option('Display Footer Copyright') == 1) && $copyright = settings('copyright')): ?>
		    <?php echo $copyright; ?>
	<?php endif; ?>
	<a href="http://omeka.org" id="omeka-logo">Proudly Powered by Omeka</a>
    <?php fire_plugin_hook('public_footer'); ?>
</div> <!-- end of footerContent--> 
</footer>
</div>
</body>
</html>
