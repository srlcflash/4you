var MAIN_ID = '0';
var SUB_ID = '0';

window.clearCategoryIds = function () {
    MAIN_ID = '0';
    SUB_ID = '0';
};

function loadJobData(category) {
    MAIN_ID = category.main.length > 0 ? category.main[0] : '0';
    SUB_ID = category.sub.length > 0 ? category.sub[0] : '0';
    loadAdvertisementData(1);
}

//Category Popup
function CategoryPopup() {
    return {
        html: function (callback) {
            $.ajax({
                type: 'GET',
                url: base_url('/Site/CategoryPopup'),
                success: function (res) {
                    callback(res);
                }
            });
        }
    }
}