(function(f){function j(c,a){function b(){d.frameCount++;c.call(d)}var d=this,g;this.frameDuration=a||25;this.frameCount=-1;this.start=function(){b();g=setInterval(b,this.frameDuration)};this.stop=function(){clearInterval(g);g=null}}function k(){var c=f.event.special.frame.handler,a=f.Event("frame"),b=this.array,d=b.length;for(a.frameCount=this.frameCount;d--;)c.call(b[d],a)}function h(c,a,b){if(e[a])e[a].array.push(c);else{e[a]=new j(k,b);e[a].array=[c];var d=setTimeout(function(){e[a].start();clearTimeout(d);
d=null},0)}}function i(c,a){for(var b=e[a].array,d=b.length;d--;)if(b[d]===c){b.splice(d,1);break}if(b.length===0){e[a].stop();delete e[a]}}var e={};f.event.special.frame={setup:function(c,a){var b=a.length;if(b)for(;b--;)h(this,a[b],c&&c.frameDuration);else h(this,0,c&&c.frameDuration)},teardown:function(c){var a=c.length;if(a)for(;a--;)i(this,c[a]);else for(var b in e)i(this,b)},handler:function(){f.event.handle.apply(this,arguments)}}})(jQuery);