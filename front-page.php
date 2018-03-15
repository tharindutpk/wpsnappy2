<?php
/**
 * WP Snappy.
 *
 * This file adds the front page to the WP Snappy Theme.
 *
 * @package   WP Snappy
 * @link      https://www.wpsnappy.com/
 * @author    Tharindu Pramuditha
 * @license   GPL-2.0+
 */

// Force full-width-content layout.
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

// Remove default page header.
remove_action( 'genesis_before_content_sidebar_wrap', 'wpsnappy_page_header' );

// Remove content-sidebar-wrap.
add_filter( 'genesis_markup_content-sidebar-wrap', '__return_null' );

// Remove default loop.
remove_action( 'genesis_loop', 'genesis_do_loop' );

// Check if any front page widgets are active.
add_action( 'genesis_loop', 'wpsnappy_front_page_loop' );
/**
 * Front page content.
 *
 * @since  2.0.0
 *
 * @return void
 */
function wpsnappy_front_page_loop() {
	?>
	<div class="home-section featured-links">
		<div class="wrap">
			<div class="featured-links-border">
				<div class="featured-links-border-inner"></div>
			</div>
			<div class="featured-links-inner">
				<h1 class="section-title" itemprop="headline">WordPress Tutorials</h1>
				<p>Learn more about,</p>
				<ul class="featured-links-list">
					<li class="featured-links-item"><a href="/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/homepage/laptop.svg" title="WordPress Tutorials" alt="WordPress Tutorials"><h3>Tutorials</h3></a></li>
					<li class="featured-links-item"><a href="/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/homepage/analytics.svg" title="WordPress Guides" alt="WordPress Guides"><h3>Guides</h3></a></li>
					<li class="featured-links-item"><a href="/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/homepage/browser.svg" title="WordPress Themes" alt="WordPress Themes"><h3>Themes</h3></a></li>
					<li class="featured-links-item"><a href="/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/homepage/startup.svg" title="WordPress Plugins" alt="WordPress Plugins"><h3>Plugins</h3></a></li>
					<li class="featured-links-item"><a href="/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/homepage/job-search.svg" title="WordPress News & Opinions" alt="WordPress News & Opinions"><h3>News & Opinions</h3></a></li>
					<li class="featured-links-item"><a href="/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/homepage/genesis-framework.svg" title="Genesis Framework" alt="Genesis Framework"><h3>Genesis Framework</h3></a></li>
				</ul>
			</div>
		</div>
	</div>

	<div class="home-section featured-articles">
		<div class="wrap">
			<h3 class="section-title">Recent Posts</h3>

			<div class="featured-sections">

				<div class="featured-main"></div>

				<div class="featured-row">

					<?php
					$args = array(
						'posts_per_page' => 3,
						'orderby'        => 'date',
						'order'          => 'DESC',
						'post_type'      => 'post',
						'offset'         => 1
					);

					$blog_posts = new WP_Query( $args );
					if ( $blog_posts->have_posts() ): $i = 0;
						while ( $blog_posts->have_posts() ):
							$blog_posts->the_post();
							$categories = get_the_category();

							?>

							<div class="one-third<?php echo ( $i ) == 0 ? ' first' : '' ?>">
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'featured-image' ); ?></a>
								<div class="featured-row-body">
									<div class="featured-row-header">
										<div class="category"><?php echo esc_html( $categories[0]->name ); ?></div>
										<div class="index"><?php echo $i + 2 ?></div>
									</div>
									<div class="featured-row-footer">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</div>
								</div>
							</div>

							<?php

							$i ++;
						endwhile;
					endif;
					wp_reset_postdata(); ?>

				</div>

				<div class="blog-link">
					<a href="/blog/">Read our blog</a>
				</div>

			</div>

		</div>
	</div>

	<div class="home-section signup-footer">
		<div class="wrap">
			<h3 class="section-title">Want To Learn WordPress?</h3>
			<div class="sign-up-text">
				<p>Want the best WordPress tutorials and guides delivered to your inbox?</p>
			</div>
			<div class="sign-up-form-footer">
				<form action="//wpsnappy.us16.list-manage.com/subscribe/post?u=47b6cfe6506a11c0a811fdd79&amp;id=58c79beb6e" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
					<div class="footer-form-fields-wrapper">
						<div class="footer-form-fields">
							<input type="email" value="" name="EMAIL" class="form-field email" id="mce-EMAIL" placeholder="Enter your email here">
							<div id="mce-responses" class="clear">
								<div class="response" id="mce-error-response" style="display:none"></div>
								<div class="response" id="mce-success-response" style="display:none"></div>
							</div>
							<div style="position: absolute; left: -5000px;" aria-hidden="true">
								<input type="text" name="b_47b6cfe6506a11c0a811fdd79_58c79beb6e" tabindex="-1" value="">
							</div>
						</div>
					</div>
					<div class="footer-form-button">
						<input type="submit" value="Please!" name="please" id="mc-embedded-subscribe" class="button">
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php
}

// Run Genesis.
genesis();
