// Create a single IEEF-based global module for this script
ammoniteDynamicSlides = function() {
  // LOCALIZED DATA
  let localizedData = ammoniteDynamicSlidesLocalizedData;

  // SCRIPT SETTINGS
  let settings = {
    opacityTransitionDuration: 1500,
    heightTransitionDuration: 1500
  }

  // ASSOCIATED CLASSES
  let classes = {
    outerContainer: 'ammonite-dynamic-slides-outer-container',
    innerContainer: 'ammonite-dynimic-slides-inner-container',
    loadingContainer: 'ammonite-dynamic-slides-loading-spinner-container'
  }

  // EVENT LISTENERS
  // Outer container loaded
  jQuery( document ).ready( function() {
    let loadInterval = setInterval( function() {
      if ( jQuery( '.' + classes.outerContainer ).length !== 0 ) {
        clearInterval( loadInterval );
        loadNewSlide( localizedData.initialSlideId );
      }
    }, 500 );
  } );

  // SCRIPT METHODS
  function loadNewSlide( slideId ) {
    // INITIAL AJAX
      // Get slide and call success or failure
      let newSlideUrl = localizedData.ajaxUrl + slideId;
      jQuery.ajax( {
        type: 'get',
        dataType: 'json',
        url: newSlideUrl,
        success: function( response ) {
          handleAjaxSuccess( response );
        }
      } );

    // AJAX HANDLERS
      // Handle AJAX success
      function handleAjaxSuccess( response ) {
        // Set inner container's HTML
        jQuery( '.' + classes.innerContainer ).html( response );

        // Bring in new slide
        bringInNewSlide();
      }

      // Handle AJAX failure
      function handleAjaxFailure() {

      }

    // ANIMATION MAIN FUNTIONS
      // Bring in loading animation immediately (this function is invoked immediately)
      (function bringInLoadingAnimation() {
        jQuery( '.' + classes.outerContainer ).queue( fadeOutSlide );
        jQuery( '.' + classes.outerContainer ).queue( fadeInLoadingAnimation );
      })();

      // Bring in a new slide
      function bringInNewSlide() {
        console.log( 'bringInNewSlide ran' );
        resizeOuterContainer();
        jQuery( '.' + classes.outerContainer ).queue( fadeOutLoadingAnimation );
        jQuery( '.' + classes.outerContainer ).queue( fadeInSlide );
      }

    // ANIMATION HELPER FUNCTIONS
      // Fade out slide
      function fadeOutSlide( next ) {
        jQuery( '.' + classes.innerContainer ).animate( {
          opacity: 0
        }, settings.opacityTransitionDuration / 2, next );
      }

      // Fade in loading animation
      function fadeInLoadingAnimation( next ) {
        jQuery( '.' + classes.loadingContainer ).animate( {
          opacity: 1
        }, settings.opacityTransitionDuration / 2, next );
      }

      // Resize outer container
      function resizeOuterContainer( next ) {
        // Get slide height
        let innerContainerHeight = jQuery( '.' + classes.innerContainer ).outerHeight();

        // Animate outer container height
        jQuery( '.' + classes.outerContainer ).animate( {
          'height': innerContainerHeight + 'px'
        }, settings.heightTransitionDuration, next );

        // Animate loading animation container height alongside outer container
        jQuery( '.' + classes.loadingContainer ).animate( {
          'height': innerContainerHeight + 'px'
        }, settings.heightTransitionDuration );
      }

      // Fade out loading animation
      function fadeOutLoadingAnimation( next ) {
        jQuery( '.' + classes.loadingContainer ).animate( {
          opacity: 0
        }, settings.opacityTransitionDuration / 2, next );
      }

      // Fade in slide
      function fadeInSlide( next ) {
        jQuery( '.' + classes.innerContainer ).animate( {
          opacity: 1
        }, settings.opacityTransitionDuration / 2, next );
      }
  }
  
}();
