class Header {
	constructor(el) {
		this.el = el;
		this.toggleNavTrigger = this.el.querySelector('[data-toggle-nav]');
		this.body = document.body;

		this.toggleClass = 'is-menu-opened';
		this.stickyClass = 'is-header-sticky';

		this.breakpoint = 600;
		this.isStuck = false;

		this.init();
	}
	init() {
		if (this.toggleNavTrigger) {
			this.toggleNavTrigger.addEventListener('click', (e) => {
				e.preventDefault();
				this.toggle();
			});
		}
		window.addEventListener('resize', () => {
			this.resize();
		});
		window.addEventListener('scroll', () => {
			this.scroll();
		});
	}
	toggle() {
		if (window.innerWidth <= this.breakpoint) {
			this.body.classList.toggle(this.toggleClass);
		} else {
			this.removeToggle();
		}
	}
	removeToggle() {
		this.body.classList.remove(this.toggleClass);
	}
	getTopOffset() {
		return this.el.offsetTop;
	}
	scroll() {
		const distance = this.getTopOffset() - window.pageYOffset;
		const offset = window.pageYOffset;
		if ( (distance <= 0) && !this.isStuck) {
			this.startSticky()
		} else if (this.isStuck && (offset <= distance)){
			this.stopSticky();
		}
	}
	startSticky() {
		this.body.classList.add(this.stickyClass);
		this.isStuck = true;
	}
	stopSticky() {
		this.body.classList.remove(this.stickyClass);
		this.isStuck = false;
	}
	resize() {
		this.removeToggle();
	}
}

const els = Array.prototype.slice.call(document.querySelectorAll('[data-module="header"]'));
if (els) {
	els.map((el) => {
		return new Header(el);
	});
}
