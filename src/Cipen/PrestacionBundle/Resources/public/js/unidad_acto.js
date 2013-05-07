
function cargarUnidadesNomenclador() {
    
   var obraSocialId = $('[data-id="obraSocial"] option:selected').val();
   var url = urlGetUnidadesPorObraSocial;
   var nomenclador = $('[data-id="nomenclador"] option:selected').val();
   
   $('[data-id="unidadHonorario"] option').remove();
   $('[data-id="unidadGasto"] option').remove();

   if (obraSocialId != "" && nomenclador != "SIN_NOMENCLADOR") {
       
        $.post(url,{obraSocialId:obraSocialId},function(datos){       

            var option =   '<option value=""></option>'
            $.each(datos, function(id,unidad){
               option +=   '<option value="'+unidad.id+'">'+unidad.descripcion+'</option>'
            });
            
            $('[data-id="unidadHonorario"]').append(option);
            $('[data-id="unidadGasto"]').append(option);
            $('[data-id="control-group-unidad"]').show();

        });
        
    } else {
        $('[data-id="control-group-unidad"]').hide();
    }
    
}

$('[data-id="nomenclador"]').change(function(){ 
    cargarUnidadesNomenclador();
});

$('[data-id="obraSocial"]').change(function(){    
   cargarUnidadesNomenclador();
});
