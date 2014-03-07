(function($) {

    window.Task = {

        Message: {

            options: {
                delay: 5000
            },

            showMessages: function(block){

                var block = $(block);

                block.removeClass('hide');

                setTimeout(function(){
                    block.addClass('hide');
                }, Task.Message.options.delay);
            }
        },

        Form: {
            initFormStyler: function(){
                $('input, select').styler();
            },

            setFilePath: function(path, id){
                $('#'+id+'-styler .jq-'+id+'__name').html(path);
            }
        }
    }


})(jQuery);