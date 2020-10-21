<div class="fl-content-slider">
	<div class="fl-content-slider-wrapper">
		<?php
		if ( '1' === $settings->shuffle ) {
			shuffle( $settings->slides );
		}
		for ( $i = 0; $i < count( $settings->slides ); $i++ ) :

			if ( ! is_object( $settings->slides[ $i ] ) ) {
				continue;
			} else {
				$slide = $settings->slides[ $i ];
			}
			?>
		<div class="fl-slide fl-slide-<?php echo $i; ?> fl-slide-text-<?php echo $slide->text_position; ?>">
			<?php

			// Mobile photo or video
			$module->render_mobile_media( $slide );

			// Background photo or video
			$module->render_background( $slide );

			?>
			<div class="fl-slide-foreground clearfix">
				<?php

				// Content
				$module->render_content( $slide );

				// Foreground photo or video
				$module->render_media( $slide );

				?>
			</div>
		</div>
	<?php endfor; ?>
	</div>
		<?php

		// Render the navigation.
		if ( $settings->arrows && count( $settings->slides ) > 0 ) :
			?>
			<div class="fl-content-slider-navigation" aria-label="content slider buttons">
				<a class="slider-prev" href="#" aria-label="previous" role="button">
					<div class="fl-content-slider-svg-container">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 407.436 407.436">
							<path fill="#31606E" d="M315.869 21.178L294.621 0 91.566 203.718l203.055 203.718 21.248-21.178-181.945-182.54z"></path>
						</svg>
					</div>
				</a>
				<a class="slider-next" href="#" aria-label="next" role="button">
					<div class="fl-content-slider-svg-container">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 407.436 407.436">
							<path fill="#31606E" d="M112.814 0L91.566 21.178l181.946 182.54-181.946 182.54 21.248 21.178 203.055-203.718z"></path>
						</svg>
					</div>
				</a>
			</div>
		<?php endif; ?>

		<div class="fl-clear"></div>
</div>

<?php if ( $settings->thumbs && count( $settings->slides ) > 0 ) : ?>
	<div class="fl-content-slider-thumbs">
		<?php foreach($settings->slides as $key=>$slide_item): ?>
			<?php if ( $slide_item->fg_photo_src): ?>
				<a href="#" class="fl-content-slider-thumbs__thumb fl-content-slider-thumbs__thumb-<?php echo($key)?>" data-index="<?php echo $key?>">
					<img src="<?php echo esc_url( $slide_item->fg_photo_src ); ?>" alt="<?php echo esc_attr( $slide_item->title );?>">
				</a>
			<?php endif; ?>
		<?php endforeach;?>
	</div>
<?php endif; ?>
