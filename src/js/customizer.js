/**
 * Customizer: Preview changes in backend
 */

var wp = global.wp

document.addEventListener('DOMContentLoaded', function () {

	/**
	 * Footer: Copyright Text
	 */
	wp.customize('footer_copyright_text_setting', function (value) {
		value.bind(function (newval) {
			document.querySelector('.js-footer-copyright-text').innerHTML = newval
		})
	})
})
