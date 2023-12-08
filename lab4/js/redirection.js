// Redireting to home page
document.addEventListener("DOMContentLoaded", function () {
	const countdownElement = document.getElementById('countdown');
	let seconds = 3;
	
	function updateCountdown() {
		countdownElement.textContent = seconds;
		seconds--;

		if (seconds < 0) {
			window.location.href = '../php/index.php';
		} 
		else {
			setTimeout(updateCountdown, 1000);
		}
	}

	updateCountdown();
});