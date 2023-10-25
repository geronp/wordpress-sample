<?php /* Template Name: News-Press */ ?>
<?php get_template_part('partials/header'); ?>

<main>
	<?php while (have_posts()) : the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile; ?>
</main>

<?php get_template_part('partials/footer'); ?>