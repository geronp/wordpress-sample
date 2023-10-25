<?php
get_template_part('partials/header');

// Set header styling class
$header_class = "grid-container";
if(!has_post_thumbnail()) {
  $header_class .= " wide";
}

?>

<main class="single single-news">
    <?php while (have_posts()) : the_post(); 
	$postid = get_the_ID();
	$contributor = get_field('contributors');	
	?>
    <article>
        <!-- News section -->
        <section class="article-hero">
            
        <div class="container">
            <?php get_template_part('partials/breadcrumb-for-press-page'); ?>
            <div class="<?=$header_class;?>">
                <div class="news-title items">
                    <h1><?php the_title(); ?></h1>
                </div>
                <?php if(has_post_thumbnail()) { ?>
                    <div class="news-img items">
                        <figure class="hero-featured-image">
                                <?php the_post_thumbnail(); ?>
                        </figure>
                    </div>
                <?php } ?>
                <div class="author-details items">
                    <div class="hero-information-meta">
                        <?php if( $contributor ):
                            $image = get_field( 'image', $contributor->ID );
                        ?>
                            <figure class="picture">
                                <img src="<?php echo esc_url( $image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                            </figure>
                        <?php endif; ?>
                        <div class="info">
                            <?php if( $contributor ):
                                $title = get_the_title($contributor->ID);
                            ?>
                                <div class="author"><?php echo $title; ?></div>
                            <?php endif; ?>
                            <div class="meta">
                                <span class="date"><?php the_date('M d, Y'); ?></span>
                                <span class="reading-time"><?php echo do_shortcode( '[rt_reading_time postfix="mins" postfix_singular="min"]' ); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(has_excerpt()) : ?>
                <div class="row">
                    <div class="col">
                        <div class="hero-summary">
                            <?php the_excerpt(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
        </section>
        <!-- hero section -->

        <!-- content area  -->
        <section class="article-content">
            <div class="container">
               <div class="row">
				    <div class="col-12">
				        <?= the_content() ?>
				    </div>
			   </div>

               <div class="share-section">
					<span>Share this: </span><?php if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) { ADDTOANY_SHARE_SAVE_KIT(); } ?>
				</div>
            </div>
        </section>
        <!-- content area  -->
    </article>
    <?php endwhile; ?>
</main>

<?php get_template_part('partials/footer'); ?>