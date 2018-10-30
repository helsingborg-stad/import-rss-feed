var ImportRssFeed = {};

ImportRssFeed.ManualRssImport = (function ($) {
    var ajaxObject = importRssFeedAjaxObject;
    var loadingState = false;

    function ManualRssImport() {
        if (typeof(ajaxObject) == 'undefined') {
            return;
        }

        $(document).on('click', '.js-run-rss-import', function(e) {
            e.preventDefault();

            if (loadingState) {
                return;
            }

            this.toggleLoadingState();
            this.runImport(ajaxObject.adminUrl, ajaxObject.nonce);
        }.bind(this));
    }

    ManualRssImport.prototype.toggleLoadingState = function () {

        if (!loadingState) {
            $('.js-run-rss-import').addClass('button-disabled');
            $('.js-spinner').addClass('is-active');

            loadingState = true;
            return;
        }

        $('.js-run-rss-import').removeClass('button-disabled');
        $('.js-spinner').removeClass('is-active');

        loadingState = false;
    };

    ManualRssImport.prototype.runImport = function (url, nonce) {
        $.ajax({
            url : url,
            type : 'post',
            data : {
                action : 'importRssFeed',
                nonce : nonce
            },
            success : function(response, status) {
                this.toggleLoadingState();
                console.log(response);
            }.bind(this),
            error : function(jqXHR, status, error) {
            }
        });
    };

    return new ManualRssImport();

})(jQuery);
