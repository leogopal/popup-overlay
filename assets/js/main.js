jQuery(document).ready(function ($) {

	var modal = document.querySelector(".modal");
	var closeButton = document.querySelector(".close-button");

	function toggleModal() {
		modal.classList.toggle("show-modal");
	}

	function windowOnClick(event) {
		if (event.target === modal) {
			toggleModal();
		}
	}

	// Checks if the cookie exists, displays form if it doesn't.
	if( ! Cookies.get('double-connect') ) {

		$("body").addClass('overlay-active');

		setTimeout(function () {
			$('.modal').addClass('show-modal');
		}, 4000);

		Cookies.set('double-connect', 'dc-verified', {
			expires: 4,
			domain: document.location.hostname,
			path: '/',
			secure: false
		});
	}

	closeButton.addEventListener("click", toggleModal);
	window.addEventListener("click", windowOnClick);

});