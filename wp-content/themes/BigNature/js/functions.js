// Pour les fonctions spécifiques en jQuery \\\\
jQuery( document ).ready(function($) {

    // ---------------------------------------------------------
    // VARIABLES
    // ---------------------------------------------------------

    

    // ---------------------------------------------------------
    // FUNCTIONS
    // ---------------------------------------------------------

    // ---------------------------------------------------------
    // INITIALISATIONS
    // ---------------------------------------------------------    
    
    // ---------------------------------------------------------
    //ANIMATIONS
    // ---------------------------------------------------------
    gsap.registerPlugin(ScrollToPlugin, ScrollTrigger);

/* Main navigation */
let panelsSection = document.querySelector("#panels"),
	panelsContainer = document.querySelector(".horizontal-scroll"),
	tween;

/* Panels */
const panels = gsap.utils.toArray(".horizontal-scroll .horizontal-scroll__item");
tween = gsap.to(panels, {
	xPercent: -100 * ( panels.length - 1 ),
	ease: "none",
	scrollTrigger: {
		trigger: ".horizontal-scroll",
		pin: true,
		start: "top top",
		scrub: 1,
		end: () =>  "+=" + (panelsContainer.offsetWidth - innerWidth)
	}
});
});
