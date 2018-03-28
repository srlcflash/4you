function base_url(link) {
    return BASE_URL + link;
}

//Popup
var Popup = (function () {

    var _Popup = {};

    var popupContainer = $('.popup-container');

    _Popup.addClass = function (className) {
        popupContainer.addClass(className);
    };

    _Popup.removeClass = function (className) {
        popupContainer.removeClass(className);
    };

    function hide(callback) {
        document.querySelector('body').style.overflow = "";
        var allClass = popupContainer.attr('class').split(' ');

        allClass.map(function (className) {
            if (className !== 'popup-container') {
                popupContainer.removeClass(className);
            }
        });

        popupContainer.addClass('isHide');

        setTimeout(function () {
            if (typeof callback === "function" && callback !== undefined) {
                callback();
            }
        }, 100);

    }

    $('.popup .close').on('click', function () {
        hide();
    });

    $(document).on('keypress', function (e) {
        if (e.keyCode === 27) {
            //hide();
        }
    });

    //Public functions
    _Popup.show = function (ajaxLoad) {

        popupContainer.addClass('isShow');

        Animation.load();

        if (ajaxLoad !== undefined) {

            document.querySelector('body').style.overflow = "hidden";
            var container = popupContainer.find('.content');
            container.html('');
            container.html(ajaxLoad);
            Animation.hide();
            container.fadeTo('slow', 1)
        }

    };

    _Popup.beforeShow = function (ajaxLoad) {

        popupContainer.addClass('isShow');
        var container = popupContainer.find('.content');

        container.html('')
            .fadeTo('fast', 0);

        Animation.load();

        if (ajaxLoad !== undefined) {
            document.querySelector('body').style.overflow = "hidden";
            container
                .html('')
                .html(ajaxLoad);
            Animation.hide();
        }

    };

    _Popup.loadNewLayout = function (html) {
        popupContainer.find('.content')
            .css('opacity', 0);
        if (popupContainer.hasClass('isShow')) {

            Animation.hide();

            popupContainer.find('.content')
                .animate({'opacity': 1}, 800)
                .html('')
                .html(html);
        }
    };

    _Popup.hide = function (callback) {
        hide(callback);
    };

    return _Popup;
})();

var Input = (function () {

    var _selectors = 'input[type="text"],input[type="password"],input[type="number"],input[type="email"],textarea';
    var isBuild = false;

    function init() {
        var inputWrapper = $('.input-wrapper');

        inputWrapper.each(function (index) {

            var $this = $(this);

            // Setup layout
            var _inputBox = $('<div class="input-box">');
            var _inputLine = $('<div class="input-line">');
            var _animateLine = $('<div class="animate-line">');

            var _input = $this.find(_selectors);
            var _labelText = $this.find('.float-text');


            if ($this.children('.input-line').length > 0) {
                $this.find(_inputLine).remove();
                $this.find(_animateLine).remove();

            } else {
                $this
                    .append(_input)
                    .append(_labelText)
                    .append(_inputLine)
                    .append(_animateLine);
            }


            //On Input Focus
            $(document).on('focus', _selectors, function (evt) {
                var $this = $(this);

                var _parent = $this.parents('.input-wrapper');
                if (!_parent.hasClass('focus')) {

                    _parent.addClass('focus')
                        .addClass('text-top');
                }
            });

            //On Input Blur
            $(document).on('blur', _selectors, function () {
                var $this = $(this);
                var _parent = $this.parents('.input-wrapper');

                _parent.removeClass('focus')
                    .addClass('blur');

                if (_parent.hasClass('text-top') && $this.val().length === 0) {
                    _parent.removeClass('text-top');
                }

                setTimeout(function () {
                    _parent.removeClass('blur');
                }, 300);
            });

            if (index === (inputWrapper.length - 1)) {
                isBuild = true;
                updateInput();
            }
        });
    }

    function updateInput() {

        if (isBuild) {
            setTimeout(function () {
                $(document).find(_selectors).each(function () {
                    var $this = $(this);
                    var _parent = $this.parents('.input-wrapper');

                    if ($this.val().length > 0) {
                        _parent.addClass('text-top');
                    }

                });
            }, 100)
        }
    }

    $(document).ready(function () {
        updateInput();
    });

    init();

    return {
        isBuild: isBuild,
        init: init,
        updateInput: updateInput
    }

})();

