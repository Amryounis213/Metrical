<script>
    $(".owner").hide();
    $(".tenant").hide();
    $( "#type" ).change(function() {
      x = $("#type").val();
      
        if(x == 1)
        {
            $(".tenant").hide();
            $(".owner").show();
            
            
        }
        else if( x == 2)
        {
            $(".owner").hide();
            $(".tenant").show();
            
        }
        else{
            $(".owner").slideUp();
            $(".tenant").slideUp();
        }
     
    });
    </script>