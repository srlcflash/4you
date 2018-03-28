$(function () {

    var route = {
        tab1: {
            view: '/employer/JobPost',
            form: 't'

        },
        tab2: {
            view: '/employer/Package',
            form: '/employer/PackageEdit'
        },
        tab3: {
            view: '/employer/PasswordReset',
            form: 't'
        },
        tab4: {
            view: '/employer/ViewCompanyDetails',
            form: '/employer/BasicData'
        }
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
        return $('.employer-tab li.active a').attr('href').split('#')[1];
    }

    // Event for tab
    $('.employer-tab li a').on('click', function (e) {
        e.preventDefault();

        var $this = $(this);
        var $tab = $this.attr('href').split('#')[1];

        $('.employer-tab li').removeClass('active');
        $this.parent().addClass('active');

        loadTab(
            $tab,
            'view',
            $tabContainer
        );

    });

    // Event for edit button
    $(document).on('click', '.btn-employer-edit', function () {
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
        Popup.beforeShow();

        _ajax(
            {
                url: '/employer/ImageCrop'
            },
            function (html) {
                Popup.addClass('small-size');
                Popup.show(html)
            }
        );

    });

})