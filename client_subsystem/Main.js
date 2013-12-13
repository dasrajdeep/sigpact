var registry={
	styles:[],
	images:{},
	views:{}
};

function boot() {
	loadPageView('startView');
	loadStylesheet('mainStyle');
	loadScript('mainScript');
}

$(document).ready(function() {
	boot();
});