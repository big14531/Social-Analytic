function getAbsolutePath() {
    return $(location).attr('href');
}

function navtab_active() 
{   
    var url = getAbsolutePath();
    var split_url =  url.split( '/' );
    if( split_url.indexOf("facebook") !== -1 )
    {
        $( "#facebook-tab" ).addClass( 'active' );
    }
    if( split_url.indexOf("twitter") !== -1 )
    {
        $( "#twitter-tab" ).addClass( 'active' );
    }
    if( split_url.indexOf("instagram") !== -1 )
    {
        $( "#instagram-tab" ).addClass( 'active' );
    }
}

navtab_active();