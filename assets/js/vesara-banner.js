/**
 * Vesara Silks — Banner Slider JS  v1.1.0
 *
 * Fixes for hosted/production environments:
 * - Guards against elementorFrontend init event firing BEFORE this script loads.
 * - Uses MutationObserver as a last-resort fallback to catch banners injected by Elementor.
 * - Pure opacity crossfade — NO display toggling (eliminates layout glitch).
 * - All slides are position:absolute stacked. Only opacity + pointer-events change.
 */
(function () {
    'use strict';

    /**
     * Initialize a single banner wrapper.
     * @param {HTMLElement} wrapper
     */
    function initBanner( wrapper ) {
        if ( wrapper.classList.contains( 'vsw-initialized' ) ) return;
        wrapper.classList.add( 'vsw-initialized' );

        var slides     = Array.prototype.slice.call( wrapper.querySelectorAll( '.vsw-banner-slide' ) );
        var dots       = Array.prototype.slice.call( wrapper.querySelectorAll( '.vsw-banner-dot' ) );
        var autoplay   = wrapper.getAttribute( 'data-autoplay' ) === 'yes';
        var speed      = parseInt( wrapper.getAttribute( 'data-speed' ),      10 ) || 4000;
        var transition = parseInt( wrapper.getAttribute( 'data-transition' ), 10 ) || 700;
        var current    = 0;
        var total      = slides.length;
        var timer      = null;
        var animating  = false;

        if ( total <= 1 ) return;

        // Apply CSS transition duration from data attribute to every slide
        slides.forEach( function ( slide ) {
            var dur = ( transition / 1000 ) + 's';
            slide.style.transition = 'opacity ' + dur + ' ease, transform ' + dur + ' cubic-bezier(0.25, 0.8, 0.25, 1)';
        } );

        // Sync CSS animation duration for keyframes (like Ken Burns)
        wrapper.style.setProperty( '--vsw-anim-dur', ( speed + transition ) + 'ms' );

        /**
         * Cross-fade from current slide to nextIndex.
         * No display toggling — only opacity & pointer-events.
         */
        function goTo( nextIndex ) {
            if ( animating || nextIndex === current ) return;
            animating = true;
            stopAutoplay();

            var outgoing = slides[ current ];
            var incoming = slides[ nextIndex ];

            // Bring incoming above outgoing (z-index 3) while still invisible
            incoming.style.zIndex = '3';

            // Single rAF to ensure the browser has painted the z-index change
            requestAnimationFrame( function () {

                // Fade in incoming
                incoming.style.opacity       = '1';
                incoming.style.pointerEvents = 'auto';
                incoming.classList.add( 'vsw-slide-active' );

                // Fade out outgoing
                outgoing.style.opacity       = '0';
                outgoing.style.pointerEvents = 'none';
                outgoing.classList.remove( 'vsw-slide-active' );

                // After transition completes, reset z-index
                setTimeout( function () {
                    outgoing.style.zIndex = '1';
                    incoming.style.zIndex = '2';

                    // Sync dot indicators
                    dots.forEach( function ( dot, i ) {
                        dot.classList.toggle( 'active', i === nextIndex );
                    } );

                    current   = nextIndex;
                    animating = false;
                    startAutoplay();
                }, transition + 50 ); // small buffer over transition duration
            } );
        }

        /** Go to next slide (wrapping) */
        function next() {
            goTo( ( current + 1 ) % total );
        }

        /** Go to previous slide (wrapping) */
        function prev() {
            goTo( ( current - 1 + total ) % total );
        }

        /** Start the autoplay interval */
        function startAutoplay() {
            if ( ! autoplay || animating ) return;
            stopAutoplay();
            timer = setTimeout( function() {
                // Prevent memory leaks in Elementor editor when wrapper is removed
                if ( ! document.body.contains( wrapper ) ) {
                    stopAutoplay();
                    return;
                }
                next();
            }, speed );
        }

        /** Stop the autoplay interval */
        function stopAutoplay() {
            if ( timer ) {
                clearTimeout( timer );
                timer = null;
            }
        }

        // Dot click — jump to slide, reset timer
        dots.forEach( function ( dot, i ) {
            dot.addEventListener( 'click', function () {
                stopAutoplay();
                goTo( i );
                startAutoplay();
            } );
        } );

        // Touch / swipe support
        var touchStartX = 0;
        var touchStartY = 0;

        wrapper.addEventListener( 'touchstart', function ( e ) {
            touchStartX = e.touches[0].clientX;
            touchStartY = e.touches[0].clientY;
        }, { passive: true } );

        wrapper.addEventListener( 'touchend', function ( e ) {
            var deltaX = touchStartX - e.changedTouches[0].clientX;
            var deltaY = touchStartY - e.changedTouches[0].clientY;

            // Only trigger horizontal swipe if dominant axis
            if ( Math.abs( deltaX ) > Math.abs( deltaY ) && Math.abs( deltaX ) > 50 ) {
                stopAutoplay();
                if ( deltaX > 0 ) { next(); } else { prev(); }
                startAutoplay();
            }
        }, { passive: true } );

        // Kick off autoplay
        startAutoplay();
    }

    /**
     * Init all banners currently in DOM.
     */
    function initAllBanners() {
        document.querySelectorAll( '.vsw-banner-wrapper:not(.vsw-initialized)' ).forEach( function ( w ) {
            initBanner( w );
        } );
    }

    /**
     * Called by Elementor when the banner widget element is ready.
     * @param {jQuery} $scope
     */
    function widgetHandler( $scope ) {
        var wrapper = $scope[0].querySelector( '.vsw-banner-wrapper' );
        if ( wrapper ) {
            // Small delay so Elementor finishes injecting inner styles
            setTimeout( function () { initBanner( wrapper ); }, 150 );
        }
    }

    // ── Hook into Elementor Frontend ──────────────────────────────────────────
    //
    // Production-safe: On hosted sites, `elementor/frontend/init` may fire BEFORE
    // this script loads (script bundled late or async). We therefore check both:
    //   1. If elementorFrontend already exists and hooks are available — attach now.
    //   2. Otherwise listen for the window event as usual.
    //
    function attachElementorHook() {
        if ( typeof elementorFrontend !== 'undefined' && elementorFrontend.hooks ) {
            elementorFrontend.hooks.addAction(
                'frontend/element_ready/vsw_banner.default',
                widgetHandler
            );
        }
    }

    if ( typeof elementorFrontend !== 'undefined' && elementorFrontend.hooks ) {
        // elementorFrontend already initialised (script loaded after init event)
        attachElementorHook();
    } else {
        // Wait for init event
        window.addEventListener( 'elementor/frontend/init', attachElementorHook );
        // jQuery fallback (Elementor < 3.x)
        if ( typeof jQuery !== 'undefined' ) {
            jQuery( window ).on( 'elementor/frontend/init', attachElementorHook );
        }
    }

    // ── DOMContentLoaded fallback (non-editor / SSR pages) ───────────────────
    function onDOMReady() {
        var inEditor = ( typeof elementorFrontend !== 'undefined' &&
                         typeof elementorFrontend.isEditMode === 'function' &&
                         elementorFrontend.isEditMode() );

        if ( ! inEditor ) {
            initAllBanners();
        }
    }

    if ( document.readyState === 'loading' ) {
        document.addEventListener( 'DOMContentLoaded', onDOMReady );
    } else {
        // DOM already ready (script loaded deferred / at end of body)
        onDOMReady();
    }

    // ── MutationObserver: catch banners injected AFTER page load ─────────────
    // This handles Elementor popup, AJAX page loads, or dynamic widget rendering.
    if ( typeof MutationObserver !== 'undefined' ) {
        var observer = new MutationObserver( function ( mutations ) {
            var needsInit = false;
            mutations.forEach( function ( m ) {
                if ( m.addedNodes.length ) needsInit = true;
            } );
            if ( needsInit ) {
                document.querySelectorAll( '.vsw-banner-wrapper:not(.vsw-initialized)' ).forEach( function ( w ) {
                    setTimeout( function () { initBanner( w ); }, 100 );
                } );
            }
        } );
        document.addEventListener( 'DOMContentLoaded', function () {
            if ( document.body ) {
                observer.observe( document.body, { childList: true, subtree: true } );
            }
        } );
    }

})();
