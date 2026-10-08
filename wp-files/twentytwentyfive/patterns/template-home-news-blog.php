<?php
/**
 * Title: News blog home
 * Slug: twentytwentyfive/template-home-news-blog
 * Template Types: front-page, index, home
 * Viewport width: 1400
 * Inserter: no
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

?>
<!-- wp:template-part {"slug":"header-large-title"} /-->

<!-- wp:group {"tagName":"main","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<main class="wp-block-group">
	<!-- wp:group {"align":"full","layout":{"type":"constrained"},"className":"pt-50 pb-50"} -->
	<div class="wp-block-group alignfull pt-50 pb-50">
		<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|50"}}}} -->
		<div class="wp-block-columns alignwide">
			<!-- wp:column {"width":"25%"} -->
			<div class="wp-block-column" style="flex-basis:25%">
				<!-- wp:group {"style":{"layout":{"columnSpan":1,"rowSpan":1}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch"}} -->
				<div class="wp-block-group">
					<!-- wp:query {"query":{"perPage":1,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"ignore","inherit":false,"taxQuery":null,"parents":[]}} -->
					<div class="wp-block-query">
						<!-- wp:post-template -->
							<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
							<div class="wp-block-group">
								<!-- wp:post-featured-image {"isLink":true,"className":"aspect-[3/2]"} /-->
								<!-- wp:post-title {"isLink":true,"className":"text-large"} /-->
								<!-- wp:post-terms {"term":"category","className":"uppercase tracking-[1.4px]"} /-->
							</div>
							<!-- /wp:group -->
						<!-- /wp:post-template -->
						<!-- wp:query-no-results -->
							<!-- wp:paragraph -->
							<p><?php echo esc_html_x( 'Sorry, but nothing was found. Please try a search with different keywords.', 'Message explaining that there are no results returned from a search.', 'twentytwentyfive' ); ?></p>
							<!-- /wp:paragraph -->
						<!-- /wp:query-no-results -->
					</div>
					<!-- /wp:query -->
					<!-- wp:query {"query":{"perPage":1,"pages":0,"offset":"3","postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"ignore","inherit":false,"taxQuery":null,"parents":[]}} -->
					<div class="wp-block-query">
						<!-- wp:post-template -->
							<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
							<div class="wp-block-group">
								<!-- wp:post-featured-image {"isLink":true,"className":"aspect-[3/2]"} /-->
								<!-- wp:post-title {"isLink":true,"className":"text-large"} /-->
								<!-- wp:post-terms {"term":"category","className":"uppercase tracking-[1.4px]"} /-->
							</div>
							<!-- /wp:group -->
						<!-- /wp:post-template -->
					</div>
					<!-- /wp:query -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:column -->
			<!-- wp:column {"width":"50%"} -->
			<div class="wp-block-column" style="flex-basis:50%">
				<!-- wp:query {"query":{"perPage":1,"pages":0,"offset":"1","postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"ignore","inherit":false,"taxQuery":null,"parents":[]}} -->
				<div class="wp-block-query">
					<!-- wp:post-template -->
						<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"default"}} -->
						<div class="wp-block-group">
							<!-- wp:post-featured-image {"isLink":true,"className":"aspect-[4/3]"} /-->
							<!-- wp:post-title {"level":1,"isLink":true} /-->
							<!-- wp:post-terms {"term":"category","className":"uppercase tracking-[1.4px]"} /-->
							<!-- wp:post-excerpt {"className":"text-medium"} /-->
						</div>
						<!-- /wp:group -->
					<!-- /wp:post-template -->
				</div>
				<!-- /wp:query -->
			</div>
			<!-- /wp:column -->
			<!-- wp:column {"width":"25%"} -->
			<div class="wp-block-column" style="flex-basis:25%">
				<!-- wp:group {"style":{"layout":{"columnSpan":1,"rowSpan":1}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch"}} -->
				<div class="wp-block-group">
					<!-- wp:query {"query":{"perPage":1,"pages":0,"offset":"2","postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"ignore","inherit":false,"taxQuery":null,"parents":[]}} -->
					<div class="wp-block-query">
						<!-- wp:post-template -->
							<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
							<div class="wp-block-group">
								<!-- wp:post-featured-image {"isLink":true,"className":"aspect-[3/2]"} /-->
								<!-- wp:post-title {"isLink":true,"className":"text-large"} /-->
								<!-- wp:post-terms {"term":"category","className":"uppercase tracking-[1.4px]"} /-->
							</div>
							<!-- /wp:group -->
						<!-- /wp:post-template -->
					</div>
					<!-- /wp:query -->
					<!-- wp:query {"query":{"perPage":1,"pages":0,"offset":"4","postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"ignore","inherit":false,"taxQuery":null,"parents":[]}} -->
					<div class="wp-block-query">
						<!-- wp:post-template -->
							<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
							<div class="wp-block-group">
								<!-- wp:post-featured-image {"isLink":true,"className":"aspect-[3/2]"} /-->
								<!-- wp:post-title {"isLink":true,"className":"text-large"} /-->
								<!-- wp:post-terms {"term":"category","className":"uppercase tracking-[1.4px]"} /-->
							</div>
							<!-- /wp:group -->
						<!-- /wp:post-template -->
					</div>
					<!-- /wp:query -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:column -->
		</div>
		<!-- /wp:columns -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"align":"full","style":{"spacing":{"blockGap":"var:preset|spacing|50"}},"layout":{"type":"constrained"},"className":"pt-50 pb-50"} -->
	<div class="wp-block-group alignfull pt-50 pb-50">
		<!-- wp:query {"query":{"perPage":2,"pages":0,"offset":"5","postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"ignore","inherit":false,"taxQuery":null,"parents":[]},"align":"wide"} -->
		<div class="wp-block-query alignwide">
			<!-- wp:post-template {"layout":{"type":"grid","columnCount":2},"className":"gap-50"} -->
				<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
				<div class="wp-block-group gap-50">
					<!-- wp:post-featured-image {"isLink":true,"className":"aspect-[3/2]"} /-->
					<!-- wp:post-title {"isLink":true,"className":"text-x-large"} /-->
					<!-- wp:post-terms {"term":"category","className":"uppercase tracking-[1.4px]"} /-->
				</div>
				<!-- /wp:group -->
			<!-- /wp:post-template -->
		</div>
		<!-- /wp:query -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"align":"full","layout":{"type":"constrained"},"className":"pt-50 pb-50"} -->
	<div class="wp-block-group alignfull pt-50 pb-50">
		<!-- wp:query {"query":{"perPage":6,"pages":0,"offset":"7","postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"ignore","inherit":false,"taxQuery":null,"parents":[]},"align":"wide"} -->
		<div class="wp-block-query alignwide">
			<!-- wp:post-template {"layout":{"type":"grid","columnCount":3},"className":"gap-50"} -->
				<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
				<div class="wp-block-group gap-50">
					<!-- wp:post-featured-image {"isLink":true,"className":"aspect-[4/3]"} /-->
					<!-- wp:post-title {"isLink":true,"className":"text-large"} /-->
					<!-- wp:post-terms {"term":"category","className":"uppercase tracking-[1.4px]"} /-->
				</div>
				<!-- /wp:group -->
			<!-- /wp:post-template -->
			<!-- wp:group {"layout":{"type":"constrained"},"className":"pt-40 pb-40"} -->
			<div class="wp-block-group pt-40 pb-40">
				<!-- wp:query-pagination {"align":"wide","layout":{"type":"flex","justifyContent":"space-between"}} -->
					<!-- wp:query-pagination-previous /-->
					<!-- wp:query-pagination-numbers /-->
					<!-- wp:query-pagination-next /-->
				<!-- /wp:query-pagination -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:query -->
	</div>
	<!-- /wp:group -->
</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer-newsletter"} /-->
