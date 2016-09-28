var track_page      = 1; //track user scroll as page number, right now page number is 1
var loading         = false; //prevents multiple loads

load_contents(track_page); //initial content load

$(window).scroll(function() { //detect page scroll
    if($(window).scrollTop() + $(window).height() >= $(document).height()) { //if user scrolled to bottom of the page
        
        setTimeout(function(){
            track_page++; //page number increment
            load_contents(track_page); //load content  
            // console.log(track_page);
        }, 500);

    }
});    
//Ajax load function
function load_contents(track_page){
    if(loading == false){
        loading = true;  //set loading flag on
        $('.loading-info').show(); //show loading animation
        $.post( 'load.php', {'page': track_page}, function(data){
            loading = false; //set loading flag off once the content is loaded
            if(data.trim().length == 0){
                //notify user if nothing to load
                $('.loading-info').html("No more records!");
                return;
            }
            $('.loading-info').hide(); //hide loading animation once data is received
            $("#results").append(data).hide().fadeIn('slow'); //append data into #results element
            // $(".pagination").append('<li><a href="#load_' + track_page + '">' + track_page + '</a></li>');

       
        }).fail(function(xhr, ajaxOptions, thrownError) { //any errors?
            alert(thrownError); //alert with HTTP error
        })
    }
}