(function($){
    
    $.initFormCollection = function(collectionName)
    {
        var $collection = $('[data-collection="'+collectionName+'"]');

        $('[data-collection-add="'+collectionName+'"]').on('click', function(e) {
            var prototype = $collection.attr('data-prototype');
            var newForm = prototype.replace(/__name__/g, $collection.children().length);
            $collection.append(newForm);
            e.preventDefault();
          
            //inicio los autocomplete de la collection que se crean dinámicamente
            $('[data-autocomplete]').each(function(){
                $.initAutocomplete($(this).attr('id'));
            });
          
        });

        $(document).on('click', '[data-collection-del="'+collectionName+'"]', function(e) {
            var $this = $(this);
            $this.parents($this.attr('data-collection-parent-to-remove')).remove();
            e.preventDefault();
        });
                
    };
    
})(jQuery);