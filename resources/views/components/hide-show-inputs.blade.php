<script>
    $(".owner").hide();
    $(".tenant").hide();
    $("#comm").hide();
    $( "#type" ).change(function() {
      x = $("#type").val();
      
        if(x == 1)
        {
            $(".tenant").hide();
            $(".owner").show();
            $("#comm").show();
            $("#community")[0].selectedIndex = 0;
        }
        else if( x == 2)
        {
            $(".owner").hide();
            $(".tenant").show();
            $("#comm").show();
            $("#community")[0].selectedIndex = 0;
        }
        else{
            $(".owner").slideUp();
            $(".tenant").slideUp();
            $("#comm").hide();
        }
     
    });
    </script>