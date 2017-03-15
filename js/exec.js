(function(){
    'use strict'

    var Executive = function(_id,_name){
        this.id = _id;
        this.name = _name;   
    }

    Executive.prototype.WatchForm = function(){
        var _Form = new Form("exec-form");
        jQuery("#exec-form .submit-button").click(function(event){
            event.preventDefault(); 
            _Form.Submit(); 
        });
    }

    Executive.prototype.Contact = function(){
        $modal('<h4>Contact ' + this.name + '</h4>'
               +' <div class="form" id="exec-form">'
               +'     <form>'
               +'         <input type="hidden" name="team-member" value="' + this.id + '"\>'
               +'         <div class="form-field form-field-text">'
               +'             <label for="name">Name:</label>'
               +'             <input type="text" name="name" required=true />'
               +'         </div>'
               +'         <div class="form-field form-field-text">'
               +'             <label for="email">Email:</label>'
               +'             <input type="email" name="email" required=true />'
               +'         </div>'
               +'         <div class="form-field form-field-subject">'
               +'             <label for="subject">Subject:</label>'
               +'             <input type="text" name="subject" required=true />'
               +'         </div>'
               +'         <div class="form-field form-field-textarea">'
               +'             <label for="body">Body:</label>'
               +'             <textarea name="body" required=true></textarea>'
               +'         </div>'
               +'         <button class="button submit-button">Submit</buton>'
               +'     </form>'
               +' </div>'
            +'</div>');

            this.WatchForm();
    }

    window.Executive = Executive; 
})();