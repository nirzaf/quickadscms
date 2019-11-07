var $ = jQuery.noConflict();
window.jQuery = $;


/* bootstrap-select */
$.components.register("selectpicker",{mode:"default",defaults:{style:"btn-select",iconBase:"icon",tickIcon:"md-check"}});

/* scrollable */
$.components.register("scrollable",{mode:"init",defaults:{namespace:"scrollable",contentSelector:"> [data-role='content']",containerSelector:"> [data-role='container']"},init:function(context){if($.fn.asScrollable){var defaults=$.components.getDefaults("scrollable");$('[data-plugin="scrollable"]',context).each(function(){var options=$.extend({},defaults,$(this).data());$(this).asScrollable(options)})}}});

/* animsition */
$.components.register("animsition",{mode:"manual",defaults:{inClass:"fade-in",outClass:"fade-out",inDuration:800,outDuration:500,linkElement:".animsition-link",loading:!0,loadingParentElement:"body",loadingClass:"loader",loadingType:"default",timeout:!1,timeoutCountdown:5e3,onLoadEvent:!0,browser:["animation-duration","-webkit-animation-duration"],overlay:!1,overlayClass:"animsition-overlay-slide",overlayParentElement:"body",inDefaults:["fade-in","fade-in-up-sm","fade-in-up","fade-in-up-lg","fade-in-down-sm","fade-in-down","fade-in-down-lg","fade-in-left-sm","fade-in-left","fade-in-left-lg","fade-in-right-sm","fade-in-right","fade-in-right-lg","zoom-in-sm","zoom-in","zoom-in-lg"],outDefaults:["fade-out","fade-out-up-sm","fade-out-up","fade-out-up-lg","fade-out-down-sm","fade-out-down","fade-out-down-lg","fade-out-left-sm","fade-out-left","fade-out-left-lg","fade-out-right-sm","fade-out-right","fade-out-right-lg","zoom-out-sm","zoom-out","zoom-out-lg"]},init:function(context,callback){var options=$.components.getDefaults("animsition");if(options.random){var li=options.inDefaults.length,lo=options.outDefaults.length,ni=parseInt(li*Math.random(),0),no=parseInt(lo*Math.random(),0);options.inClass=options.inDefaults[ni],options.outClass=options.outDefaults[no]}var $this=$(".animsition",context);return $this.animsition(options),$("."+options.loadingClass).addClass("loader-"+options.loadingType),$this.animsition("supportCheck",options)?($.isFunction(callback)&&$this.one("animsition.end",function(){callback.call()}),!0):($.isFunction(callback)&&callback.call(),!1)}});

/* sidepanel */
$.components.register("slidePanel", {
    mode: "manual",
    defaults: {
        closeSelector: ".slidePanel-close",
        mouseDragHandler: ".slidePanel-handler",
        loading: {
            template: function (options) {
                return '<div class="' + options.classes.loading + '"><div class="cssload-speeding-wheel"></div></div>'
            }, showCallback: function (options) {
                this.$el.addClass(options.classes.loading + "-show")
            }, hideCallback: function (options) {
                this.$el.removeClass(options.classes.loading + "-show")
            }
        }
    }
});


