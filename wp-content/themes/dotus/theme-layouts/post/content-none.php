<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package DOTUS_Framework
 */
?>
<div class="no-results not-found">
	<div class="page-content">
		<h2><?php esc_html_e( 'Nothing Found', 'dotus' ); ?></h2>
		<?php if ( is_search() ) : ?>
			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'dotus' ); ?></p>
			<a class="theme-btn" href="<?php echo esc_url(home_url( '/' )); ?>"><?php esc_html_e( 'BACK TO HOME', 'dotus' ); ?></a>
			<?php else : ?>
			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'dotus' ); ?></p>
			<a  class="theme-btn" href="<?php echo esc_url(home_url( '/' )); ?>"><?php esc_html_e( 'BACK TO HOME', 'dotus' ); ?></a>
			<?php endif; ?>
	</div><!-- .page-content -->
</div><!-- .no-results -->
