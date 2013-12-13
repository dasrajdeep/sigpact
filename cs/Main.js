var registry={
	styles:[],
	inlineImages:{},
	viewComponents:{}
};

function showMainLoader() {
	$('body').html('Loading...');
}

function hideMainLoader() {
	$('body').html('');
}

function loadPageView(viewName) {
	showMainLoader();
	$.get('index.php',{'action':'loadview','view_name':viewName}, function(viewData) {
		hideMainLoader();
		$('body').html(viewData);
	});
}

function loadStylesheet(styleName) {
	$.get('index.php',{'action':'loadstyle','style_name':styleName}, function(styleData) {
		$('<style id="style_'+styleName+'">'+styleData+'</style>').appendTo('head');
		registry.styles.push(styleName);
	});
}

function loadScript(scriptName) {
	$.get('index.php',{'action':'loadscript','script_name':scriptName}, function(scriptData) {});
}

function boot() {
	loadPageView('startView');
	loadStylesheet('mainStyle');
	loadScript('mainScript');
}

$(document).ready(function() {
	boot();
});