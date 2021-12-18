/** classes used internally for slider init */
const initParams = {
    sliderClass: 'campus-slider',
    trackClass: 'campus-slider-track',
    listClass: 'campus-slider-list',
    slideClass: 'campus-slider-slide',
    sliderInitialized: 'campus-slider-initialized',
    trackDragging: 'dragging'
}

/** params that will be used if user doesn't override them during initialization */
const defaultParams = {
    loop: false,
    speed: 300,
    slidesPerView: 1,
    additionalSliderClass: '',
    additionalSlideClass: '',
    navigation: false,
    autoplay: false,
    breakpoints: {},
}

/** regex to match first the first coords (250px) in translate3d(250px, 0, 0)  */
const transformRegex = /[-0-9.]+(?=px)/;

/**
 * find the closest breakpoint to the current value of window width
 * @param {Number[]} array
 * @param {Number} value
 * @returns {Number}
 */
const findCurrentBreakpoint = (array, value) => {
    const foundBreakpoint = array.find(el => el === value);

    /** if value is already in array - return this value */
    if (foundBreakpoint) {
        return value;
    }

    /** if not - return the closest previous value  */
    const tmp = [...array, value].sort((a, b) => a - b);
    const idx = tmp.findIndex(el => el === value);

    return idx ? array[idx - 1] : value
}

/** returns the array of styles, filtering empty values that can be used in classList add */
const concatStyles = styles => {
    return styles.filter(el => el);
}

/**
 * We can receive 2 types of event: either Mouse or Touch.
 * For Mouse event current x-coordinate locate in event.clientX
 * For Touch event - in event.touches[0] - track only one touch
 * normalized to MouseEvent
 *
 * @param {MouseEvent | TouchEvent} evt
 * @returns {*}
 */
const resolveEvent = evt => {
    return evt.type.search('touch') !== -1 ? evt.touches[0] : evt;
}

/**
 * update slide width
 *
 * @param {HTMLElement} slide
 * @param {Number} width
 */
const updateSlideWidth = (slide, width) => {
    slide.style.width = `${width}px`
}


class CampusSlider {
    constructor(el, params= {}) {
        let containers;
        const sliderParams = Object.assign({}, defaultParams, params);

        /** if element and target container are not specified - we stop here */
        if (!el && !params.el) {
            return;
        }

        /** if we receive selector - look for it in the DOM */
        if (el) {
            containers = document.querySelectorAll(el);
        }

        if (containers) {
            if (containers.length > 1) {
                containers = Array.from(containers);

                /**
                 * if multiple containers found - repeat the process for each on
                 * yes, we can create another instance inside current one
                 */
                return containers.map(container => {
                    return new CampusSlider(null, {...sliderParams, el: container})
                });
            }

            if (containers.length === 1) {
                sliderParams.el = containers[0];
            }
        }

        /** if we cannot locate dom element for slider init, return null */
        if (!sliderParams.el) {
            return;
        }

        /** save initial params - necessary for breakpoints override */
        this.initParams = sliderParams;
        this.params = sliderParams;
        this.swipePosition = {
            posInit: 0,
            posX1: 0,
            posX2: 0,
            posFinal: 0,
            posThreshold: 0.4
        }

        /**
         * We bind this (slider instance) to touch events here due to 2 facts:
         * 1. We need a way to remove exact the same event handler after touch is over
         * 2. We need 'this' to be pointed to particular slider instance
         */
        this.swipeStart = this.swipeStart.bind(this);
        this.swipeEnd = this.swipeEnd.bind(this);
        this.swipeAction = this.swipeAction.bind(this);
        this.initSlider();
    }

    /** function to be called when resize is triggered */
    onResizeHandler() {
        const newCurrentBreakpoint = findCurrentBreakpoint(this.breakpointsKeys, window.innerWidth);

        /** if current breakpoint is the same as one before resize - params didn't change, so skip next part */
        if (this.currentBreakpoint !== newCurrentBreakpoint) {
            this.currentBreakpoint = newCurrentBreakpoint;
            this.updateSliderProps();

            if (this.params.navigation && this.slides.length > this.params.slidesPerView) {
                this.prevButton.classList.add('active')
                this.nextButton.classList.add('active')
            } else {
                this.prevButton.classList.remove('active')
                this.nextButton.classList.remove('active')
            }
        }

        /**
         * update slide width, since they depend on container width and slide per view param
         * needs to be run on each resize
         */
        this.containerWidth = this.params.el.offsetWidth;
        this.slides.forEach(slide => {
            updateSlideWidth(slide, this.getSlideWidth());
        })

        /** snap slide to beginning */
        this.toSlide(this.activeIndex)
    }

