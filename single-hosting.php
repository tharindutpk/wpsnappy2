<?php
/**
 * WP Snappy.
 *
 * This file adds the single hosting page template to the WP Snappy Theme.
 *
 * Template Name: Hosting
 *
 * @package WP Snappy
 * @author  Tharindu Pramuditha
 * @license GPL-2.0+
 * @link    http://www.wpsnappy.com/
 */

// Hosting review box.
add_action( 'genesis_after_entry', 'display_hosting_review_score', 1 );
function display_hosting_review_score() {
?>
<div class="hosting-review-box clearfix" id="ratings">
	<h3 class="section-title">Review Score</h3>
	<div class="one-half first">
		<ul class="hosting-score-list">
			<li>
				<span>Overall</span>
				<div class="hosting-review-score">
					<div class="star-rating-holder">
						<div class="star-rating-filled" style="width: <?php echo $total_score * 20 ?>%;"></div>
					</div>
					<div class="score-numbers"><?php echo $total_score ?>/5</div>
				</div>
			</li>
			<li>
				<span>Support</span>
				<div class="hosting-review-score">
					<div class="star-rating-holder">
						<div class="star-rating-filled" style="width: <?php echo $pricing_score * 20 ?>%;"></div>
					</div>
					<div class="score-numbers"><?php echo $pricing_score ?>/5</div>
				</div>
			</li>
			<li>
				<span>Features</span>
				<div class="hosting-review-score">
					<div class="star-rating-holder">
						<div class="star-rating-filled" style="width: <?php echo $features_score * 20 ?>%;"></div>
					</div>
					<div class="score-numbers"><?php echo $features_score ?>/5</div>
				</div>
			</li>
			<li>
				<span>Uptime</span>
				<div class="hosting-review-score">
					<div class="star-rating-holder">
						<div class="star-rating-filled" style="width: <?php echo $support_score * 20 ?>%;"></div>
					</div>
					<div class="score-numbers"><?php echo $support_score ?>/5</div>
				</div>
			</li>
			<li>
				<span>Value</span>
				<div class="hosting-review-score">
					<div class="star-rating-holder">
						<div class="star-rating-filled" style="width: <?php echo $reliability_score * 20 ?>%;"></div>
					</div>
					<div class="score-numbers"><?php echo $reliability_score ?>/5</div>
				</div>
			</li>
		</ul>
	</div>
</div>
<?php
}

// Hosting top features.
add_action( 'genesis_after_entry', 'display_hosting_top_features', 2 );
function display_hosting_top_features() {
?>
<div class="hosting-top-features clearfix" id="top-features">
	<h3 class="section-title">Top Features</h3>
	<ul class="hosting-top-features-list">
		<?php
		$feature_list = get_post_meta( get_the_ID(), '_wpsnappy_hosting_features', true );
		foreach ( $feature_list as $key => $entry ) {
			echo '<li><i class="fa fa-check-circle" style="color:#23ab11"></i>'.$entry.'</li>';
		}
		?>
	</ul>
</div>
<?php
}

// Hosting FAQs.
add_action( 'genesis_after_entry', 'display_hosting_faq_section', 3 );
function display_hosting_faq_section() {
	if ( ! is_singular( 'hosting' ) ) {
		return;
	}
	$hosting_provider = get_post_meta( get_the_ID(), '_wpsnappy_hosting_provider_name', true );
?>	
<div class="hosting-faq clearfix" id="faq">
	<h3 class="section-title"><span><?php echo $hosting_provider ?></span> Frequently Asked Questions</h3>
	<div class="hosting-faq-pane">
		<ul class="hosting-faq-list">
		<?php
			$faq_entries = get_post_meta( get_the_ID(), '_wpsnappy_hosting_faq', true );
			foreach ( (array) $faq_entries as $key => $entry ) {
					
				if ( isset( $entry['question'] ) ) {
					$question = esc_html( $entry['question'] );
				}
					
				if ( isset( $entry['answer'] ) ) {
					$answer = $entry['answer'];
				}

				echo '<li itemscope itemtype="http://schema.org/Question"><span class="hosting-faq-question" itemprop="text"><strong>'.$question.'</strong></span>';
				echo '<div class="hosting-faq-answer" itemprop="acceptedAnswer" itemscope itemtype="http://schema.org/Answer">';
				echo '<div itemprop="text">'.$answer.'</div></div></li>';

			}
		?>
		</ul>
	</div>
</div>
<?php
}

genesis();
