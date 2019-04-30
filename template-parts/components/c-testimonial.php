<?php

// create id attribute for specific styling
$id = 'testimonial-' . $block['id'];

// create align class ("alignwide") from block setting ("wide")
$align_class = $block['align'] ? 'align' . $block['align'] : '';

// Load values and assing defaults.
$text = get_field('testimonial') ?: 'Your testimonial here...';
$author = get_field('author') ?: 'Author name';
$image = get_field('image') ?: 295;
$background_color = get_field('background_color');
?>
<div id="<?php echo $id; ?>" style="background: <?php echo $background_color; ?>;" class="testimonial <?php echo $align_class; ?>">
	<blockquote class="testimonial-blockquote">
		<span class="testimonial-text"><?php echo $text; ?></span>
		<span class="testimonial-author"><?php echo $author; ?></span>
	</blockquote>
	<div class="testimonial-image">
		<?php echo wp_get_attachment_image( $image, 'full' ); ?>
	</div>
</div>
<style>
	.testimonial {
		width: 100%;
		display: flex;
	}
	.testimonial .testimonial-blockquote {
		width: 70%;
	}
	.testimonial .testimonial-image {
		width: 30%;
		height: 100%;

	}
	.testimonial .testimonial-image img {
		width: 100%;
		height: 100%;
	}
</style>