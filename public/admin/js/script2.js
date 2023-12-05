const sidebar = document.querySelector(".sidebar");
const menu = document.querySelector("#menu");

const main = document.querySelector(".main");

const menu_container = document.querySelector(".menu-container");
const logout_container = document.querySelector(".logout-container");

const icon_logout = document.querySelector(".icon-logout");

const search = document.querySelector("#search");
const dashboard = document.querySelector("#dashboard");
const Sales = document.querySelector("#Sales");
const Products = document.querySelector("#Products");
const Orders = document.querySelector("#Orders");
const settings = document.querySelector("#settings");

let previousToggled = null;
let currentToggled = null;

search.addEventListener("click", (e) => {
  toggleMenu(search);
});

dashboard.addEventListener("click", (e) => {
  toggleMenu(dashboard);
});

Sales.addEventListener("click", (e) => {
  toggleMenu(Sales);
});

Products.addEventListener("click", (e) => {
  toggleMenu(Products);
});

Orders.addEventListener("click", (e) => {
  toggleMenu(Orders);
});

settings.addEventListener("click", (e) => {
  toggleMenu(settings);
});

const toggleMenu = (button) => {
  if (previousToggled && button !== menu) {
    untoggleMenu(previousToggled);
  }

  button.classList.add("toggled");
  button.style.backgroundColor = "#8ed7c6";

  if (button !== menu) {
    previousToggled = button;
  }
};

const untoggleMenu = (button) => {
  button.classList.remove("toggled");
  button.style.backgroundColor = "#18c29c";
};

menu.addEventListener("click", (e) => {
  sidebar.classList.contains("active") ? closeMenu() : openMenu();
});

const openMenu = () => {
  sidebar.classList.add("active");
  sidebar.style.width = "250px";

  toggleMenu(menu);

  let menu_logo = document.createElement("img");
  menu_logo.id = "menu-logo";
  menu_logo.src = "./assets/images/logo.svg";
  menu_logo.style.width = "60px";
  menu_container.style.paddingLeft = "15px";
  menu_container.insertBefore(menu_logo, menu_container.childNodes[0]);

  let p_search = document.createElement("p");
  p_search.id = "p-search";
  p_search.innerHTML = "Search";
  search.style.width = "220px";
  search.style.justifyContent = "left";
  search.appendChild(p_search);

  let p_dash = document.createElement("p");
  p_dash.id = "p-dashboard";
  p_dash.innerHTML = "Dashboard";
  dashboard.style.width = "220px";
  dashboard.style.justifyContent = "left";
  dashboard.appendChild(p_dash);

  let p_Sales = document.createElement("p");
  p_Sales.id = "p-Sales";
  p_Sales.innerHTML = "Sales";
  Sales.style.width = "220px";
  Sales.style.justifyContent = "left";
  Sales.appendChild(p_Sales);

  let p_Products = document.createElement("p");
  p_Products.id = "p-Products";
  p_Products.innerHTML = "Products";
  Products.style.width = "220px";
  Products.style.justifyContent = "left";
  Products.appendChild(p_Products);

  let p_Orders = document.createElement("p");
  p_Orders.id = "p-Orders";
  p_Orders.innerHTML = "Orders";
  Orders.style.width = "220px";
  Orders.style.justifyContent = "left";
  Orders.appendChild(p_Orders);

  let p_settings = document.createElement("p");
  p_settings.id = "p-settings";
  p_settings.innerHTML = "Settings";
  settings.style.width = "220px";
  settings.style.justifyContent = "left";
  settings.appendChild(p_settings);

  icon_logout.style.width = "25%";

  let user_container = document.createElement("div");
  user_container.id = "user-container";

  let user_name = document.createElement("p");
  user_name.id = "user-name";
  user_name.innerHTML = "Diego Ferreira";

  let user_role = document.createElement("p");
  user_role.id = "user-role";
  user_role.innerHTML = "Veterinarian";

  user_container.appendChild(user_name);
  user_container.appendChild(user_role);

  logout_container.insertBefore(user_container, logout_container.childNodes[0]);

  let logout_photo = document.createElement("img");
  logout_photo.id = "logout-photo";
  logout_photo.src = "https://github.com/diegoafv.png";
  logout_container.style.paddingLeft = "15px";
  logout_container.insertBefore(logout_photo, logout_container.childNodes[0]);

  main.style.width = "calc(100% - 250px)";
};

const closeMenu = () => {
  menu_container.removeChild(document.getElementById("menu-logo"));
  menu_container.style.paddingLeft = "0px";

  untoggleMenu(menu);

  search.removeChild(document.getElementById("p-search"));
  search.style.width = "50px";
  search.style.justifyContent = "center";

  dashboard.removeChild(document.getElementById("p-dashboard"));
  dashboard.style.width = "50px";
  dashboard.style.justifyContent = "center";

  Sales.removeChild(document.getElementById("p-Sales"));
  Sales.style.width = "50px";
  Sales.style.justifyContent = "center";

  Products.removeChild(document.getElementById("p-Products"));
  Products.style.width = "50px";
  Products.style.justifyContent = "center";

  Orders.removeChild(document.getElementById("p-Orders"));
  Orders.style.width = "50px";
  Orders.style.justifyContent = "center";

  settings.removeChild(document.getElementById("p-settings"));
  settings.style.width = "50px";
  settings.style.justifyContent = "center";

  logout_container.removeChild(document.getElementById("logout-photo"));
  logout_container.removeChild(document.getElementById("user-container"));
  logout_container.style.paddingLeft = "0px";

  icon_logout.style.width = "100%";

  sidebar.classList.remove("active");
  sidebar.style.width = "78px";

  main.style.width = "calc(100% - 78px)";
};


var properties = [
	'name',
	'wins',
	'draws',
	'losses',
	'total',
];

$.each( properties, function( i, val ) {
	
	var orderClass = '';

	$("#" + val).click(function(e){
		e.preventDefault();
		$('.filter__link.filter__link--active').not(this).removeClass('filter__link--active');
  		$(this).toggleClass('filter__link--active');
   		$('.filter__link').removeClass('asc desc');

   		if(orderClass == 'desc' || orderClass == '') {
    			$(this).addClass('asc');
    			orderClass = 'asc';
       	} else {
       		$(this).addClass('desc');
       		orderClass = 'desc';
       	}

		var parent = $(this).closest('.header__item');
    		var index = $(".header__item").index(parent);
		var $table = $('.table-content');
		var rows = $table.find('.table-row').get();
		var isSelected = $(this).hasClass('filter__link--active');
		var isNumber = $(this).hasClass('filter__link--number');
			
		rows.sort(function(a, b){

			var x = $(a).find('.table-data').eq(index).text();
    			var y = $(b).find('.table-data').eq(index).text();
				
			if(isNumber == true) {
    					
				if(isSelected) {
					return x - y;
				} else {
					return y - x;
				}

			} else {
			
				if(isSelected) {		
					if(x < y) return -1;
					if(x > y) return 1;
					return 0;
				} else {
					if(x > y) return -1;
					if(x < y) return 1;
					return 0;
				}
			}
    		});

		$.each(rows, function(index,row) {
			$table.append(row);
		});

		return false;
	});

});