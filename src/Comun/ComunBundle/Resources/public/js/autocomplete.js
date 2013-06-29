/* 
 * Dependencias: jquery-ui autocomplete
 */

(function($){
    $(function(){  
        $('[data-autocomplete]').each(function(){
            $.initAutocomplete($(this).attr('id'));
        });
    });    

    $.initAutocomplete = function(id) 
    {
        var $autocompleteText = $('#'+id);
        eval('var config = '+$autocompleteText.attr('data-autocomplete')+';');                

        $autocompleteText.autocomplete({
            source: function(request,response){

                var parametrosEnviar = {term:request.term};                
                //me fijo si existen parametros configurados en el tag del campo autocompletar
                if($autocompleteText.attr('data-autocomplete-parametros')){
                    eval('var parametrosConfigurados = '+$autocompleteText.attr('data-autocomplete-parametros'))
                    $.extend(parametrosEnviar,parametrosConfigurados)                                                     
                }                
                
                $.getJSON( config.url, parametrosEnviar,function(items){
                    response(items);
                });      
            },
            minLength: config.min_length,
            select: function(e, ui) {
                $autocompleteText.attr('disabled','disabled');                
                $('#'+config.id_value+"-add-on").html(
                      '<a href="javascript:void(0)" title="Cambiar valor" data-hidden-id="'+config.id_value+'" data-text-id="'+$autocompleteText.attr('id')+'" ><i class="icon-remove"></i></a>'
                )
                $autocompleteText.val(ui.item[1]);
                $('#'+config.id_value).val(ui.item[0]);
                return false;
            }
        }).data('ui-autocomplete')._renderItem = function(ul, item) {
            return $('<li></li>')
                .data('item.autocomplete', item)
                .append('<a>' + item[1] + '</a>')
                .appendTo(ul);
        };        
    };
    
})(jQuery);


//para eliminar el valor seleccionado en el autocompletar
$('body').on('click','[data-text-id]',function(event){

    var $btn = $(this);
    var $autocomplete = $('#'+$btn.data('textId'));
    
    $('#'+$btn.data('hiddenId')).val('');
    $autocomplete.val('')
    $autocomplete.removeAttr('disabled')
    $btn.remove();    
})

//inicializo datos de autocomplete
$(document).ready(function(){
    $('[data-autocomplete]').each(function(i,elemento){
        
        var objetoText = $(elemento)
        var id = objetoText.attr('id');
        var objetoHidden = $('#'+id.substring(0,id.length-13));
        
        if(objetoHidden.val() == '' || objetoText == '') {
            objetoText.val('');
            objetoHidden.val('');
            objetoText.removeAttr('disabled');
        } else {            
            objetoText.attr('disabled','disabled');
            createBtnClean(objetoText.attr('id'),objetoHidden.attr('id'))
        }
       
        
    })
    
    function createBtnClean(idText,idHidden){
        $('#'+idHidden+"-add-on").html('<a href="javascript:void(0)" title="Cambiar valor" data-hidden-id="'+idHidden+'" data-text-id="'+idText+'" ><i class="icon-remove"></i></a>')
    }    
    
});

