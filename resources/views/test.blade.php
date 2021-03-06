
<!DOCTYPE html>
<html>
  <head>
    <title>GeoComplete</title>
    <meta charset="UTF-8">
  </head>
  <body>

    <form>
      <input id="geocomplete" type="text" placeholder="Type in an address" size="90" />
      <input id="find" type="button" value="find" />
    </form>
        
    <div id="examples">
      Examples:
      <a href="#">Hamburg, Germany</a>
      <a href="#">Juliusstraße 25, Germany</a>
      <a href="#">3rr0r</a>
      <a href="#">Hauptstraße</a>
    </div>
    
    <div class="map_canvas" style="width: 500px; height: 400px;"></div>
    
    <pre id="logger">Log:</pre>
    
    <script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

    <script src="/js/jquery.geocomplete.js"></script>
    <script src="/js/logger.js"></script>
     
    <script>
      $(function(){
        
        var options = {
          map: ".map_canvas"
        };
        
        $("#geocomplete").geocomplete(options)
          .bind("geocode:result", function(event, result){
            $.log("Result: " + result.formatted_address);
          })
          .bind("geocode:error", function(event, status){
            $.log("ERROR: " + status);
          })
          .bind("geocode:multiple", function(event, results){
            $.log("Multiple: " + results.length + " results found");
          });
        
        $("#find").click(function(){
          $("#geocomplete").trigger("geocode");
        });
        
        $("#examples a").click(function(){
          $("#geocomplete").val($(this).text()).trigger("geocode");
          return false;
        });
        
      });
    </script>

  </body>
</html>

