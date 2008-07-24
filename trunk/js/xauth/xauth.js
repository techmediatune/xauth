xauth = {
	init: function(/*Object*/ kwArgs){
		// kwArgs.node:
		//		A DOMNode object containing the UI of the login
		//		area. Should either be an iframe, or have an
		//		iframe somewhere within its contents
		// kwArgs.url:
		//		The URL of the third-party site
		var node = kwArgs.node;
		var url = kwArgs.url;

		if(!node || !node.nodeType == 1 || !url){
			throw new Error("Pass xauth.init an object containing the attributes `node` and `url`");
		}

		var iframe = kwArgs.iframe = (node.tagName == "IFRAME") ? node : document.getElementsByTagName("iframe", node)[0];
		if(!iframe){
			throw new Error("Pass xauth.init a node that contains an iframe element");
		}

		// Make sure to deal with problems due to reloading the page
		iframe.src = iframe.src;

		xauth._stack.push(kwArgs);

		kwArgs._callbacks = [];
		kwArgs.addCallback = xauth._addCallback;

		return kwArgs;
	},
	_addCallback: function(/*Object?*/ context, /*Function*/ callback){
		if(arguments.length > 1){
			this._callbacks.push([context, callback])
		}else{
			this._callbacks.push([{}, context])
		}
	},
	_stack: [],
	_getStack: function(child){
		for(var i=0, s; s=xauth._stack[i]; i++){
			if(s.iframe.contentWindow == child){
				return s;
			}
		}
	},
	_init: function(child){
		var stack = xauth._getStack(child);
		if(stack){
			child.name = child.location.href + "?loaded";
			child.location = stack.url;
		}
	},
	_callback: function(child){
		var stack = xauth._getStack(child);
		if(stack){
			var status = 0;
			var statuses = child.location.hash.slice(1).split("&");
			for(var i=0, s; s=statuses[i]; i++){
				var keyval = s.split("=");
				if(keyval[0] == "xauth"){
					var inted = parseInt(keyval[1]);
					status = (inted == keyval[1] && !isNaN(inted)) ? inted : keyval[1];
				}
			}

			for(var i=0, c; c=stack._callbacks[i]; i++){
				c[1].call(c[0], status, child.name, stack.node);
			}
		}
	}
}