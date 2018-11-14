$(document).ready(function(){
    function changeContent($table, content){
        var $contentElement = $table.find('.content').first();
        $contentElement.addClass('animating');
        $contentElement.html(content);
        setTimeout(function(){
            $contentElement.removeClass('animating');
        }, 1);
    }

    function activateTab($tab){
        var $table = $tab.closest('.product-table');
        if( !$tab.hasClass('active') ){
            $table.find('.trigger').removeClass('active');
            $tab.addClass('active');
            changeContent( $table, $tab.attr('data-content') );
        }
    }

    $(document).on('click', '.pedigree-product .product-table .trigger', function(){
        activateTab($(this));
    });
});
