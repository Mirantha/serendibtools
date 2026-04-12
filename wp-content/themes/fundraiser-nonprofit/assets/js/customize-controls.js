( function( api ) {

	// Extends our custom "fundraiser-nonprofit" section.
	api.sectionConstructor['fundraiser-nonprofit'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );