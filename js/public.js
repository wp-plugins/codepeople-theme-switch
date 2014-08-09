jQuery( function ($){

	if( typeof codepeople_theme_switch != 'undefined' )
	{
        function getWidth()
        {
            var myWidth = 0;
            if( typeof( window.innerWidth ) == 'number' ) {
                //Non-IE
                myWidth = window.innerWidth;
            } else if( document.documentElement && document.documentElement.clientWidth ) {
                //IE 6+ in 'standards compliant mode'
                myWidth = document.documentElement.clientWidth;
            } else if( document.body && document.body.clientWidth ) {
                //IE 4 compatible
                myWidth = document.body.clientWidth;
            }
            
            return ( typeof screen != 'undefined' ) ? Math.min( screen.width, myWidth ) : myWidth;
        };
        
		var width = getWidth();
		
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