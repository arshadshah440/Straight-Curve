<script>
	/* Contains custom build of Modernizr */
	/*!
 * modernizr v3.11.3
 * Build https://modernizr.com/download?-flexbox-inlinesvg-svg-setclasses-dontmin
 *
 * Copyright (c)
 *  Faruk Ates
 *  Paul Irish
 *  Alex Sexton
 *  Ryan Seddon
 *  Patrick Kettner
 *  Stu Cox
 *  Richard Herrera
 *  Veeck

 * MIT License
 */
!function(e,n,t,r){var s=[],o={_version:"3.11.3",_config:{classPrefix:"",enableClasses:!0,enableJSClass:!0,usePrefixes:!0},_q:[],on:function(e,n){var t=this;setTimeout((function(){n(t[e])}),0)},addTest:function(e,n,t){s.push({name:e,fn:n,options:t})},addAsyncTest:function(e){s.push({name:null,fn:e})}},i=function(){};i.prototype=o,i=new i;var l=[];function a(e,n){return typeof e===n}var f=t.documentElement,u="svg"===f.nodeName.toLowerCase();function d(){return"function"!=typeof t.createElement?t.createElement(arguments[0]):u?t.createElementNS.call(t,"http://www.w3.org/2000/svg",arguments[0]):t.createElement.apply(t,arguments)}
/*!
{
  "name": "Inline SVG",
  "property": "inlinesvg",
  "caniuse": "svg-html5",
  "tags": ["svg"],
  "notes": [{
    "name": "Test page",
    "href": "https://paulirish.com/demo/inline-svg"
  }, {
    "name": "Test page and results",
    "href": "https://codepen.io/eltonmesquita/full/GgXbvo/"
  }],
  "polyfills": ["inline-svg-polyfill"],
  "knownBugs": ["False negative on some Chromia browsers."]
}
!*/
i.addTest("inlinesvg",(function(){var e=d("div");return e.innerHTML="<svg/>","http://www.w3.org/2000/svg"===("undefined"!=typeof SVGRect&&e.firstChild&&e.firstChild.namespaceURI)})),
/*!
{
  "name": "SVG",
  "property": "svg",
  "caniuse": "svg",
  "tags": ["svg"],
  "authors": ["Erik Dahlstrom"],
  "polyfills": [
    "svgweb",
    "raphael",
    "amplesdk",
    "canvg",
    "svg-boilerplate",
    "sie",
    "dojogfx",
    "fabricjs"
  ]
}
!*/
i.addTest("svg",!!t.createElementNS&&!!t.createElementNS("http://www.w3.org/2000/svg","svg").createSVGRect);var c="Moz O ms Webkit",p=o._config.usePrefixes?c.split(" "):[];o._cssomPrefixes=p;var m={elem:d("modernizr")};i._q.push((function(){delete m.elem}));var v={style:m.elem.style};function g(e,n,r,s){var o,i,l,a,c="modernizr",p=d("div"),m=function(){var e=t.body;return e||((e=d(u?"svg":"body")).fake=!0),e}();if(parseInt(r,10))for(;r--;)(l=d("div")).id=s?s[r]:c+(r+1),p.appendChild(l);return(o=d("style")).type="text/css",o.id="s"+c,(m.fake?m:p).appendChild(o),m.appendChild(p),o.styleSheet?o.styleSheet.cssText=e:o.appendChild(t.createTextNode(e)),p.id=c,m.fake&&(m.style.background="",m.style.overflow="hidden",a=f.style.overflow,f.style.overflow="hidden",f.appendChild(m)),i=n(p,e),m.fake?(m.parentNode.removeChild(m),f.style.overflow=a,f.offsetHeight):p.parentNode.removeChild(p),!!i}function h(e){return e.replace(/([A-Z])/g,(function(e,n){return"-"+n.toLowerCase()})).replace(/^ms-/,"-ms-")}function y(e,t){var s=e.length;if("CSS"in n&&"supports"in n.CSS){for(;s--;)if(n.CSS.supports(h(e[s]),t))return!0;return!1}if("CSSSupportsRule"in n){for(var o=[];s--;)o.push("("+h(e[s])+":"+t+")");return g("@supports ("+(o=o.join(" or "))+") { #modernizr { position: absolute; } }",(function(e){return"absolute"===function(e,t,r){var s;if("getComputedStyle"in n){s=getComputedStyle.call(n,e,t);var o=n.console;null!==s?r&&(s=s.getPropertyValue(r)):o&&o[o.error?"error":"log"].call(o,"getComputedStyle returning null, its possible modernizr test results are inaccurate")}else s=!t&&e.currentStyle&&e.currentStyle[r];return s}(e,null,"position")}))}return r}i._q.unshift((function(){delete v.style}));var w=o._config.usePrefixes?c.toLowerCase().split(" "):[];function C(e,n){return function(){return e.apply(n,arguments)}}function S(e,n,t,s,o){var i=e.charAt(0).toUpperCase()+e.slice(1),l=(e+" "+p.join(i+" ")+i).split(" ");return a(n,"string")||a(n,"undefined")?function(e,n,t,s){if(s=!a(s,"undefined")&&s,!a(t,"undefined")){var o=y(e,t);if(!a(o,"undefined"))return o}for(var i,l,f,u,c,p=["modernizr","tspan","samp"];!v.style&&p.length;)i=!0,v.modElem=d(p.shift()),v.style=v.modElem.style;function m(){i&&(delete v.style,delete v.modElem)}for(f=e.length,l=0;l<f;l++)if(u=e[l],c=v.style[u],~(""+u).indexOf("-")&&(u=u.replace(/([a-z])-([a-z])/g,(function(e,n,t){return n+t.toUpperCase()})).replace(/^-/,"")),v.style[u]!==r){if(s||a(t,"undefined"))return m(),"pfx"!==n||u;try{v.style[u]=t}catch(e){}if(v.style[u]!==c)return m(),"pfx"!==n||u}return m(),!1}(l,n,s,o):function(e,n,t){var r;for(var s in e)if(e[s]in n)return!1===t?e[s]:a(r=n[e[s]],"function")?C(r,t||n):r;return!1}(l=(e+" "+w.join(i+" ")+i).split(" "),n,t)}function x(e,n,t){return S(e,r,r,n,t)}o._domPrefixes=w,o.testAllProps=S,o.testAllProps=x,
/*!
{
  "name": "Flexbox",
  "property": "flexbox",
  "caniuse": "flexbox",
  "tags": ["css"],
  "notes": [{
    "name": "The _new_ flexbox",
    "href": "https://www.w3.org/TR/css-flexbox-1/"
  }],
  "warnings": [
    "A `true` result for this detect does not imply that the `flex-wrap` property is supported; see the `flexwrap` detect."
  ]
}
!*/
i.addTest("flexbox",x("flexBasis","1px",!0)),function(){var e,n,t,r,o,f;for(var u in s)if(s.hasOwnProperty(u)){if(e=[],(n=s[u]).name&&(e.push(n.name.toLowerCase()),n.options&&n.options.aliases&&n.options.aliases.length))for(t=0;t<n.options.aliases.length;t++)e.push(n.options.aliases[t].toLowerCase());for(r=a(n.fn,"function")?n.fn():n.fn,o=0;o<e.length;o++)1===(f=e[o].split(".")).length?i[f[0]]=r:(i[f[0]]&&(!i[f[0]]||i[f[0]]instanceof Boolean)||(i[f[0]]=new Boolean(i[f[0]])),i[f[0]][f[1]]=r),l.push((r?"":"no-")+f.join("-"))}}(),function(e){var n=f.className,t=i._config.classPrefix||"";if(u&&(n=n.baseVal),i._config.enableJSClass){var r=new RegExp("(^|\\s)"+t+"no-js(\\s|$)");n=n.replace(r,"$1"+t+"js$2")}i._config.enableClasses&&(e.length>0&&(n+=" "+t+e.join(" "+t)),u?f.className.baseVal=n:f.className=n)}(l),delete o.addTest,delete o.addAsyncTest;for(var b=0;b<i._q.length;b++)i._q[b]();e.Modernizr=i}(window,window,document);
</script>