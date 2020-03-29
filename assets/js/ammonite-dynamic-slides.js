// Create a single IEEF-based global module for this script
ammoniteDynamicSlides = function() {
  // LOCALIZED DATA
  let localizedData = ammoniteDynamicSlidesLocalizedData;

  // SCRIPT SETTINGS
  let settings = {

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
    let newSlideUrl = localizedData.ajaxUrl + slideId;

    // Get slide
    jQuery.ajax( {
      type: 'get',
      dataType: 'json',
      url: newSlideUrl,
      success: function( response ) {
        handleAjaxSuccess( response );
      }
    } );

    // Handle AJAX success
    function handleAjaxSuccess( response ) {
      console.log( response );
    }

    // Handle AJAX failure
    function handleAjaxFailure() {

    }
  }
}();


// jQuery( document ).ready( function() {
//   jQuery( 'button' ).click( function() {
//     jQuery.ajax( {
//       type: 'get',
//       dataType: 'json',
//       url: 'http://localhost/creatinghealth/wp-json/ammonite-dynamic-slides/v1/slides/2104',
//       success: function( response ) {
//         jQuery( '.ammonite-dynimic-slides-inner-container' ).html( response );
//       }
//     } );
//   } );
// } );
