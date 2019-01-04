<?php
$footer_copyright_text = get_theme_mod('footer_copyright_text_setting');
?>
<footer id="colophon" class="site-footer">
	<div class="container footer__container">
		<?php if( !empty($footer_copyright_text) ) : ?>
			<p class="footer__copyright"><?php echo $footer_copyright_text; ?></p>
		<?php endif; ?>
	</div>
</footer>
