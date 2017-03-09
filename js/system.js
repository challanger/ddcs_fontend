(function(){
    "use strict"

    $(document).ready(function(){
        jQuery("header").on("click",".mobile-menu-toogle",function(){
            jQuery("#main-content").toggleClass("mobile-meue-active");
        });

        jQuery(".mobile-menu").on("click","ul a",function(){
            jQuery("#main-content").removeClass("mobile-meue-active");
        });
    }); 
})(); 