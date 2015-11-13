(function($) {
    
    $.skEasyAjax = function(element, options) {

        
        var defaults = {
            defaultAjaxTargetUrl :'',
            onStart: function(target) {},
            onComplete: function(target) {},
            onError: function(error) {},
            targetSelector:'.ajax_action'
        };


        skeaplugin = this;
        skeaplugin.callBackFunction = '';

        skeaplugin.settings = {}

        var $element = $(element),  
             element = element;

        skeaplugin.init = function() {
           
            skeaplugin.settings = $.extend({}, defaults, options);
            skEasyAjaxBinder();
        };
        
        skeaplugin.refresh = function()
        {
            ajaxUIRefresh();
        }

        
        var skEasyAjaxBinder = function() {
           
            $element.each(function(){

                if ($(this).prop('tagName') == 'FORM')
                {
                    $(this).bind('submit',skEasyAjaxHandler);
                
                }
                else
                {
                    $(this).bind('click',skEasyAjaxHandler);
                }
                 
                
            });
            
            
            
        };
        var ajaxUIRefresh = function() {
            $element = $(skeaplugin.settings.targetSelector);
            
            element = $element.get();
           console.log('unbind');
           console.log($element.length);
            $element.each(function(){
                
                $(this).unbind('click',skEasyAjaxHandler);
                $(this).unbind('submit',skEasyAjaxHandler);
                
            });
            
            skEasyAjaxBinder();
        };
        
        var skEasyAjaxHandler = function(e)
        {
            
            
            
            var currentElement = $(e.target);
            
            
            var params = currentElement.data('params');

            if (currentElement.attr('data-callBack') != undefined)
            {
                                
                skeaplugin.callBackFunction = currentElement.attr('data-callBack');
                
            }

            if (currentElement.data('url') != undefined)
            {
                var ajaxUrl = currentElement.data('url');
            }
            else
            {
                var ajaxUrl = skeaplugin.settings.defaultAjaxTargetUrl;
            }

            var ajaxData = {params:JSON.stringify(params)};
            
            if (currentElement.data('token') != undefined)
            {
                ajaxData.token = currentElement.data('token');
            }
            
            ajaxData.action= currentElement.data('action');
            
            if (currentElement.prop('tagName') == 'FORM')
            {
                e.preventDefault();
                ajaxData = currentElement.MytoJson();
                
            }
            
            skeaplugin.settings.onStart(currentElement);
    
            $.ajax
            ({
                url : ajaxUrl,
                type : "post",
                data : ajaxData,
                success : function(response)
                {
                    skeaplugin.settings.onComplete(currentElement);
                    skEasyAjaxOnSuccess(response);
                    

                },
                error : function(e)
                {
                    skeaplugin.settings.onComplete(currentElement);
                    skeaplugin.settings.onError(e);
                    
                   

                }

            });
        };
        
        
        var skEasyAjaxOnSuccess = function(json_params)
        {
            
            if (typeof(json_params) == 'object')
            {
                var params = json_params;
            }
            else 
            {
                var params = JSON.parse(json_params);
            }
            
            
            

            if (params.status ==0 )
            {
               skeaplugin.settings.onError(params);
            }
            
            
            
            if (typeof window[skeaplugin.callBackFunction] == 'function')
            {
                
                if (params.callBackParams)
                {
                    window[skeaplugin.callBackFunction](params.callBackParams);
                }
                else
                {
                    window[skeaplugin.callBackFunction]();
                }

            }
            else
            {
                $(window).trigger(skeaplugin.callBackFunction);
            }

            ajaxUIRefresh();
            
        };
        
        skeaplugin.init();

    };
    
    $.skEasyAjax.refresh = function()
    {
        skeaplugin.refresh();
    }

    
    $.fn.skEasyAjax = function(options) {

        
//        return this.each(function() {

            
            if (undefined == $(this).data('skEasyAjax')) {

               
                var skeaplugin = new $.skEasyAjax(this, options);

               
                $(this).data('skEasyAjax', skeaplugin);

            }

//        });

    };

})(jQuery);

jQuery.fn.MytoJson = function(options) {

    options = jQuery.extend({}, options);

    var self = this,
        json = {},
        push_counters = {},
        patterns = {
            "validate": /^[a-zA-Z][a-zA-Z0-9_]*(?:\[(?:\d*|[a-zA-Z0-9_]+)\])*$/,
            "key":      /[a-zA-Z0-9_]+|(?=\[\])/g,
            "push":     /^$/,
            "fixed":    /^\d+$/,
            "named":    /^[a-zA-Z0-9_]+$/
        };


    this.build = function(base, key, value){
        base[key] = value;
        return base;
    };

    this.push_counter = function(key){
        if(push_counters[key] === undefined){
            push_counters[key] = 0;
        }
        return push_counters[key]++;
    };
    
    var inputs = jQuery(this).serializeArray();

    jQuery(this).find('input[type=checkbox]').each(
                    function() {
                        if ($(this).attr('checked') == 'checked')
                        {
                            var checkbox = $(this);
                            var present = false;
                            $(inputs).each
                            (
                                function()
                                {
                                    if (this.name == checkbox.attr('name') && this.value == checkbox.val())
                                    {
                                        present = true;
                                        return;
                                    }
                                });
                            if (!present)
                            {
                                inputs.push({'name':$(this).attr('name'),'value':$(this).val()});
                            }
                            

                        }
                        
                    });
                    
   
    jQuery.each(inputs, function(){


        var k,
            keys = this.name.match(patterns.key),
            merge = this.value,
            reverse_key = this.name;

        while((k = keys.pop()) !== undefined){

            // adjust reverse_key
            reverse_key = reverse_key.replace(new RegExp("\\[" + k + "\\]$"), '');

            // push
            if(k.match(patterns.push)){
                merge = self.build([], self.push_counter(reverse_key), merge);
            }

            // fixed
            else if(k.match(patterns.fixed)){
                merge = self.build([], k, merge);
            }

            // named
            else if(k.match(patterns.named)){
                merge = self.build({}, k, merge);
            }
        }


        json = jQuery.extend(true, json, merge);
    });


    return json;
}

jQuery.fn.serializeObject = function()
{
   var o = {};
   var a = this.serializeArray();
   jQuery.each(a, function() {
       if (o[this.name]) {
           if (!o[this.name].push) {
               o[this.name] = [o[this.name]];
           }
           o[this.name].push(this.value || '');
       } else {
           o[this.name] = this.value || '';
       }
   });
   return o;
};