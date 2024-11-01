(function ($) {
    $(function () {
        var bqs = $(tte_settings.tte_jquery_selector);
        var user = $(tte_settings.tte_username);
        for (var i = 0; i < bqs.length; i++) {
            var tweetCopy = bqs[i].innerText;
            buildLink(tweetCopy);
        }

        function buildLink() {
            // check if user wants to include the page url
            var includeUrl = tte_settings.tte_page_url;
            if (includeUrl !== "1") {
                if (user.selector === "" || user.selector === null) {
                    $('<div class="tweet-this twitter-share-button"><a href="https://twitter.com/intent/tweet?text=' + tweetCopy + '">' + tte_settings.tte_link_text + '</a></div>').insertAfter(bqs[i]);
                } else {
                    $('<div class="tweet-this twitter-share-button"><a href="https://twitter.com/intent/tweet?text=' + tweetCopy + '&via=' + user.selector + '">' + tte_settings.tte_link_text + '</a></div>').insertAfter(bqs[i]);
                }
            } else {
                if (user.selector === "" || user.selector === null) {
                    $('<div class="tweet-this twitter-share-button"><a href="https://twitter.com/intent/tweet?text=' + tweetCopy + '&url=' + window.location.href + '">' + tte_settings.tte_link_text + '</a></div>').insertAfter(bqs[i]);
                } else {
                    $('<div class="tweet-this twitter-share-button"><a href="https://twitter.com/intent/tweet?text=' + tweetCopy + '&url=' + window.location.href + '&via=' + user.selector + '">' + tte_settings.tte_link_text + '</a></div>').insertAfter(bqs[i]);
                }
            }
        }

    });
})(jQuery);