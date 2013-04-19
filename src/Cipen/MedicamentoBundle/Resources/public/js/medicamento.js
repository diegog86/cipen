
  
var isCatastro = function () {
          
            if ($('[data-id="catastro"] option:selected').val() == 0) {
                $('[data-id="kairo"]').val(0)
                $('[data-id="kairo-group"]').hide();
            } else {
                $('[data-id="kairo-group"]').show();
            }
            
       

}

$('[data-id="catastro"]').change(function() {
   isCatastro(); 
});