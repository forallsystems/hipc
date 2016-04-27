jQuery(document).ready(function($) {

	var sortList = $( 'ul#custom-type-list' );
	var animation = $( '#loading-animation' );
	var pageTitle = $ ( 'div h2' );

	sortList.sortable({

		update: function( event, ui ) {
			animation.show();

			$.ajax({
				url: ajaxurl,
				type: 'POST',
				dataType: 'json',
				data: {
					action: 'save_sort',
					order: sortList.sortable( 'toArray' ),
					security: HIPC_EVENT_LISTING.security
				}, 
				success: function( response ) {
					$( 'div#message' ).remove();
					animation.hide();
					if( true === response.success) {
						pageTitle.after( '<div id="message" class="updated"><p>' + HIPC_EVENT_LISTING.sucess + '</p></div>' );
					} else {
						pageTitle.after( '<div id="message" class="error"><p>'+ HIPC_EVENT_LISTING.failure + '</p></div>' );
					}
					
				},
				error: function (  error  ) {
					$( 'div#message' ).remove();
					animation.hide();
					
				}
			});
		}

	});
});

/* To be added to main plugin page to properly load this script
	if (  $pagenow == 'edit.php' && $typenow == 'events') {
		wp_enqueue_script( 'reorder-js', plugins_url( 'js/reorder.js', __FILE__ ), array( 'jquery', 'jquery-ui-sortable' ), '20160216', true);
		wp_localize_script( 'reorder-js', 'HIPC_EVENT_LISTING', array(
			'security' 	=> wp_create_nonce( 'hipc-event-order' ),
			'sucess'	=> 'Events sort order has been saved.',
			'failure'	=> 'There was an error saving the sort order, or you do not have the proper permissions.'
			) );
	}*/