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

        }



    }

})(jQuery);