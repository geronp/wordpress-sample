<?php get_template_part('partials/header'); ?>

<main class="single">
	<?php while (have_posts()) : the_post(); ?>
		<div class="container">
			<?php the_content(); ?>
		</div>
	<?php endwhile; ?>
</main>

<?php get_template_part('partials/footer'); ?>