    /** rearrange slides and create additional wrappers for slider */
    initTrack() {
        const list = document.createElement('div');
        const track = document.createElement('div');
        const slideClasses = concatStyles([initParams.slideClass, this.params.additionalSlideClass]);

        list.classList.add(initParams.listClass);
        track.classList.add(initParams.trackClass);
        track.style.cssText = `
            transform: translate3d(0, 0, 0);
            transition: transform ${ this.params.speed}ms
        `
        /**
         *  children are actually not an array, they are NodeList, to use them as an array,
         *  they need to transform into one either by Array.from() or [...this.params.el.children]
         */
        this.slides = Array.from(this.params.el.children);

        this.slides.forEach(slide => {
            slide.classList.add(...slideClasses);
            updateSlideWidth(slide, this.getSlideWidth());
        })

        /** append actually move nodes to new parent */
        track.append(...this.params.el.children)
        list.append(track)
        this.params.el.append(list)
        this.track = track;
    }

    /** saves list of breakpoint for future use */
    initBreakpoints() {
        /**
         *  try to convert each breakpoint into number, using +
         *  filter non-numbers and numbers bellow 0
         *  sort number in DESC order
         */
        this.breakpointsKeys = Object.keys(this.params.breakpoints)
            .map(el => +el)
            .filter(el => Number.isInteger(el) && el >= 0)
            .sort((a, b) => a - b);

        this.currentBreakpoint = findCurrentBreakpoint(this.breakpointsKeys, window.innerWidth);
    }

    /** create dynamic navigation button */
    initNavigation() {
        const navigationHtml = `
        <button class="slider-control-prev slider-control button-hover" type="button">
            <span class="slider-control-prev-icon"><i class="fas fa-chevron-left"></i></span>
            <span class="slider-control-prev-title">Previous</span>
        </button>
        <button class="slider-control-next slider-control button-hover" type="button">
            <span class="slider-control-next-icon"><i class="fas fa-chevron-right"></i></span>
            <span class="slider-control-prev-title">Next</span>
        </button>
        `;

        this.params.el.insertAdjacentHTML('beforeend', navigationHtml);
        this.prevButton = this.params.el.querySelector('.slider-control-prev')
        this.nextButton = this.params.el.querySelector('.slider-control-next')

        if (this.params.navigation && this.slides.length > this.params.slidesPerView) {
            this.prevButton.classList.add('active')
            this.nextButton.classList.add('active')
        }
    }

    /** event registration */
    initEvents() {
        /** event delegation useful for dynamic content */
        this.params.el.addEventListener('click', event => {
            if (this.prevButton.contains(event.target)) {
                this.slidePrev()
            }

            if (this.nextButton.contains(event.target)) {
                this.slideNext()
            }
        })

        this.params.el.addEventListener('touchstart', this.swipeStart);
        this.params.el.addEventListener('mousedown', this.swipeStart);
    }

    /** update navigation button to track current index */
    updateNavigation() {
        if (this.params.loop) {
            return
        }

        switch (this.activeIndex) {
            case 0:
                this.prevButton.disabled = true
                break;
            case this.slides.length - this.params.slidesPerView:
                this.nextButton.disabled = true
                break;
            default:
                this.prevButton.disabled = false;
                this.nextButton.disabled = false;
        }
    }

    /** calculate current slide width */
    getSlideWidth() {
        return this.containerWidth / this.params.slidesPerView
    }

    updateSliderProps() {
        /** if breakpoints are empty, just skip it*/
        if (!this.breakpointsKeys.length) {
            return;
        }

        /**
         * filter out breakpoint higher that current window width
         * pick params for each breakpoint
         * merge together using init params
         */
        const currentBreakpoints = this.breakpointsKeys.filter(breakpoint => breakpoint <= this.currentBreakpoint);
        const breakpointCollection = currentBreakpoints.map(key => this.params.breakpoints[key]);
        this.params = breakpointCollection.reduce((acc, currVal) => {
            return {...acc, ...currVal}
        }, this.initParams)
    }

    /** action to determing next slide move */
    slideNext() {
        if (this.activeIndex + this.params.slidesPerView < this.slides.length) {
            this.toSlide(this.activeIndex + 1, this.params.speed);
        } else {
            if (this.params.loop) {
                this.toSlide(0, this.params.speed);
            } else {
                this.toSlide(this.activeIndex, this.params.speed);
            }
        }
    }

    /** action to determing prev slide move */
    slidePrev() {
        if (this.activeIndex - 1 >= 0) {
            this.toSlide(this.activeIndex - 1, this.params.speed);
        } else {
            if (this.params.loop) {
                this.toSlide(this.slides.length - this.params.slidesPerView, this.params.speed);
            } else {
                this.toSlide(this.activeIndex, this.params.speed);
            }
        }
    }

