$(function(){
    
    $('.api-selector select').change(function(){
        $.ajax({
            method: "POST",
            url: $('.api-selector').data('change-url'),
            data: {api_key_id: $(this).val()}
        }).done(function(response) {
            //console.debug( "done", response );
            location.reload();
        })
        .fail(function(response) {
            console.debug( "error", response );
        }); 
        
    });
    
});

