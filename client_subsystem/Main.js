var registry={
	styles:[],
	images:{},
	views:{}
};

function boot_system() {
	loadPageView('front');
}

$(document).ready(function() {
	boot_system();
});