//Selector
var Select = (function () {


    var select = {};

    select.init = function (ele) {
        var ele = (ele !== undefined && ele !== "") ? ele : '.selector';

        $(ele).each(function () {
            var $this = $(this);

            var selectedOption = $this.find('.selected-option');
            var optionList = $this.find('.option-list');
            var htmlSelect = $this.find('select');

            var HTMLSelect = {
                isRequired: false,
                selected: function (selectedDisabled) {

                    var selectedVal = this.getSelectVal();

                    if (selectedVal == "Select" ||
                        selectedVal == null ||
                        selectedVal == undefined ||
                        selectedVal == "") {
                        var selected = htmlSelect.find('option:disabled')
                    } else {
                        var selected = htmlSelect.find('option:selected');
                    }

                    return [
                        selected,
                        selected.val(),
                        selected.html()
                    ];
                },
                options: function () {
                    var list = [];
                    htmlSelect.find('option').each(function () {
                        var isSelected = false;
                        var isDisabled = false;

                        if ($(this).is(':selected')) {
                            isSelected = true;
                        }

                        if ($(this).prop('disabled')) {
                            isDisabled = true;
                        }

                        var opt = {
                            val: $(this).val(),
                            text: $(this).html(),
                            isSelected: isSelected,
                            isDisabled: isDisabled
                        };
                        list.push(opt);
                    });
                    return list;
                },
                getSelectVal: function () {
                    return htmlSelect.val();
                },
                update: function (val) {
                    htmlSelect.find('option[value="' + val + '"]').prop('selected', true);
                    htmlSelect.trigger('change');
                }

            };

            //Show Selected
            function setSelected(isSelectedVal) {
                selectedOption.find('span').html(HTMLSelect.selected(isSelectedVal)[2]);
            }

            //Set options to list
            function setOptions() {
                optionList.html('');
                var count = 0;
                var optionLength = HTMLSelect.options().length;

                if (optionLength > 9) {
                    optionList.addClass('is-scroll');
                }

                if (optionLength === 1 || optionLength === 0) {
                    console.log('EEE ', HTMLSelect.getSelectVal())
                    if (HTMLSelect.getSelectVal() == "" ||
                        HTMLSelect.getSelectVal() == 0 ||
                        HTMLSelect.getSelectVal() == null ||
                        HTMLSelect.getSelectVal() == undefined) {
                        $this.addClass('is-disabled');
                    } else {
                        $this.removeClass('is-disabled');
                    }
                } else {
                    $this.removeClass('is-disabled');
                }
                HTMLSelect.options().map(function (option) {

                    var li = $('<li>');

                    if (option.isSelected) {
                        li.addClass('selected');
                    }
                    if (option.isDisabled) {
                        li.addClass('disabled');
                    }

                    li.html(option.text);
                    li.attr('data-val', option.val);
                    optionList.append(li);
                    count++;
                });

            }


            setSelected(true);
            setOptions();

            selectedOption.on('click', function () {
                $('.option-list').css('display', 'none');
                optionList.css('display', 'block');
            });

            //option click
            optionList.on('click', 'li', function () {
                optionList.css('display', 'none');
                var $this = $(this);
                var val = $this.attr('data-val');

                HTMLSelect.update(val);
                setSelected(false);
                setOptions();
            });

            htmlSelect.on('domChanged', function () {

            });

            $(document).on('click', function (evt) {
                var target = $(evt.target);

                if (!target.parents().hasClass('selector')) {
                    optionList.css('display', 'none');
                }
            });


        })
    };


    select.init();

    return select;

})();

