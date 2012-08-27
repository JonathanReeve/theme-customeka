<div id="footer">
	<?php echo get_theme_option('Footer Text'); ?>
	<?php if ((get_theme_option('Display Footer Copyright') == 1) && $copyright = settings('copyright')): ?>
                    <?php echo $copyright; ?>
	<?php endif; ?>
	<a href="http://omeka.org" id="omeka-logo">Proudly Powered by Omeka</a>
	<?php plugin_footer(); ?>
</div>
</div>
</div>
</body>
</html>
