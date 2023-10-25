<footer>
	<div class="container">
		<div class="branding">
			<div class="row">
				<div class="col-lg-12 col-8">
					<?php
					$footer_branding = get_field('footer_branding', 'option');
					if (!empty($footer_branding)) : ?>
						<a href="<?= home_url(); ?>"><img src="<?= esc_url($footer_branding['url']); ?>" alt="<?= esc_attr($footer_branding['alt']); ?>" /></a>
					<?php endif; ?>
				</div>

				<?php if (have_rows('footer_social_networks', 'option')) : ?>
					<div class="col-4">
						<ul class="social-networks">
							<?php while (have_rows('footer_social_networks', 'option')) : the_row();
								$footer_social_network_image = get_sub_field('footer_social_network_image', 'option');
								$footer_social_network_link = get_sub_field('footer_social_network_link', 'option');
								if ($footer_social_network_link) :
									$footer_social_network_link_url = $footer_social_network_link['url'];
									$footer_social_network_link_target = $footer_social_network_link['target'] ? $footer_social_network_link['target'] : '_self';
							?>
									<li>
										<a href="<?= esc_url($footer_social_network_link_url); ?>" target="<?= esc_attr($footer_social_network_link_target); ?>" rel="noopener noreferrer"><img src="<?= esc_url($footer_social_network_image['url']); ?>" rel="noopener noreferrer" alt="<?= esc_attr($footer_social_network_image['alt']); ?>" /></a>
									</li>
								<?php endif; ?>
							<?php endwhile; ?>
						</ul>
					</div>
				<?php endif; ?>

			</div>
		</div>
		<div class="footer-navigation desktopFooter">
			<div class="footer-navigation-item">
				<?php
				$footer_nav_header_1 = get_field('footer_nav_header_1', 'option');
				if (!empty($footer_nav_header_1)) : ?>
					<h6><?= $footer_nav_header_1 ?></h6>
				<?php endif; ?>
				<?php
				wp_nav_menu(
					array(
						'menu' => 'product-footer',
						'menu_class' => 'product-footer',
					)
				);
				?>
			</div>

			<div class="footer-navigation-item">
				<?php
				$footer_nav_header_2 = get_field('footer_nav_header_2', 'option');
				if (!empty($footer_nav_header_2)) : ?>
					<h6><?= $footer_nav_header_2 ?></h6>
				<?php endif; ?>
				<?php
				wp_nav_menu(
					array(
						'menu' => 'data-footer',
						'menu_class' => 'data-footer',
					)
				);
				?>
			</div>

			<div class="footer-navigation-item">
				<?php
				$footer_nav_header_3 = get_field('footer_nav_header_3', 'option');
				if (!empty($footer_nav_header_3)) : ?>
					<h6><?= $footer_nav_header_3 ?></h6>
				<?php endif; ?>
				<?php
				wp_nav_menu(
					array(
						'menu' => 'insight-footer',
						'menu_class' => 'insight-footer',
					)
				);
				?>
			</div>

			<div class="footer-navigation-item">
				<?php
				$footer_nav_header_4 = get_field('footer_nav_header_4', 'option');
				if (!empty($footer_nav_header_4)) : ?>
					<h6><?= $footer_nav_header_4 ?></h6>
				<?php endif; ?>
				<?php
				wp_nav_menu(
					array(
						'menu' => 'about-footer',
						'menu_class' => 'about-footer',
					)
				);
				?>
			</div>

			<div class="footer-navigation-item">
				<?php
				$footer_nav_header_5 = get_field('footer_nav_header_5', 'option');
				if (!empty($footer_nav_header_5)) : ?>
					<h6><?= $footer_nav_header_5 ?></h6>
				<?php endif; ?>
				<?php
				$footer_phone_number = get_field('footer_phone_number', 'option');
				if ($footer_phone_number) :
					$footer_phone_number_url = $footer_phone_number['url'];
					$footer_phone_number_title = $footer_phone_number['title'];
				?>
					<div class="contact">
                        <a href="/customer-support/">Customer Support</a>
						<?php /* ?><a href="<?= esc_url($footer_phone_number_url); ?>"><?= esc_html($footer_phone_number_title); ?></a><?php */ ?>
					</div>
				<?php endif; ?>
				<div class="social">
					<?php
					wp_nav_menu(
						array(
							'menu' => 'social-networks-footer',
							'menu_class' => 'social-networks-footer',
						)
					);
					?>
				</div>
			</div>
		</div>
		<div class="accordion accordion-flush footer-navigation" id="mobileFooter">
			<div class="accordion-item footer-navigation-item">
				<h6 class="accordion-header" id="flush-headingOne">
					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
						<?php echo !empty($footer_nav_header_1) ? $footer_nav_header_1 : ""; ?>
					</button>
				</h6>
				<div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#mobileFooter">
					<div class="accordion-body">
						<?php
						wp_nav_menu(
							array(
								'menu' => 'product-footer',
								'menu_class' => 'product-footer',
							)
						);
						?>
					</div>
				</div>
			</div>

			<div class="accordion-item footer-navigation-item">
				<h6 class="accordion-header" id="flush-headingTwo">
					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
						<?php echo !empty($footer_nav_header_2) ? $footer_nav_header_2 : ""; ?>
					</button>
				</h6>
				<div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#mobileFooter">
					<div class="accordion-body">
						<?php
						wp_nav_menu(
							array(
								'menu' => 'data-footer',
								'menu_class' => 'data-footer',
							)
						);
						?>
					</div>
				</div>
			</div>

			<div class="accordion-item footer-navigation-item">
				<h6 class="accordion-header" id="flush-headingThree">
					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
						<?php echo !empty($footer_nav_header_3) ? $footer_nav_header_3 : ""; ?>
					</button>
				</h6>
				<div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#mobileFooter">
					<div class="accordion-body">
						<?php
						wp_nav_menu(
							array(
								'menu' => 'insight-footer',
								'menu_class' => 'insight-footer',
							)
						);
						?>
					</div>
				</div>
			</div>

			<div class="accordion-item footer-navigation-item">
				<h6 class="accordion-header" id="flush-headingFour">
					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
						<?php echo !empty($footer_nav_header_4) ? $footer_nav_header_4 : ""; ?>
					</button>
				</h6>
				<div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#mobileFooter">
					<div class="accordion-body">
						<?php
						wp_nav_menu(
							array(
								'menu' => 'about-footer',
								'menu_class' => 'about-footer',
							)
						);
						?>
					</div>
				</div>
			</div>
			<div class="accordion-item footer-navigation-item"></div>
		</div>
		<?php
		$footer_additional_cta_pagelink = get_field('footer_additional_cta_pagelink', 'option');
		$footer_additional_cta_label = get_field('footer_additional_cta_label', 'option');
		if (!empty($footer_additional_cta_pagelink)) : ?>
			<div class="additional-cta">
				<div class="row">
					<div class="col-12">
						<a href="<?php the_field('footer_additional_cta_pagelink'); ?>" class="button btn-outline-white"><?= $footer_additional_cta_label ?></a>
					</div>
				</div>
			</div>
		<?php endif; ?>
		<div class="row">
			<div class="col-12">
				<div class="copyright">
					<?php
					$copyright_notice = get_field('copyright_notice', 'option');
					if (!empty($copyright_notice)) : ?>
						<span class="copyright-notice">&copy; <?= date("Y"); ?> <?= $copyright_notice ?></span>
					<?php endif; ?>
					<?php
					wp_nav_menu(
						array(
							'menu' => 'copyright-footer',
							'menu_class' => 'copyright-footer',
						)
					);
					?>
				</div>
			</div>
			<div class="col-12">
				<div class="scroll-to-top">
					<a href="javascript:void(0)" title="Back to Top" id="scrollToTop">
						<!-- Back to Top button -->
						<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" xmlns:v="https://vecta.io/nano">
							<rect width="40" height="40" rx="20" />
							<path d="M10.17 22.186l9.83-9.83 9.83 9.83-2.46 2.458L20 17.271l-7.372 7.373z" fill="#0597ff" fill-rule="evenodd" />
						</svg>
					</a>
				</div>
			</div>
		</div>
		<?php
            $cookie_display = get_field('cookie_display', 'option');
            if ($cookie_display == "on" && (!isset($_COOKIE["cookiePolicyAccepted"]) || $_COOKIE["cookiePolicyAccepted"] != "1")) { ?>
			<div class="cookie-button">
				<div class="cookie-front">
					<a class="cookie" href="javascript:void(0)"><span class="side1">Cookie Policy</span><span class="right-arrow"></span></a>
				</div>
				<div class="cookie cookie-rear">
					<span><a href="javascript:void(0)" class="side2" data-bs-toggle="modal" data-bs-target="#cookieModal">Learn More</a></span> | <span><a href="javascript:void(0)" id="cookie-close" class="side2">Close</a></span>
				</div>
			</div>
			<div class="modal fade" id="cookieModal" tabindex="-1" aria-labelledby="cookieModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="cookieModalLabel">Cookie Policy</h5>
							<input type="button" id="modalCloseBtn" class="btn-close" data-bs-dismiss="modal" aria-label="Close" />
						</div>
						<div class="modal-body">
							<div class="d-flex align-items-start mobile-flex-column">
								<div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
									<?php
									$privacy_settings_title = get_field('privacy_settings_title', 'option');
									if (!empty($privacy_settings_title)) {
									?>
										<button class="nav-link active" id="v-pills-tab-1" data-bs-toggle="pill" data-bs-target="#v-pills-1" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true"><?= $privacy_settings_title ?></button>
									<?php }
									$google_analytics_title = get_field('google_analytics_title', 'option');
									if (!empty($google_analytics_title)) {
									?>
										<button class="nav-link" id="v-pills-tab-2" data-bs-toggle="pill" data-bs-target="#v-pills-2" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false"><?= $google_analytics_title ?></button>
									<?php } ?>
								</div>
								<div class="tab-content" id="v-pills-tabContent">
									<?php
									$privacy_settings_content = get_field('privacy_settings_content', 'option');
									if (!empty($privacy_settings_content)) {
									?>
										<div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-tab-1"><?= $privacy_settings_content ?></div>
									<?php }
									$google_analytics_content = get_field('google_analytics_content', 'option');
									if (!empty($google_analytics_content)) {
									?>
										<div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-tab-2"><?= $google_analytics_content ?></div>
									<?php } ?>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="button btn-primary" id="acceptCookie">Accept</button>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
		<?php
        wp_reset_postdata();
		$post_type = get_post_type();
        $tax = get_query_var('taxonomy');
        if ($post_type == "product" || $tax == "byindustry") :
            if($tax == "byindustry") {
                $cta_text = get_field('cta_text_industry', 'option');
            } else {
			    $cta_text = get_field('cta_text_need_help', 'option');
            }
		?>
			<div class="sticky-side-cta-need-help-block">
				<div class="stickyside-button">
					<?php if (!empty($cta_text)) : ?>
						<div class="stickyside-front" data-bs-toggle="modal" data-bs-target="#stickysideneedhelp">
							<span><svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M15 28.125C11.519 28.125 8.18064 26.7422 5.71922 24.2808C3.25781 21.8194 1.875 18.481 1.875 15C1.875 11.519 3.25781 8.18064 5.71922 5.71922C8.18064 3.25781 11.519 1.875 15 1.875C18.481 1.875 21.8194 3.25781 24.2808 5.71922C26.7422 8.18064 28.125 11.519 28.125 15C28.125 18.481 26.7422 21.8194 24.2808 24.2808C21.8194 26.7422 18.481 28.125 15 28.125ZM15 30C18.9782 30 22.7936 28.4196 25.6066 25.6066C28.4196 22.7936 30 18.9782 30 15C30 11.0218 28.4196 7.20644 25.6066 4.3934C22.7936 1.58035 18.9782 0 15 0C11.0218 0 7.20644 1.58035 4.3934 4.3934C1.58035 7.20644 0 11.0218 0 15C0 18.9782 1.58035 22.7936 4.3934 25.6066C7.20644 28.4196 11.0218 30 15 30V30Z" fill="white" />
									<path d="M9.85318 10.8487C9.85062 10.9093 9.86046 10.9697 9.88212 11.0263C9.90377 11.0829 9.93677 11.1345 9.9791 11.1779C10.0214 11.2213 10.0722 11.2555 10.1282 11.2786C10.1843 11.3016 10.2445 11.313 10.3051 11.3119H11.8519C12.1107 11.3119 12.3169 11.1 12.3507 10.8431C12.5194 9.61312 13.3632 8.71688 14.8669 8.71688C16.1532 8.71688 17.3307 9.36 17.3307 10.9069C17.3307 12.0975 16.6294 12.645 15.5213 13.4775C14.2594 14.3944 13.2601 15.465 13.3313 17.2031L13.3369 17.61C13.3389 17.733 13.3892 17.8503 13.4768 17.9366C13.5645 18.0229 13.6827 18.0713 13.8057 18.0712H15.3263C15.4506 18.0712 15.5699 18.0219 15.6578 17.934C15.7457 17.846 15.7951 17.7268 15.7951 17.6025V17.4056C15.7951 16.0594 16.3069 15.6675 17.6888 14.6194C18.8307 13.7512 20.0213 12.7875 20.0213 10.7644C20.0213 7.93125 17.6288 6.5625 15.0094 6.5625C12.6338 6.5625 10.0313 7.66875 9.85318 10.8487V10.8487ZM12.7726 21.6544C12.7726 22.6537 13.5694 23.3925 14.6663 23.3925C15.8082 23.3925 16.5938 22.6537 16.5938 21.6544C16.5938 20.6194 15.8063 19.8919 14.6644 19.8919C13.5694 19.8919 12.7726 20.6194 12.7726 21.6544Z" fill="white" />
								</svg></span>
							<span class="need-text"><a href="javascript:void(0)" class="stickyside-side"><?= $cta_text ?></a></span>
						</div>
					<?php endif; ?>
				</div>
			</div>
        <?php
        endif;
        ?>
<?php
$select_pages = get_field('select_pages', 'option');
$post_id = get_the_ID();

if ($post_type == "dataset" || (!empty($select_pages) && in_array($post_id, $select_pages))) :
	$cta_text_data = get_field('cta_text_data', 'option');
?>
	<div class="sticky-side-cta-data">
		<div class="stickyside-data-button stickyside-button">
			<?php if (!empty($cta_text_data)) : ?>
				<div class="sticky-dataside-front">
					<span><svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M15 28.125C11.519 28.125 8.18064 26.7422 5.71922 24.2808C3.25781 21.8194 1.875 18.481 1.875 15C1.875 11.519 3.25781 8.18064 5.71922 5.71922C8.18064 3.25781 11.519 1.875 15 1.875C18.481 1.875 21.8194 3.25781 24.2808 5.71922C26.7422 8.18064 28.125 11.519 28.125 15C28.125 18.481 26.7422 21.8194 24.2808 24.2808C21.8194 26.7422 18.481 28.125 15 28.125ZM15 30C18.9782 30 22.7936 28.4196 25.6066 25.6066C28.4196 22.7936 30 18.9782 30 15C30 11.0218 28.4196 7.20644 25.6066 4.3934C22.7936 1.58035 18.9782 0 15 0C11.0218 0 7.20644 1.58035 4.3934 4.3934C1.58035 7.20644 0 11.0218 0 15C0 18.9782 1.58035 22.7936 4.3934 25.6066C7.20644 28.4196 11.0218 30 15 30V30Z" fill="white" />
							<path d="M9.85318 10.8487C9.85062 10.9093 9.86046 10.9697 9.88212 11.0263C9.90377 11.0829 9.93677 11.1345 9.9791 11.1779C10.0214 11.2213 10.0722 11.2555 10.1282 11.2786C10.1843 11.3016 10.2445 11.313 10.3051 11.3119H11.8519C12.1107 11.3119 12.3169 11.1 12.3507 10.8431C12.5194 9.61312 13.3632 8.71688 14.8669 8.71688C16.1532 8.71688 17.3307 9.36 17.3307 10.9069C17.3307 12.0975 16.6294 12.645 15.5213 13.4775C14.2594 14.3944 13.2601 15.465 13.3313 17.2031L13.3369 17.61C13.3389 17.733 13.3892 17.8503 13.4768 17.9366C13.5645 18.0229 13.6827 18.0713 13.8057 18.0712H15.3263C15.4506 18.0712 15.5699 18.0219 15.6578 17.934C15.7457 17.846 15.7951 17.7268 15.7951 17.6025V17.4056C15.7951 16.0594 16.3069 15.6675 17.6888 14.6194C18.8307 13.7512 20.0213 12.7875 20.0213 10.7644C20.0213 7.93125 17.6288 6.5625 15.0094 6.5625C12.6338 6.5625 10.0313 7.66875 9.85318 10.8487V10.8487ZM12.7726 21.6544C12.7726 22.6537 13.5694 23.3925 14.6663 23.3925C15.8082 23.3925 16.5938 22.6537 16.5938 21.6544C16.5938 20.6194 15.8063 19.8919 14.6644 19.8919C13.5694 19.8919 12.7726 20.6194 12.7726 21.6544Z" fill="white" />
						</svg></span>
					<span class="data-text"><a href="javascript:void(0)" class="sticky-dataside-side"><?= $cta_text_data ?></a></span>
				</div>
			<?php endif; ?>
		</div>
	</div>
<?php
endif;
?>

<?php
$post_id = get_the_ID();
$product_template = get_page_template_slug($post_id);

if ($product_template == "template-products.php") :
	$cta_text = get_field('cta_text_products_overview', 'option');
?>
	<div class="sticky-side-cta-need-help-block">
        <div class="stickyside-button">
            <?php if (!empty($cta_text)) : ?>
                <div class="stickyside-front" data-bs-toggle="modal" data-bs-target="#stickysideneedhelp">
                    <span><svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 28.125C11.519 28.125 8.18064 26.7422 5.71922 24.2808C3.25781 21.8194 1.875 18.481 1.875 15C1.875 11.519 3.25781 8.18064 5.71922 5.71922C8.18064 3.25781 11.519 1.875 15 1.875C18.481 1.875 21.8194 3.25781 24.2808 5.71922C26.7422 8.18064 28.125 11.519 28.125 15C28.125 18.481 26.7422 21.8194 24.2808 24.2808C21.8194 26.7422 18.481 28.125 15 28.125ZM15 30C18.9782 30 22.7936 28.4196 25.6066 25.6066C28.4196 22.7936 30 18.9782 30 15C30 11.0218 28.4196 7.20644 25.6066 4.3934C22.7936 1.58035 18.9782 0 15 0C11.0218 0 7.20644 1.58035 4.3934 4.3934C1.58035 7.20644 0 11.0218 0 15C0 18.9782 1.58035 22.7936 4.3934 25.6066C7.20644 28.4196 11.0218 30 15 30V30Z" fill="white" />
                            <path d="M9.85318 10.8487C9.85062 10.9093 9.86046 10.9697 9.88212 11.0263C9.90377 11.0829 9.93677 11.1345 9.9791 11.1779C10.0214 11.2213 10.0722 11.2555 10.1282 11.2786C10.1843 11.3016 10.2445 11.313 10.3051 11.3119H11.8519C12.1107 11.3119 12.3169 11.1 12.3507 10.8431C12.5194 9.61312 13.3632 8.71688 14.8669 8.71688C16.1532 8.71688 17.3307 9.36 17.3307 10.9069C17.3307 12.0975 16.6294 12.645 15.5213 13.4775C14.2594 14.3944 13.2601 15.465 13.3313 17.2031L13.3369 17.61C13.3389 17.733 13.3892 17.8503 13.4768 17.9366C13.5645 18.0229 13.6827 18.0713 13.8057 18.0712H15.3263C15.4506 18.0712 15.5699 18.0219 15.6578 17.934C15.7457 17.846 15.7951 17.7268 15.7951 17.6025V17.4056C15.7951 16.0594 16.3069 15.6675 17.6888 14.6194C18.8307 13.7512 20.0213 12.7875 20.0213 10.7644C20.0213 7.93125 17.6288 6.5625 15.0094 6.5625C12.6338 6.5625 10.0313 7.66875 9.85318 10.8487V10.8487ZM12.7726 21.6544C12.7726 22.6537 13.5694 23.3925 14.6663 23.3925C15.8082 23.3925 16.5938 22.6537 16.5938 21.6544C16.5938 20.6194 15.8063 19.8919 14.6644 19.8919C13.5694 19.8919 12.7726 20.6194 12.7726 21.6544Z" fill="white" />
                        </svg></span>
                    <span class="need-text"><a href="javascript:void(0)" class="stickyside-side"><?= $cta_text ?></a></span>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
</div>
</footer>
<?php get_footer(); ?>