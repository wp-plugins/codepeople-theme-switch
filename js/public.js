jQuery( function ($){

	if( typeof codepeople_theme_switch != 'undefined' )
	{
		var width = $( document ).width();

		if( width < codepeople_theme_switch[ 'width' ] )
		{
			var selection = window.confirm( codepeople_theme_switch[ 'message' ] );
			if( selection )
			{
				var loc = document.location.href;
				loc += ( ( loc.indexOf( '?' ) == -1 ) ? '?' : '&' ) + 'theme_switch_width=' + width;
				document.location = loc;
			}
			else
			{
				var loc = codepeople_theme_switch[ 'url' ];
				loc += ( ( loc.indexOf( '?' ) == -1 ) ? '?' : '&' ) + 'theme_switch_denied=1';
				$( 'body' ).append( $( '<img style="width:1px;height:1px;display:none;" src="' + loc + '" />' ) );
			}
		}
		
	}
});