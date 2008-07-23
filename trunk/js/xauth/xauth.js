xauth = {
	init: function(/*Object*/ kwArgs){
		// kwArgs.node:
		//		A DOMNode object containing the UI of the login
		//		area. Should either be an iframe, or have an
		//		iframe somewhere within its contents
		// kwArgs.url:
		//		The URL of the third-party site
		var node = kwArgs.node, url = kwArgs.url;
		if(!node || !node.nodeType == 1 || !url){
			throw new Error("Pass xauth.init an object containing the attributes `node` and `url`");
		}
		xauth.url = url;
		xauth.node = node;
		var iframe = (node.tagName == "IFRAME") ? node : document.getElementsByTagName("iframe", node)[0];
		if(!iframe){
			throw new Error("Passed node doesn't contain an iframe element");
		}
		xauth.iframe = iframe;
		if(!xauth.loaded){
			// Handle page reloads
			iframe.src = iframe.src;
		}
	},
	_callbacks: [],
	addOnLoad: function(/*Function*/ callback){
		xauth._callbacks.push(callback);
	},
	_init: function(){
		xauth.loaded = true;
		document.getElementsByTagName("iframe")[0].src = xauth.url;
	},
	_callback: function(status, token){
		for(var c=xauth._callbacks, i=0, l=c.length; i<l; i++){
			c[i](status, token, xauth.node);
		}
	}
}