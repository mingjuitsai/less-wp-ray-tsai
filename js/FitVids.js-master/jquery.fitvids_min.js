(function(d){d.fn.fitVids=function(f){var c={customSelector:null,ignore:null};if(!document.getElementById("fit-vids-style")){var h=document.head||document.getElementsByTagName("head")[0],g=document.createElement("div");g.innerHTML='<p>x</p><style id="fit-vids-style">.fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}</style>';
h.appendChild(g.childNodes[1])}f&&d.extend(c,f);return this.each(function(){var b="iframe[src*='player.vimeo.com'] iframe[src*='youtube.com'] iframe[src*='youtube-nocookie.com'] iframe[src*='kickstarter.com'][src*='video.html'] object embed".split(" ");c.customSelector&&b.push(c.customSelector);var e=".fitvidsignore";c.ignore&&(e=e+", "+c.ignore);b=d(this).find(b.join(","));b=b.not("object object");b=b.not(e);b.each(function(){var a=d(this);if(!(0<a.parents(e).length||"embed"===this.tagName.toLowerCase()&&
a.parent("object").length||a.parent(".fluid-width-video-wrapper").length)){a.css("height")||a.css("width")||!isNaN(a.attr("height"))&&!isNaN(a.attr("width"))||(a.attr("height",9),a.attr("width",16));var b="object"===this.tagName.toLowerCase()||a.attr("height")&&!isNaN(parseInt(a.attr("height"),10))?parseInt(a.attr("height"),10):a.height(),c=isNaN(parseInt(a.attr("width"),10))?a.width():parseInt(a.attr("width"),10),b=b/c;a.attr("id")||(c="fitvid"+Math.floor(999999*Math.random()),a.attr("id",c));a.wrap('<div class="fluid-width-video-wrapper"></div>').parent(".fluid-width-video-wrapper").css("padding-top",
100*b+"%");a.removeAttr("height").removeAttr("width")}})})}})(window.jQuery||window.Zepto);