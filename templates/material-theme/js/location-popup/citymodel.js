var IndexClass = BaseClass.extend({
    init: function () {
        this._super();
        if (window.sitecode == 'olxin') this.initGeoAutoSuggest();
        this.initGeosuggest();
        this.initOther();
        this.initFacebook();
        if (this.isModuleActive('island_trending')) this.initIsland('trendingads', 'INT-3-[HP]');
        if (this.isModuleActive('island_interesting')) this.initIsland('interestingads', 'INT-4-[HP]');
        this.initTable();
        this.initFacebookBug();
        if (this.isModuleActive('phoneusers')) this.initMergeForm();
        if (this.isModuleActive('paid_subscriptions')) this.initPaidSubscriptionsNotice();
        this.initLatestAds();
        if ($('.latestads').is(':visible') == true) this.initCarousel();
        this.youTubePlayer();
        if ($('#loginprompt').length) this.initLoginPrompt();
        $('.app-dl-banner').click(function (e) {
            if (!$(e.target).hasClass('dl-link')) window.location = $(this).data("location")
        })
    },
    initLoginPrompt: function () {
        if (!window.user_logged) $('#loginprompt').show()
    },
    initFacebook: function () {
        if (typeof fb_connect_url == 'undefined') return false;
        var cache = $.ajaxSettings.cache;
        $.ajaxSettings.cache = true;
        $.getScript(fb_connect_url, function () {
            FB.init({
                appId: fb_app_id,
                status: true,
                cookie: true,
                xfbml: true
            })
        });
        $.ajaxSettings.cache = cache
    },
    fblockActive: function (element, space) {
        $(space).find('.fblock').removeClass('active');
        $(element).closest('.fblock').addClass('active')
    },
    geolocation: function () {
        var dfd = $.Deferred(),
            errorText = 'Fail to read your position';
        if (navigator.geolocation && ('getCurrentPosition' in navigator.geolocation)) {
            navigator.geolocation.getCurrentPosition(function (position) {
                $(this).trigger('geolocalized', [position.coords]);
                dfd.resolve(position.coords)
            }, function (error) {
                switch (error.code) {
                    case error.PERMISSION_DENIED:
                        errorText = errorText;
                        break;
                    case error.POSITION_UNAVAILABLE:
                        errorText = errorText;
                        break;
                    case error.TIMEOUT:
                        errorText = errorText + ' (Timeout)';
                        break;
                    case error.UNKNOWN_ERROR:
                        errorText = errorText;
                        break
                }
                ;
                if (!error || typeof error !== 'object') error = {};
                error.value = errorText;
                dfd.reject(error)
            }, {
                timeout: 5e3
            })
        } else {
            error = {};
            error.value = errorText;
            dfd.reject(error)
        }
        ;
        return dfd.promise()
    },
    initGeoAutoSuggest: function () {
        var thiz = this,
            isRegionSelected = false,
            hasResults = true;
        if (!isRegionSelected && hasResults && $.cookie('i2GeoSuggest') != 1) $.when(thiz.geolocation()).then(function (data) {
            $.get(www_base + '/i2/ajax/suggest/city/', {
                lon: data.longitude,
                lat: data.latitude,
                suggest: '1'
            }, function (data) {
                if (data != '') {
                    $container = $('.chooselocationPop');
                    $links = $container.find('ul');
                    $links.html(data);
                    $container.show();
                    $.fn.geosuggest.bindAutoSuggestCitiesLinks($container, $.fn.geosuggest.settings);
                    $container.find('a.close').click(function (e) {
                        e.preventDefault();
                        $.cookie('i2GeoSuggest', '1', {
                            expires: null,
                            path: '/',
                            domain: '.' + session_domain
                        });
                        $container.remove()
                    })
                }
            })
        })
    },
    initGeosuggest: function () {
        var thiz = this,
            $input = $('#cityField'),
            defaultText = $input.attr('defaultval'),
            defaultAlternative = $input.attr('defaultalternative');
        $input.focus(function () {
            if ($input.val() == defaultText || $input.val() == defaultAlternative) $input.val('');
            if ($input.val() == '') {
                $input.val(defaultAlternative);
                $input.addClass('ca2');
                $input.setSelection(0, 0)
            } else {
                var inputLength = $input.val().length;
                $input.setSelection(inputLength, inputLength)
            }
            ;
            thiz.fblockActive(this, '.searchmain')
        }).blur(function () {
            if ($input.val() == defaultAlternative) $input.val(defaultText)
        }).keydown(function () {
            if ($input.val() == defaultText || $input.val() == defaultAlternative) $input.val('').removeClass('ca2')
        }).geosuggest({
            showGeoSuggestions: false,
            saveAsDefaultLocationInCookie: true,
            loadDefaultLocationFromCookie: true,
            distanceSelect: $('#distanceSelect'),
            citiesOld: window.module_cities_old === 1,
            locationChanged: function (text, regionID, cityID, districtID, distance, byUser, locUrl) {
                var url = '';
                if (typeof locUrl !== "undefined") url = locUrl.replace(';', '_').replace(':', '-');
                if (sitecode == 'olxua' || (sitecode == 'olxkz' && window.module_cities_old == 1)) {
                    $('#maincat-grid').find('a[data-search="1"]').each(function () {
                        $(this).attr('href', $(this).data('url').replace(/(http[s]?:\/\/)/g, "\$1" + url + (url.length ? '.' : '')))
                    })
                } else {
                    if (typeof districtID !== "undefined" && districtID != 0) {
                        url += '/?search[district_id]=' + districtID;
                        if (typeof distance !== "undefined" && distance != 0) url += '&search[dist]=' + distance
                    } else if (url.length && typeof distance !== "undefined" && distance != 0) url += '/?search[dist]=' + distance;
                    $('#maincat-grid').find('a[data-search="1"]').each(function () {
                        $(this).attr('href', $(this).data('url') + url)
                    })
                }
                ;
                if (thiz.isModuleActive('island_trending')) thiz.get('island', 'trending', {
                    cityID: cityID
                }, function (response) {
                    if (response.status === 'ok' && response.content !== '') {
                        $('#island-trendingads .trendingads-carousel').html(response.content);
                        thiz.initIsland('trendingads', 'INT-3-[HP]')
                    }
                })
            }
        })
    },
    initOther: function () {
        var thiz = this;
        $.fn.setCursorPosition = function (pos) {
            this.each(function (index, elem) {
                if (elem.setSelectionRange) {
                    elem.setSelectionRange(pos, pos)
                } else if (elem.createTextRange) {
                    var range = elem.createTextRange();
                    range.collapse(true);
                    range.moveEnd('character', pos);
                    range.moveStart('character', pos);
                    range.select()
                }
            });
            return this
        };
        $('input#headerSearch').focus(function () {
            $this = $(this);
            if ($this.val() == '') {
                $this.addClass('ca2').val($this.attr('defaultval'));
                $this.setCursorPosition(0)
            } else if ($this.val() == $this.attr('defaultval')) {
                $this.val($this.attr('defaultval'));
                $this.setCursorPosition(0)
            }
            ;
            $('#distanceSelect').find('ul').addClass('hidden').hide();
            $('#categorySelectList').hide();
            thiz.fblockActive(this, '.searchmain')
        }).keydown(function () {
            $this = $(this);
            if ($this.val() == $this.attr('defaultval')) $this.removeClass('ca2').val('')
        }).keyup(function () {
            $this = $(this);
            if ($this.val().length == 0) {
                $this.addClass('ca2').val($this.attr('defaultval'));
                $this.setCursorPosition(0)
            }
        }).click(function () {
            $this = $(this);
            if ($this.val() == $this.attr('defaultval')) $this.setCursorPosition(0)
        }).bind('paste', function () {
            $this = $(this);
            if ($this.val() == $this.attr('defaultval')) $this.removeClass('ca2').val('')
        });
        if ($.inArray(sitecode, ['olxpk', 'otomotopl', 'autovitro']) == -1 || $.cookie('newolx') != null) $('input#headerSearch').focus();
        $('#lastsearchclear').click(function () {
            $this = $(this);
            $.get(www_base_ajax + '/misc/clearcategories/', function () {
                $('.lastsearch, .youractivity').fadeOut()
            });
            return false
        });
        var allTags = null,
            maxSpace = $('#lastsearchBox').width() - $('#lastsearchclear').outerWidth(true);
        $('#lastsearchBox a.item').each(function (index) {
            allTags += ($(this).outerWidth(true));
            if (maxSpace > allTags) $(this).show()
        });
        mediaQuery();
        $(window).resize(function () {
            mediaQuery()
        })

        function mediaQuery() {
            var windowWidth = $(window).width();
            if (windowWidth < '1110') {
                $('body').addClass('smallscreen')
            } else $('body').removeClass('smallscreen')
        };
        if ($('#categorySelect').size() > 0) {
            var dropdownHeight = $('#categorySelectList > li').length * 28,
                dropdownTopMargin = $('#categorySelect').offset().top + $('#categorySelect').height();

            function scaleDropDown() {
                if ($('#categorySelectList').is(':visible')) {
                    var viewportHeight = $(window).height(),
                        viewportSpace = viewportHeight - dropdownTopMargin - 18 + $(document).scrollTop();
                    if (dropdownHeight < viewportSpace) {
                        $('#categorySelectList').css('max-height', 'none')
                    } else $('#categorySelectList').css('max-height', viewportSpace)
                }
            };
            $(window).resize(function () {
                scaleDropDown()
            });
            $('#categorySelect').click(function () {
                thiz.fblockActive(this, '.searchmain');
                var $selectList = $('#categorySelectList');
                $selectList.toggle();
                $selectList.is(':visible') ? $(document).trigger('hidedropdowns') : '';
                scaleDropDown();
                return false
            });
            $('.categorySelectA1, .categorySelectA2').click(function () {
                $('#categorySelectList').hide();
                $('#categorySelectHidden').val($(this).data('id'));
                $('#categorySelectName').text($(this).data('name'));
                $('#categorySelect').addClass('data-inserted');
                $("#categorySelect").removeClass(function (index, css) {
                    return (css.match(/\ba-category-\S+/g) || []).join(' ')
                });
                $('#categorySelect').addClass($(this).data('icon_class'));
                return false
            });
            $(document).bind('click', function (e) {
                var $clicked = $(e.target);
                if (!$clicked.parents().hasClass('categorySelectList')) $('#categorySelectList').hide()
            });
            var timer = null;

            function getFacets() {
                if (timer != null) window.clearTimeout(timer);
                timer = window.setTimeout(function () {
                    var $input = $('input#headerSearch'),
                        oldValue = $input.val();
                    if ($input.val() == $input.attr('defaultval')) $input.val('');
                    $.post(www_base_ajax + '/searchfacets/', $('#searchmain').serialize(), function (data) {
                        var categoriesStats = data.data;
                        $('.categorySelectA1, .categorySelectA2').find('span.counter').each(function () {
                            if (categoriesStats[$(this).data('id')]) {
                                $(this).html(categoriesStats[$(this).data('id')]).removeClass('hidden')
                            } else $(this).addClass('hidden')
                        })
                    });
                    $input.val(oldValue)
                }, 600)
            };
            $('body').live('geo-suggest-selected', function (e) {
                getFacets()
            });
            $('select#distanceSelect, #cityField').change(function () {
                getFacets()
            });
            $('input#headerSearch').blur(function () {
                getFacets()
            })
        }
    },
    initIsland: function (islandName, trackerID) {
        var thiz = this,
            numberOfThumbs = 4,
            cDiv = $('.' + islandName + '-carousel');
        for (var i = 0; i < numberOfThumbs; i++) {
            var $currentDiv = $(cDiv.find('div')[i]),
                $img = $currentDiv.find('img');
            $img.attr('src', $img.data('src'))
        }
        ;
        this[islandName + 'Carousel'] = {
            prevArrow: $('#island-' + islandName + ' .prev-arrow'),
            nextArrow: $('#island-' + islandName + ' .next-arrow'),
            cDiv: cDiv,
            wrapper: $('#island-' + islandName + ' .wrapper'),
            bottomDots: $('#island-' + islandName + ' .island-bottom-dots'),
            slidesToShow: numberOfThumbs,
            startSlide: numberOfThumbs + 1,
            curPos: 0,
            lock: false,
            offsetLeft: 0,
            wrapperWdth: 0,
            curDot: 0,
            init: function () {
                var obj = thiz[islandName + 'Carousel'];
                if (obj.cDiv.length == 0) return;
                obj.curPos = 0;
                obj.lock = false;
                obj.startSlide = 4 + 1;
                obj.slideWidth = $(obj.cDiv.find('div')[0]).outerWidth(true);
                obj.totSlides = $(obj.cDiv.find('div')).length;
                obj.slideGap = parseInt($(obj.cDiv.find('div')[0]).css("marginRight"));
                obj.wrapperWdth = (obj.slideWidth * obj.slidesToShow) - obj.slideGap + 5;
                obj.wrapper.css({
                    width: obj.wrapperWdth + 'px'
                });
                obj.cDiv.css({
                    width: (obj.slideWidth * obj.totSlides) + 'px',
                    left: '0'
                });
                obj.offsetLeft = (obj.cDiv.position().left > 0) ? obj.cDiv.position().left : 0;
                obj.initDots();
                obj.updateArrows();
                obj.bindEvents()
            },
            initDots: function () {
                var obj = thiz[islandName + 'Carousel'],
                    dots = '';
                for (var i = 0; i < obj.totSlides / obj.slidesToShow; i++) dots += '<span></span>';
                obj.bottomDots.html('').append(dots);
                var offsetLast = (obj.bottomDots.find('span').length > 1) ? parseInt($(obj.bottomDots.find('span').last()).css("marginRight")) : 0,
                    width = $(obj.bottomDots.find('span')[0]).outerWidth(true) * $(obj.bottomDots.find('span')).length + offsetLast,
                    left = (obj.wrapperWdth - width) / 2;
                obj.bottomDots.css({
                    width: width + 'px',
                    left: left + 'px'
                });
                obj.curDot = 0;
                $(obj.bottomDots.find('span')[obj.curDot]).addClass('active')
            },
            bindEvents: function () {
                var obj = thiz[islandName + 'Carousel'];
                obj.prevArrow.unbind('click');
                obj.prevArrow.bind('click', function () {
                    if ($(this).hasClass('disable') != true && obj.lock != true) obj.startAnim('right')
                });
                obj.nextArrow.unbind('click');
                obj.nextArrow.bind('click', function () {
                    if ($(this).hasClass('disable') != true && obj.lock != true) {
                        obj.startAnim('left');
                        var i;
                        for (i = obj.startSlide; i < (obj.startSlide + obj.slidesToShow); i++) {
                            var $currentDiv = $(obj.cDiv.find('div')[i - 1]);
                            $currentDiv.removeClass('hidden');
                            var $img = $currentDiv.find('img');
                            $img.attr('src', $img.data('src'))
                        }
                        ;
                        obj.startSlide = i
                    }
                });
                obj.cDiv.find('div a').unbind('click');
                obj.cDiv.find('div a').bind('click', function (event) {
                    $this = $(this);
                    event = event || window.event;
                    xt_adc(this, trackerID)
                });
                obj.cDiv.find('div img').unbind('load');
                obj.cDiv.find('div img').load(function () {
                    $(this).parent().find('span.loader').delay(800).fadeOut(500)
                })
            },
            startAnim: function (dir) {
                var obj = thiz[islandName + 'Carousel'];
                obj.lock = true;
                var dist = obj.slideWidth * obj.slidesToShow,
                    pos = (dir == 'left') ? obj.cDiv.position().left - (dist + obj.offsetLeft) : obj.cDiv.position().left + (dist - obj.offsetLeft);
                obj.cDiv.animate({
                    left: pos + 'px'
                }, "slow", function () {
                    obj.updateCurPos(dir)
                })
            },
            updateCurPos: function (dir) {
                var obj = thiz[islandName + 'Carousel'];
                if (dir == 'left') {
                    if (obj.curPos < obj.totSlides) obj.curPos += obj.slidesToShow
                } else if (obj.curPos > 0) obj.curPos -= obj.slidesToShow;
                obj.updateArrows();
                obj.updateDots(dir)
            },
            updateArrows: function () {
                var obj = thiz[islandName + 'Carousel'];
                if (obj.curPos == 0 && obj.slidesToShow > obj.totSlides) {
                    obj.nextArrow.addClass('disable');
                    obj.prevArrow.addClass('disable')
                } else if (obj.curPos == 0 && obj.slidesToShow < obj.totSlides) {
                    obj.nextArrow.removeClass('disable');
                    obj.prevArrow.addClass('disable')
                } else if ((obj.curPos + obj.slidesToShow) >= obj.totSlides) {
                    obj.nextArrow.addClass('disable');
                    obj.prevArrow.removeClass('disable')
                } else {
                    obj.prevArrow.removeClass('disable');
                    obj.nextArrow.removeClass('disable')
                }
                ;
                obj.lock = false
            },
            updateDots: function (dir) {
                var obj = thiz[islandName + 'Carousel'];
                $(obj.bottomDots.find('span')).removeClass('active');
                if (dir == 'left') {
                    obj.curDot += 1
                } else if (obj.curDot > 0) obj.curDot -= 1;
                $(obj.bottomDots.find('span')[obj.curDot]).addClass('active')
            }
        };
        thiz[islandName + 'Carousel'].init()
    },
    initFacebookBug: function () {
        if (window.location.hash == '#_=_') {
            window.location.hash = '';
            if ($.type(history.pushState) != 'undefined') history.pushState('', document.title, window.location.pathname)
        }
    },
    initMergeForm: function () {
        var $form = $('#mergemail');
        $form.validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                    maxlength: 255
                }
            },
            messages: {
                email: {
                    required: 'This field is required',
                    email: 'Invalid email format',
                    maxlength: 'Cannot be longer than 255 chars'
                }
            }
        });
        var $form = $('#mergesms');
        $form.validate({
            rules: {
                phone: {
                    required: true,
                    cellphone: true
                }
            },
            messages: {
                phone: {
                    required: 'This field is required'
                }
            }
        })
    },
    initTable: function () {
        var hasPager = $('.pager').length > 0,
            eventClick = (Main.isTouchDevice()) ? "touchstart click" : "click",
            $form = $('#userAdsFrom');
        if (!$form.length) return;
        var $globalCheckbox = $('#globalCheckbox'),
            $checkboxes = $('#adsTable tbody input.checkbox'),
            $globalActions = $('#globalActions li'),
            $globalLinks = $('#globalLinks'),
            actualType = $globalLinks.data("type"),
            fanPageVisible = $.cookie('facebooksuccess') == null,
            $inputSearch = $('[name="title"]', $form),
            $clearButton = $inputSearch.siblings('.clear-input-button'),
            startWithValue = $inputSearch.val() != $inputSearch.data("defaultText");
        $inputSearch.focus(function () {
            $inputSearch.removeClass('ca2').parent().find('.button').addClass('active');
            var val = $.trim($inputSearch.val());
            if (val == $inputSearch.data("defaultText")) $inputSearch.val('')
        }).blur(function () {
            var val = $.trim($inputSearch.val());
            if (!val) {
                $inputSearch.val($inputSearch.data("defaultText"));
                $inputSearch.addClass('ca2').parent().find('.button').removeClass('active')
            }
        });
        if ($inputSearch.val() != $inputSearch.data("defaultText")) $inputSearch.removeClass('ca2').parent().find('.button').addClass('active');
        $inputSearch.bind('keyup change paste input', function (e) {
            var $this = $(this);
            if ($this.val().length > 0 && $this.val() != $this.data("defaultText")) {
                $clearButton.removeClass('hidden')
            } else $clearButton.addClass('hidden')
        });
        $clearButton.click(function () {
            $(this).addClass('hidden');
            $inputSearch.val('').focus();
            if (startWithValue) $form.submit()
        });
        $form.submit(function () {
            if ($inputSearch.val() == $inputSearch.data("defaultText")) {
                return false
            } else return true
        });
        var showGlobalActions = function (checkGlobalState, sender) {
                var $globalCheckboxRender = $globalCheckbox.closest('th').find('label.f_checkbox'),
                    $checkedCheckboxes = $checkboxes.filter(':checked:visible'),
                    allCounter = $checkboxes.filter(':visible').length;
                if (checkGlobalState)
                    if (!$checkedCheckboxes.length) {
                        $globalCheckbox.attr('checked', false);
                        $globalCheckboxRender.removeClass('selected').removeClass('disabled');
                        $globalActions.closest('thead').find('.globalActionHide').css('visibility', 'visible')
                    } else {
                        $globalCheckbox.attr('checked', 'checked');
                        $globalCheckboxRender.addClass('selected');
                        if ($checkedCheckboxes.length == allCounter) {
                            $globalCheckboxRender.removeClass('disabled')
                        } else $globalCheckboxRender.addClass('disabled');
                        $globalActions.closest('thead').find('.globalActionHide').css('visibility', 'hidden')
                    }
                ;
                $globalActions.hide().removeClass('disabled');
                $checkedCheckboxes.each(function () {
                    var $tr = $(this).closest('tr.row-elem'),
                        $trStats = $tr.next('tr.row-stats'),
                        $adGlobalActions = $tr.find('a.globalAction:visible');
                    $adGlobalActions = $.merge($adGlobalActions, $trStats.find('a.globalAction:visible'));
                    var $globalActionsFirst = 0;
                    $adGlobalActions.each(function () {
                        var code = $(this).data("code"),
                            allowed = $(this).data("allowed");
                        if (typeof allowed == 'undefined') allowed = 1;
                        var $action = $globalActions.filter('#' + code);
                        if (allowed) $action.show()
                    });
                    $globalActions.removeClass('first').each(function () {
                        var $this = $(this);
                        if ($this.is(':visible') && $globalActionsFirst == 0) {
                            $this.addClass('first');
                            $globalActionsFirst++
                        }
                        ;
                        if (!$adGlobalActions.filter('.' + $this.attr('id') + ':visible').length) $this.addClass('disabled')
                    })
                });
                if ($('#globalActions > li:visible').length > 3) {
                    $('#globalActions').parent().css('height', 48)
                } else $('#globalActions').parent().css('height', 'auto')
            },
            showLoader = function ($tr, message) {
                var $rowStats = $tr.next('.row-stats'),
                    $actionJs = $rowStats.next('.row-shadow').find('.action_js');
                $actionJs.find('span.message').html(message);
                $actionJs.find('img.loader').show();
                var rowHeight = $rowStats.height() + $tr.height(),
                    rowWidth = $rowStats.width();
                $actionJs.css({
                    height: rowHeight,
                    width: rowWidth
                }).show();
                $actionJs.find('p').css('marginTop', -$actionJs.find('p').height() / 2);
                return $actionJs
            },
            showDeactivateDialog = function (ids) {
                var defVal = 'Specify the reason for deactivating your Ad...';
                $(window).resize(function () {
                    var innerHeight = $(window).height() - 100;
                    $('#reasonInnerHeight').css({
                        maxHeight: innerHeight,
                        overflow: "auto"
                    })
                });
                $.fancybox({
                    href: '#reasonDiv',
                    onStart: function () {
                        var $reasonDiv = $('#reasonDiv');
                        $reasonDiv.show().find('textarea').val(defVal).hide().parent().siblings('p').hide();
                        $reasonDiv.find('.removeReason').attr('checked', false);
                        var innerHeight = $(window).height() - 100;
                        $('#reasonInnerHeight').css({
                            maxHeight: innerHeight,
                            overflow: "auto"
                        })
                    },
                    onClosed: function () {
                        $('#reasonDiv').hide()
                    },
                    onComplete: function () {
                        var $fancy = $('#fancybox-wrap');
                        $fancy.data("ids", ids);
                        if ($fancy.data("initialized") != undefined) return;
                        $fancy.data("initialized", 1);
                        $('#deleteButton', $fancy).click(function () {
                            var $this = $(this),
                                $input = $('input[name=reson]:checked', $fancy),
                                reasonID = $input.val(),
                                success = $input.hasClass('success'),
                                text = $this.closest('div#reasonDiv').find('textarea:visible').val();
                            if (reasonID != null) {
                                $.fancybox.close();
                                if (success) setTimeout(function () {
                                    $.cookie('facebooksuccess', '1', {
                                        expires: 14,
                                        path: '/',
                                        domain: '.' + session_domain
                                    });
                                    deleteAndLike()
                                }, 4e3);
                                ids = $fancy.data("ids").split(',');
                                for (id in ids) {
                                    var $link = $('a.deactivateme' + ids[id]);
                                    $link.data("reasonID", reasonID);
                                    $link.data("text", text == undefined || text == defVal ? '' : text);
                                    $link.click()
                                }
                            } else ShowMessage.error('Choose reason')
                        });
                        $('.removeReason', $fancy).click(function () {
                            $('b.report-countdown').text(255);
                            var $this = $(this),
                                $textarea = $this.closest('li').find('textarea').val(defVal);
                            if ($textarea.length) {
                                $textarea.addClass('c73').css('display', 'block');
                                $textarea.parent().siblings('p').show()
                            } else {
                                $this.closest('ol').find('textarea').hide();
                                $this.closest('ol').find('textarea').parent().siblings('p').hide()
                            }
                            ;
                            $textarea.focus(function () {
                                var $this = $(this),
                                    actualValue = $this.val();
                                $this.parents().find('.fblock').addClass('active');
                                if (actualValue == defVal) {
                                    $this.val('');
                                    $this.removeClass('c73')
                                }
                            });
                            $textarea.blur(function () {
                                var $this = $(this),
                                    actualValue = $this.val();
                                $this.parents().find('.fblock').removeClass('active');
                                if (!actualValue) {
                                    $this.val(defVal);
                                    $this.addClass('c73')
                                }
                            });
                            $textarea.keyup(function () {
                                $this = $(this);
                                if ($this.val().length > 255) $this.val($this.val().substring(0, 255));
                                $('b.report-countdown').text(255 - $this.val().length)
                            });
                            $.fancybox.resize()
                        })
                    },
                    autoScale: false,
                    autoDimensions: true,
                    title: '<p class="marginleft15 lheight22">Choose reason</p>'
                })
            };
        $('.fancyboxBecomeFan a.close').click(function () {
            $.fancybox.close()
        });
        var updateCounter = function (type, value) {
            var $link = $globalLinks.find('#type' + type),
                $span = $link.find('span.counter'),
                counter = parseInt($span.text().replace('(', '').replace('_', ''));
            if (isNaN(counter)) counter = 0;
            counter += value;
            if (counter < 0) counter = 0;
            $span.text('(' + counter + ')');
            if (!counter) {
                $span.hide();
                if (type == actualType) {
                    setTimeout(function () {
                        $('#active-table').remove();
                        $('#noAdsBlock').fadeIn(1e3)
                    }, 2500)
                } else $link.hide()
            } else {
                $link.show();
                $span.show()
            }
        };
        $globalCheckbox.bind(eventClick, function () {
            var $globalCheckboxRender = $globalCheckbox.closest('.th').find('label.f_checkbox'),
                $checkboxesRendered = $('#adsTable tbody label.f_checkbox');
            $globalCheckboxRender.removeClass('disabled');
            if ($globalCheckbox.is(':checked')) {
                $checkboxes.attr('checked', 'checked');
                $checkboxesRendered.addClass('selected');
                $globalActions.closest('thead').find('.globalActionHide').css('visibility', 'hidden')
            } else {
                $checkboxes.attr('checked', false);
                $checkboxesRendered.removeClass('selected');
                $globalActions.closest('thead').find('.globalActionHide').css('visibility', 'visible')
            }
            ;
            showGlobalActions(false, this)
        });
        $checkboxes.bind(eventClick, function () {
            showGlobalActions(true, this)
        });
        $globalActions.bind(eventClick, function () {
            var $this = $(this);
            if ($this.hasClass('disabled')) return false;
            var code = $this.attr('id'),
                $checkedCheckboxes = $checkboxes.filter(':checked');
            if (code == 'deactivateme') {
                var ids = '';
                $checkedCheckboxes.each(function () {
                    if (ids) ids += ',';
                    ids += $(this).val()
                });
                showDeactivateDialog(ids);
                return false
            }
            ;
            if (code == 'promoteme') {
                var ids = '';
                $checkedCheckboxes.each(function () {
                    if (ids) {
                        ids += '&'
                    } else ids += '?';
                    ids += 'id[]=' + $(this).val()
                });
                window.location = multipay_url + ids;
                return false
            }
            ;
            $checkedCheckboxes.each(function () {
                var $tr = $(this).closest('tr.row-elem'),
                    findMe = '.' + code + ':visible';
                $inputs = $tr.find(findMe);
                if ($inputs.length) {
                    if (code == 'activatecourier') {
                        if (!$inputs.data("status")) $inputs.click()
                    } else if (code == 'deactivatecourier') {
                        if ($inputs.data("status")) $inputs.click()
                    } else $inputs.click()
                } else $tr.next('tr.row-stats').find(findMe).click()
            }).eq(0).each(function () {
                var $tr = $(this).closest('tr.row-elem');
                $('html, body').animate({
                    scrollTop: $tr.offset().top
                }, 100)
            });
            return false
        });
        var deleteAndLike = function () {
            $.fancybox.close();
            if (!fanPageVisible) return;
            if (sitecode == 'olxby') return;
            fanPageVisible = 0;
            $.fancybox({
                href: '#deleteAndLike',
                width: 'auto',
                onStart: function () {
                    $('#fancybox-outer').addClass('fancyboxBecomeFan');
                    $('#deleteAndLike').show();
                    $('#deleteAndLike a.close').click(function () {
                        $.fancybox.close();
                        return false
                    })
                },
                onComplete: function () {
                    setTimeout("FBMyAccountLayercallback()", 2500)
                },
                onClosed: function () {
                    $('#deleteAndLike').hide();
                    $('#fancybox-outer').removeClass('fancyboxBecomeFan');
                    if (hasPager || !$('tr.row-elem:visible').length) window.location.reload()
                },
                title: '<p class="marginleft15 lheight22">Your Ad has been deleted</p>',
                autoScale: false,
                autoDimensions: true
            })
        };
        FBMyAccountLayercallback = function () {
            if (typeof FB != 'undefined') {
                FB.XFBML.parse();
                FB.Event.subscribe('edge.create', function (href, widget) {
                    $.fancybox.close()
                })
            }
        };
        var errorCallback = function ($loader, $tr, fadeOutTime) {
                return function (obj, status, errorTrown) {
                    var text = obj.responseText,
                        messageDisplayTime = 4500;
                    if ($.hasErrorInAjaxResponse(text)) text = new String(text).substring(16);
                    if (text == 'Edit your Ad and correct errors before refreshing') {
                        text = 'Edit your Ad and correct errors before refreshing';
                        $loader.addClass('warning');
                        var $divWarning = $tr.find('.refreshEditError');
                        setTimeout(function () {
                            $divWarning.show().find('.remove').click(function () {
                                $divWarning.fadeOut();
                                return false
                            })
                        }, 3500)
                    } else if (text == 'The Ad needs to be improved before activation') {
                        $loader.addClass('warning');
                        var $divWarning = $tr.find('.activateEditError');
                        setTimeout(function () {
                            $divWarning.show().find('.remove').click(function () {
                                $divWarning.fadeOut();
                                return false
                            })
                        }, 3500)
                    } else if (text == 'activate_courier_error_wrong_category') {
                        $loader.addClass('warning');
                        text = 'You can\'t activate courier service for this Ad becouse it is not available for its category';
                        messageDisplayTime = 5e3
                    } else if (text == 'activate_courier_error_invalid_ad_data') {
                        $loader.addClass('warning');
                        text = 'You have selected one or more Ads that are for Exchange or for Free.';
                        messageDisplayTime = 5e3
                    } else {
                        $loader.addClass('error');
                        ajaxErrorHander(text)
                    }
                    ;
                    $loader.find('span.message').html(text);
                    $loader.find('img.loader').hide();
                    $loader.find('p').css('marginTop', -$loader.find('p').height() / 2);
                    $checkboxes.attr('checked', false);
                    $('#adsTable tbody label.f_checkbox').removeClass('selected');
                    showGlobalActions(true);
                    setTimeout(function () {
                        $loader.fadeOut(fadeOutTime, function () {
                            $loader.removeClass('error').removeClass('warning')
                        })
                    }, messageDisplayTime)
                }
            },
            getClosestTr = function ($this) {
                var $tr = $this.closest('tr.row-elem');
                if (!$tr.length) $tr = $this.closest('tr.row-stats').prev('tr.row-elem');
                return $tr
            };
        $('.checkLogin').bind(eventClick, function (e) {
            var event = e;
            $this = $(this);
            $.ajax({
                type: 'POST',
                url: www_base + '/ajax/myaccount/checklogin/',
                async: false,
                dataType: 'json',
                error: function (obj, status, errorTrown) {
                    event.preventDefault();
                    var $tr = getClosestTr($this),
                        $loader = showLoader($tr, "");
                    errorCallback($loader, $tr, 1e3).call(this, obj, status, errorTrown)
                },
                success: function (data) {
                }
            });
            event.stopPropagation()
        });
        $('#adsTable tbody a.globalAction').bind(eventClick, function (event) {
            var $this = $(this),
                $tr = getClosestTr($this),
                adID = $tr.find('input.adID').val(),
                code = $this.data("code"),
                jobMessage = '',
                successMessage = '',
                successJob = function ($loader, data) {
                },
                extraParams = {},
                fadeOutTime = 1e3;
            switch (code) {
                case 'confirmme':
                    jobMessage = 'Confirming Ad...';
                    successMessage = 'The Ad was confirmed';
                    successJob = function ($loader, data) {
                        $tr.next('tr.row-stats').find('.confirmRow').remove();
                        $tr.next('tr.row-stats').find('.statsRow').show();
                        $tr.find('.confirmtarget').remove();
                        $tr.find('.waitingMessage').show();
                        $this.remove();
                        $tr.removeClass('reqconfirmation');
                        setTimeout(function () {
                            $loader.fadeOut(fadeOutTime);
                            if (sitecode.indexOf('slando') == 0) window.location.reload()
                        }, 4e3)
                    };
                    break;
                case 'activateme':
                    jobMessage = 'Activating Ad...';
                    successMessage = 'The Ad is active';
                    successJob = function ($loader, data) {
                        updateCounter(actualType, -1);
                        updateCounter('active', 1);
                        setTimeout(function () {
                            $tr.fadeOut(fadeOutTime);
                            $tr.next('tr.row-stats').fadeOut(fadeOutTime).next('tr.row-shadow').fadeOut(fadeOutTime);
                            $loader.fadeOut(fadeOutTime, function () {
                                if (hasPager || !$('tr.row-elem:visible').length) window.location.reload()
                            })
                        }, 4e3)
                    };
                    break;
                case 'activatemelimited':
                    jobMessage = 'Activating Ad...';
                    successMessage = 'The Ad is active';
                    successJob = function ($loader, data) {
                        updateCounter(actualType, -1);
                        updateCounter('active', 1);
                        setTimeout(function () {
                            $tr.fadeOut(fadeOutTime);
                            $tr.next('tr.row-stats').fadeOut(fadeOutTime).next('tr.row-shadow').fadeOut(fadeOutTime);
                            $loader.fadeOut(fadeOutTime, function () {
                                if (hasPager || !$('tr.row-elem:visible').length) window.location.reload()
                            })
                        }, 4e3)
                    };
                    break;
                case 'removeme':
                    jobMessage = 'Removing Ad...';
                    successMessage = 'This Ad has been permanently removed';
                    successJob = function ($loader, data) {
                        updateCounter(actualType, -1);
                        setTimeout(function () {
                            $tr.fadeOut(fadeOutTime);
                            $tr.next('tr.row-stats').fadeOut(fadeOutTime).next('tr.row-shadow').fadeOut(fadeOutTime);
                            $loader.fadeOut(fadeOutTime, function () {
                                if (hasPager || !$('a.removeme:visible').length) window.location.reload()
                            })
                        }, 4e3)
                    };
                    break;
                case 'deactivateme':
                    if ($this.data("reasonID")) {
                        jobMessage = 'Deactivating Ad...';
                        successMessage = 'Ad successfully deactivated';
                        successJob = function ($loader, data) {
                            if (useExternalScripts) {
                                var xt_temp = xtcustom;
                                delete xt_temp.page_name;
                                xt_temp.click_name = 'ad_deleted';
                                xt_temp.action_type = 'deleted';
                                xt_med('C', '', xt_temp.click_name, 'A', null, null, xt_temp)
                            }
                            ;
                            setTimeout(function () {
                                $tr.fadeOut(fadeOutTime);
                                $tr.next('tr.row-stats').fadeOut(fadeOutTime).next('tr.row-shadow').fadeOut(fadeOutTime);
                                $loader.fadeOut(fadeOutTime, function () {
                                    if ((hasPager || !$('tr.row-elem:visible').length) && !$('#deleteAndLike').is(':visible')) window.location.reload()
                                })
                            }, 4e3);
                            updateCounter(actualType, -1);
                            updateCounter('archive', 1)
                        };
                        extraParams = {
                            reasonID: $this.data("reasonID"),
                            text: $this.data("text")
                        }
                    } else {
                        showDeactivateDialog(adID);
                        return false
                    }
                    ;
                    break;
                case 'refreshme':
                    jobMessage = 'Refreshing Ad...';
                    successMessage = 'Ad successfully refreshed';
                    successJob = function ($loader, data) {
                        $this.remove();
                        var $tpl = $('#dateContainerTpl').clone();
                        $tpl.find('.dateContainer_from').html(data.from).end().find('.dateContainer_to').html(data.to);
                        $tr.find('p.dateContainer').css({
                            'font-weight': 'bold'
                        }).html($tpl.html());
                        if (typeof data.message != 'undefined') successMessage = data.message;
                        setTimeout(function () {
                            $loader.fadeOut(fadeOutTime)
                        }, 5e3)
                    };
                    break;
                case 'activatecourier':
                    jobMessage = '';
                    successMessage = 'Livrare cu verificare service has been activated for selected ads';
                    successJob = function ($loader, data) {
                        var activatecourierMetadata = $tr.find('.globalAction.activatecourier').data('metadata');
                        activatecourierMetadata.allowed = 0;
                        activatecourierMetadata.status = 1;
                        var deactivatecourierMetadata = $tr.find('.globalAction.deactivatecourier').data('metadata');
                        deactivatecourierMetadata.allowed = 1;
                        deactivatecourierMetadata.status = 1;
                        setTimeout(function () {
                            $loader.fadeOut(fadeOutTime, function () {
                                $tr.find('span.courier').fadeIn('slow')
                            })
                        }, 5e3)
                    };
                    break;
                case 'deactivatecourier':
                    jobMessage = '';
                    successMessage = 'Livrare cu verificare service has been deactivated for selected ads';
                    successJob = function ($loader, data) {
                        var activatecourierMetadata = $tr.find('.globalAction.activatecourier').data('metadata');
                        activatecourierMetadata.allowed = 1;
                        activatecourierMetadata.status = 0;
                        var deactivatecourierMetadata = $tr.find('.globalAction.deactivatecourier').data('metadata');
                        deactivatecourierMetadata.allowed = 0;
                        deactivatecourierMetadata.status = 0;
                        setTimeout(function () {
                            $loader.fadeOut(fadeOutTime, function () {
                                $tr.find('span.courier').fadeOut('slow')
                            })
                        }, 3e3)
                    };
                    break;
                default:
                    break
            }
            ;
            var $loader = showLoader($tr, jobMessage);
            ajaxErrorHander = function () {
            };
            $.ajax({
                type: 'POST',
                url: www_base + '/ajax/myaccount/' + code + '/',
                data: $.extend({
                    adID: adID
                }, extraParams),
                dataType: 'json',
                success: function (data) {
                    $loader.find('span.message').html(data !== null && data.length ? data : successMessage);
                    $loader.find('img.loader').hide();
                    $loader.find('p').css('marginTop', -$loader.find('p').height() / 2);
                    $checkboxes.attr('checked', false);
                    $('#adsTable tbody label.f_checkbox').removeClass('selected');
                    showGlobalActions(true);
                    successJob($loader, data)
                },
                error: errorCallback($loader, $tr, fadeOutTime)
            });
            return false
        });
        $('.myoffersnew').renderForms();
        $('#adsTable .modInfo').click(function () {
            var $tr = $(this).closest('tr.row-stats').prev('tr.row-elem'),
                adID = $tr.find('input.adID').val(),
                innerHeight = $(window).height() - 150;
            $('#moderationDescription' + adID).css({
                maxHeight: innerHeight,
                overflow: "auto",
                width: "550"
            });
            $.fancybox({
                href: '#moderationDescription' + adID,
                autoScale: false,
                autoDimensions: true,
                title: '<p class="marginleft15 lheight22">This Ad was not published</p>',
                onStart: function () {
                    var $div = $('#moderationDescription' + adID);
                    $div.find('.fancybox-close').click(function () {
                        $.fancybox.close();
                        return false
                    })
                }
            });
            return false
        });
        var $statsCloud = $('.statsviewscloud');
        if ($statsCloud.length) {
            $statsCloud.bind("mouseenter", function () {
                var $this = $(this),
                    $statsCloudBox = $this.find('.suggesttitlebottom');
                clearTimeout($this.data('timeout'));
                if ($statsCloudBox.is(':hidden')) $statsCloudBox.slideDown('fast')
            });
            $statsCloud.bind("mouseleave", function () {
                var $this = $(this),
                    $statsCloudBox = $this.find('.suggesttitlebottom');
                $this.data('timeout', setTimeout(function () {
                    if (!$statsCloudBox.is(':hidden')) $statsCloudBox.slideUp('fast')
                }, 1e3))
            });
            $statsCloud.find('.clearViews').click(function () {
                var $this = $(this),
                    $tr = $this.closest('tr.row-stats').prev('tr.row-elem'),
                    adID = $tr.find('input.adID').val(),
                    $statsCloudBox = $this.closest('.suggesttitlebottom');
                $.post(www_base + '/ajax/myaccount/clearviews/', {
                    adID: adID
                }, function (resp) {
                    $('.suggesttext', $statsCloudBox).fadeOut(function () {
                        $(this).text(resp.response).fadeIn();
                        $this.closest('tr.row-stats').find('.statsviewsCounter').text('a');
                        $tr.end().find('.statsviewsCounter').text(0)
                    })
                }, 'json');
                return false
            })
        }
    },
    initPaidSubscriptionsNotice: function () {
        var $showPaidSubscriptionsDetails = $('#showPaidSubscriptionsDetails'),
            $paidSubscriptionsDetails = $('#paidSubscriptionsDetails');
        $showPaidSubscriptionsDetails.fancybox({
            onStart: function () {
                $paidSubscriptionsDetails.show();
                var innerHeight = $(window).height() - 200;
                $paidSubscriptionsDetails.find('.innerHeight').css({
                    maxHeight: innerHeight,
                    overflow: "auto"
                })
            },
            title: '<p class="block clr xx-large lheight22 marginleft10">Categories with ads above the limit</p>',
            titleShow: true,
            scrolling: 'no',
            autoScale: true,
            autoDimensions: true,
            onClosed: function () {
                $paidSubscriptionsDetails.hide()
            },
            onCleanup: function () {
                $paidSubscriptionsDetails.unwrap()
            }
        })
    },
    initLatestAds: function () {
        var thiz = this;
        if ($('.latestads').is(':visible')) $('#body-container .wrapper').css({
            'padding-bottom': '20px'
        });
        $('.latestads p a.view-all-top').attr('href', $('.latestad-carousel .view-all a').attr('href'));
        $('#selectCategory').change(function () {
            var selId = $(this).find('option:selected')[0].id;
            $('.latestads .latestad-carousel').html('Loading ...');
            thiz.post('latestads', 'getads', {
                data: selId
            }, function (data) {
                if (data.indexOf('title') != -1) {
                    $('.latestads .latestad-carousel').html('').append(data);
                    $('.latestads p a.view-all-top').attr('href', $('.latestad-carousel .view-all a').attr('href'))
                } else $('.latestads .latestad-carousel').html('Ads not available right now.');
                thiz.adsCarousel.init()
            })
        })
    },
    initCarousel: function () {
        var thiz = this;
        thiz.adsCarousel = {
            prevArrow: $('.latestads .prev-arrow'),
            nextArrow: $('.latestads .next-arrow'),
            cDiv: $('.latestad-carousel'),
            wrapper: $('.latestads .wrapper'),
            bottomDots: $('.bottom-dots'),
            slidesToShow: 5,
            curPos: 0,
            lock: false,
            offsetLeft: 0,
            wrapperWdth: 0,
            curDot: 0,
            init: function () {
                var obj = thiz.adsCarousel;
                obj.curPos = 0;
                obj.lock = false;
                obj.slideWidth = $(obj.cDiv.find('div')[0]).outerWidth(true);
                obj.totSlides = $(obj.cDiv.find('div')).length;
                obj.slideGap = parseInt($(obj.cDiv.find('div')[0]).css("marginRight"));
                obj.wrapperWdth = (obj.slideWidth * obj.slidesToShow) - obj.slideGap;
                obj.wrapper.css({
                    width: obj.wrapperWdth + 'px'
                });
                obj.cDiv.css({
                    width: (obj.slideWidth * obj.totSlides) + 'px',
                    left: '0'
                });
                obj.offsetLeft = (obj.cDiv.position().left > 0) ? obj.cDiv.position().left : 0;
                obj.initDots();
                obj.updateArrows();
                obj.bindEvents()
            },
            initDots: function () {
                var obj = thiz.adsCarousel,
                    dots = '';
                for (var i = 0; i < obj.totSlides / obj.slidesToShow; i++) dots += '<span></span>';
                obj.bottomDots.html('').append(dots);
                var offsetLast = (obj.bottomDots.find('span').length > 1) ? parseInt($(obj.bottomDots.find('span').last()).css("marginRight")) : 0,
                    width = $(obj.bottomDots.find('span')[0]).outerWidth(true) * $(obj.bottomDots.find('span')).length + offsetLast,
                    left = (obj.wrapperWdth - width) / 2;
                obj.bottomDots.css({
                    width: width + 'px',
                    left: left + 'px'
                });
                obj.curDot = 0;
                $(obj.bottomDots.find('span')[obj.curDot]).addClass('active')
            },
            bindEvents: function () {
                var obj = thiz.adsCarousel;
                obj.prevArrow.bind('click', function () {
                    if ($(this).hasClass('disable') != true && obj.lock != true) obj.startAnim('right')
                });
                obj.nextArrow.bind('click', function () {
                    if ($(this).hasClass('disable') != true && obj.lock != true) obj.startAnim('left')
                })
            },
            startAnim: function (dir) {
                var obj = thiz.adsCarousel;
                obj.lock = true;
                var dist = obj.slideWidth * obj.slidesToShow,
                    pos = (dir == 'left') ? obj.cDiv.position().left - (dist + obj.offsetLeft) : obj.cDiv.position().left + (dist - obj.offsetLeft);
                obj.cDiv.animate({
                    left: pos + 'px'
                }, "slow", function () {
                    obj.updateCurPos(dir)
                })
            },
            updateCurPos: function (dir) {
                var obj = thiz.adsCarousel;
                if (dir == 'left') {
                    if (obj.curPos < obj.totSlides) obj.curPos += obj.slidesToShow
                } else if (obj.curPos > 0) obj.curPos -= obj.slidesToShow;
                obj.updateArrows();
                obj.updateDots(dir)
            },
            updateArrows: function () {
                var obj = thiz.adsCarousel;
                if (obj.curPos == 0 && obj.slidesToShow > obj.totSlides) {
                    obj.nextArrow.addClass('disable');
                    obj.prevArrow.addClass('disable')
                } else if (obj.curPos == 0 && obj.slidesToShow < obj.totSlides) {
                    obj.nextArrow.removeClass('disable');
                    obj.prevArrow.addClass('disable')
                } else if ((obj.curPos + obj.slidesToShow) >= obj.totSlides) {
                    obj.nextArrow.addClass('disable');
                    obj.prevArrow.removeClass('disable')
                } else {
                    obj.prevArrow.removeClass('disable');
                    obj.nextArrow.removeClass('disable')
                }
                ;
                obj.lock = false
            },
            updateDots: function (dir) {
                var obj = thiz.adsCarousel;
                $(obj.bottomDots.find('span')).removeClass('active');
                if (dir == 'left') {
                    obj.curDot += 1
                } else if (obj.curDot > 0) obj.curDot -= 1;
                $(obj.bottomDots.find('span')[obj.curDot]).addClass('active')
            }
        };
        thiz.adsCarousel.init()
    },
    youTubePlayer: function () {
        var tryTill = 1,
            intr = setInterval(function () {
                if ($('#div-gpt-ad-1433503533903-2 iframe').length > 0 && $('#div-gpt-ad-1433503533903-2 iframe').contents().find('body').length > 0) {
                    openVidPlayer();
                    (tryTill > 20) ? clearInterval(intr) : tryTill++
                }
            }, 200),
            openVidPlayer = function () {
                $('#div-gpt-ad-1433503533903-2 iframe').contents().find('body').unbind().bind('click', function (e) {
                    clearInterval(intr);
                    var vid = $(this).find('#vidThumb').attr('vidUrl'),
                        traciking = $(this).find('#vidThumb').attr('tracking'),
                        embedCode = '<object type="application/x-shockwave-flash" style="width:500px; height:400px;"';
                    embedCode += ' data="' + vid + '">';
                    embedCode += '<param name="movie" value="' + vid + '"/>';
                    embedCode += '<param name="allowFullScreen" value="true" />';
                    embedCode += '<param name="allowscriptaccess" value="always" />';
                    embedCode += '</object>';
                    $('#youtubeContainer').html('').append(embedCode);
                    $.fancybox({
                        href: '#youtubeContainer',
                        onStart: function () {
                            $('#youtubeContainer').css({
                                width: 'auto',
                                overflow: 'auto'
                            }).show()
                        },
                        onComplete: function () {
                            $('#fancybox-close').html('x').addClass('ad-banner')
                        },
                        onCleanup: function () {
                            $('#youtubeContainer').hide()
                        },
                        scrolling: 'no',
                        autoScale: false,
                        autoDimensions: true,
                        padding: 10,
                        centerOnScroll: true
                    });
                    var trackPixel = new Image(1, 1);
                    trackPixel.src = traciking;
                    $('body').append(trackPixel);
                    return false
                })
            }
    }
});
$().ready(function () {
    new IndexClass()
});