(function(){
    "use strict"

    function Form(_formID,_action){
        this.formID = _formID;
        if(typeof(_action) === "undefined")
            this.action = "submit";
        else 
            this.action = _action;

        this.form = jQuery("#" + this.formID); 
    };

    Form.prototype.Check = function(){
        var valid = true; 
        
        this.SetSubmitText("Checking...");
        this.ClearWarnings(); 
        var FormThis = this; 

        this.form.find("input,textarea").each(function(key,item){
            if(jQuery(this).prop("required") == true)
            {
                var value = jQuery(this).val(); 
                if(value === ""){
                    FormThis.SetInputWarning(this); 
                    FormThis.SetWarningMessage(this,"*This field is required"); 
                    valid = false; 
                }
                else if((jQuery(this).attr("type") === "email") && (FormThis.ValidateEmail(value) === false))
                {
                    FormThis.SetInputWarning(this); 
                    FormThis.SetWarningMessage(this,"*This must be a valid email address"); 
                    valid = false; 
                }
            }
        });

        this.SetSubmitText("Submit");

        return valid; 
    }

    Form.prototype.ClearForm = function() {
        jQuery(this.form).find("input,textarea").val("");
    }

    Form.prototype.ClearWarnings = function() {
        jQuery(this.form).find(".input-warning").removeClass("input-warning"); 
        jQuery(this.form).find(".input-warning-text").remove(); 
    }

    Form.prototype.GetValues = function(){
        var values = {};
        jQuery(this.form).find("input,textarea").each(function(key,field){
            var fieldName = jQuery(this).attr("name");
            values[fieldName] = jQuery(this).val(); 
        });
        return values; 
    }

    Form.prototype.SetInputWarning = function(_input) {
        jQuery(_input).parents(".form-field").addClass("input-warning"); 
    }

    Form.prototype.SetSubmitText = function(_text){
        jQuery(this).find(".submit-button").html(_text); 
    }

    Form.prototype.Send = function(_values){
        this.SetSubmitText("Submittings...");
        var FormThis = this; 
        jQuery.post(window.rootPath+'process/form?action=' + this.action + '&form=' + this.formID,_values)
            .done(function(response){
                try {
                    var json = JSON.parse(response); 
                    if((typeof(json.status) === "string") && (json.status === "OK"))
                    {
                        $modal(json.message);
                        FormThis.SetSubmitText("Submit");
                        FormThis.ClearForm(); 
                    }
                    else
                    {
                        console.log(response);
                        $modal("Error: The server returned an invalid response please try again later.");
                        FormThis.SetSubmitText("Submit");
                    }
                } catch(error) {
                    console.log(response);
                    $modal("Error: Failed to parse the server response, please try again later.");
                    FormThis.SetSubmitText("Submit");
                }
            })
            .fail(function(){
                $modal("Error: failed to submit the forms.");
                FormThis.SetSubmitText("Submit");
            });
    }

    Form.prototype.SetWarningMessage = function(_input,_message){
        jQuery(_input).parents(".form-field").append("<div class='input-warning-text'>" + _message + "</div>");
    }

    Form.prototype.Submit = function(){
        if(this.Check()){
            var values = this.GetValues(); 
            this.Send(values);
        }

        return false; 
    }

    Form.prototype.ValidateEmail = function(_value) {
        var pattern = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i; 
        return pattern.test(_value);
    }

    window.Form = Form; 

})(); 