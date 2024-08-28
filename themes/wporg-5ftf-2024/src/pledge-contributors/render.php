<?php

use WordPressDotOrg\FiveForTheFuture\Contributor;

if ( ! $block->context['postId'] ) {
	return '';
}

$contributors = Contributor\get_contributor_user_objects(
	Contributor\get_pledge_contributors( $block->context['postId'], 'publish' )
);

?>
<div
	<?php echo get_block_wrapper_attributes(); // phpcs:ignore ?>
>
	<?php if ( ! empty( $contributors ) ) : ?>
		<ul class="pledge-contributors">
			<?php foreach ( $contributors as $contributor ) : ?>
				<li class="pledge-contributor">
					<span class="pledge-contributor__avatar">
						<a href="<?php echo esc_url( 'https://profiles.wordpress.org/' . $contributor->user_nicename . '/' ); ?>">
							<?php echo get_avatar( $contributor->user_email, 280, 'mystery', $contributor->display_name ); ?>
						</a>
					</span>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php else : ?>
		<p><?php esc_html_e( 'No confirmed contributors yet.', 'wporg-5ftf' ); ?></p>
	<?php endif; ?>
</div>
