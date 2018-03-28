$(function () {

    var route = {
        tab1: {
            view: '/JobSeeker/PersonalInfo',
            form: '/JobSeeker/PersonalInfoEdit'
        },
        tab2: {
            view: '/JobSeeker/CurrentPositionInfo',
            form: '/JobSeeker/CurrentPositionInfoEdit'
        },
        tab3: {
            view: '/JobSeeker/ExpectedPositionInfo',  
            form: '/JobSeeker/ExpectedPositionInfoEdit'
        },
        tab4: {
            view: '/JobSeeker/ResetPassword',
            form: '/JobSeeker/PersonalInfoEdit'
        },
        tab5: {
            view: '/JobSeeker/ResetPassword1',
            form: '/JobSeeker/PersonalInfoEdit1'
        },
    };

    var $tabContainer = $('.tab-horizontal-content');

    function loadTab(tab, type, appendTo) {
        appendTo.html(Animation.loader());
        _ajax(
            {
                url: route[tab][type]
            },
            function (html) {
                appendTo.html(html);
            }
        );
    }

    function getCurrentActiveTab() {
        return $('.profile-tab li.active a').attr('href').split('#')[1];
    }

    // Event for tab
    $('.profile-tab li a').on('click', function (e) {
        e.preventDefault();

        var $this = $(this);
        var $tab = $this.attr('href').split('#')[1];

        $('.profile-tab li').removeClass('active');
        $this.parent().addClass('active');

        loadTab(
            $tab,
            'view',
            $tabContainer
        );

    });

    // Event for edit button
    $(document).on('click', '.btn-profile-edit', function () {
        var tab = getCurrentActiveTab();
        loadTab(
            tab,
            'form',
            $tabContainer
        );
    });

    //On load
    loadTab(
        'tab1',
        'view',
        $tabContainer
    );

    //Show popup
    $('.uploadImage').on('click', function () {
        Animation.load('body');
        _ajax(
            {
                url: '/user/ImageCrop'
            },
            function (html) {
                Animation.hide();
                Popup.addClass('small-size');
                Popup.show(html)
            }
        );

    });

})