$.fn.SearchBox = function (opt) {
    return $(this).each(function () {

        var defOption = {
            itemClick: null,
            onEnter: null,
            onKeyUp: null
        };

        var option = $.extend(defOption, opt);

        var $this = $(this);
        var $input = $this.find('input');
        var $searchPanel = $this.find('.search-result');

        $this.addClass('input-search-box');


        $input.on('keyup', function () {
            if ($(this).val().length > 0) {
                $this.addClass('is-active');
                if (typeof option.onKeyUp === 'function') {
                    option.onKeyUp.call($this, $(this));
                }
            } else {
                $this.removeClass('is-active');
            }
        });

        $input.on('keypress', function (evt) {

            if (evt.keyCode == 13) {

                if (typeof option.onEnter === 'function') {
                    $this.removeClass('is-active');
                    option.onEnter.call($this, $(this));
                    $input.val('');
                    $input.focus();
                }
            }
        });

        $searchPanel.find('ul li').on('click', function () {
            if (typeof option.itemClick === 'function') {
                $this.removeClass('is-active');
                $input.val('');
                option.itemClick.call($this, $(this));
            }

        })

    })
};

function msg(_this, _msg, _typeClass, _opt) {

    // var $outerLayer = $('<div class="cm-message-outer"></div>'),
    //     $message = $('<div class="message"></div>'),
    //     $body = $('body');
    //
    // $body.find('.cm-message-outer').remove();

    var defOpt = {
        delay: 3000,
        stay: false
    };
    var opt = $.extend(defOpt, _opt);

    var $this = _this;

    $this
        .html(_msg)
        .addClass('is-fixed')
        .addClass(_typeClass)
        .slideDown('slow', function () {
            if (!opt.stay) {
                setTimeout(function () {

                    $this.fadeOut(500, function () {
                        $this.html('')
                            .removeClass(_typeClass);
                    })

                }, opt.delay)
            }

        });

    // $message
    //     .html(_msg)
    //     .addClass(_typeClass);
    // $outerLayer.append($message);
    // console.log($($message))
    // // alert($message.get(0).innerWidth)
    // $body.append($outerLayer);
}

$.fn.Success = function (_msg, _opt) {

    return this.each(function () {
        msg($(this), _msg, 'success', _opt);
    });
};

$.fn.Error = function (_msg, _opt) {

    return this.each(function () {
        msg($(this), _msg, 'error', _opt);
    });
};

$.fn.Info = function (_msg, _opt) {

    return this.each(function () {
        msg($(this), _msg, 'error', _opt);
    });
};


var SearchBox = (function () {

    var search = {};

    $('.input-search-box').each(function () {


        return search;
    });

})();

var imageCropData = (function () {
    var cropDataName = null;
    return {
        set: function (_data) {
            cropDataName = _data;
        },
        get: function () {
            return cropDataName;
        },
        trigger: function (fn, data) {
            window[fn].call(this, data);
        }
    };
})();


//------------------------------------------------------------------------------------
//Registration
//------------------------------------------------------------------------------------
$('.btn-registration').on('click', function (evt) {
    evt.preventDefault();

    Popup.beforeShow();

    loadLayoutByAjax('/Site/RegistrationPopup', function (html) {
        Popup.addClass('registration-popup');
        Popup.show(html);
        Input.init();
    });
});

//------------------------------------------------------------------------------------
//Sign In
//------------------------------------------------------------------------------------
$('.btn-sign-in').on('click', function (evt) {

    evt.preventDefault();

    Popup.beforeShow();

    loadLayoutByAjax('/Site/SignInPopup', function (html) {
        Popup.addClass('sign-in-popup');
        Popup.addClass('small');
        Popup.show(html);
        Input.init();
    });

});

$('.popup-container').on('click', '.forget_password', function (evt) {
    evt.preventDefault();

    Popup.beforeShow();

    loadLayoutByAjax('/Site/PasswordResetFrom', function (html) {
        Popup.loadNewLayout(html);
        Input.init();
    })
});


(function () {
    var isShow = false;
    $('.profile-link').on('click', function (e) {
        var $this = $(this);

        if (!$this.hasClass('is-active')) {
            $this.addClass('is-active');
            $this.find('.drop-box').fadeIn('fast');

        }
    });

    $(document).on('click', function (e) {

        var $this = $(e.target);
        var $profileLink = $('.profile-link');

        if ($this.hasClass('is-active') ||
            $this.parents('.profile-link').hasClass('is-active')) return;

        $profileLink.find('.drop-box').fadeOut('fast');
        $profileLink.removeClass('is-active');
    });
})();

