var dbug = {
    on:"true",
    log: function(log_this) {
        console.log(log_this);
    }
};

jQuery( document ).ready(function( $ ) {
  // Code using $ as usual goes here.

  

    $(document).on('ajaxBeforeSend', function(e, xhr, options){
        // This gets fired for every Ajax request performed on the page.
        // The xhr object and $.ajax() options are available for editing.
        // Return false to cancel this request.
       // console.log(xhr);
    });


    /* ---------------------------------------- */ 
    // Main Page Navigation Dropdown
    /* ---------------------------------------- */ 
	// get and display all song titles
    findAllSongs();
    selectSongFromDropdown();


    /* ---------------------------------------- */ 
    // Update data
    /* ---------------------------------------- */     
    addFragment();
    


});

var rootURL = "http://localhost:8888/dreamstatepoetry/";
var currentCar;


/* ------- Navigation -------  */
function selectSongFromDropdown() {
    $('.song-link').on('click', function() {
        var _song_id = $(this).data('song-id');
        console.log("select song from dropdown:" + _song_id);
        location.href =rootURL + "edit-song/" + _song_id;
    })
}

/* ------- Song Fragments - Descriptor Nav -------  */
function selectSongFragmentDescriptorNav() {
    //$('.descriptor-wrap')
}


/* ------- Songs RESTful functions ------- */

//------- Get all songs
function findAllSongs() {
	//console.log('finding all songs');
    $.ajax({
        type: 'GET',
        url: rootURL + 'songs',
        dataType: 'json',
        success: function(response){
            //dbug.log('Success: ', response);
            //return response;
            renderDropdownList(response);             
        },
        error: function(xhr, type){
           console.log(xhr, type);
        }
    });
}

//------- Render list of all songs
function renderDropdownList(data) {
    $('#songs-list li').remove();
    $.each(data, function(index, song) {
        $('#songs-list').append('<li class="song-link" data-song-id="' + song.id + '"><a class="song-link" data-song-id="' + song.id + '">' + song.title + '</a></li>');
    });
    selectSongFromDropdown();
}


//------- Get song by id
function findById(id) {
    console.log('findById:' + id);
    $.ajax({
        type: 'GET',
        url: rootURL + 'songs/' + id,
        dataType: 'json',
        success: function(data){
          //  $('#btnDelete').show();
            currentSong = eval(data);//JSON.parse(data);
            console.info(currentSong);
            renderDetails(currentSong);
        },
        error: function(xhr, type){
           console.log(xhr, type);
        }
    });
}

//------- Show song details
function renderDetails(song) {
    if($.isEmptyObject(song)){
        $('#song-id').val('');
        $('#song-title').val('');
    }else{
        $('#song-id').val(song.id);
        $('#song-title').val(song.year);

    }
}


/* -------------- Data Control --------------  */
//------- Add fragment
function addFragment() {
    var desc_id, fragment_txt;
    $('.add-fragment-input-form').on("change", function() {
        desc_id = $(this).data('descriptor-id');
        fragment_txt = $('#add-fragment-input-'+desc_id).val();
 
      //  console.log(desc_id +"     "+fragment_txt);  
    });    

    $('.add-fragment-input-form').on("submit", function(e) {
        e.preventDefault();
        desc_id = $(this).data('descriptor-id');
        fragment_txt = $('#add-fragment-input-'+desc_id).val();
        $.ajax({
            type: 'POST',
            url: rootURL + 'fragment',
            data : { "desc_id" : desc_id, "text" : fragment_txt },
            dataType: 'json',
            success: function(data){
              //  $('#btnDelete').show();
           //     currentSong = eval(data);//JSON.parse(data);
                console.info("complete "+data);
                //renderDetails(currentSong);
            },
            error: function(xhr, type){
               console.log(xhr, type);
            }
        }); 
        
    });    


    $('#add-fragment-button-'+desc_id).on("click", function(e) {
        e.preventDefault();
        console.log(desc_id +" "+fragment_txt);
         
    });

   
}
