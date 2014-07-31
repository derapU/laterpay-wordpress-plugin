<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<?php if ( $post_content_cached && ! LaterPay_Helper_Request::is_ajax() ): ?>
    <span id="laterpay-post-footer" data-post-id="<?php echo $post_id; ?>"></span>
    <script>
        (function($) {
            $('#laterpay-post-footer').hide();
            var post_id = $('#laterpay-post-footer').data('post-id');
            $.get(
                lpVars.getFooterUrl,
                {id: post_id, show_statistic: true},
                function(html) {
                    $('#laterpay-post-footer').before(html);
                    $('#laterpay-post-footer').remove();
                    lpShowStatistic();
                }
            );
        })(jQuery);
    </script>
<?php else: ?>
<iframe src="<?php echo $identify_link; ?>" id="laterpay-identify" style="height:1px; left:-9000px; position:absolute; width:1px;"></iframe>
<?php endif; ?>
