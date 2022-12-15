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
    gsap.registerPlugin(ScrollTrigger);

    /* Main navigation */
    let panelsSection = document.querySelector("#panels"),
        panelsContainer = document.querySelector(".horizontal-scroll");

    /* Panels */
    const panels = gsap.utils.toArray(".horizontal-scroll .horizontal-scroll__item");
    const intros = gsap.utils.toArray(".engagement-intros .engagement-intro");
    gsap.to(intros,{
        opacity:0
    });
    gsap.to(panels, {
        xPercent: -120 * ( panels.length - 1 ),
        ease: "none",
        scrollTrigger: {
            trigger: ".horizontal-scroll",
            pin: "#panels",
            start: "top top",
            scrub: 1,
            snap: 1 / (panels.length - 1),
            onUpdate: self => {
                if(self.progress>= 0 && self.progress<=0.25){
                    
                    gsap.to("#intro-2",{opacity:0})
                    gsap.to("#intro-3",{opacity:0})
                    gsap.to("#intro-4",{opacity:0})
                    gsap.to("#intro-1",{opacity:1})
                }
                if(self.progress>= 0.26 && self.progress<=0.50){
                    gsap.to("#intro-1",{opacity:0})
                    gsap.to("#intro-3",{opacity:0})
                    gsap.to("#intro-4",{opacity:0})
                    gsap.to("#intro-2",{opacity:1})
                }
                if(self.progress>= 0.51 && self.progress<=0.75){
                    gsap.to("#intro-1",{opacity:0})
                    gsap.to("#intro-2",{opacity:0})
                    gsap.to("#intro-4",{opacity:0})
                    gsap.to("#intro-3",{opacity:1})
                }
                if(self.progress>= 0.76 && self.progress<=1){
                    gsap.to("#intro-1",{opacity:0})
                    gsap.to("#intro-2",{opacity:0})
                    gsap.to("#intro-3",{opacity:0})
                    gsap.to("#intro-4",{opacity:1})
                }
            },
            end: () =>  "+=" + (panelsContainer.offsetWidth - innerWidth)

        }
    });



});
