(function($){$.fn.lightbox_me=function(options){return this.each(function(){var opts=$.extend({},$.fn.lightbox_me.defaults,options),$overlay=$(),$self=$(this),$iframe=$('<iframe id="foo" style="z-index: '+(opts.zIndex+1)+';border: none; margin: 0; padding: 0; position: absolute; width: 100%; height: 100%; top: 0; left: 0; filter: mask();"/>'),ie6=$.browser.msie&&$.browser.version<7;if(opts.showOverlay){var $currentOverlays=$(".js_lb_overlay:visible");if($currentOverlays.length>0)$overlay=$('<div class="lb_overlay_clear js_lb_overlay"/>');
else $overlay=$('<div class="'+opts.classPrefix+'_overlay js_lb_overlay"/>')}if(ie6){var src=/^https/i.test(window.location.href||"")?"javascript:false":"about:blank";$iframe.attr("src",src);$("body").append($iframe)}$("body").append($self.hide()).append($overlay);if(opts.showOverlay){setOverlayHeight();$overlay.css({position:"absolute",width:"100%",top:0,left:0,right:0,bottom:0,zIndex:opts.zIndex+2,display:"none"});if(!$overlay.hasClass("lb_overlay_clear"))$overlay.css(opts.overlayCSS)}if(opts.showOverlay)$overlay.fadeIn(opts.overlaySpeed,
function(){setSelfPosition();$self[opts.appearEffect](opts.lightboxSpeed,function(){setOverlayHeight();setSelfPosition();opts.onLoad()})});else{setSelfPosition();$self[opts.appearEffect](opts.lightboxSpeed,function(){opts.onLoad()})}if(opts.parentLightbox)opts.parentLightbox.fadeOut(200);$(window).resize(setOverlayHeight).resize(setSelfPosition).scroll(setSelfPosition).keyup(observeKeyPress);if(opts.closeClick)$overlay.click(function(e){closeLightbox();e.preventDefault});$self.delegate(opts.closeSelector,
"click",function(e){closeLightbox();e.preventDefault()});$self.bind("close",closeLightbox);$self.bind("reposition",setSelfPosition);function closeLightbox(){var s=$self[0].style;if(opts.destroyOnClose)$self.add($overlay).remove();else $self.add($overlay).hide();if(opts.parentLightbox)opts.parentLightbox.fadeIn(200);$iframe.remove();$self.undelegate(opts.closeSelector,"click");$(window).unbind("reposition",setOverlayHeight);$(window).unbind("reposition",setSelfPosition);$(window).unbind("scroll",setSelfPosition);
$(document).unbind("keyup",observeKeyPress);if(ie6)s.removeExpression("top");opts.onClose()}function observeKeyPress(e){if((e.keyCode==27||e.DOM_VK_ESCAPE==27&&e.which==0)&&opts.closeEsc)closeLightbox()}function setOverlayHeight(){if($(window).height()<$(document).height()){$overlay.css({height:$(document).height()+"px"});$iframe.css({height:$(document).height()+"px"})}else{$overlay.css({height:"100%"});if(ie6){$("html,body").css("height","100%");$iframe.css("height","100%")}}}function setSelfPosition(){var s=
$self[0].style;$self.css({left:"50%",marginLeft:$self.outerWidth()/2*-1,zIndex:opts.zIndex+3});if($self.height()+80>=$(window).height()&&($self.css("position")!="absolute"||ie6)){var topOffset=$(document).scrollTop()+40;$self.css({position:"absolute",top:topOffset+"px",marginTop:0});if(ie6)s.removeExpression("top")}else if($self.height()+80<$(window).height())if(ie6){s.position="absolute";if(opts.centered){s.setExpression("top",'(document.documentElement.clientHeight || document.body.clientHeight) / 2 - (this.offsetHeight / 2) + (blah = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) + "px"');
s.marginTop=0}else{var top=opts.modalCSS&&opts.modalCSS.top?parseInt(opts.modalCSS.top):0;s.setExpression("top","((blah = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) + "+top+') + "px"')}}else if(opts.centered)$self.css({position:"fixed",top:"50%",marginTop:$self.outerHeight()/2*-1});else $self.css({position:"fixed"}).css(opts.modalCSS)}})};$.fn.lightbox_me.defaults={appearEffect:"fadeIn",appearEase:"",overlaySpeed:250,lightboxSpeed:300,closeSelector:".close",
closeClick:true,closeEsc:true,destroyOnClose:false,showOverlay:true,parentLightbox:false,onLoad:function(){},onClose:function(){},classPrefix:"lb",zIndex:20001,centered:false,modalCSS:{top:"40px"},overlayCSS:{background:"black",opacity:0.7}}})(jQuery);