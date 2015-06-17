(function ( $ ) {

    $.fn.calendar = function( options ) {

        this.getCurrentMonth = function() {
            today = new Date();
            mm = today.getMonth()+1; //January is 0!
            yyyy = today.getFullYear();

            // if(mm<10) {
            //     mm='0'+mm
            // }

            return (yyyy*12)+ +mm;
        }

        console.log(this.getCurrentMonth());
        // This is the easiest way to have default options.
        this.settings = $.extend({
            // These are the defaults.
            color: "#556b2f",
            backgroundColor: "white"
        }, options );


        var myCalendar = this;

        // bind navigation
        this.find('a.navigate').click(function(e){
            e.preventDefault();

            if ( myCalendar.find($('.'+$(this).data('show'))).length ) {
                var show = myCalendar.find($('.'+$(this).data('show')));
                hide = myCalendar.find($('.'+$(this).data('hide')));

                hide.fadeOut(100,function(){
                    show.fadeIn(100);
                });
            }

        });

        return this.find('.'+this.getCurrentMonth()).show();
    };

}( jQuery ));