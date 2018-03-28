var $isTitleHide = false;
var isScrollTop = false;
//Job category Selection

//Get job title position in the top.
var $titleOffset = ($('#searchWrapper').offset().top),
    breakpoint = calSize();


var SelectedCategory = (function () {
    var _category = {
        categoryID: {
            main: [],
            sub: []
        }
    };

    $(document).on('click', '.category-list li a', function (evt) {
        evt.preventDefault();

        var $this = $(this),
            $parentUl = $this.parents('.category-list');

        //Main category
        if ($parentUl.hasClass('main')) {

            $('.category-list.main li a').removeClass('active');
            $this.addClass('active');
            _category.categoryID.main = [
                $parentUl.find('li a.active').attr('id'),
                $parentUl.find('li a.active').text()
            ];

            //If select main category All that popup will be hide
            if ($this.hasClass('all')) {
                loadJobsByCategory();
                scrollToDown();
            }
        }

        //Sub category
        if ($parentUl.hasClass('sub')) {
            $('.category-list.sub li a').removeClass('active');
            $this.addClass('active');
            _category.categoryID.sub = [
                $parentUl.find('li a.active').attr('id'),
                $parentUl.find('li a.active').text()
            ];
            //Call after select
            loadJobsByCategory();
            scrollToDown();
        }


    });

    return _category;

})();

//Job Search
var JobSearch = (function () {

    var search = {};

    var $jobInput = $('.job-input input[type="text"]');


    search.changeTitle = function () {
        var $title = $('.main-title');
        var searchSection = $('.search-section');
    };

    //On input focus
    $jobInput.on('focus', function () {
    });

    //On input blur
    $jobInput.on('blur', function () {
    });

    //Show category Popup
    $('.show-category').on('click', function () {
        Popup.beforeShow();
        //Get layout
        //Call to server js and get layout
        CategoryPopup().html(function (html) {
            Popup.addClass('size-60');
            Popup.addClass('no-padding');
            Popup.show(html);
        });
    });

    return search;
})();

function loadJobsByCategory() {
    var category = SelectedCategory.categoryID;

    $('.show-category').find('.selected-item span').text(category.main[1]);
    $('.job-input').find('input[type="text"]').focus();
    $('.subCategory').text(category.sub[1]);

    //Call to server
    loadJobData(category);
    // hide popup
    Popup.hide();
}

var searchDivHeight = $('.full-height').innerHeight();

setPageHeight();

function setPageHeight() {
    var pageHeight = responsivePageHeight();
    $('.full-height').css('padding-bottom', (pageHeight - searchDivHeight) + 'px');
}


function responsivePageHeight() {
    return $(window)[0].innerHeight;
}

(function () {

    //$('.navbar').removeClass('light-blue').css('backgroundColor', 'transparent');
})();


function calSize() {
    var val = 0;
    var deviceWidth = $(window)[0].innerWidth;
    if (deviceWidth > 425) {
        val = $titleOffset + 90;
    } else {
        val = $titleOffset - 80;
    }
    return val;
}

function scrollToDown() {

    var _titleTopSpace = $titleOffset + 90,
        $searchSection = $('.search-section'),
        $searchArea = $('.search-area');

    var $pageHeight = responsivePageHeight();

    if ($(window).scrollTop() > 0) {
        $("html, body").animate({scrollTop: _titleTopSpace}, 500);
    }

}


(function () {
    var $header = $('header'),
        $searchInput = $('#searchText'),
        $searchArea = $('.search-area'),
        $searchSection = $('.search-section'),
        $loadAdvertisements = $('#ajaxLoadAdvertisements'),
        $searchWrapper = $('#searchWrapper'),
        $loadAdvertisementsPosition = 0,
        $_scrollTop = 0,
        isInputFocus = false;

    var $pageHeight = responsivePageHeight();

    function init() {
        $header.addClass('absolute');
        $searchWrapper.addClass('is-animate-bar');
    }

    var lastScrollVal = 0;

    function scrollOnFocusInput() {
        $("html, body").animate({scrollTop: $searchArea.offset().top - 30}, 500);
        $searchArea.siblings('.filters').css('opacity', '1');
    }

    function scrollDirection(e) {
        var currentScrollVal = $(window).scrollTop(),
            result;

        result = currentScrollVal > lastScrollVal ? 'DOWN' : 'UP';
        lastScrollVal = currentScrollVal;

        return result;
    }

    $(window).on('scroll', function (e) {

        var $_scroll = $(window).scrollTop(),
            $searchWrapperHeight = $searchWrapper.height() + 3,
            topVal = $searchWrapperHeight * -1;

        if (scrollDirection() === "DOWN") {
            if ($_scroll > $pageHeight) {
                $searchWrapper.addClass('is-fixed-search');
                $searchWrapper.css({'top': topVal + 'px'});
            }
            $searchSection.css('padding-bottom', '30px');

        } else {

            //when call at scroll up
            if ($_scroll < $pageHeight) {
                $searchWrapper.removeClass('is-fixed-search');
                $searchWrapper.removeAttrs('style');

            } else if ($_scroll < $pageHeight + 10) {

                $searchWrapper.css({'top': topVal + 'px'});

            } else {

                $searchArea.siblings('.filters').css('opacity', '1');
                $searchWrapper.css({'top': '0'});

            }

            if ($_scroll === 0) {
                $searchArea.siblings('.filters').css('opacity', '0');
                $searchSection.css('padding-bottom', ($pageHeight - searchDivHeight) + 'px');
            }
        }
    });

    $searchInput.on('focus click', function () {
        scrollOnFocusInput();
    });

    $searchInput.on('keyup', function () {
        //$(this).trigger('click');
    });

    init();

})();

function scrollFun() {
    var $jobList = $('.job-list'),
        $searchInput = $('#searchText'),
        $searchArea = $('.search-area'),
        $pageHeight = responsivePageHeight(),
        $searchWrapper = $('#searchWrapper');

    $searchWrapper.css({'top': 0});
    scrollToDown();
}