/* paginator */
$.components.register("paginator",{mode:"init",defaults:{namespace:"pagination",currentPage:1,itemsPerPage:10,disabledClass:"disabled",activeClass:"active",visibleNum:{0:3,480:5},tpl:function(){return"{{prev}}{{lists}}{{next}}"},components:{prev:{tpl:function(){return'<li class="'+this.namespace+'-prev"><a href="#"><span class="icon md-chevron-left"></span></a></li>'}},next:{tpl:function(){return'<li class="'+this.namespace+'-next"><a href="#"><span class="icon md-chevron-right"></span></a></li>'}},lists:{tpl:function(){var lists="",remainder=this.currentPage>=this.visible?this.currentPage%this.visible:this.currentPage;remainder=0===remainder?this.visible:remainder;for(var k=1;remainder>k;k++)lists+='<li class="'+this.namespace+'-items" data-value="'+(this.currentPage-remainder+k)+'"><a href="#">'+(this.currentPage-remainder+k)+"</a></li>";lists+='<li class="'+this.namespace+"-items "+this.classes.active+'" data-value="'+this.currentPage+'"><a href="#">'+this.currentPage+"</a></li>";for(var i=this.currentPage+1,limit=i+this.visible-remainder-1>this.totalPages?this.totalPages:i+this.visible-remainder-1;limit>=i;i++)lists+='<li class="'+this.namespace+'-items" data-value="'+i+'"><a href="#">'+i+"</a></li>";return lists}}}},init:function(context){if($.fn.asPaginator){var defaults=$.components.getDefaults("paginator");$('[data-plugin="paginator"]',context).each(function(){var $this=$(this),options=$this.data(),total=$this.data("total");options=$.extend({},defaults,options),$this.asPaginator(total,options)})}}});

/* animate-list */
$.components.register("animate-list",{mode:"init",defaults:{child:".panel",duration:250,delay:50,animate:"scale-up",fill:"backwards"},init:function(){var self=this;$("[data-plugin=animateList]").each(function(){var $this=$(this),options=$.extend({},self.defaults,$this.data(),!0),animatedBox=function($el,opts){this.options=opts,this.$children=$el.find(opts.child),this.$children.addClass("animation-"+opts.animate),this.$children.css("animation-fill-mode",opts.fill),this.$children.css("animation-duration",opts.duration+"ms");var delay=0,self=this;this.$children.each(function(){$(this).css("animation-delay",delay+"ms"),delay+=self.options.delay})};animatedBox.prototype={run:function(type){var self=this;this.$children.removeClass("animation-"+this.options.animate),"undefined"!=typeof type&&(this.options.animate=type),setTimeout(function(){self.$children.addClass("animation-"+self.options.animate)},0)}},$this.data("animateList",new animatedBox($this,options))})}});

/* jquery-placeholder */
$.components.register("placeholder",{mode:"init",init:function(context){$.fn.placeholder&&$("input, textarea",context).placeholder()}});

/* material */
$.components.register("material",{init:function(context){$(".form-material",context).each(function(){var $this=$(this);if($this.data("material")!==!0){var $control=$this.find(".form-control");if($control.attr("data-hint")&&$control.after("<div class=hint>"+$control.attr("data-hint")+"</div>"),$this.hasClass("floating")){if($control.hasClass("floating-label")){var placeholder=$control.attr("placeholder");$control.attr("placeholder",null).removeClass("floating-label"),$control.after("<div class=floating-label>"+placeholder+"</div>")}(null===$control.val()||"undefined"==$control.val()||""===$control.val())&&$control.addClass("empty")}$control.next().is("[type=file]")&&$this.addClass("form-material-file"),$this.data("material",!0)}})},api:function(){function _isChar(e){return"undefined"==typeof e.which?!0:"number"==typeof e.which&&e.which>0?!e.ctrlKey&&!e.metaKey&&!e.altKey&&8!=e.which&&9!=e.which:!1}$(document).on("keydown.site.material paste.site.material",".form-control",function(e){_isChar(e)&&$(this).removeClass("empty")}).on("keyup.site.material change.site.material",".form-control",function(){var $this=$(this);""===$this.val()&&"undefined"!=typeof $this[0].checkValidity&&$this[0].checkValidity()?$this.addClass("empty"):$this.removeClass("empty")}).on("focus",".form-material-file",function(){$(this).find("input").addClass("focus")}).on("blur",".form-material-file",function(){$(this).find("input").removeClass("focus")}).on("change",".form-material-file [type=file]",function(){var value="";$.each($(this)[0].files,function(i,file){value+=file.name+", "}),value=value.substring(0,value.length-2),value?$(this).prev().removeClass("empty"):$(this).prev().addClass("empty"),$(this).prev().val(value)})}});

