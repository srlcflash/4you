$(function () {
    var advanceToggle = false;

    $('.btnAdvance').on('click', function () {
        advanceToggle = !advanceToggle;
        if (advanceToggle) {
            $('.more-panel').slideDown('fast');
            $('.search-action').addClass('hide');
        }else {
            $('.more-panel').slideUp('fast');
            $('.search-action').removeClass('hide');
        }
    });


});

/*======================================
 Message
 =======================================*/

var Message = (function () {
    var _message = {};

    function removeClasses() {
        var classes = ['success', 'info', 'warning', 'danger'];
        classes.map(function (item) {
            $('.adm-alert').removeClass(item);
        });

    }

    function loadMessage(msg, type) {

        var msgTypes = {
            'success': 'success',
            'info': 'info',
            'warning': 'warning',
            'danger': 'danger'
        };

        removeClasses();

        $('.adm-alert')
            .html(msg)
            .addClass(msgTypes[type])
            .slideDown('slow', function () {
                var _this = $(this);
                setTimeout(function () {
                    _this.slideUp('fast');
                    removeClasses();
                }, 3000);
            });
    }

    _message.success = function (msg) {
        if (msg === '' || msg === undefined) {
            msg = 'Save Successfully!'
        }
        loadMessage(msg, 'success');
    };

    _message.info = function (msg) {
        if (msg === '' || msg === undefined) {
            msg = 'Please wait...'
        }
        loadMessage(msg, 'info');
    };

    _message.danger = function (msg) {
        if (msg === '' || msg === undefined) {
            msg = 'Oh snap!'
        }
        loadMessage(msg, 'danger');
    };

    _message.warning = function (msg) {
        if (msg === '' || msg === undefined) {
            msg = 'Warning!'
        }
        loadMessage(msg, 'warning');
    };

    return _message;

})();

/*=========================================
 Search bar
 =========================================*/

$(function () {
    $(document).find('.search-input-wrp input[type="text"].input-search').on('focus', function () {
        $(this).parents('.search-input-wrp').addClass('input-focus');
    });

    $(document).find('.search-input-wrp input[type="text"].input-search').on('blur', function () {
        $(this).parents('.search-input-wrp').removeClass('input-focus');
    });
});

/*=========================================
 Sweet Alert
 =========================================*/

var Alert = (function () {

    /*
     How to use....

     ----------------
     Confirm Alert
     -----------------

     Default
     1. Alert.confirm();

     Your Way
     2. Alert.confirm({
     title: "Your message title goes here",
     msg: "Your message goes here",

     ---- Call after confirm btn was click.---
     confirmed: function(){
     //Your code
     },

     ---- Call after confirm btn was click.---
     canceled: function(){
     //Your code
     }
     });

     */

    var _alert = {};

    _alert.confirm = function (option) {

        var _option = {
            title: "Are you sure?",
            msg: "You will not be able to recover this imaginary file!",
            type: "warning",
            confirmed: null,
            canceled: null
        };

        _option = $.extend(_option, option);

        swal({
                title: _option.title,
                text: _option.msg,
                type: _option.type,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: true
            },
            function (isConfirm) {
                if (isConfirm) {
                    // Call after confirm btn click
                    if (typeof _option.confirmed === 'function') {
                        _option.confirmed();
                    }
                } else {
                    // Call after cancel btn click
                    if (typeof _option.canceled === 'function') {
                        _option.canceled();
                    }
                }
            }
        );
    };

    return _alert;
})();


/*=========================================
 Scroll
 =========================================*/

var Scroll = (function () {
    var _scroll = {};

    _scroll.toUp = function (pos) {
        var _pos = ( pos > 0 && pos != undefined) ? pos : 0;
        $("html, body").animate({scrollTop: _pos}, "slow");
    };

    return _scroll;
}());

var Modal = (function () {
    var _modal = {};


    _modal.show = function (option) {
        var defaultOpt = {
            loadAjax: null
        };

        var opt = $.extend(defaultOpt, option);

        $('.modal').modal('open', {
                dismissible: true,
                opacity: .5,
                inDuration: 300,
                outDuration: 200,
                startingTop: '4%',
                endingTop: '10%',
                ready: function (modal, trigger) {

                    if (opt.loadAjax && typeof opt.loadAjax == 'function') {
                        opt.loadAjax.call(this, modal, trigger);
                    }
                }
            }
        );
    };

    _modal.close = function () {
        $('.modal').modal('close', {
            complete: function () {

            } // Callback for Modal close
        });
    };

    return _modal;
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
                console.log('Self',self)
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


// $(function () {
//     $('.btn-editAndSave').on('click',function () {
//         var $this = $(this);
//         var input = $this.prev('input');
//         if(input.is(':disabled')) {
//             input.prop('disabled',false);
//             $this.find('i').html('save');
//         }else {
//             input.prop('disabled',true);
//             $this.find('i').html('edit');
//         }
//     });
// });

