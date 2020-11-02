<div class="blog-head__search-btn d-flex justify-content-end">
    <button type="button" data-toggle="modal" data-target="#searchModal">
        <?php $icon_alt = get_post_meta( $settings->search_btn_icon, '_wp_attachment_image_alt', true )?>
        <img src="<?php echo esc_url( $settings->search_btn_icon_src ); ?>" alt="<?php echo esc_attr( $icon_alt ); ?>"/>
    </button>
</div>

<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-hidden="true"
    data-backdrop="false"
>
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1.03965 1.53958L22.96 23.4599" stroke="#31606E" stroke-linecap="square"/>
            <path d="M1.54055 23.9599L23.4609 2.03955" stroke="#31606E" stroke-linecap="square"/>
            </svg>
        </button>
      </div>
      <div class="modal-body">
        <form role="search" aria-label="Search form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" autocomplete="off">
            <div class="form-group fl-form-field d-flex align-items-center">
                <button type="submit">
                    <?php $icon_alt = get_post_meta( $settings->search_input_icon, '_wp_attachment_image_alt', true )?>
                    <img src="<?php echo esc_url( $settings->search_input_icon_src ); ?>" alt="<?php echo esc_attr( $icon_alt ); ?>"/>
                </button>
                <input class="fl-search-text" type="search" value="<?php get_search_query(); ?>" name="s" autocomplete="off">

                <?php if ( 'ajax' == $settings->result ) : ?>
                    <div class="fl-search-loader-wrap">
                        <div class="fl-search-loader">
                            <svg class="spinner" viewBox="0 0 50 50">
                                <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
                            </svg>
                        </div>
                    </div>
                    <?php endif; ?>
               
                <?php if ( 'ajax' == $settings->result ) : ?>
                    <div class="fl-search-results-content fl-search-results-content--modal"></div>
                <?php endif; ?>

            </div>
        </form>
      </div>
    </div>
  </div>
</div>
