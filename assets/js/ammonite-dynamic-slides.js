jQuery( document ).ready( function() {
  jQuery( 'button' ).click( function() {
    jQuery.ajax( {
      type: 'get',
      dataType: 'json',
      url: 'http://localhost/creatinghealth/wp-json/ammonite-dynamic-slides/v1/slides/2104',
      success: function( response ) {
        jQuery( '.ammonite-dynimic-slides-inner-container' ).html( response );
      }
    } );
  } );
} );
