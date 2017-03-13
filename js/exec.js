(function(){
    'use strict'

    var Executive = function(_id){
        this.id = _id; 
    }

    Executive.prototype.Contact = function(){
        $modal("TODO: open contact form for Exec member.");
    }

    window.Executive = Executive; 
})();