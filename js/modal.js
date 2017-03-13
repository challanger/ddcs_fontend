(function(){
    'use strict';

    var Modal = function(_content){
        this.modal = null; 
    }

    Modal.prototype.closeOthers = function(){
        if(this.modal !== null)
            this.modal.close(); 
    }

    Modal.prototype.addModal = function(_message){
        if(jQuery("#revealModel").length < 1){
            jQuery("body").append('<div class="reveal" id="revealModel" data-reveal><div class="content">' + _message + '</div><button class="close-button" data-close aria-label="Close modal" type="button"><span aria-hidden="true">&times;</span></button></div>');
            this.modal = new Foundation.Reveal(jQuery("#revealModel")); 
            this.modal.open(); 
        }
        else 
        {
            jQuery("#revealModel > .content").html(_message); 
            this.modal.open(); 
        }
    }

    Modal.prototype.openModal = function(_message){
        this.closeOthers(); 
        this.addModal(_message);
    }

    var MODAL = new Modal(); 
    window.$modal = function(_content){
        MODAL.openModal(_content);
    }; 

    
})();