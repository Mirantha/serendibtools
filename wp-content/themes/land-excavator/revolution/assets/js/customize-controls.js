( function( api ) {

	// Extends our custom "land-excavator" section.
	api.sectionConstructor['land-excavator'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );