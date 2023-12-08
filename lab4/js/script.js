// Set current date
function setDate() {
	const daysOfWeek = ["Sunday", "Mondady", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
	const months = ["January", "Fabuary", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

	const currentDate = new Date();

	const dayOfWeek = daysOfWeek[currentDate.getDay()];
	const dayOfMonth = currentDate.getDate();
	const month = months[currentDate.getMonth()];
	const year = currentDate.getFullYear();

	const formattedDate = `${dayOfWeek}, ${month} ${dayOfMonth}, ${year}`;

	document.getElementById("header-date").textContent = formattedDate;
}

document.addEventListener("DOMContentLoaded", function(){
	setDate();
});

function resetFields(){
	document.getElementById("error-msg").innerText = "";
	document.getElementById("result-msg").innerText = "";
}
