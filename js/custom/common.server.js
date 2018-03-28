function loadLayoutByAjax(url, callback) {
    $.ajax({
        type: 'POST',
        url: base_url(url),
        success: function (res) {
            callback(res);
        },
        error:function (error) {
            console.log(error);
            callback('<h3 style="color: #000;"><span style="color: #fbab18;">Oops,</span> something went wrong..</h3>');
        }
    });
}

function _ajax(opt, callback) {
    var defOpt = {
        url:null,
        type:'POST'
    };
    var opt = $.extend(defOpt,opt);
    console.info('Loading...');
    $.ajax({
        type: opt.type,
        url: base_url(opt.url),
        success: function (res) {
            console.info('Loaded');
            callback(res);
        },
        error:function (error) {
            console.log(error);
            callback('<h3 style="color: #000;"><span style="color: #fbab18;">Oops,</span> something went wrong..</h3>');
        }
    });
}