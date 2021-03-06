<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<div class="lp_page wp-core-ui">

    <div id="lp_js_flashMessage" class="lp_flashMessage" style="display:none;">
        <p></p>
    </div>

    <div class="lp_navigation lp_u_relative">
        <?php if ( ! $laterpay['plugin_is_in_live_mode'] ): ?>
            <a href="<?php echo add_query_arg( array( 'page' => $laterpay['admin_menu']['account']['url'] ), admin_url( 'admin.php' ) ); ?>" class="lp_pluginModeIndicator lp_u_absolute" data-icon="h">
                <h2><?php _e( '<strong>Test</strong> mode', 'laterpay' ); ?></h2>
                <span><?php _e( 'Earn money in <i>live mode</i>', 'laterpay' ); ?></span>
            </a>
        <?php endif; ?>
        <?php echo $laterpay['top_nav']; ?>
    </div>

    <div class="lp_wrap">

        <h1><?php echo sprintf( __( '%s Dashboard of %s Sales between%s%s%s', 'laterpay' ),
            '<div class="lp_dropdown">' .
                '<span class="lp_dropdown_currentItem">' . __( '8 Day', 'laterpay' ) . '</span>' .
                '<div class="lp_dropdown_list">' .
                    '<div class="lp_triangle lp_outerTriangle"><div class="lp_triangle"></div></div>' .
                    '<a href="#" class="lp_js_selectDashboardInterval lp_dropdown_listItem" data-interval="day">' .
                        __( '24 Hour', 'laterpay' ) .
                    '</a>' .
                    '<a href="#" class="lp_js_selectDashboardInterval lp_dropdown_listItem lp_is-selected" data-interval="week">' .
                         __( '8 Day', 'laterpay' ) .
                     '</a>' .
                    '<a href="#" class="lp_js_selectDashboardInterval lp_dropdown_listItem" data-interval="2-weeks">' .
                        __( '2 Week', 'laterpay' ) .
                    '</a>' .
                    '<a href="#" class="lp_js_selectDashboardInterval lp_dropdown_listItem" data-interval="month">'
                        . __( '1 Month', 'laterpay' ) .
                    '</a>' .
                '</div>' .
            '</div>',

            '<div class="lp_dropdown">' .
                '<span class="lp_dropdown_currentItem">' . __( 'all', 'laterpay' ) . '</span>' .
                '<div class="lp_dropdown_list">' .
                    '<div class="lp_triangle lp_outerTriangle"><div class="lp_triangle"></div></div>' .
                    '<a href="#" class="lp_js_selectRevenueModel lp_dropdown_listItem lp_is-selected" data-revenue-model="all">' .
                        __( 'all', 'laterpay' ) .
                    '</a>' .
                    '<a href="#" class="lp_js_selectRevenueModel lp_dropdown_listItem" data-revenue-model="ppu">' .
                        __( 'PPU', 'laterpay' ) .
                    '</a>' .
                    '<a href="#" class="lp_js_selectRevenueModel lp_dropdown_listItem" data-revenue-model="sis">' .
                        __( 'SIS', 'laterpay' ) .
                    '</a>' .
                '</div>' .
            '</div>',

            '<a href="#" id="lp_js_loadPreviousInterval" class="lp_prevNextLink lp_tooltip" data-tooltip="Show week before">' .
                '<div class="lp_triangle lp_triangle--left"></div>' .
            '</a>',

            '<span id="lp_js_displayedInterval">' .
                date( 'j.n.', strtotime( '-8 days' ) ) .
                ' &ndash; ' .
                date( 'j.n.', strtotime( '-1 days' ) ) .
            '</span>',

            '<a href="#" id="lp_js_loadNextInterval" class="lp_prevNextLink lp_tooltip" data-tooltip="Show week after">' .
                '<div class="lp_triangle lp_triangle--right"></div>' .
            '</a>'
        ); ?>
        <a href="#" id="lp_js_refreshDashboard" class="lp_DashboardRefreshLink"><?php _e( 'Refresh', 'laterpay' ); ?></a></h1>

        <div class="lp_row">
            <div class="lp_u_w-1-3">
                <h2><?php _e( 'Conversion', 'laterpay' ); ?></h2>
                <div id="lp_js_conversionDiagram" class="lp_dashboardGraph"></div>
                <div class="lp_statisticsRow lp_u_clearfix">
                    <ul>
                        <li class="lp_tooltip" data-tooltip="<?php _e( 'Number of times a page with purchasable content has been viewed in selected interval', 'laterpay' ); ?>">
                            <big><span id="lp_js_totalImpressions">0</span></big>
                            <?php _e( 'Views', 'laterpay' ); ?>
                        </li>
                        <li class="lp_tooltip" data-tooltip="<?php _e( 'Share of purchases of all page views of pages with purchasable content', 'laterpay' ); ?>">
                            <big><span id="lp_js_avgConversion">0.0</span><small>%</small></big>
                            <?php _e( 'Conversion', 'laterpay' ); ?>
                        </li>
                        <li class="lp_tooltip" data-tooltip="<?php _e( 'Share of new buyers of all buyers in selected interval', 'laterpay' ); ?>">
                            <big><span id="lp_js_shareOfNewCustomers">0</span><small>%</small></big>
                            <?php _e( 'New Customers', 'laterpay' ); ?>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="lp_u_w-1-3">
                <h2><?php _e( 'Items Sold', 'laterpay' ); ?></h2>
                <div id="lp_js_salesDiagram" class="lp_dashboardGraph"></div>
                <div class="lp_statisticsRow lp_u_clearfix">
                    <ul>
                        <li class="lp_tooltip" data-tooltip="<?php _e( 'Average number of items sold per day in selected interval', 'laterpay' ); ?>">
                            <big><span id="lp_js_avg-items-sold">0.0</span></big>
                            <?php _e( 'AVG Items Sold', 'laterpay' ); ?>
                        </li>
                        <li class="lp_tooltip" data-tooltip="<?php _e( 'Total number of items sold in selected interval', 'laterpay' ); ?>">
                            <big><span id="lp_js_total-items-sold">0</span></big>
                            <?php _e( 'Items Sold', 'laterpay' ); ?>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="lp_u_w-1-3">
                <h2><?php _e( 'Committed Revenue', 'laterpay' ); ?></h2>
                <div id="lp_js_revenueDiagram" class="lp_dashboardGraph"></div>
                <div class="lp_statisticsRow lp_u_clearfix">
                    <ul>
                        <li class="lp_tooltip" data-tooltip="<?php _e( 'Average value of items sold in selected interval', 'laterpay' ); ?>">
                            <big><span id="lp_js_avgRevenue">0.00</span><small><?php echo $laterpay['currency']; ?></small></big>
                            <?php _e( 'AVG Purchase', 'laterpay' ); ?>
                        </li>
                        <li class="lp_tooltip" data-tooltip="<?php _e( 'Total value of items sold in selected interval', 'laterpay' ); ?>">
                            <big><span id="lp_js_totalRevenue">0.00</span><small><?php echo $laterpay['currency']; ?></small></big>
                            <?php _e( 'Committed Revenue', 'laterpay' ); ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="lp_row">
            <div class="lp_u_w-1-3">
                <h3><?php _e( 'Best-converting Items', 'laterpay' ); ?></h3>
                <ol id="lp_js_bestConvertingList" class="lp_topBottomList">
                    <dfn><?php _e( 'No data available', 'laterpay' ); ?></dfn>
                </ol>
                <h3><?php _e( 'Least-converting Items', 'laterpay' ); ?></h3>
                <ol id="lp_js_leastConvertingList" class="lp_topBottomList">
                    <dfn><?php _e( 'No data available', 'laterpay' ); ?></dfn>
                </ol>
            </div>
            <div class="lp_u_w-1-3">
                <h3><?php _e( 'Most-selling Items', 'laterpay' ); ?></h3>
                <ol id="lp_js_bestSellingList" class="lp_topBottomList">
                    <dfn><?php _e( 'No data available', 'laterpay' ); ?></dfn>
                </ol>
                <h3><?php _e( 'Least-selling Items', 'laterpay' ); ?></h3>
                <ol id="lp_js_leastSellingList" class="lp_topBottomList">
                    <dfn><?php _e( 'No data available', 'laterpay' ); ?></dfn>
                </ol>
            </div>
            <div class="lp_u_w-1-3">
                <h3><?php _e( 'Most Revenue-generating Items', 'laterpay' ); ?></h3>
                <ol id="lp_js_bestGrossingList" class="lp_topBottomList">
                    <dfn><?php _e( 'No data available', 'laterpay' ); ?></dfn>
                </ol>
                <h3><?php _e( 'Least Revenue-generating Items', 'laterpay' ); ?></h3>
                <ol id="lp_js_leastGrossingList" class="lp_topBottomList">
                    <dfn><?php _e( 'No data available', 'laterpay' ); ?></dfn>
                </ol>
            </div>
        </div>

    </div>

</div>