/* selectable */
$.components.register("selectable",{mode:"init",defaults:{allSelector:".selectable-all",itemSelector:".selectable-item",rowSelector:"tr",rowSelectable:!1,rowActiveClass:"active",onChange:null},init:function(context){if($.fn.asSelectable){var defaults=$.components.getDefaults("selectable");$('[data-plugin="selectable"], [data-selectable="selectable"]',context).each(function(){var options=$.extend({},defaults,$(this).data());$(this).asSelectable(options)})}}});

/* bootbox */
$.components.register("bootbox",{mode:"api",defaults:{message:""},api:function(){if("undefined"!=typeof bootbox){var defaults=$.components.getDefaults("bootbox");$(document).on("click.site.bootbox",'[data-plugin="bootbox"]',function(){var $btn=$(this),options=$btn.data();if(options=$.extend(!0,{},defaults,options),options.classname&&(options.className=options.classname),"string"==typeof options.callback&&$.isFunction(window[options.callback])&&(options.callback=window[options.callback]),options.type)switch(options.type){case"alert":bootbox.alert(options);break;case"confirm":bootbox.confirm(options);break;case"prompt":bootbox.prompt(options);break;default:bootbox.dialog(options)}else bootbox.dialog(options)})}}});


/* datatable */
$.components.register("dataTable", {
    defaults: {
        responsive: !0,
        language: {
            sSearchPlaceholder: "Search..",
            lengthMenu: "_MENU_",
            search: "_INPUT_",
            paginate: {previous: '<i class="icon md-chevron-left"></i>', next: '<i class="icon md-chevron-right"></i>'}
        }
    }, api: function () {
        $.fn.dataTable && $.fn.dataTable.TableTools && $.extend(!0, $.fn.dataTable.TableTools.classes, {
            container: "DTTT btn-group pull-left",
            buttons: {normal: "btn btn-default btn-flat", disabled: "disabled"},
            print: {body: "site-print DTTT_Print"}
        })
    }, init: function (context) {
        if ($.fn.dataTable) {
            var defaults = $.components.getDefaults("dataTable");
            $('[data-plugin="dataTable"]', context).each(function () {
                var options = $.extend(!0, {}, defaults, $(this).data());
                $(this).dataTable(options)
            })
        }
    }
});

/* Alertify */
$.components.register("alertify",{mode:"api",defaults:{type:"alert",delay:5e3,theme:"bootstrap"},api:function(){if("undefined"!=typeof alertify){var defaults=$.components.getDefaults("alertify");$(document).on("click.site.alertify",'[data-plugin="alertify"]',function(){var $this=$(this),options=$.extend(!0,{},defaults,$this.data());switch(options.labelOk&&(options.okBtn=options.labelOk),options.labelCancel&&(options.cancelBtn=options.labelCancel),"undefined"!=typeof options.delay&&alertify.delay(options.delay),"undefined"!=typeof options.theme&&alertify.theme(options.theme),"undefined"!=typeof options.cancelBtn&&alertify.cancelBtn(options.cancelBtn),"undefined"!=typeof options.okBtn&&alertify.okBtn(options.okBtn),"undefined"!=typeof options.placeholder&&alertify.delay(options.placeholder),"undefined"!=typeof options.defaultValue&&alertify.delay(options.defaultValue),"undefined"!=typeof options.maxLogItems&&alertify.delay(options.maxLogItems),"undefined"!=typeof options.closeLogOnClick&&alertify.delay(options.closeLogOnClick),options.type){case"alert":alertify.alert(options.alertMessage);break;case"confirm":alertify.confirm(options.confirmTitle,function(){alertify.success(options.successMessage)},function(){alertify.error(options.errorMessage)});break;case"prompt":alertify.prompt(options.promptTitle,function(str,ev){var message=options.successMessage.replace("%s",str);alertify.success(message)},function(ev){alertify.error(options.errorMessage)});break;case"log":alertify.log(options.logMessage);break;case"success":alertify.success(options.successMessage);break;case"error":alertify.error(options.errorMessage)}})}}});