/*global $:false, TweenLite:false, Back, Cubic, Quad, TweenMax, Expo, bw_theme_ajax, BoxesFx, _wpcf7 */
window.$ = window.$ = $;

var $body = $('body');
var $window = $(window);
var $newEl, layersPlaing;
var djaxBack = true;
var self, $oldEl;

var App = {
    firstPage: true,
    start: function () {

        "use strict";

        self = this;

        if ($('body').hasClass('djax-active')) {
            App.djax();
        }

        if ($('body').hasClass('image-copyright')) {
            App.image_copyright();
        }

        App.images();

        App.bind();

        App.popularWidget();

        App.pageAnimations('in');

        App.resize();

        App.onReady();

    },
    onReady: function () {
        "use strict";
        App.play.expandLayers(false);

        var loader = document.getElementById('loaderMask');
        loader.style.display = 'none';

    },
    image_copyright: function () {
        "use strict";
        var copyTimer;

        $(document).on('contextmenu', '.copyright, #kenburns img, #fotorama img, .bw-owl-slider img, .mfp-img', function (e) {
            clearTimeout(copyTimer);
            $('#image-copyright').show().css('top', e.screenY - 90).css('left', e.screenX + 10);
            copyTimer = setTimeout(function () {
                $('#image-copyright').fadeOut(150);
            }, 2000);
            return false;
        });

    },
    resize: function () {
        "use strict";
        //$window.resize(function() {
        $(window).on("debouncedresize", function () {

            if ($('#rail-slider').length) {
                App.play.rail.length();
                App.play.rail.focus(self.railIndex);
            }

        });

    },
    checkPlaying: function () {
        "use strict";
        if ($('.bmplayer-btn-play').hasClass('fa-pause')) {
            $('.bmplayer-controls-secondary').removeClass('hide');
        } else {
            $('.bmplayer-controls-secondary').addClass('hide');
        }
    },
    // addthis
    addthis: function () {
        "use strict";
        if ($('#bw-share').length || $('#bw-share-gallery').length) {
            if (typeof (window.addthis) !== 'undefined') {
                window.addthis = null;
                window._adr = null;
                window._atc = null;
                window._atd = null;
                window._ate = null;
                window._atr = null;
                window._atw = null;
            }
            $.getScript('//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-534b93e766f14c42');
        }
    },
    cf7: function () {
        "use strict";
        if ($('#bw-cf7').length && !App.firstPage) {

            _wpcf7.supportHtml5 = $.wpcf7SupportHtml5();
            $('div.wpcf7 > form').wpcf7InitForm();

        }
    },
    djax: function () {
        "use strict";
        var djax_transition = function ($newContent) {

            App.firstPage = false;

            $oldEl = this;
            $newEl = $newContent;

            $body.addClass('djax-content-ready');

            if ($body.hasClass('expand-layers') && !$body.hasClass('layers-plaing')) {
                App.animations.layOut();
            }

            // browser back button
            if (djaxBack) {

                $oldEl.fadeOut(300, function () {

                    $oldEl.after($newEl);
                    $oldEl.remove();
                    $newEl.hide().fadeIn(300);

                    if ($('#loaderMask').length) {
                        $('#loaderMask').hide();
                    }

                    App.pageAnimations('in');

                });
            }

            App.pageAnimations('in');

        };

        if (window.location === window.parent.location) {
            $body.djax('.djax-dynamic', ['.pdf', '.doc', '.eps', '.png', '.zip', 'admin', 'wp-', 'wp-admin', 'feed', '#', '?lang=', '&lang=', '&add-to-cart=', '?add-to-cart=', '?remove_item'], djax_transition);
        }

    },
    djaxRender: function () {
        "use strict";
        $oldEl.hide().after($newEl);
        $oldEl.remove();
        if ($('#loaderMask').length) {
            $('#loaderMask').hide();
        }

    },
    bind: function () {
        "use strict";
        $(document).on('keypress', '.search-form input', function (e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                var searchUrl = $('#searchform').attr('action') + '?s=' + encodeURIComponent($('#search').val());
                $('.search-location').attr('href', searchUrl).trigger('click');
            }
        });

        // search forms
        $(document).on('submit', '.search-form', function (e) {
            e.preventDefault();
            var searchUrl = $('#searchform').attr('action') + '?s=' + encodeURIComponent($('#search').val());
            $('.search-location').attr('href', searchUrl).trigger('click');
        });

        // like box
        $(document).on('click', '.like-box', function () {
            if (!$(this).hasClass('done')) {
                $(this).addClass('done').find('em').html(parseInt(($('.like-box em').html())) + 1);
                $.ajax({
                    type: "post",
                    url: bw_theme_ajax.ajax,
                    data: "action=__call_likebox&nonce=" + bw_theme_ajax.nonce + "&post_like=&post_id=" + $('.like-box').attr('data-post-id')
                });
            }
        });

        // isotope element hover
        $(document).on('mouseenter', '.isotope:not(.isotope-portfolio) .isotope-item:not(.gallery-cover) .over-effect', function () {

            var $this = $(this).closest('.isotope-item');

            var top = $('.border-hor.after', $this);
            var bottom = $('.border-hor.before', $this);
            var left = $('.border-ver.after', $this);
            var right = $('.border-ver.before', $this);
            var element = $('.element', $this);

            TweenLite.to(top, 0.4, {opacity: 1, right: 10, ease: Back.easeOut});
            TweenLite.to(left, 0.4, {opacity: 1, bottom: 10, ease: Back.easeOut, delay: 0.05});
            TweenLite.to(bottom, 0.4, {opacity: 1, left: 10, ease: Back.easeOut, delay: 0.15});
            TweenLite.to(right, 0.4, {opacity: 1, top: 10, ease: Back.easeOut, delay: 0.2});
            if (!$('.isotope').hasClass('isotope-blog')) {
                TweenLite.to(element, 0.6, {scale: 1.05, ease: Cubic.easeOut});
            }

        }).on('mouseout', '.isotope:not(.isotope-portfolio) .isotope-item:not(.gallery-cover) .over-effect', function () {

            var $this = $(this).closest('.isotope-item');

            var top = $('.border-hor.after', $this);
            var bottom = $('.border-hor.before', $this);
            var left = $('.border-ver.after', $this);
            var right = $('.border-ver.before', $this);
            var element = $('.element', $this);


            TweenLite.to($('.border'), 0.2, {opacity: 0, onComplete: function () {
                    TweenLite.to(top, 0.4, {right: '100%', ease: Back.easeOut});
                    TweenLite.to(left, 0.4, {bottom: '100%', ease: Back.easeOut, delay: 0.05});
                    TweenLite.to(bottom, 0.4, {left: '100%', ease: Back.easeOut, delay: 0.15});
                    TweenLite.to(right, 0.4, {top: '100%', ease: Back.easeOut, delay: 0.2});
                }});
            if (!$('.isotope').hasClass('isotope-blog')) {
                TweenLite.to(element, 0.4, {scale: 1, ease: Quad.easeOut});
            }

        });

        // portfolio element effects
        $(document).on('mouseenter', '.isotope-portfolio .isotope-item', function () {
            TweenLite.to($('.element', this), 0.4, {scale: 1.1, ease: Back.easeOut});
        }).on('mouseout', '.isotope-portfolio .isotope-item', function () {
            TweenLite.to($('.element', this), 0.4, {scale: 1, ease: Cubic.easeOut});
        });

        // On djax request
        $(window).bind('djaxClick', function (event, element) {

            event.preventDefault();

            djaxBack = false;

            $('.bw-layer').removeClass('layer-white');

            var djaxUrl = $(element).attr('href');

            if (djaxUrl.indexOf("?bw") >= 0) {
                $('.bw-layer').addClass('layer-white');
            }

            $body.removeClass('djax-content-ready');

            if ($body.hasClass('expand-layers')) {
                App.pageAnimations('out');
            }

            App.animations.layIn();

        });

        // disable empty url\'s
        $(document).on('click', 'a[href="#"]', function (e) {
            e.preventDefault();
        });

        // disable anchor, other links
        $(document).on('click', 'a[href*=#]', function (e) {
            e.preventDefault();
        });

        // fix for cart
        $(document).on('click', 'a.cart-contents', function (e) {
            e.preventDefault();
            $('#cart-location').trigger('click');
            return false;
        });

        // main menu toggle
        $(document).on('click', '#main-menu-toggle', function () {

            if (!$body.hasClass('expand-layers')) {

                var menuToggle = $('#main-menu-toggle'), menu = $('#main-menu');

                $('.bw-layer').removeClass('layer-white');

                if (menu.hasClass('visible')) {
                    menuToggle.addClass('close');
                } else {
                    menuToggle.removeClass('close');
                }

                $(this).toggleClass('close');

                if (!$body.hasClass('layers-plaing')) {

                    App.animations.layJustIn();
                    setTimeout(function () {
                        menu.toggleClass('visible');
                        App.animations.layJustOut();
                    }, 1000);

                }
            }

        });

        // add this rail gallery effect
        $(document).on('click', '#rail-buttons .rail-addthis', function () {

            var self = $(this);
            var element = $('#bw-share-gallery a');
            var c = 0;

            if (self.hasClass('animate')) {
                return;
            }

            if (!self.hasClass('open')) {

                self.addClass('open');

                TweenMax.staggerTo(element, 0.3,
                        {opacity: 1, visibility: 'visible'},
                0.075);
                TweenMax.staggerTo(element, 0.3,
                        {top: -12, ease: Cubic.easeOut},
                0.075);

                TweenMax.staggerTo(element, 0.2,
                        {top: 0, delay: 0.1, ease: Cubic.easeOut, onComplete: function () {
                                c++;
                                if (c >= element.length) {
                                    self.removeClass('animate');
                                }
                            }},
                0.075);

                self.addClass('animate');

            } else {

                TweenMax.staggerTo(element, 0.3,
                        {opacity: 0, onComplete: function () {
                                c++;
                                if (c >= element.length) {
                                    self.removeClass('open animate');
                                    element.css('visibility', 'hidden');
                                }
                                ;
                            }},
                0.075);

            }

        });

        // addthis article
        $(document).on('click', '.share-title', function () {

            var self = $(this);
            var element = $('#bw-share .addthis_toolbox a');
            var c = 0;

            if (self.hasClass('animate')) {
                return;
            }

            if (!self.hasClass('open')) {

                self.addClass('open');

                TweenMax.staggerTo(element, 0.2,
                        {opacity: 1, visibility: 'visible'},
                0.045);
                TweenMax.staggerTo(element, 0.2,
                        {top: -12, ease: Cubic.easeOut},
                0.045);

                TweenMax.staggerTo(element, 0.15,
                        {top: 0, delay: 0.1, ease: Cubic.easeOut, onComplete: function () {
                                c++;
                                if (c >= element.length) {
                                    self.removeClass('animate');
                                }
                            }},
                0.045);

                self.addClass('animate');

            } else {

                TweenMax.staggerTo(element, 0.3,
                        {opacity: 0, onComplete: function () {
                                c++;
                                if (c >= element.length) {
                                    self.removeClass('open animate');
                                    element.css('visibility', 'hidden');
                                }
                                ;
                            }},
                0.075);

            }

        });

        // social cions hover effect
        $('.social a').bind('mouseenter', function () {

            TweenLite.to($('.social-holder .pad'), 0.4, {opacity: 1, top: -7, left: $(this).position().left + 3, ease: Back.easeOut});

        }).bind('mouseleave', function () {

            TweenLite.to($('.social-holder .pad'), 0.4, {opacity: 0, top: -7});

        });

        // music player
        if ($('#bmplayer-container').length) {
            App.checkPlaying();
            $('.bmplayer-btn-play').bind('click', function () {
                setTimeout(function () {
                    App.checkPlaying();
                }, 50);
            });
        }

    },
    images: function () {
        "use strict";
        $('.box').each(function () {
            var $this = $(this);
            if ($('img', $this).length > 0) {
                var totalPercent = ($this.outerHeight() / $this.outerWidth()) * 100;
                var marginPix = ($this.outerHeight() - $('.thumb', $this).outerHeight()) * 0.5;
                var absolutePercent = marginPix / $this.outerHeight();
                $('.thumb', $this).css('margin-top', (absolutePercent * totalPercent) + '%');
            }
        });

    },
    popularWidget: function () {
        "use strict";
        var $tab = $('.bw-polular-widget-holder .bw-sidebar-posts');
        var $holder = $('.bw-polular-widget-holder');
        var $popularNav = $('.bw-popular-widget-nav a');

        $tab.hide();
        $('.bw-sidebar-posts:first', $holder).show(0);

        $popularNav.bind('click', function () {

            var $this = $(this);

            var $popularHolder = $(this).closest('.bw-polular-widget-holder');
            $('.bw-popular-widget-nav a', $popularHolder).removeClass('active');
            $this.addClass('active');

            $('.bw-sidebar-posts', $popularHolder).hide();
            $('.bw-sidebar-posts.' + $this.attr('data-parent'), $popularHolder).fadeIn(300);

        });

    },
    pageAnimations: function (direction) {
        "use strict";
        var e = $('#djax > #content > div, #djax > #content > article');

        switch (direction) {

            case 'in':
            {

                App.play.slider.start('in');
                App.addthis();
                App.cf7();

                if (e.hasClass('bw--mp')) {
                    App.play.mp.start('in');
                }
                if (e.hasClass('bw--article')) {
                    App.play.article();
                }
                if (e.hasClass('bw--page')) {
                    App.play.graph();
                }
                if (e.hasClass('bw--white')) {
                    App.play.white.start(e);
                }

                if (e.hasClass('bw--rail')) {
                    App.play.rail.start('in');
                    break;
                }
                if (e.hasClass('bw--isotope')) {
                    App.play.isotope.start('in');
                    break;
                }
                if (e.hasClass('bw--fotorama')) {
                    App.play.fotorama.start('in');
                    break;
                }
                if (e.hasClass('bw--kenburns')) {
                    App.play.kenburns.start('in');
                    break;
                }

                break;

            }
            case 'out':
            {

                App.play.slider.start('out');

                if (e.hasClass('bw--mp')) {
                    App.play.mp.start('out');
                }
                if (e.hasClass('bw--rail')) {
                    App.play.rail.start('out');
                    break;
                }
                if (e.hasClass('bw--isotope')) {
                    App.play.isotope.start('out');
                    break;
                }
                if (e.hasClass('bw--fotorama')) {
                    App.play.fotorama.start('out');
                    break;
                }
                if (e.hasClass('bw--kenburns')) {
                    App.play.kenburns.start('out');
                    break;
                }

                break;
            }

            default:
                break;
        }

    },
    play: {
        expandLayers: function (expand) {
            "use strict";
            var lTop = $('.bw-layer.top');
            var lBottom = $('.bw-layer.bottom');

            if (expand) {
                // in
                $body.addClass('expand-layers');
                TweenMax.to(lTop, 0.7, {width: '100%', ease: Expo.easeInOut});
                TweenMax.to(lBottom, 0.7, {width: '100%', ease: Expo.easeInOut, delay: 0.2});

                /*$('.bw-layer').each(function(i){
                 $(this).delay(0).animate({width:'100%'},800,'easeInOutExpo');
                 });*/

            } else {
                // out
                $body.removeClass('expand-layers');
                TweenMax.to(lTop, 0.7, {width: 0, ease: Expo.easeInOut});
                TweenMax.to(lBottom, 0.7, {width: 0, ease: Expo.easeInOut, onComplete: function () {
                        djaxBack = true;
                    }});

                /*$('.bw-layer').each(function(i){
                 $(this).delay(0).animate({width:'0%'},800,'easeInOutExpo');
                 });*/

            }

        },
        white: {
            start: function (e) {
                "use strict";
                if (e.hasClass('bw--white-delay')) {
                    App.play.white.run(0.45);
                } else {
                    App.play.white.run(0);
                }

            },
            run: function (delayAnimation) {
                "use strict";
                TweenMax.staggerTo($('.to--white'), 0.75,
                        {top: 0, ease: Expo.easeOut, delay: delayAnimation},
                0.15);

                TweenMax.staggerTo($('.to--white'), 0.45,
                        {opacity: 1, delay: delayAnimation},
                0.15);

            }

        },
        article: function () {
            "use strict";
            App.play.slider.run();

        },
        graph: function () {
            "use strict";
            if ($('.bargraph').length > 0) {
                $('.bargraph li').each(function () {
                    $('.bar-wrap span', this).addClass('visible');
                    TweenLite.to($('.bar-wrap span', this), 1.8, {delay: 0.15, width: $('.bar-wrap span', this).attr('data-width') + '%', ease: Expo.easeInOut});
                });
            }

        },
        mp: {
            start: function (direction) {
                "use strict";
                self = this;

                switch (direction) {

                    case 'in':
                    {

                        self.run();

                        break;
                    }
                    case 'out':
                    {

                        self.stop();

                        break;
                    }
                    default:
                        break;
                }
            },
            run: function () {
                "use strict";
                $('.mp-item').magnificPopup({
                    removalDelay: 500,
                    mainClass: 'mfp-fade',
                    image: {
                        titleSrc: function (item) {
                            var output = '';
                            if (typeof item.el.attr('data-title') !== "undefined" && item.el.attr('data-title') !== "") {
                                output = item.el.attr('data-title');
                            }
                            if (typeof item.el.attr('data-alt') !== "undefined" && item.el.attr('data-alt') !== "") {
                                output += '<small>' + item.el.attr('data-alt') + '</small>';
                            }
                            return output;
                        }
                    },
                    iframe: {
                        markup:
                                '<div class="mfp-figure mfp-figure--video">' +
                                '<button class="mfp-close"></button>' +
                                '<div>' +
                                '<div class="mfp-iframe-scaler">' +
                                '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>' +
                                '</div>' +
                                '</div>' +
                                '<div class="mfp-bottom-bar">' +
                                '<div class="mfp-title mfp-title--video"></div>' +
                                '<div class="mfp-counter"></div>' +
                                '</div>' +
                                '</div>',
                        patterns: {
                            youtube: {
                                index: 'youtube.com/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).
                                id: 'v=', // String that splits URL in a two parts, second part should be %id%
                                // Or null - full URL will be returned
                                // Or a function that should return %id%, for example:
                                // id: function(url) { return 'parsed id'; }
                                src: '//www.youtube.com/embed/%id%' // URL that will be set as a source for iframe.
                            },
                            vimeo: {
                                index: 'vimeo.com/',
                                id: '/',
                                src: '//player.vimeo.com/video/%id%'
                            },
                            gmaps: {
                                index: '//maps.google.',
                                src: '%id%&output=embed'
                            }
                            // you may add here more sources
                        },
                        srcAction: 'iframe_src' // Templating object key. First part defines CSS selector, second attribute. "iframe_src" means: find "iframe" and set attribute "src".
                    },
                    gallery: {
                        enabled: true,
                        navigateByImgClick: true,
                        // arrowMarkup: '<a href="#" class="mfp-arrow mfp-arrow-%dir% control-item arrow-button arrow-button--%dir%"></a>',
                        tPrev: 'Previous (Left arrow key)', // title for left button
                        tNext: 'Next (Right arrow key)', // title for right button
                        // tCounter: '<div class="gallery-control gallery-control--popup"><div class="control-item count js-gallery-current-slide"><span class="js-unit">%curr%</span><sup class="js-gallery-slides-total">%total%</sup></div></div>'
                        tCounter: '<div class="gallery-control gallery-control--popup"><a href="#" class="control-item arrow-button arrow-button--left js-arrow-popup-prev"></a><div class="control-item count js-gallery-current-slide"><span class="js-unit">%curr%</span>/<span class="js-gallery-slides-total">%total%</span></div><a href="#" class="control-item arrow-button arrow-button--right js-arrow-popup-next"></a></div>'
                    },
                    callbacks: {}
                }
                );

            },
            stop: function () {

                "use strict";

            }

        },
        slider: {
            start: function (direction) {
                "use strict";
                self = this;

                switch (direction) {

                    case 'in':
                    {
                        self.run();
                        self.bind();
                        break;
                    }

                    case 'out':
                    {
                        self.stop();
                        break;
                    }

                    default:
                        break;
                }

            },
            run: function () {
                "use strict";
                // box slider
                if ($('#boxgallery').length > 0) {

                    new BoxesFx(document.getElementById('boxgallery'));

                }

                // owl carousel
                var $owlSlider = $('.bw-owl-slider');

                if ($owlSlider.length > 0) {

                    $owlSlider.each(function () {
                        var self = $(this);
                        self.owlCarousel({
                            items: 1,
                            singleItem: true,
                            lazyLoad: true,
                            navigation: (self.hasClass('hide-nav')) ? false : true,
                            autoPlay: (self.hasClass('auto-play')) ? true : false,
                            pagination: true,
                            navigationText: false,
                            autoHeight: (self.hasClass('auto-height')) ? true : false,
                            transitionStyle: (self.attr('data-effect')) ? (self.attr('data-effect')) : false
                        });
                    });


                }

            },
            bind: function () {
                "use strict";
                var portfolioToggle = $('.portfolio-toggle'),
                        portfolio = $('.bw-portfolio');

                if (portfolioToggle.length) {
                    portfolioToggle.bind('click', function () {
                        portfolio.toggleClass('expand');
                    });
                }

            },
            stop: function () {

            }

        },
        kenburns: {
            start: function (direction) {
                "use strict";
                var self = this;

                switch (direction) {

                    case 'in':
                    {
                        self.run();
                        break;
                    }

                    case 'out':
                    {
                        break;
                    }

                    default:
                        break;
                }
            },
            run: function () {
                "use strict";
                var kb_images = [];

                $("#kb-images span").map(function () {
                    kb_images.push($(this).attr("data-src"));
                });

                $('#kenburns').Kenburns({
                    images: kb_images,
                    scale: 0.75,
                    duration: 8000,
                    fadeSpeed: 1200,
                    ease3d: 'cubic-bezier(0.445, 0.050, 0.550, 0.950)',
                    onSlideComplete: function () {

                    },
                    onLoadingComplete: function () {

                    }

                });

            }

        },
        fotorama: {
            start: function (direction) {
                "use strict";
                var self = this;

                switch (direction) {

                    case 'in':
                    {
                        self.run();
                        break;
                    }

                    case 'out':
                    {
                        self.stop();
                        break;
                    }

                    default:
                        break;
                }
            },
            run: function () {
                "use strict";
                var self = this;

                // 1. Initialize fotorama.
                self.fe = $("#fotorama").fotorama({
                    allowfullscreen: false,
                    arrows: true,
                    width: '100%',
                    maxWidth: '100%',
                    height: '100%',
                    minheight: '100%',
                    maxheight: '100%',
                    nav: "thumbs",
                    fit: "scaledown"
                });

                // 2. Get the API object.
                self.fotorama = self.fe.data('fotorama');

            },
            stop: function () {
                "use strict";
                var self = this;
                // 3. Kills the fotorama and restores the original content.
                self.fotorama.destroy();

            }
        },
        isotope: {
            start: function (direction) {
                "use strict";
                var self = this;

                switch (direction) {

                    case 'in':
                    {

                        self.run();
                        self.bg();
                        self.show();

                        $(window).on("debouncedresize", function () {
                            self.run();
                        });

                        break;
                    }
                    case 'out':
                    {

                        self.stop();
                        break;

                    }
                    default:
                        break;
                }

            },
            bg: function () {
                "use strict";
                if ($('.isotope-holder.light-gray').length) {
                    $('.isotope-holder.light-gray').addClass('doit');
                }
            },
            run: function () {
                "use strict";
                var $container = $('.isotope');
                var $containerFilter = $('.isotope-filter');

                // isotope filter
                if ($containerFilter.length > 0) {
                    $('li', $containerFilter).bind('click', function (e) {

                        e.preventDefault();

                        var filter = $(this).attr('data-filter');

                        $('.isotope-filter .filter-content span').html($(this).html());

                        if (typeof (filter) !== 'undefined') {
                            $container.isotope({'filter': '.' + filter});
                        } else {
                            $container.isotope({'filter': '*'});
                        }

                    });
                }

                var colWidth = function () {

                    var eleSpace = $container.attr('data-space');

                    var w = $container.width(),
                            columnNum = 1,
                            metroNum = 1,
                            portfolioNum = 1,
                            columnWidth = 0,
                            elementSpace = eleSpace;

                    if (w > 1200) {
                        columnNum = 5;
                        metroNum = 8;
                        portfolioNum = 3;
                    } else if (w > 900) {
                        columnNum = 4;
                        metroNum = 6;
                        portfolioNum = 3;
                    } else if (w > 600) {
                        columnNum = 3;
                        metroNum = 5;
                        portfolioNum = 2;
                    } else if (w > 300) {
                        columnNum = 2;
                        metroNum = 2;
                        portfolioNum = 1;
                    }

                    if ($container.hasClass('metro')
                            || $container.hasClass('catalog')
                            || $container.hasClass('isotope-blog')) {
                        columnWidth = Math.floor(w / metroNum);
                    } else if ($container.hasClass('isotope-portfolio')) {
                        columnWidth = Math.floor(w / portfolioNum);
                    } else {
                        columnWidth = Math.floor(w / columnNum);
                    }

                    $container.find('.isotope-item').each(function () {
                        var $item = $(this),
                                multiplier_w = $item.attr('class').match(/item-w(\d)/),
                                multiplier_h = $item.attr('class').match(/item-h(\d)/);

                        if ($container.hasClass('isotope-portfolio')) {

                            multiplier_h[1] = 1.2;
                        }

                        var width = multiplier_w ? columnWidth * multiplier_w[1] - elementSpace : columnWidth - elementSpace,
                                height = multiplier_h ? columnWidth * multiplier_h[1] * 0.5 - elementSpace : columnWidth * 0.5 - elementSpace,
                                metroHeight = multiplier_h ? columnWidth * multiplier_h[1] * 0.8 - elementSpace : columnWidth * 0.8 - elementSpace;

                        if (w <= 300) {
                            width = columnWidth - elementSpace;
                        }

                        if (w <= 600 && w > 300 && ($item.hasClass('item-w3') || $item.hasClass('item-w4'))) {
                            width = columnWidth - elementSpace;
                        }

                        $item.css({
                            width: width,
                            height: (!$container.hasClass('metro') && !$container.hasClass('catalog')) ? height : metroHeight
                        });

                    });
                    return columnWidth;
                };

                $(".isotope").isotope({
                    resizable: false,
                    transformsEnabled: false,
                    itemSelector: '.isotope-item',
                    masonry: {
                        columnWidth: colWidth(),
                        gutterWidth: 4,
                        rowHeight: 600
                    }
                });

                $('.isotope').imagesLoaded(function () {
                    setTimeout(function () {
                        $('.isotope').isotope('reloadItems').isotope();
                    }, 800);
                });

            },
            show: function () {
                "use strict";
                if (!$('.isotope').hasClass('isotope-blog')) {

                    var $animateElement = $('.isotope .isotope-item .element');

                    setTimeout(function () {
                        $('.isotope').addClass('transition');
                    }, 100);

                    setTimeout(function () {

                        $animateElement.each(function (e) {
                            (function (self, index) {
                                setTimeout(function () {

                                    TweenMax.to($(self), 0.3, {top: 0, alpha: 1, ease: Expo.easeOut});

                                    var $showAtts = $(self).closest('.isotope-item');

                                    if ($('.icon-video', $showAtts)) {
                                        $('.icon-video', $showAtts).addClass('visible');
                                    }
                                    if ($('.info', $showAtts)) {
                                        $('.info', $showAtts).addClass('visible');
                                    }

                                }, index * 55);
                            })(this, e);
                        });
                    }, 300);

                }

                if ($('.isotope').hasClass('isotope-blog')) {

                    var $animateElement = $('.isotope .isotope-item');

                    setTimeout(function () {

                        $animateElement.each(function (e) {
                            (function (self, index) {
                                setTimeout(function () {
                                    TweenMax.to($(self), 0.5, {opacity: 1, ease: Expo.easeOut});
                                    TweenMax.from($(self), 0.5, {marginTop: -50, ease: Expo.easeOut});
                                }, index * 65);
                            })(this, e);
                        });
                    }, 300);
                }

            },
            stop: function () {
                "use strict";
                $(".isotope").isotope('destroy');

            }

        },
        rail: {
            start: function (direction) {alert('ddd');
                "use strict";
                self.railIndex = 1;

                switch (direction) {

                    case 'in':
                    {

                        App.play.rail.length();
                        App.play.rail.focus(self.railIndex);
                        App.play.rail.mousewheel();
                        App.play.rail.cursors();
                        App.play.rail.nav();
                        App.play.rail.bind();

                        break;
                    }
                    case 'out':
                    {

                        $('#rail-screen').unbind();

                        break;
                    }
                    default:
                        break;
                }

            },
            bind: function () {
                "use strict";
                if ($body.hasClass('bw-is-mobile')) {

                    $('.bw--rail').bind("swipeleft", function () {
                        App.play.rail.focus(self.railIndex + 1);
                    });

                    $('.bw--rail').bind("swiperight", function () {
                        App.play.rail.focus(self.railIndex - 1);
                    });

                }

            },
            nav: function () {
                "use strict";
                $(document).on('click', '#rail.rail-next, #rail-buttons .rail-next', function () {
                    if (!$('#rail').hasClass('animate')) {
                        App.play.rail.focus(self.railIndex + 1);
                    }
                });

                $(document).on('click', '#rail.rail-prev, #rail-buttons .rail-prev', function () {
                    if (!$('#rail').hasClass('animate')) {
                        App.play.rail.focus(self.railIndex - 1);
                    }
                });

            },
            mousewheel: function () {
                "use strict";
                $(window)
                        .unbind('mousewheel')
                        .mousewheel(function (e, d) {

                            if (!$('#rail').hasClass('animate') && !$('#main-menu').hasClass('visible')) {
                                if (d > 0) {
                                    // scroll up
                                    App.play.rail.focus(self.railIndex - 1);
                                } else {
                                    // scroll down
                                    App.play.rail.focus(self.railIndex + 1);
                                }
                            }
                        });
            },
            cursors: function () {
                "use strict";
                $('#rail img').on('mouseenter', function () {alert('caciu');

                    var $this = $(this);

                    $('#rail').removeClass('rail-next rail-prev');

                    switch (true) {

                        case ($this.index() > self.railIndex) :
                        {

                            $('#rail').addClass('rail-next');

                            break;
                        }
                        case ($this.index() < self.railIndex) :
                        {

                            $('#rail').addClass('rail-prev');

                            break;
                        }
                        default :
                            return;
                    }

                });

            },
            focus: function (index) {
                "use strict";
                if ($('#rail img:eq(' + index + ')').length && !$('#rail').hasClass('animate') && index >= 0) {

                    $('#rail-buttons a span').removeClass('unactive');

                    if (index === 0) {
                        $('.rail-prev span').addClass('unactive');
                    }

                    if (index + 1 >= $('#rail img').length) {
                        $('.rail-next span').addClass('unactive');
                    }

                    self.railIndex = index;

                    $('#rail').addClass('animate');

                    var elementLeftPosition = parseInt($('#rail img:eq(' + index + ')').position().left, 10);

                    var centerPosition = (elementLeftPosition - ($window.width() * 0.5)) + $('#rail img:eq(' + index + ')').width() * 0.5;

                    TweenMax.to($('#rail img:not(:eq(' + index + '))'), 0.3, {delay: 0.3, opacity: 0.3});
                    TweenMax.to($('#rail img:eq(' + index + ')'), 0.3, {delay: 0.3, opacity: 1});

                    $('#rail img').removeClass('focus');
                    $('#rail img:eq(' + index + ')').addClass('focus');

                    TweenMax.to($('#rail-slider'), 0.8, {left: -centerPosition, ease: Expo.easeInOut, onComplete: function () {

                            $('#rail').removeClass('animate');

                        }});

                    App.play.rail.info(index);

                }

            },
            info: function (index) {
                "use strict";
                var $hidden = $('#rail-hidden'),
                        $info = $('#rail-info'),
                        title = $('li:eq(' + index + ')', $hidden).attr('data-title');

                TweenMax.to($('.img-title', $info), 0.3, {opacity: 0, bottom: -60, ease: Cubic.easeIn, onComplete: function () {
                        $('.img-title', $info).html(title);
                        TweenMax.to($('.img-title', $info), 0.3, {opacity: 1, bottom: 0, ease: Cubic.easeOut});
                    }});

                TweenMax.to($('.img-desc', $info), 0.3, {opacity: 0, top: -40, ease: Cubic.easeIn, onComplete: function () {
                        var source = '';
                        source += $('#rail-source li:eq(' + index + ')').html();
                        $('.img-desc', $info).html((index + 1) + ' ' + $info.attr('data-from') + ' ' + $('li', $hidden).length + ' ' + $info.attr('data-photos') + ((($.trim(source) !== '') ? ', ' : '') + source));
                        TweenMax.to($('.img-desc', $info), 0.3, {opacity: 1, top: 0, ease: Cubic.easeOut});
                    }});

            },
            length: function () {
                "use strict";
                var totalRailWidth = 0;

                $('#rail img').each(function () {
                    totalRailWidth += parseInt($(this).width(), 10);
                });

                totalRailWidth += 15000;

                $('#rail-slider').width(totalRailWidth);
                $('#rail').width(totalRailWidth + (totalRailWidth * 0.01));

            }

        }

    },
    animations: {
        layIn: function () {
            "use strict";
            $('.bw-layer').removeClass('stuck');

            App.play.expandLayers(true);
            $body.addClass('layers-plaing');

            clearTimeout(layersPlaing);

            layersPlaing = setTimeout(function () {

                if ($newEl) {
                    if ($newEl.find('.isotope:not(.isotope-blog):not(.do-no-stuck)').length) {
                        $('.bw-layer').addClass('stuck');
                    }
                }

                $('html, body').animate({scrollTop: 0}, 0);

                $body.removeClass('layers-plaing');

                if ($body.hasClass('djax-content-ready')) {
                    App.animations.layOut();
                }

                App.pageAnimations('in');

            }, 1000);

        },
        layOut: function () {
            "use strict";
            App.djaxRender();

            $('#main-menu-toggle').removeClass('close');

            if ($('#main-menu').hasClass('visible')) {
                $('#main-menu').toggleClass('visible');
            }

            if (!$body.hasClass('layers-plaing')) {
                App.play.expandLayers(false);
            }

            if ($('#loaderMask').length) {
                $('#loaderMask').hide();
            }

        },
        layJustIn: function () {
            "use strict";
            $('.bw-layer').removeClass('stuck');

            App.play.expandLayers(true);
            $body.addClass('layers-plaing');

            clearTimeout(layersPlaing);

            layersPlaing = setTimeout(function () {
                $body.removeClass('layers-plaing');
            }, 1000);

        },
        layJustOut: function () {

            "use strict";
            App.play.expandLayers(false);

            if ($('#loaderMask').length) {
                $('#loaderMask').hide();
            }

        }

    }
};

$.extend({
    myFunc: function (someArg, callbackFnk) {
        "use strict";
        var url = "http://example.com?q=" + someArg;
        $.getJSON(url, function (data) {

            // now we are calling our own callback function
            if (typeof callbackFnk === 'function') {
                callbackFnk.call(this, data);
            }

        });
    }
});

$(window).load(function () {
    "use strict";
    App.start();
});