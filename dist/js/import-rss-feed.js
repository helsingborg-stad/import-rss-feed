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
            }.bind(this),
            error : function(jqXHR, status, error) {
            }
        });
    };

    return new ManualRssImport();
})(jQuery);

//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbImltcG9ydC1yc3MtZmVlZC5qcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EiLCJmaWxlIjoiaW1wb3J0LXJzcy1mZWVkLmpzIiwic291cmNlc0NvbnRlbnQiOlsidmFyIEltcG9ydFJzc0ZlZWQgPSB7fTtcblxuSW1wb3J0UnNzRmVlZC5NYW51YWxSc3NJbXBvcnQgPSAoZnVuY3Rpb24gKCQpIHtcbiAgICB2YXIgYWpheE9iamVjdCA9IGltcG9ydFJzc0ZlZWRBamF4T2JqZWN0O1xuICAgIHZhciBsb2FkaW5nU3RhdGUgPSBmYWxzZTtcblxuICAgIGZ1bmN0aW9uIE1hbnVhbFJzc0ltcG9ydCgpIHtcbiAgICAgICAgaWYgKHR5cGVvZihhamF4T2JqZWN0KSA9PSAndW5kZWZpbmVkJykge1xuICAgICAgICAgICAgcmV0dXJuO1xuICAgICAgICB9XG5cbiAgICAgICAgJChkb2N1bWVudCkub24oJ2NsaWNrJywgJy5qcy1ydW4tcnNzLWltcG9ydCcsIGZ1bmN0aW9uKGUpIHtcbiAgICAgICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcblxuICAgICAgICAgICAgaWYgKGxvYWRpbmdTdGF0ZSkge1xuICAgICAgICAgICAgICAgIHJldHVybjtcbiAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgdGhpcy50b2dnbGVMb2FkaW5nU3RhdGUoKTtcbiAgICAgICAgICAgIHRoaXMucnVuSW1wb3J0KGFqYXhPYmplY3QuYWRtaW5VcmwsIGFqYXhPYmplY3Qubm9uY2UpO1xuICAgICAgICB9LmJpbmQodGhpcykpO1xuICAgIH1cblxuICAgIE1hbnVhbFJzc0ltcG9ydC5wcm90b3R5cGUudG9nZ2xlTG9hZGluZ1N0YXRlID0gZnVuY3Rpb24gKCkge1xuXG4gICAgICAgIGlmICghbG9hZGluZ1N0YXRlKSB7XG4gICAgICAgICAgICAkKCcuanMtcnVuLXJzcy1pbXBvcnQnKS5hZGRDbGFzcygnYnV0dG9uLWRpc2FibGVkJyk7XG4gICAgICAgICAgICAkKCcuanMtc3Bpbm5lcicpLmFkZENsYXNzKCdpcy1hY3RpdmUnKTtcblxuICAgICAgICAgICAgbG9hZGluZ1N0YXRlID0gdHJ1ZTtcbiAgICAgICAgICAgIHJldHVybjtcbiAgICAgICAgfVxuXG4gICAgICAgICQoJy5qcy1ydW4tcnNzLWltcG9ydCcpLnJlbW92ZUNsYXNzKCdidXR0b24tZGlzYWJsZWQnKTtcbiAgICAgICAgJCgnLmpzLXNwaW5uZXInKS5yZW1vdmVDbGFzcygnaXMtYWN0aXZlJyk7XG5cbiAgICAgICAgbG9hZGluZ1N0YXRlID0gZmFsc2U7XG4gICAgfTtcblxuICAgIE1hbnVhbFJzc0ltcG9ydC5wcm90b3R5cGUucnVuSW1wb3J0ID0gZnVuY3Rpb24gKHVybCwgbm9uY2UpIHtcbiAgICAgICAgJC5hamF4KHtcbiAgICAgICAgICAgIHVybCA6IHVybCxcbiAgICAgICAgICAgIHR5cGUgOiAncG9zdCcsXG4gICAgICAgICAgICBkYXRhIDoge1xuICAgICAgICAgICAgICAgIGFjdGlvbiA6ICdpbXBvcnRSc3NGZWVkJyxcbiAgICAgICAgICAgICAgICBub25jZSA6IG5vbmNlXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgc3VjY2VzcyA6IGZ1bmN0aW9uKHJlc3BvbnNlLCBzdGF0dXMpIHtcbiAgICAgICAgICAgICAgICB0aGlzLnRvZ2dsZUxvYWRpbmdTdGF0ZSgpO1xuICAgICAgICAgICAgICAgIGNvbnNvbGUubG9nKHJlc3BvbnNlKTtcbiAgICAgICAgICAgIH0uYmluZCh0aGlzKSxcbiAgICAgICAgICAgIGVycm9yIDogZnVuY3Rpb24oanFYSFIsIHN0YXR1cywgZXJyb3IpIHtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfSk7XG4gICAgfTtcblxuICAgIHJldHVybiBuZXcgTWFudWFsUnNzSW1wb3J0KCk7XG5cbn0pKGpRdWVyeSk7XG4iXX0=
