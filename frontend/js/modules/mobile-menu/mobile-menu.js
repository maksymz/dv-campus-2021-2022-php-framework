
const defaultParams = {
    buttonSelector: '#menu-btn-mobile',
    navigationSelector: '#navigation-wrapper'
}

class MobileMenu {
    constructor(params) {
        this.params = Object.assign({}, defaultParams, params);

        const {buttonSelector, navigationSelector} = this.params;

        this.button = document.querySelector(buttonSelector);
        this.navigationSelector = document.querySelector(navigationSelector);

        if (this.button) {
            this.addEventListeners();
        }
    }

    addEventListeners() {
        window.addEventListener('click',  event => {
            if (this.button.contains(event.target)) {
                /** click inside of the button box */
                this.toggleMenu()
            } else {
                this.closeMenu()
            }
        })

        window.addEventListener('resize', () => {
            if (window.innerWidth > 768) {
                this.closeMenu();
            }
        })
    }

    closeMenu() {
        this.button.classList.remove('active')
        this.navigationSelector.classList.remove('active')
        document.body.classList.remove('open-menu')
    }

    toggleMenu() {
        this.button.classList.toggle('active');
        this.navigationSelector.classList.toggle('active')
        document.body.classList.toggle('open-menu')
    }
}

export default MobileMenu;
