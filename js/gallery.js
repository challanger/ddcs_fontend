(function(){
    'use strict'

    var Gallery = function(_folder){
        this.folder = _folder; 
    }

    Gallery.prototype.AddOn = function(_gallery) {
        var ThisGallery = this; 
        jQuery(_gallery).on("click",".item",function(){
            ThisGallery.OpenPreview(this); 
        });
    }

    Gallery.prototype.OpenPreview = function(_item){
        var image = jQuery(_item).data("image"); 
        $modal("<div class='gallery-preview'><img src='" + image + "'></div>");
    }

    window.Gallery = Gallery; 
})();