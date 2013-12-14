function rpc(methodName) {

	var numArgs=arguments.length-1;
	
	var rpcArgs='/'+methodName;
	
	for(var i=1;i<=numArgs;i++) rpcArgs+='/'+arguments[i];
	
	$.post(rpcArgs,{'action':'rpc'}, function(result) {
	});
}