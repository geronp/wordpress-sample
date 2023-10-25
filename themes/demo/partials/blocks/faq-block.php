<?php
$faqs = get_field('faqs');

if ($faqs) :
	$title = get_field('title');
	$index = 0; ?>
	<section class="faqs">
		<div class="container">
			<h4><?= $title ?></h4>
			<div class="row justify-content-center">
				<div class="col-12 col-md-8">
					<div class="accordion" id="faqs">
						<?php foreach ($faqs as $faq) :
							$title = get_the_title($faq->ID);
							$content = get_the_content(null, false, $faq->ID);

							$btnClass = $index == 0 ? "" : "collapsed";
							$divClass = $index == 0 ? "show" : "";
							$expanded = $index == 0 ? "true" : "false";  ?>

							<div class="accordion-item">
								<h2 class="accordion-header" id="heading-<?= $index ?>">
									<button class="accordion-button <?= $btnClass ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?= $index ?>" aria-expanded="<?= $expanded ?>" aria-controls="collapse-<?= $index ?>"><?= $title ?></button>
								</h2>
								<div id="collapse-<?= $index ?>" class="accordion-collapse collapse <?= $divClass ?>" aria-labelledby="heading-<?= $index ?>" data-bs-parent="#faqs">
									<div class="accordion-body"><?= $content ?></div>
								</div>
							</div>

						<?php $index++;
						endforeach;
						wp_reset_postdata(); ?>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>
