
function cargarUnidadesNOmenclador() {
    
   var obraSocialId = $('[data-campo="obraSocial"] option:selected').val();
   var url = urlGetUnidadesPorObraSocial;
   var nomenclador = $('[data-campo="nomenclador"] option:selected').val();
   
   $('[data-group-unidades="unidades"]').remove();

   if (obraSocialId != "" && nomenclador != "SIN NOMENCLADOR") {
       
        $.post(url,{obraSocialId:obraSocialId},function(datos){       

            var option = '';
            var html = '';

            $.each(datos, function(id,unidad){
               option +=   '<option value="'+unidad.id+'">'+unidad.descripcion+'</option>'

            });

               html += '<div class="control-group" data-group-unidades="unidades">' +
                             '<label for="actounidad_cantidadEspecialista" class="control-label required">Unidad Honorario</label>' +
                             '<div class="controls">' +                        
                                 '<select class="span7" name="unidadHonorario" >' +
                                     option
               html +=  '         </select>' +           
                             '</div>' +
                       '</div>';


               html += '<div class="control-group" data-group-unidades="unidades">' +
                             '<label for="actounidad_cantidadEspecialista" class="control-label required">Unidad Gasto</label>' +
                             '<div class="controls">' +                        
                                 '<select class="span7" name="unidadGasto" >' +
                                     option
               html +=  '         </select>' +           
                             '</div>' +
                       '</div>';

               
              $(html).insertAfter('[data-campo-group="obraSocial"]');

        });
    }
    
}

$('[data-campo="nomenclador"]').change(function(){ 
    cargarUnidadesNOmenclador();
});

$('[data-campo="obraSocial"]').change(function(){    
   cargarUnidadesNOmenclador();
});