var Animation = (function () {
    var ele = null;
    return {
        load: function (_ele) {
            var self = this;
            ele = _ele !== undefined ? _ele : '.popup';
            this.message = this.message !== undefined ? this.message : 'Please wait...';

            showLoader();

            (function () {
                var oldMsg = self.message;
                setInterval(function () {
                    if (oldMsg !== self.message) {
                        oldMsg = self.message;
                        $('.animation-outer').find('.text-orange').text(oldMsg);
                    }
                }, 100);
            }());

            function showLoader() {
                console.log('Self', self)
                var html = '';
                html += '<div class="animation-outer">';
                html += '<div class="animation">';
                html += '<img src="' + BASE_URL + '/images/system/loader/frontLoader.gif" alt="">';
                html += '<h5 class="text-orange">' + self.message + '</h5>';
                html += '</div>';
                html += '</div>';

                $('.popup').css('overflow', 'hidden');
                $(ele).append(html);
            }

            return this;
        },
        hide: function () {
            if (ele) {
                $('.popup').attr('style', '');
                $(ele).find('.animation-outer').remove();
                this.message = undefined;
            }
        },
        loader: function () {
            var html = '';
            html += '<div class="animation-outer fixed">';
            html += '<div class="animation">';
            html += '<img src="' + BASE_URL + '/images/system/loader/frontLoader.gif" alt="">';
            html += '</div>';
            html += '</div>';
            return html;
        },

    }
})();

var Button = function (ele) {

    var ele = ele !== undefined ? ele : ".disabled";

    return {
        disabled: function () {
            $(document).find(ele).prop('disabled', true);
        },
        enabled: function () {
            $(document).find(ele).prop('disabled', false);
        }
    };
};

$.fn.Button = function (options) {
    var defaultOption = {
        disabled: false,
        enabled: false
    };

    var option = $.extend(defaultOption, options);

    $(this).each(function () {
        var $this = $(this);

        if (option.disabled) {
            $(document).find($this).prop('disabled', true);
        } else {
            $(document).find($this).prop('disabled', false);
        }

    });

};

var fileUploader = (function () {

    load();

    function load() {
        var $inputFile = $('input[type="file"]');

        $inputFile.on('change', function () {
            fileLoad($(this));
        });

        $inputFile.each(function () {
            fileLoad($(this));
        });

        //............................................

        function fileLoad($this) {
            var defaultObj = $this.get(0);

            if (!defaultObj.files[0])
                return;

            var fileName = defaultObj.files[0].name,
                parentDiv = $this.parent();

            if (parentDiv.hasClass('file-uploader')) {
                var span = $('<span class="fileName"></span>');
                var spanClose = $('<span class="btn-close"></span>');
                span.attr('title', fileName);

                if (parentDiv.find('.fileName').length === 1) {
                    parentDiv.find('.fileName').remove();
                    parentDiv.append(span.text(fileName));
                } else {
                    parentDiv.append(span.text(fileName));
                }

                // span.append(spanClose);

            }
        }
    }

    return {
        load: load
    }

}());

var Toast = (function () {
    var $outerLayer = $('<div class="toast-outer"></div>');
    var $toast = $('<div class="toast"></div>');

    return {
        success: function (message) {
            $('body').find('.toast-outer').remove();
            $('body').append($outerLayer);

            $toast
                .addClass('success')
                .text(message);

            $outerLayer
                .addClass('is-show')
                .append($toast);

        }
    };
}());

// Toast.success('Success')

// Mobole meun js
(function () {
    var isOpen = false;

    var $outer = $('<div class="menu-outer"></div>');

    function appendOuter() {
        $('body').append($outer);

        $outer.on('click', function () {
            isOpen = !isOpen;
            menuShowHide();
        });
    }

    $('.mobile-menu').on('click', function () {
        isOpen = !isOpen;
        menuShowHide();
    });

    function menuShowHide() {
        if (isOpen) {
            appendOuter();
            $('body').css('overflow', 'hidden');
            $('.navbar-nav').addClass('is-show');
        } else {
            $('.navbar-nav').removeClass('is-show');
            $('body').css('overflow', 'auto');
            $('.menu-outer').remove();
        }
    }
})();

