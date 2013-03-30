
  
    var cargarPrestacion = function () {

        $('.select2-choice > span').html('');
        $('[data-prestacion-btn="agregar"]').attr('disabled','disabled');
        if (typeof urlInternacionPrestacionGetAjax != "undefined"){
           
            var cos=$('[data-prestacion="con_os"]:checked').val();
            var tp=$('[data-prestacion="tipo_prestacion"]:checked').val();
            var url = urlInternacionPrestacionGetAjax ;
            var p = $('[data-prestacion="p"]').val() ;
           
            $('[data-prestacion]').attr('disabled','disabled');
            $('[data-prestacion="prestacion"]').html('');

            $.post(url,{cos:cos, tp:tp, p:p},function(datos){       

                 var option = '<option selected="selected" value=""></option>';
                 $.each(datos, function(id,prestacion){
                      option +=   '<option value="'+prestacion.id+'">'+prestacion.descripcion+'</option>'
                 });

                 $('[data-prestacion="prestacion"]').append(option);
                 $('[data-prestacion]').removeAttr('disabled');

             });
       }

    }
   

    $('[data-prestacion="con_os"]').change(function(){ 
        cargarPrestacion();
    });

    $('[data-prestacion="tipo_prestacion"]').change(function(){    
       cargarPrestacion();
    });
    
    $('[data-prestacion="prestacion"]').change(function(){    
       if($('[data-prestacion="prestacion"] option:selected').val() != '') {
           $('[data-prestacion-btn="agregar"]').removeAttr('disabled');
       }else{
           $('[data-prestacion-btn="agregar"]').attr('disabled','disabled')
       }
    });

    var nuevaPrestacion = function() {
        habilitarDeshabilitarInternacionPrestacionActo();
    }


    function habilitarDeshabilitarInternacionPrestacionActo() {
        
        $('[data-internacion-prestacion-acto="realizarActo"]').each(function(index,value){ 
            
            if ($('#'+this.id).is(':checked')){
                $('#'+this.id).parent().parent().parent().css('background','#DAFFD6');
            } else {
                $('#'+this.id).parent().parent().parent().css('background','#F9F9F9');
            }
        });
    } 

    $('[data-internacion-prestacion-acto="realizarActo"]').change(function(){
        habilitarDeshabilitarInternacionPrestacionActo();
    })
