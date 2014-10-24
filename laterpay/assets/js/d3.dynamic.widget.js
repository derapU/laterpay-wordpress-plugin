var margin={top:45,right:40,bottom:20,left:50};margin.xAxis=margin.left+margin.right;margin.yAxis=margin.top+margin.bottom;var LPCurve=function(e){var t=this,n;this.container=e;this.interpolation="linear";this.minPrice=0;this.maxPrice=5;this.todayPrice=0;this.pubDays=0;this.defaultPrice=.99;this.i18nDefaultPrice=lpVars.i18nDefaultPrice;this.currency=lpVars.currency;this.i18nDays=lpVars.i18nDays;this.dragging=false;n=d3.select(e).append("svg").append("g");n.append("rect").attr("class","background");n.append("g").attr("class","x axis");n.append("g").attr("class","y axis");n.append("defs").append("marker").attr({id:"arrow-x","class":"arrowhead",refX:2,refY:2,markerWidth:4,markerHeight:4,orient:"auto"}).append("path").attr("d","M0,0 V4 L4,2 Z");n.append("defs").append("marker").attr({id:"arrow-y","class":"arrowhead",refX:2,refY:2,markerWidth:4,markerHeight:4,orient:"auto"}).append("path").attr("d","M0,4 H4 L2,0 Z");n.append("line").attr("class","default-price");n.append("text").attr("text-anchor","middle").attr("class","default-price").text(this.i18nDefaultPrice);n.append("path").attr("class","line");n.append("rect").attr({"class":"start-price",width:32,rx:3,height:29,ry:3});n.append("text").attr("class","start-price").attr("text-anchor","end");n.append("text").attr("class","start-price-currency").attr("text-anchor","end").text(this.currency);n.append("path").attr("class","start-price-triangle");n.append("rect").attr({"class":"end-price",width:32,rx:3,height:29,ry:3});n.append("text").attr("class","end-price").attr("text-anchor","end");n.append("text").attr("class","end-price-currency").attr("text-anchor","end").text(this.currency);n.append("path").attr("class","end-price-triangle");this.svg=n;jQuery(window).bind("resize",function(){t.plot()})};LPCurve.prototype.interpolate=function(e){this.interpolation=e;return this};LPCurve.prototype.setPrice=function(e,t,n){this.minPrice=e;this.maxPrice=t;if(n){this.defaultPrice=n}return this};LPCurve.prototype.set_data=function(e){this.data=e;return this};LPCurve.prototype.set_today=function(e,t){this.pubDays=e;this.todayPrice=t;return this};LPCurve.prototype.get_data=function(){return this.data};LPCurve.prototype.plot=function(){function N(t,n){var r=o.invert(d3.event.y);if(r<l[0]){r=l[0]}if(r>l[1]){r=l[1]}t.y=r;if(n===0&&e.data[0].x===t.x){e.data[1].y=t.y}else if(n===1){e.data[0].y=t.y}else if(n===0&&e.data[e.data.length-1].x===t.x){e.data[e.data.length-2].y=t.y}else if(n===e.data.length-2){e.data[e.data.length-1].y=t.y}e.plot()}function C(){e.dragging=true;jQuery(e.container).toggleClass("dragging")}function k(){e.dragging=false;jQuery(e.container).toggleClass("dragging")}function O(){clearInterval(A);jQuery(e.container).toggleClass("ew-resize");e.dragging=false;for(var t=0,n=e.data.length;t<n;t++){e.data[t].x=Math.round(e.data[t].x)}e.plot()}function M(){jQuery(e.container).toggleClass("ew-resize");e.dragging=true}function _(t,n){var r=s.invert(d3.event.x),i=n===e.data.length-2,o=n===e.data.length-3,u;if(i){var a=(r-t.x)/(1e3/L),f=function(){u=+t.x+a;u=Math.max(u,e.data[n].x+.51);u=Math.max(u,29.51);u=Math.min(u,60.49);t.x=u;s.domain(d3.extent(e.data,function(e){return e.x}));e.plot()};clearInterval(A);A=setInterval(f,1e3/L);f()}else if(o){u=r;u=Math.max(u,e.data[n].x+.51);u=Math.min(u,60.49);if(u>=25){e.data[n+2].x=u+5}else{e.data[n+2].x=30}t.x=u;s.domain(d3.extent(e.data,function(e){return e.x}));e.plot()}else{u=r;u=Math.max(u,e.data[n].x+.51);u=Math.min(u,e.data[n+2].x-.51);t.x=u;s.domain(d3.extent(e.data,function(e){return e.x}));e.plot()}}var e=this,t=this.svg,n=this.dragging,r=jQuery(this.container).width()-margin.xAxis,i=jQuery(this.container).height()-margin.yAxis,s=d3.scale.linear().range([0,r+10]),o=d3.scale.linear().range([i,0]),u,a;d3.select(this.container).select("svg").attr({width:r+margin.xAxis,height:i+margin.yAxis}).select("g").attr("transform","translate("+(margin.left-10)+","+margin.top+")");t.select(".background").transition().duration(n?0:250).attr({width:r+10,height:i});var f=d3.extent(e.data,function(e){return e.x}),l=[this.minPrice,this.maxPrice],c=d3.svg.axis().scale(s).tickSize(-i,0,0).ticks(7).orient("bottom"),h=d3.svg.axis().scale(o).tickSize(-i,0,0).ticks(7).orient("left");s.domain(f);o.domain(l);t.select("g.x.axis").attr({transform:"translate(0,"+i+")","marker-end":"url(#arrow-x)"}).transition().duration(n?0:250).call(c);t.select("g.y.axis").attr("marker-start","url(#arrow-y)").transition().duration(n?0:250).call(h);t.select("line.default-price").transition().duration(n?0:250).attr({x1:0,y1:o(this.defaultPrice),x2:r+10,y2:o(this.defaultPrice)});t.select("text.default-price").transition().duration(n?0:250).attr({x:r/2,y:o(e.defaultPrice)});var p=d3.svg.line().interpolate(this.interpolation).x(function(e){return s(e.x)}).y(function(e){return o(e.y)});t.select("path.line").datum(e.data).transition().duration(n?0:250).attr("d",p);var d=d3.behavior.drag().on("dragstart",M).on("drag",_).on("dragend",O);var v=d3.behavior.drag().on("dragstart",C).on("drag",N).on("dragend",k);var m=e.data.length,g=t.selectAll("circle.draggable").data(e.data),y=t.selectAll(".line-price").data(e.data.slice(1,m)),b=t.selectAll(".today-price-line").data(e.data.slice(1,m)),w=t.selectAll(".line-price-visible").data(e.data.slice(1,m));t.select("rect.start-price").datum(e.data[0]).call(v).transition().duration(n?0:250).attr({x:function(){return-40},y:function(e){return o(e.y)-14.5}});t.select("text.start-price").datum(e.data[0]).call(v).transition().duration(n?0:250).attr({x:function(){return-12},y:function(e){return o(e.y)-.5}}).text(function(e){return e.y.toFixed(2)});t.select("text.start-price-currency").datum(e.data[0]).call(v).transition().duration(n?0:250).attr({x:function(){return-13},y:function(e){return o(e.y)+9.5}});t.select("path.start-price-triangle").datum(e.data[0]).call(v).transition().duration(n?0:250).attr("d",function(e){u=-8;a=o(e.y)-5;return"M "+u+" "+a+" l 5 5 l -5 5 z"});t.select("rect.end-price").datum(e.data[e.data.length-1]).call(v).transition().duration(n?0:250).attr({x:function(){return r+18},y:function(e){return o(e.y)-15}});t.select("text.end-price").datum(e.data[e.data.length-1]).call(v).transition().duration(n?0:250).attr({x:function(){return r+46},y:function(e){return o(e.y)-1}}).text(function(e){return e.y.toFixed(2)});t.select("text.end-price-currency").datum(e.data[e.data.length-1]).call(v).transition().duration(n?0:250).attr({x:function(){return r+46},y:function(e){return o(e.y)+9}});t.select("path.end-price-triangle").datum(e.data[e.data.length-1]).call(v).transition().duration(n?0:250).attr("d",function(e){u=r+18;a=o(e.y)+5;return"M "+u+" "+a+" l 0 -10 l -5 5 z"});var E=t.selectAll(".x-drag-square").data(e.data.slice(1,m));E.enter().append("rect").attr("class",function(t,n){if(n===e.data.length-2){return"x-drag-square hidden"}return"x-drag-square"}).call(d);E.exit().remove();E.transition().duration(n?0:250).attr({x:function(e){return s(e.x)-15},y:function(){return-40},width:30,rx:3,height:30,ry:3});var S=t.selectAll(".x-triangle-bottom").data(e.data.slice(1,m));S.enter().append("path").attr("class",function(t,n){if(n===e.data.length-2){return"x-triangle-bottom hidden"}return"x-triangle-bottom"}).call(d);S.exit().remove();S.transition().duration(n?0:250).attr("d",function(e){u=s(e.x)-5;a=-10;return"M "+u+" "+a+" l 10 0 l -5 5 z"});var x=t.selectAll(".x-text-days").data(e.data.slice(1,m));x.enter().append("text").attr("class",function(t,n){if(n===e.data.length-2){return"x-text-days hidden"}return"x-text-days"}).call(d);x.exit().remove();x.transition().duration(n?0:250).text(this.i18nDays).attr({x:function(e){return s(e.x)},y:function(){return-16},height:30,"text-anchor":"middle"});var T=t.selectAll(".x-text").data(e.data.slice(1,m));T.enter().append("text").attr("class",function(t,n){if(n===e.data.length-2){return"x-text hidden"}return"x-text"}).call(d);T.exit().remove();T.transition().duration(n?0:250).text(function(e){return Math.round(e.x)}).attr({x:function(e){return s(e.x)},y:function(){return-26},height:30,"text-anchor":"middle"});w.enter().append("line").attr("class",function(t,n){if(n===e.data.length-2){return"line-price-visible hidden"}return"line-price-visible"});w.exit().remove();w.transition().duration(n?0:250).attr({x1:function(e){return s(e.x)},y1:function(){return 0},x2:function(e){return s(e.x)},y2:function(e){return o(e.y)}});y.enter().append("line").attr("class",function(t,n){if(n===e.data.length-2){return"line-price hidden"}return"line-price"}).call(d);y.exit().remove();y.transition().duration(n?0:250).attr({x1:function(e){return s(e.x)},y1:function(){return 0},x2:function(e){return s(e.x)},y2:function(e){return o(e.y)}});g.enter().append("circle").attr("class",function(t,n){if(n===0||n===e.data.length-1){return"draggable circle-hidden"}return"draggable"}).attr("r",0).call(v);g.transition().duration(n?0:250).attr({r:5,cx:function(e){return s(e.x)},cy:function(e){return o(e.y)}});g.exit().remove();if(this.pubDays>0){b.enter().append("line").attr("class","line-today-price-visible");b.exit().remove();b.transition().duration().attr({x1:function(){return s(lpc.pubDays)},y1:function(){return o(0)},x2:function(){return s(lpc.pubDays)},y2:function(){return o(lpc.maxPrice)}});g.enter().append("circle").attr("class","point-today").attr("r",0).call(v);g.transition().duration(n?0:250).attr({r:5,cx:function(){return s(lpc.pubDays)},cy:function(){return o(lpc.todayPrice)}});g.exit().remove()}var L=60,A}