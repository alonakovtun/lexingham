!function(o){var t={};function a(r){if(t[r])return t[r].exports;var e=t[r]={i:r,l:!1,exports:{}};return o[r].call(e.exports,e,e.exports,a),e.l=!0,e.exports}a.m=o,a.c=t,a.d=function(o,t,r){a.o(o,t)||Object.defineProperty(o,t,{enumerable:!0,get:r})},a.r=function(o){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(o,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(o,"__esModule",{value:!0})},a.t=function(o,t){if(1&t&&(o=a(o)),8&t)return o;if(4&t&&"object"==typeof o&&o&&o.__esModule)return o;var r=Object.create(null);if(a.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:o}),2&t&&"string"!=typeof o)for(var e in o)a.d(r,e,function(t){return o[t]}.bind(null,e));return r},a.n=function(o){var t=o&&o.__esModule?function(){return o.default}:function(){return o};return a.d(t,"a",t),t},a.o=function(o,t){return Object.prototype.hasOwnProperty.call(o,t)},a.p="",a(a.s=35)}({35:function(o,t){!function(o,t){var a={version:300};if("wpColorPickerAlpha"in window&&"version"in window.wpColorPickerAlpha){var r=parseInt(window.wpColorPickerAlpha.version,10);if(!isNaN(r)&&r>=a.version)return}if(!Color.fn.hasOwnProperty("to_s")){Color.fn.to_s=function(o){"hex"===(o=o||"hex")&&this._alpha<1&&(o="rgba");var t="";return"hex"===o?t=this.toString():this.error||(t=this.toCSS(o).replace(/\(\s+/,"(").replace(/\s+\)/,")")),t},window.wpColorPickerAlpha=a;var e="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAIAAAHnlligAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAHJJREFUeNpi+P///4EDBxiAGMgCCCAGFB5AADGCRBgYDh48CCRZIJS9vT2QBAggFBkmBiSAogxFBiCAoHogAKIKAlBUYTELAiAmEtABEECk20G6BOmuIl0CIMBQ/IEMkO0myiSSraaaBhZcbkUOs0HuBwDplz5uFJ3Z4gAAAABJRU5ErkJggg==";o.widget("a8c.iris",o.a8c.iris,{alphaOptions:{alphaEnabled:!1},_getColor:function(o){return o===t&&(o=this._color),this.alphaOptions.alphaEnabled?(o=o.to_s(this.alphaOptions.alphaColorType),this.alphaOptions.alphaColorWithSpace||(o=o.replace(/\s+/g,"")),o):o.toString()},_create:function(){try{this.alphaOptions=this.element.wpColorPicker("instance").alphaOptions}catch(o){}o.extend({},this.alphaOptions,{alphaEnabled:!1,alphaCustomWidth:130,alphaReset:!1,alphaColorType:"hex",alphaColorWithSpace:!1}),this._super()},_addInputListeners:function(o){var t=this,a=function(a){var r=o.val(),e=new Color(r),i=(r=r.replace(/^(#|(rgb|hsl)a?)/,""),t.alphaOptions.alphaColorType);o.removeClass("iris-error"),e.error?""!==r&&o.addClass("iris-error"):"hex"===i&&"keyup"===a.type&&r.match(/^[0-9a-fA-F]{3}$/)||e.toIEOctoHex()!==t._color.toIEOctoHex()&&t._setOption("color",t._getColor(e))};o.on("change",a).on("keyup",t._debounce(a,100)),t.options.hide&&o.one("focus",(function(){t.show()}))},_initControls:function(){if(this._super(),this.alphaOptions.alphaEnabled){var t=this,a=t.controls.strip.clone(!1,!1),r=a.find(".iris-slider-offset"),e={stripAlpha:a,stripAlphaSlider:r};a.addClass("iris-strip-alpha"),r.addClass("iris-slider-offset-alpha"),a.appendTo(t.picker.find(".iris-picker-inner")),o.each(e,(function(o,a){t.controls[o]=a})),t.controls.stripAlphaSlider.slider({orientation:"vertical",min:0,max:100,step:1,value:parseInt(100*t._color._alpha),slide:function(o,a){t.active="strip",t._color._alpha=parseFloat(a.value/100),t._change.apply(t,arguments)}})}},_dimensions:function(o){if(this._super(o),this.alphaOptions.alphaEnabled){var t,a,r,e,i,l=this,n=l.options,s=l.controls.square,p=l.picker.find(".iris-strip");for(t=Math.round(l.picker.outerWidth(!0)-(n.border?22:0)),a=Math.round(s.outerWidth()),r=Math.round((t-a)/2),e=Math.round(r/2),i=Math.round(a+2*r+2*e);i>t;)r=Math.round(r-2),e=Math.round(e-1),i=Math.round(a+2*r+2*e);s.css("margin","0"),p.width(r).css("margin-left",e+"px")}},_change:function(){var t=this,a=t.active;if(t._super(),t.alphaOptions.alphaEnabled){var r=t.controls,i=parseInt(100*t._color._alpha),l=t._color.toRgb(),n=["rgb("+l.r+","+l.g+","+l.b+") 0%","rgba("+l.r+","+l.g+","+l.b+", 0) 100%"];t.picker.closest(".wp-picker-container").find(".wp-color-result");t.options.color=t._getColor(),r.stripAlpha.css({background:"linear-gradient(to bottom, "+n.join(", ")+"), url("+e+")"}),a&&r.stripAlphaSlider.slider("value",i),t._color.error||t.element.removeClass("iris-error").val(t.options.color),t.picker.find(".iris-palette-container").on("click.palette",".iris-palette",(function(){var a=o(this).data("color");t.alphaOptions.alphaReset&&(t._color._alpha=1,a=t._getColor()),t._setOption("color",a)}))}},_paintDimension:function(o,t){var a=this,r=!1;a.alphaOptions.alphaEnabled&&"strip"===t&&(r=a._color,a._color=new Color(r.toString()),a.hue=a._color.h()),a._super(o,t),r&&(a._color=r)},_setOption:function(o,t){var a=this;if("color"!==o||!a.alphaOptions.alphaEnabled)return a._super(o,t);t=""+t,newColor=new Color(t).setHSpace(a.options.mode),newColor.error||a._getColor(newColor)===a._getColor()||(a._color=newColor,a.options.color=a._getColor(),a.active="external",a._change())},color:function(o){return!0===o?this._color.clone():o===t?this._getColor():void this.option("color",o)}}),o.widget("wp.wpColorPicker",o.wp.wpColorPicker,{alphaOptions:{alphaEnabled:!1},_getAlphaOptions:function(){var t=this.element,a=t.data("type")||this.options.type,r=t.data("defaultColor")||t.val(),e={alphaEnabled:t.data("alphaEnabled")||!1,alphaCustomWidth:130,alphaReset:!1,alphaColorType:"rgb",alphaColorWithSpace:!1};return e.alphaEnabled&&(e.alphaEnabled=t.is("input")&&"full"===a),e.alphaEnabled?(e.alphaColorWithSpace=r&&r.match(/\s/),o.each(e,(function(o,a){var i=t.data(o)||a;switch(o){case"alphaCustomWidth":i=i?parseInt(i,10):0,i=isNaN(i)?a:i;break;case"alphaColorType":i.match(/^(hex|(rgb|hsl)a?)$/)||(i=r&&r.match(/^#/)?"hex":r&&r.match(/^hsla?/)?"hsl":a);break;default:i=!!i}e[o]=i})),e):e},_create:function(){o.support.iris&&(this.alphaOptions=this._getAlphaOptions(),this._super())},_addListeners:function(){if(!this.alphaOptions.alphaEnabled)return this._super();var t=this,a=t.element,r=t.toggler.is("a");this.alphaOptions.defaultWidth=a.width(),this.alphaOptions.alphaCustomWidth&&a.width(parseInt(this.alphaOptions.defaultWidth+this.alphaOptions.alphaCustomWidth,10)),t.toggler.css({position:"relative","background-image":"url("+e+")"}),r?t.toggler.html('<span class="color-alpha" />'):t.toggler.append('<span class="color-alpha" />'),t.colorAlpha=t.toggler.find("span.color-alpha").css({width:"30px",height:"100%",position:"absolute",top:0,"background-color":a.val()}),"ltr"===t.colorAlpha.css("direction")?t.colorAlpha.css({"border-bottom-left-radius":"2px","border-top-left-radius":"2px",left:0}):t.colorAlpha.css({"border-bottom-right-radius":"2px","border-top-right-radius":"2px",right:0}),a.iris({change:function(a,r){t.colorAlpha.css({"background-color":r.color.to_s(t.alphaOptions.alphaColorType)}),o.isFunction(t.options.change)&&t.options.change.call(this,a,r)}}),t.wrap.on("click.wpcolorpicker",(function(o){o.stopPropagation()})),t.toggler.click((function(){t.toggler.hasClass("wp-picker-open")?t.close():t.open()})),a.change((function(e){var i=o(this).val();(a.hasClass("iris-error")||""===i||i.match(/^(#|(rgb|hsl)a?)$/))&&(r&&t.toggler.removeAttr("style"),t.colorAlpha.css("background-color",""),o.isFunction(t.options.clear)&&t.options.clear.call(this,e))})),t.button.click((function(e){o(this).hasClass("wp-picker-default")?a.val(t.options.defaultColor).change():o(this).hasClass("wp-picker-clear")&&(a.val(""),r&&t.toggler.removeAttr("style"),t.colorAlpha.css("background-color",""),o.isFunction(t.options.clear)&&t.options.clear.call(this,e),a.trigger("change"))}))}})}}(jQuery)}});