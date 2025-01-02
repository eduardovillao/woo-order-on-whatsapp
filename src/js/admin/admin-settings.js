function mydChangeTab(e) {
	e.preventDefault();
	let tabs = document.querySelectorAll('.myd-tab'),
	tabContent = document.querySelectorAll('.myd-tabs-content'),
	clicked = e.target;

	tabs.forEach(item => {
		item.classList.remove('nav-tab-active');
	});
	tabContent.forEach(item => {
		item.classList.remove('myd-tabs-content--active');
	});
	clicked.classList.add('nav-tab-active');
	document.getElementById(clicked.id + '-content').classList.add('myd-tabs-content--active');
}

window.mydChangeTab = mydChangeTab;
