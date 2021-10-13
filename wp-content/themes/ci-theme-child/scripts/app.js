document.addEventListener('DOMContentLoaded', function () {
  /* FOR THE FILTERS AND THE SORT STARTS HERE */
  const sorter = jQuery( '.resource-sorter, .blog-sorter' );
  const radioButtonsContainer = jQuery( '.resource-topics .facetwp-bb-module, .blog-categories .facetwp-bb-module' );

  if ( radioButtonsContainer.length > 0 ) {
    const facetWPLoadMoreButton = '<button class="facetwp-load-more fl-button" data-loading="Loading...">Load more</button>';
    let paginationLoadMoreContainer = jQuery( '.resource--list-post.facetwp-template .fl-builder-pagination-load-more' );
    let paginationLoadMoreButton = paginationLoadMoreContainer.children( '.fl-button-wrap' ).children( 'a' );

    paginationLoadMoreButton.replaceWith( facetWPLoadMoreButton );

    jQuery( document ).on( 'facetwp-loaded', ( e ) => {
      const oldPaginationLoadMoreContainer = paginationLoadMoreContainer;

      paginationLoadMoreContainer = jQuery( '.resource--list-post.facetwp-template .fl-builder-pagination-load-more' );

      if ( paginationLoadMoreContainer.length > 1 ) { oldPaginationLoadMoreContainer.remove(); }

      paginationLoadMoreButton = paginationLoadMoreContainer.children( '.fl-button-wrap' ).children( 'a' );
      paginationLoadMoreButton.replaceWith( facetWPLoadMoreButton );
    } );

    //const radioButtonsBorder = jQuery( '.resource-topics .facetwp-border, .blog-categories .facetwp-border' );
    const radioButtonsBorder = jQuery( '<div class="facetwp-border">&nbsp;</div>' );
    const radioButtons = jQuery( '.resource-topics .facetwp-facet.facetwp-type-radio, .blog-categories .facetwp-facet.facetwp-type-radio' );
    //const radioButtonsViewMore = jQuery( '.resource-topics .facetwp-view-more-button, .blog-categories .facetwp-view-more-button' );
    const radioButtonsViewMore = jQuery( '<div class="facetwp-view-more-button"></div>' ).hide();
    const radioButtonsPlaceholder = document.getElementById( 'facetwp-type-radio-placeholder' );
    const firstAndLastRadioButtons = radioButtons.children( ':first, :last' );
    const leftButton = jQuery( '<i class="fas fa-chevron-left"></i>' ).css( { visibility: 'hidden' } );
    const rightButton = jQuery( '<i class="fas fa-chevron-right"></i>' );
    let isMouseDown = false;
    let timeoutID = undefined;

    function resizeRadioButtons( e ) {
      let radioButtonsBorderOffset = 0;

      //radioButtonsContainer.css( { width: radioButtons.width() } );

      if ( radioButtons.width() >= radioButtonsContainer.width() ) {
        radioButtonsBorderOffset = 21;
        radioButtonsViewMore.show();
        radioButtons.css( { marginRight: 120 } );
      } else {
        radioButtons.css( { marginRight: 0 } );
        radioButtonsViewMore.hide();
      }

      let radioButtonsBorderWidth = ( sorter.offset().left - radioButtonsContainer.offset().left - 27 );

      if ( radioButtonsContainer.width() < radioButtonsBorderWidth ) { radioButtonsBorderWidth = radioButtonsContainer.width(); }

      radioButtonsContainer.css( { display: 'inline-block', maxWidth: ( sorter.offset().left - radioButtonsContainer.offset().left - 47 ) } );
      radioButtonsBorder.css( { width: ( radioButtonsContainer.width() + radioButtonsBorderOffset ) } );
    }

    function scrollRadioButtonsContainerTo( direction ) {
      if ( direction === 'left' ) {
        const scrollLeftValue = radioButtonsContainer.scrollLeft();

        if ( scrollLeftValue > 0 ) {
          radioButtonsContainer.scrollLeft( scrollLeftValue - 20 );
          rightButton.css( { visibility: 'visible' } );
        } else {
          leftButton.css( { visibility: 'hidden' } );
        }
      } else {
        const scrollLeftValue = radioButtonsContainer.scrollLeft();

        radioButtonsContainer.scrollLeft( scrollLeftValue + 20 );
        leftButton.css( { visibility: 'visible' } );
        if ( scrollLeftValue === radioButtonsContainer.scrollLeft() ) { rightButton.css( { visibility: 'hidden' } ); }
      }

      if ( isMouseDown ) {
        timeoutID = setTimeout( () => { scrollRadioButtonsContainerTo( direction ); }, 100 );
      }
    }

    leftButton.on( 'mousedown touchstart', ( e ) => { if ( !isMouseDown  ) { isMouseDown = true;scrollRadioButtonsContainerTo( 'left' ); } } );
    leftButton.on( 'mouseup touchend', ( e ) => { clearTimeout( timeoutID );isMouseDown = false; } );
    rightButton.on( 'mousedown touchstart', ( e ) => { if ( !isMouseDown  ) { isMouseDown = true;scrollRadioButtonsContainerTo( 'right' ); } } );
    rightButton.on( 'mouseup touchend', ( e ) => { clearTimeout( timeoutID );isMouseDown = false; } );
    radioButtonsContainer.on( 'scroll', ( e ) => {
      if ( radioButtonsContainer.scrollLeft() > 0 ) {
        leftButton.css( { visibility: 'visible' } );
      } else {
        leftButton.css( { visibility: 'hidden' } );
      }

      if ( radioButtonsContainer.scrollLeft() < ( radioButtonsContainer[ 0 ].scrollWidth - radioButtonsContainer[ 0 ].clientWidth ) ) {
        rightButton.css( { visibility: 'visible' } );
      } else {
        rightButton.css( { visibility: 'hidden' } );
      }
    } );

    setTimeout( () => {
      resizeRadioButtons();
    }, 10 );

    radioButtonsContainer.before( radioButtonsBorder );
    radioButtonsViewMore.append( leftButton ).append( '<span class="facetwp-view-more-button-text">View More</span>' ).append( rightButton );
    radioButtonsContainer.after( radioButtonsViewMore );

    let resizingTimeoutId;

    window.addEventListener( 'resize', ( e ) => {
      resizeRadioButtons( e );
      clearTimeout( resizingTimeoutId );
      resizingTimeoutId = setTimeout( () => { resizeRadioButtons( e ); }, 10 );
    } );

    setTimeout( () => { resizeRadioButtons(); }, 1 );
  }
  /* FOR THE FILTERS AND THE SORT ENDS HERE */

    jQuery('#searchModal').on('hidden.bs.modal', function (e) {
        var modal = e.target;
        modal.querySelector('form input').value = "";
    })

    jQuery('#searchModal').on('shown.bs.modal', function (e) {
        var modal = e.target;
        modal.querySelector('form input').focus();
    })

    jQuery('.leadership-details').on('click', '.close', function(e) {
        var leadershipContainer = jQuery('.leadership--container');
        leadershipContainer.removeClass('leadership--container--details-active')
    })

    jQuery('.leadership-details').on('show.bs.modal', function (e) {
        jQuery('body').css({ 'overflow-y': "auto"});
        jQuery('body').addClass('px-0')

        var currentModal = jQuery(this);
        var nextModal = currentModal.closest("div[id^='MyModal']").nextAll("div[id^='MyModal']").first();
        var prevModal = currentModal.closest("div[id^='MyModal']").prevAll("div[id^='MyModal']").first();
        var allPrev = currentModal.closest("div[id^='MyModal']").prevAll("div[id^='MyModal']").length
        var allNext = currentModal.closest("div[id^='MyModal']").nextAll("div[id^='MyModal']").length
        var leadershipContainer = jQuery('.leadership--container');

        
        if (allNext === 0) {
            currentModal.find('.btn-next').hide();
        }
        if (allPrev === 0) {
            currentModal.find('.btn-prev').hide();
        }

        //click next
        currentModal.find('.btn-next').click(function(){
            if (allNext !== 0) {
                leadershipContainer.addClass('leadership--container--details-active');
                currentModal.find('.btn-next').show();
                currentModal.modal('hide');
                nextModal.first().modal('show'); 
            } else {
                currentModal.find('.btn-next').hide();
            }
        });
        
        //click prev
        currentModal.find('.btn-prev').click(function(){
            if (allPrev !== 0) {
                leadershipContainer.addClass('leadership--container--details-active');
                currentModal.find('.btn-prev').show();
                currentModal.modal('hide');
                prevModal.first().modal('show'); 
            } else {
                currentModal.find('.btn-prev').hide();
            }
        });
          
    }).on('hide.bs.modal', function (e) {
        jQuery('body').removeClass("white-backdrop");
    })

    jQuery("#searchModal").click(function(e){
        if(e.target != this) return;
        jQuery('#searchModal').modal('hide');
    });
})