    /**
     * general purpose function to perform move to specified slide
     *
     * @param {Number} slideIndex
     * @param {Number} speed
     */
    toSlide(slideIndex, speed = 0) {
        const direction = slideIndex > 0 ? -1 : 1;
        /**  */
        const destination = slideIndex * this.getSlideWidth() * direction;
        this.track.style.transform = `translate3d(${destination}px, 0px, 0px)`;
        this.track.style.transition = `transform ${speed}ms`
        this.activeIndex = slideIndex;

        this.updateNavigation();
    }

    /**
     * Function fired on mousedown and touchstart
     *
     * @param evt
     */
    swipeStart(evt) {
        const event = resolveEvent(evt);
        this.swipePosition.posInit = this.swipePosition.posX1 = event.clientX
        this.track.style.transition = '';

        document.addEventListener('touchmove', this.swipeAction);
        document.addEventListener('touchend', this.swipeEnd);
        document.addEventListener('mousemove', this.swipeAction);
        document.addEventListener('mouseup', this.swipeEnd);
    }

    /** Function fired on mouseup and touchend */
    swipeEnd() {
        const {posInit, posX1} = this.swipePosition;
        this.swipePosition.posFinal = posInit - posX1;
        this.track.classList.remove(initParams.trackDragging)

        document.removeEventListener('touchmove', this.swipeAction);
        document.removeEventListener('mousemove', this.swipeAction);
        document.removeEventListener('touchend', this.swipeEnd);
        document.removeEventListener('mouseup', this.swipeEnd);

        this.toSlide(this.calculateSwipeDestinationIndex(), this.params.speed);
    }

    /** record mouse / touch movement */
    swipeAction(evt) {
        const event = resolveEvent(evt);
        const style = this.track.style.transform
        const transform = +style.match(transformRegex)[0];

        this.track.classList.add(initParams.trackDragging)
        this.swipePosition.posX2 = this.swipePosition.posX1 - event.clientX;
        this.swipePosition.posX1 = event.clientX;

        this.track.style.transform = `translate3d(${transform - this.swipePosition.posX2}px, 0px, 0px)`;
    }

    calculateSwipeDestinationIndex() {
        let newIndex = this.activeIndex;
        const slideWidth = this.getSlideWidth();

        /** check what direction we need to move slides */
        const direction = this.swipePosition.posFinal > 0 ? 1 : -1;
        const positionOffset = Math.abs(this.swipePosition.posFinal);

        /** check how many int slides can be fit in swipe offset */
        const indexOffset = Math.floor(positionOffset / slideWidth);

        /** check the float part */
        const thresholdOffset = (positionOffset % slideWidth) / slideWidth;

        /**
         *  if offset contains space for multiple slides to move like:
         *  0.15 - cannot be moved, 0.15 does not reach the threshold
         *  1.25 - can be moved to 1 slide, 0.25 does not reach the threshold
         *  1.75 - can be moved to 1 slide, 0.75 reaches the threshold so additional offset will be added in next step
         *  to left if direction is -1
         *  to right if direction is 1
         */
        if (indexOffset) {
            newIndex += indexOffset * direction;
        }

        /**
         *  if we reach threshold we can move one slide:
         *  to left if direction is -1
         *  to right if direction is 1
         */
        if (thresholdOffset > this.swipePosition.posThreshold) {
            newIndex += direction;
        }

        /**
         * Normalize indexes if we reach beginning or the end of sliders
         */
        if (newIndex < 0) {
            newIndex = this.params.loop ?  this.slides.length - this.params.slidesPerView : 0;
        } else if (newIndex > this.slides.length - this.params.slidesPerView) {
            newIndex = this.params.loop ? 0 : this.slides.length - this.params.slidesPerView;
        }

        /**
         * if none of previous steps overrode the newIndex it equals active index
         */
        return newIndex;
    }

    /** init slider */
    initSlider() {
        const {el, additionalSliderClass} = this.params;
        const sliderClasses = concatStyles([initParams.slideClass, additionalSliderClass, initParams.sliderInitialized]);

        window.addEventListener('resize', () => {
            this.onResizeHandler()
        })

        this.containerWidth = el.offsetWidth;
        this.activeIndex = 0;
        el.classList.add(...sliderClasses)
        this.initBreakpoints();
        this.updateSliderProps();
        this.initTrack();
        this.initNavigation();
        this.updateNavigation();
        this.initEvents();
    }
}

export default CampusSlider;