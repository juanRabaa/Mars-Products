(function($){

    function getControlValueInput( $panel ){
        return $panel.find('[rb-control-value]');
    }

    function updateValue( $panel ){
        var $storesItems = $panel.find('.store-item');
        var $controlInput = getControlValueInput( $panel );
        var value = [];

        $storesItems.each(function(){
            var storeID = $(this).attr('data-id');
            var link = $(this).find('.store-link-input input').val();
            if( link ){
                value.push({
                    id: parseInt(storeID),
                    link: link,
                });
            }
        });
        console.log(value);
        $controlInput.val( JSON.stringify(value) ).trigger('change');
    }

    $(document).on('input', '.pedigree-stores-data .store-link-input input', function(){
        var $panel = $(this).closest('.pedigree-stores-data');
        updateValue($panel);
    });

})(jQuery);
