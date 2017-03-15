(function(){
    "use strict"

    $(document).ready(function(){
        jQuery("header").on("click",".mobile-menu-toogle",function(){
            jQuery("#main-content").toggleClass("mobile-meue-active");
        });

        jQuery(".mobile-menu").on("click","ul a",function(){
            jQuery("#main-content").removeClass("mobile-meue-active");
        });

        jQuery(".form").each(function(){
            var _Form = new Form(jQuery(this).attr("id"));
            jQuery(this).on("click",".submit-button",function(event){
                event.preventDefault(); 
                _Form.Submit(); 
            });
        });

        jQuery(".executive-list .item").each(function(){
            var execID = jQuery(this).data("execId");
            var EXEC = new Executive(execID);
            jQuery(this).on("click",".contact button",function(event){
                event.preventDefault(); 
                EXEC.Contact(); 
            });
        });

        jQuery(".gallery").each(function(){
            var folder = jQuery(this).data("folder");
            var GALLERY = new Gallery(folder);
            GALLERY.AddOn(this); 
        });

        jQuery(".galleries").on("click",".item",function(){
            var gallery = jQuery(this).data("gallery");
            window.location = window.rootPath + "gallery-" + gallery + "/";
        });
    }); 
})(); 