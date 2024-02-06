const navItems = document.getElementsByClassName("nav-item");

function expandMenuItem(menuIndex) {
	const collapsibles = navItems[menuIndex].getElementsByClassName("collapsible");
	for (const collapsible of collapsibles) {
		collapsible.style.display = "block";
	}
}

function collapseMenuItem(menuIndex) {
	const collapsibles = navItems[menuIndex].getElementsByClassName("collapsible");
	for (const collapsible of collapsibles) {
		collapsible.style.display = "none";
	}
}

for (let i = 0; i < navItems.length; i++) {
	navItems[i].addEventListener("mouseover", () => expandMenuItem(i));
	navItems[i].addEventListener("mouseout", () => collapseMenuItem(i));
}

if (document.cookie !== "") {
	console.log(document.cookie);
	const cookies = document.cookie.trim().split(';');
	const uname = (cookies[1].split('='))[1];
	document.getElementById("login-signup").innerHTML = `<p>Welcome, ${uname}</p><a id=logout href=index.html>Sign Out</a>`;

	document.getElementById("logout").addEventListener("click", () => {
		for (let i = 0; i < cookies.length; i++) {
			const cookieName = cookies[i].split('=')[0];
			document.cookie = cookieName + "=; expires=Thu, 01 Jan 1970 00:00:01 GMT; path=/;";
		}
	});
}
