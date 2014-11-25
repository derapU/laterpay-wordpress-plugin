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

    <div class="lp_pagewrap">
        <ul class="lp_row lp_u_clearfix">
            <li class="lp_u_left lp_u_w-1-3">
                <div class="lp_u_m-0 lp_u_m-r1">
                    <h2><?php _e( 'Global Default Price', 'laterpay' ); ?></h2>
                    <hr class="lp_u_b-0 lp_u_m-0 lp_u_m-t05 lp_u_m-b025">
                    <dfn class="lp_spacer lp_u_block">&nbsp;</dfn>

                    <form id="lp_js_globalDefaultPrice_form" method="post" action="">
                        <input type="hidden" name="form"    value="global_price_form">
                        <input type="hidden" name="action"  value="laterpay_pricing">
                        <?php if ( function_exists( 'wp_nonce_field' ) ) { wp_nonce_field( 'laterpay_form' ); } ?>

                        <a href="#" id="lp_js_cancelEditingGlobalDefaultPrice" class="lp_editLink lp_cancel-link lp_u_right" data-icon="e" style="display:none;"><?php _e( 'Cancel', 'laterpay' ); ?></a>
                        <a href="#" id="lp_js_saveGlobalDefaultPrice" class="lp_editLink lp_saveLink lp_u_right" data-icon="f" style="display:none;"><?php _e( 'Save', 'laterpay' ); ?></a>
                        <p>
                            <span id="lp_js_globalDefaultPrice_revenueModelLabel" class="lp_js_revenueModel_labelDisplay lp_revenueModelLabel lp_u_m-r025"><?php echo $laterpay['global_default_price_revenue_model']; ?></span>
                            <span id="lp_js_globalDefaultPrice_revenueModel" class="lp_js_revenueModel lp_revenueModel lp_u_relative lp_u_left" style="display:none;">
                                <label class="lp_js_revenueModel_label lp_revenueModelLabel lp_js_globalDefaultPrice_revenueModelLabel lp_u_m-r05 lp_u_m-b025
                                        <?php if ( $laterpay['global_default_price_revenue_model'] == 'ppu' || ! $laterpay['global_default_price_revenue_model'] ) { echo 'lp_is-selected'; } ?>
                                        <?php if ( $laterpay['global_default_price'] > 5 ) { echo 'lp_is-disabled'; } ?>">
                                    <input type="radio" name="laterpay_global_price_revenue_model" class="lp_js_revenueModel_input" value="ppu"<?php if ( $laterpay['global_default_price_revenue_model'] == 'ppu' || ( ! $laterpay['global_default_price_revenue_model'] && $laterpay['global_default_price'] < 5 ) ) { echo ' checked'; } ?>>PPU
                                </label><label class="lp_js_revenueModel_label lp_revenueModelLabel lp_js_globalDefaultPrice_revenueModelLabel lp_u_m-r05 lp_u_m-b025
                                        <?php if ( $laterpay['global_default_price_revenue_model'] == 'sis' ) { echo 'lp_is-selected'; } ?>
                                        <?php if ( $laterpay['global_default_price'] < 1.49) { echo 'lp_is-disabled'; } ?>">
                                    <input type="radio" name="laterpay_global_price_revenue_model" class="lp_js_revenueModel_input" value="sis"<?php if ( $laterpay['global_default_price_revenue_model'] == 'sis' ) { echo ' checked'; } ?>>SIS
                                </label>
                            </span>
                            <?php _e( '<strong>Every post</strong> costs', 'laterpay' ); ?>
                            <strong>
                                <input  type="text"
                                        name="laterpay_global_price"
                                        id="lp_js_globalDefaultPrice"
                                        class="lp_js_priceInput lp_input lp_numberInput"
                                        value="<?php echo LaterPay_Helper_View::format_number( $laterpay['global_default_price'] ); ?>"
                                        style="display:none;"
                                        placeholder="<?php echo LaterPay_Helper_View::format_number( 0 ); ?>"
                                        autocomplete="off">
                                <span id="lp_js_globalDefaultPrice_text"><?php echo LaterPay_Helper_View::format_number( $laterpay['global_default_price'] ); ?></span>
                                <span class="lp_js_currency lp_currency"><?php echo $laterpay['standard_currency']; ?></span>
                            </strong>
                            <a href="#" id="lp_js_editGlobalDefaultPrice" class="lp_editLink lp_change-link" data-icon="d"><?php _e( 'Change', 'laterpay' ); ?></a>
                        </p>
                    </form>

                </div>
            </li>

            <li class="lp_u_left lp_u_w-1-3">
                <div class="lp_u_m-0 lp_u_m-r1">
                    <h2><?php _e( 'Category Default Prices', 'laterpay' ); ?></h2>
                    <hr class="lp_u_b-0 lp_u_m-0 lp_u_m-t05 lp_u_m-b025">
                    <dfn class="lp_spacer lp_u_block"><?php _e( 'Category default prices overwrite global default prices.', 'laterpay' ); ?></dfn>

                    <div id="lp_js_categoryDefaultPrice_list">
                        <p class="lp_u_m-1-0-0"><strong><?php _e( 'Every post in category', 'laterpay' ); ?> &hellip;</strong></p>
                        <?php foreach ( $laterpay['categories_with_defined_price'] as $category ): ?>
                            <form method="post" class="lp_js_categoryDefaultPrice_form lp_category-price-form">

                                <p class="lp_u_m-t025">
                                    <input type="hidden" name="form" value="price_category_form">
                                    <input type="hidden" name="action" value="laterpay_pricing">
                                    <input type="hidden" name="category_id" class="lp_js_categoryDefaultPrice_categoryId" value="<?php echo $category->category_id; ?>">
                                    <?php if ( function_exists( 'wp_nonce_field' ) ) { wp_nonce_field( 'laterpay_form' ); } ?>

                                    <?php $category_price           = LaterPay_Helper_View::format_number( (float) $category->category_price ); ?>
                                    <?php $category_revenue_model   = $category->revenue_model; ?>

                                    <div class="lp_js_revenueModel lp_revenueModel lp_u_relative lp_u_left" style="display:none;">
                                        <label class="lp_js_revenueModel_label lp_revenueModelLabel lp_u_m-r05 lp_u_m-b025
                                                    <?php if ( $category_revenue_model == 'ppu' || ( ! $category_revenue_model && $category_price <= 5 ) ) { echo 'lp_is-selected'; } ?>
                                                    <?php if ( $category_price > 5) { echo 'lp_is-disabled'; } ?>">
                                            <input type="radio" name="laterpay_category_price_revenue_model_<?php echo $category->category_id; ?>" class="lp_js_revenueModel_input" value="ppu"<?php if ( $category_revenue_model == 'ppu' || ( ! $category_revenue_model && $category_price <= 5 )) { echo ' checked'; } ?>>PPU
                                        </label>
                                        <label class="lp_js_revenueModel_label lp_revenueModelLabel lp_u_m-r05 lp_u_m-b025
                                                    <?php if ( $category_revenue_model == 'sis' || ( ! $category_revenue_model && $category_price > 5 ) ) { echo 'lp_is-selected'; } ?>
                                                    <?php if ( $category_price < 1.49) { echo 'lp_is-disabled'; } ?>">
                                            <input type="radio" name="laterpay_category_price_revenue_model_<?php echo $category->category_id; ?>" class="lp_js_revenueModel_input" value="sis"<?php if ( $category_revenue_model == 'sis' || ( ! $category_revenue_model && $category_price > 5 ) ) { echo ' checked'; } ?>>SIS
                                        </label>
                                    </div>

                                    <span class="lp_js_revenueModel_labelDisplay lp_revenueModelLabel"><?php echo $category_revenue_model; ?></span>
                                    <strong>
                                        <input type="hidden" name="category" value="<?php echo $category->category_name; ?>" class="lp_js_selectCategory">
                                        <span class="lp_js_categoryDefaultPrice_categoryTitle lp_categoryTitle lp_u_inlineBlock"><?php echo $category->category_name; ?></span>
                                    </strong>
                                    <?php _e( 'costs', 'laterpay' ); ?>
                                    <strong>
                                        <input  type="text"
                                                name="price"
                                                class="lp_js_priceInput lp_js_categoryDefaultPrice_input lp_input lp_numberInput"
                                                value="<?php echo LaterPay_Helper_View::format_number( $category->category_price ); ?>"
                                                style="display:none;"
                                                placeholder="<?php _e( '0.00', 'laterpay' ); ?>">
                                        <span class="lp_js_categoryDefaultPrice_display lp_category-price"><?php echo $category_price; ?></span>
                                        <span class="lp_js_currency lp_currency"><?php echo $laterpay['standard_currency']; ?></span>
                                    </strong>

                                    <a href="#" class="lp_js_saveCategoryDefaultPrice lp_editLink lp_saveLink" data-icon="f" style="display:none;"><?php _e( 'Save', 'laterpay' ); ?></a>
                                    <a href="#" class="lp_js_cancelEditingCategoryDefaultPrice lp_editLink lp_cancel-link" data-icon="e" style="display:none;"><?php _e( 'Cancel', 'laterpay' ); ?></a>
                                    <a href="#" class="lp_js_editCategoryDefaultPrice lp_editLink lp_change-link" data-icon="d"><?php _e( 'Change', 'laterpay' ); ?></a>
                                    <a href="#" class="lp_js_deleteCategoryDefaultPrice lp_editLink lp_deleteLink" data-icon="g"><?php _e( 'Delete', 'laterpay' ); ?></a>
                                </p>
                            </form>
                        <?php endforeach; ?>
                    </div>

                    <a href="#" id="lp_js_addCategoryDefaultPrice" class="lp_u_block lp_u_m-t1" data-icon="c"><?php _e( 'Set default price for another category', 'laterpay' ); ?></a>

                    <form method="post" id="lp_js_categoryDefaultPrice_template" class="lp_js_categoryDefaultPrice_form lp_category-price-form lp_is-unsaved" style="display:none;">
                        <input type="hidden" name="form" value="price_category_form">
                        <input type="hidden" name="action" value="laterpay_pricing">
                        <input type="hidden" name="category_id" class="lp_js_categoryDefaultPrice_categoryId" value="">

                        <p class="lp_u_m-t025">
                            <?php if ( function_exists( 'wp_nonce_field' ) ) { wp_nonce_field( 'laterpay_form' ); } ?>

                            <div class="lp_js_revenueModel lp_revenueModel lp_u_relative lp_u_left">
                                <label class="lp_js_revenueModel_label lp_revenueModelLabel lp_u_m-r05 lp_u_m-b025
                                        <?php if ( $laterpay['global_default_price_revenue_model'] == 'ppu' || ( ! $laterpay['global_default_price_revenue_model'] && $laterpay['global_default_price'] < 5 ) ) { echo 'lp_is-selected'; } ?>">
                                    <input type="radio" name="laterpay_category_price_revenue_model" class="lp_js_revenueModel_input" value="ppu"<?php if ( $laterpay['global_default_price_revenue_model'] == 'ppu' || ( ! $laterpay['global_default_price_revenue_model'] && $laterpay['global_default_price'] < 5 ) ) { echo ' checked'; } ?>>PPU
                                </label>
                                <label class="lp_js_revenueModel_label lp_revenueModelLabel lp_u_m-r05 lp_u_m-b025
                                        <?php if ( $laterpay['global_default_price_revenue_model'] == 'sis' ) { echo 'lp_is-selected'; } ?>
                                        <?php if ( $laterpay['global_default_price'] < 1.49) { echo 'lp_is-disabled'; } ?>">
                                    <input type="radio" name="laterpay_category_price_revenue_model" class="lp_js_revenueModel_input" value="sis"<?php if ( $laterpay['global_default_price_revenue_model'] == 'sis' ) { echo ' checked'; } ?>>SIS
                                </label>
                            </div>

                            <span class="lp_js_revenueModel_labelDisplay lp_revenueModelLabel"></span>
                            <strong>
                                <input type="hidden" name="category" value="" class="lp_js_selectCategory">
                                <span class="lp_js_categoryDefaultPrice_categoryTitle lp_categoryTitle lp_u_inlineBlock"></span>
                            </strong>
                            <?php _e( 'costs', 'laterpay' ); ?>
                            <strong>
                                <input  type="text"
                                        name="price"
                                        class="lp_js_priceInput lp_js_categoryDefaultPrice_input lp_input lp_numberInput"
                                        value="<?php echo $laterpay['global_default_price']; ?>"
                                        style="display:none;"
                                        placeholder="<?php _e( '0.00', 'laterpay' ); ?>">
                                <span class="lp_js_categoryDefaultPrice_display lp_category-price"><?php echo $laterpay['global_default_price']; ?></span>
                                <span class="lp_js_currency lp_currency"><?php echo $laterpay['standard_currency']; ?></span>
                            </strong>

                            <a href="#" class="lp_js_saveCategoryDefaultPrice lp_editLink lp_saveLink" data-icon="f" style="display:none;"><?php _e( 'Save', 'laterpay' ); ?></a>
                            <a href="#" class="lp_js_cancelEditingCategoryDefaultPrice lp_editLink lp_cancel-link" data-icon="e" style="display:none;"><?php _e( 'Cancel', 'laterpay' ); ?></a>
                            <a href="#" class="lp_js_editCategoryDefaultPrice lp_editLink lp_change-link" data-icon="d"><?php _e( 'Change', 'laterpay' ); ?></a>
                            <a href="#" class="lp_js_deleteCategoryDefaultPrice lp_editLink lp_deleteLink" data-icon="g"><?php _e( 'Delete', 'laterpay' ); ?></a>
                        </p>
                    </form>
                </div>
            </li>

            <li class="lp_u_left lp_u_w-1-3">
                <div class="lp_u_m-0 lp_u_m-r1">
                    <h2><?php _e( 'Individual Prices', 'laterpay' ); ?></h2>
                    <hr class="lp_u_b-0 lp_u_m-0 lp_u_m-t05 lp_u_m-b025">
                    <dfn class="lp_spacer lp_u_block"><?php _e( 'Individual prices overwrite global and category default prices.', 'laterpay' ); ?></dfn>

                    <div>
                        <p><?php _e( 'You can set individual prices for posts,<br>when adding or editing a post.', 'laterpay' ); ?></p>
                    </div>
                </div>
            </li>
        </ul>

        <div class="lp_row lp_u_m-t3">
            <p>
                <span class="lp_revenueModelLabel lp_u_m-r05">PPU</span><strong><dfn>Pay-per-Use</dfn></strong><br>
                <dfn>
                    <?php _e( sprintf( 'The user pays later once his LaterPay invoice reaches 5 %s.', $laterpay['standard_currency'] ), 'laterpay' ); //FIXME: translation with sprintf ?><br>
                    <?php _e( sprintf( 'You can choose PPU for prices from 0.05 - 5.00 %s.', $laterpay['standard_currency'] ), 'laterpay' ); //FIXME: translation with sprintf ?>
                </dfn>
            </p>
            <p>
                <span class="lp_revenueModelLabel lp_u_m-r05">SIS</span><strong><dfn>Single Sale</dfn></strong><br>
                <dfn>
                    <?php _e( 'The user has to log in to LaterPay and pay immediately.', 'laterpay' ); ?><br>
                    <?php _e( sprintf( 'You can choose SIS for prices from 1.49 - 149.99 %s.', $laterpay['standard_currency'] ), 'laterpay' ); //FIXME: translation with sprintf?>
                </dfn>
            </p>
        </div>
        <hr class="lp_u_m-1-0 lp_u_m-b3">


        <div class="lp_row">
            <h2><?php _e( 'Time Passes', 'laterpay' ); ?></h2>

            <div class="lp_js_timePassEditor lp_timePassEditor">
                <a href="#" id="lp_js_addTimePass" class="lp_addTimePass button button-primary" data-icon="c"><?php _e( 'New Pass', 'laterpay' ); ?></a>

                <?php foreach ( $laterpay['passes_list'] as $pass ): ?>
                    <div class="lp_js_timePassWrapper lp_u_clearfix" data-pass-id="<?php echo $pass->pass_id; ?>">
                        <div class="lp_js_timePassPreview lp_u_left">
                            <?php echo $this->render_pass( (array) $pass ); ?>
                        </div>

                        <div class="lp_js_timePass_editorContainer lp_timePass_editorContainer lp_u_m-t05"></div>

                        <a href="#" class="lp_js_saveTimePass lp_saveLink button button-primary lp_u_hide"><?php _e( 'Save', 'laterpay' ); ?></a>
                        <a href="#" class="lp_js_cancelEditingTimePass lp_cancelLink lp_u_inlineBlock lp_u_pd-05 lp_u_hide" data-icon="e"><?php _e( 'Cancel', 'laterpay' ); ?></a>
                        <a href="#" class="lp_js_editTimePass lp_changeLink lp_u_inlineBlock lp_u_pd-05" data-icon="d"><?php _e( 'Change', 'laterpay' ); ?></a><br>
                        <a href="#" class="lp_js_deleteTimePass lp_deleteLink lp_u_inlineBlock lp_u_pd-05" data-icon="g"><?php _e( 'Delete', 'laterpay' ); ?></a>
                    </div>
                <?php endforeach; ?>

                <div id="lp_js_timePassTemplate" class="lp_js_timePassWrapper lp_js_addTimePassWrapper lp_u_clearfix lp_u_hide" data-pass-id="0">
                    <div class="lp_js_timePassPreview lp_u_left">
                        <?php echo $this->render_pass(); ?>
                    </div>

                    <div class="lp_js_timePass_editorContainer lp_timePass_editorContainer lp_u_m-t05">
                        <form id="lp_js_timePassFormTemplate" class="lp_js_timePassEditor_form lp_timePassEditor_form lp_u_hide lp_u_clearfix" method="post">
                            <input type="hidden" name="form" value="time_pass_form_save">
                            <input type="hidden" name="action" value="laterpay_pricing">
                            <input type="hidden" name="pass_id" value="0">
                            <input type="hidden" name="voucher_codes" value="">
                            <?php if ( function_exists( 'wp_nonce_field' ) ) { wp_nonce_field( 'laterpay_form' ); } ?>

                            <div class="lp_timePass_formColumn">
                                <div class="lp_timePass_formRow">
                                    <span class="lp_timePass_label"><?php _e( 'The pass is valid for ', 'laterpay' ); ?></span>
                                    <select name="duration" class="lp_js_switchTimePassDuration lp_input">
                                        <?php echo LaterPay_Helper_Passes::get_select_durations(); ?>
                                    </select>
                                    <select name="period" class="lp_js_switchTimePassPeriod lp_input">
                                        <?php echo LaterPay_Helper_Passes::get_select_periods(); ?>
                                    </select>
                                    <span class="lp_timePass_label"><?php _e( 'and grants', 'laterpay' ); ?></span>
                                </div>

                                <div class="lp_timePass_formRow">
                                    <span class="lp_timePass_label"><?php _e( 'access to', 'laterpay' ); ?></span>
                                    <select name="access_to" class="lp_js_switchTimePassScope lp_input">
                                        <?php echo LaterPay_Helper_Passes::get_select_access_to(); ?>
                                    </select>
                                </div>

                                <div class="lp_timePass_formRow lp_u_hide">
                                    <span class="lp_timePass_label"><?php _e( 'category', 'laterpay' ); ?></span>
                                    <select name="access_category" class="lp_js_switchTimePassScopeCategory lp_input">
                                        <?php echo LaterPay_Helper_Passes::get_select_access_categories(); ?>
                                    </select>
                                </div>

                                <div class="lp_timePass_formRow">
                                    <span class="lp_timePass_label"><?php _e( 'The user pays', 'laterpay' ); ?></span>
                                    <input type="text"
                                            name="price"
                                            class="lp_js_timePassPriceInput lp_input lp_numberInput"
                                            value="<?php echo LaterPay_Helper_View::format_number( LaterPay_Helper_Passes::get_defaults( 'price' ) ) ?>">
                                    <?php echo $laterpay['standard_currency']; ?>
                                    <span class="lp_timePass_label"><?php _e( 'later', 'laterpay' ); ?></span><div class="lp_toggle">
                                        <label class="lp_toggle_label lp_toggle_label_pass">
                                            <input type="checkbox" class="lp_js_timePassRevenueModelInput lp_toggle_input">
                                            <input type="hidden"
                                                    name="revenue_model"
                                                    class="lp_js_timePass_toggleRevenueModel"
                                                    value="<?php echo LaterPay_Helper_Passes::get_defaults( 'revenue_model' ); ?>">
                                            <span class="lp_toggle_text" data-on="" data-off=""></span>
                                            <span class="lp_toggle_handle"></span>
                                        </label>
                                    </div><span class="lp_timePass_label"><?php _e( 'immediately', 'laterpay' ); ?></span>
                                </div>
                            </div>

                            <div class="lp_timePass_formColumn">
                                <div class="lp_timePass_formRow">
<!--                                     <div class="lp_colorPicker">
                                        <input type="text"
                                                name="title_color"
                                                class="lp_js_colorInput lp_colorInput lp_input"
                                                value="<?php echo LaterPay_Helper_Passes::get_defaults( 'title_color' ); ?>">
                                    </div> -->
                                    <span class="lp_timePass_label"><?php _e( 'Title', 'laterpay' ); ?></span>
                                    <input type="text"
                                            name="title"
                                            class="lp_js_timePassTitleInput lp_input"
                                            value="<?php echo LaterPay_Helper_Passes::get_defaults( 'title' ); ?>">
                                </div>

                                <div class="lp_timePass_formRow">
<!--                                     <div class="lp_colorPicker">
                                        <input type="text"
                                                class="lp_js_colorInput lp_colorInput lp_input"
                                                name="description_color"
                                                value="<?php echo LaterPay_Helper_Passes::get_defaults( 'description_color' ); ?>">
                                    </div> -->
                                    <span class="lp_timePass_label lp_u_topAlign">
                                        <?php _e( 'Description', 'laterpay' ); ?>
                                    </span>
                                    <textarea
                                        name="description"
                                        class="lp_js_timePassDescriptionTextarea lp_timePass_descriptionInput lp_input">
                                        <?php echo LaterPay_Helper_Passes::get_description(); ?>
                                    </textarea>
                                </div>

<!--
                                <div class="lp_timePass_formRow">
                                    <div class="lp_colorPicker">
                                        <input type="text"
                                                class="lp_js_colorInput lp_colorInput lp_input"
                                                name="background_color"
                                                value="<?php echo LaterPay_Helper_Passes::get_defaults( 'background_color' ); ?>">
                                    </div>
                                    <span class="lp_timePass_label">
                                        <a href="#"><?php _e( 'Background image', 'laterpay' ); ?></a>
                                        <?php _e( 'or color', 'laterpay' ); ?>
                                    </span>
                                </div>
-->
                            </div>
                        </form>

                        <div>
                            <div class="lp">
                                <span class="lp_voucher_price_label"><?php _e( 'Offer this time pass at a reduced price of', 'laterpay' ); ?></span>
                                <input type="text"
                                       name="voucher_price"
                                       class="lp_js_voucherPriceInput lp_input lp_numberInput"
                                       value="<?php echo LaterPay_Helper_View::format_number( LaterPay_Helper_Passes::get_defaults( 'price' ) ) ?>">
                                <span><?php echo $laterpay['standard_currency']; ?></span>
                                <a class="lp_js_generateVoucherCode button button-primary" href="#"><?php _e( 'Generate voucher code', 'laterpay' ); ?></a>
                            </div>
                            <div class="lp_js_voucherPlaceholder"></div>
                        </div>
                    </div>

                    <a href="#" class="lp_js_saveTimePass lp_saveLink button button-primary"><?php _e( 'Save', 'laterpay' ); ?></a>
                    <a href="#" class="lp_js_cancelEditingTimePass lp_cancelLink lp_u_inlineBlock lp_u_pd-05" data-icon="e"><?php _e( 'Cancel', 'laterpay' ); ?></a>
                    <a href="#" class="lp_js_editTimePass lp_changeLink lp_u_inlineBlock lp_u_pd-05 lp_u_hide" data-icon="d"><?php _e( 'Change', 'laterpay' ); ?></a><br>
                    <a href="#" class="lp_js_deleteTimePass lp_deleteLink lp_u_inlineBlock lp_u_pd-05 lp_u_hide" data-icon="g"><?php _e( 'Delete', 'laterpay' ); ?></a>
                </div>
            </div>
        </div>
        <hr class="lp_u_m-1-0 lp_u_m-b3">


        <div class="lp_row">
            <h2><?php _e( 'Bulk Price Editor', 'laterpay' ); ?></h2>
            <form id="lp_js_bulkPriceEditor_form" method="post">
                <input type="hidden" name="form" value="bulk_price_form" id="lp_js_bulkPriceEditor_hiddenFormInput">
                <input type="hidden" name="action" value="laterpay_pricing">
                <input type="hidden" name="bulk_operation_id" value="" id="lp_js_bulkPriceEditor_hiddenIdInput">
                <input type="hidden" name="bulk_message" value="" id="lp_js_bulkPriceEditor_hiddenMessageInput">
                <?php if ( function_exists( 'wp_nonce_field' ) ) { wp_nonce_field( 'laterpay_form' ); } ?>
                <div>
                    <p>
                        <select name="bulk_action" id="lp_js_selectBulkAction" class="lp_input">
                            <?php foreach ( $laterpay['bulk_actions'] as $action_value => $action_name ): ?>
                                <option value="<?php echo $action_value; ?>">
                                    <?php echo $action_name; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <select name="bulk_selector" id="lp_js_selectBulkObjects" class="lp_input">
                            <?php foreach ( $laterpay['bulk_selectors'] as $selector_value => $selector_name ): ?>
                                <option value="<?php echo $selector_value; ?>">
                                    <?php echo $selector_name; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <?php if ( $laterpay['bulk_categories'] ): ?>
                        <select name="bulk_category" id="lp_js_selectBulkObjectsCategory" class="lp_input" style="display:none;">
                            <?php foreach ( $laterpay['bulk_categories'] as $category ): ?>
                                <option value="<?php echo $category->term_id; ?>">
                                    <?php echo $category->name; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php endif; ?>

                        <?php if ( $laterpay['bulk_categories_with_price'] ): ?>
                        <select name="bulk_category_with_price" id="lp_js_selectBulkObjectsCategoryWithPrice" class="lp_input" style="display:none;">
                            <?php foreach ( $laterpay['bulk_categories_with_price'] as $category_with_price ): ?>
                                <option value="<?php echo $category_with_price->category_id; ?>"
                                        data-price="<?php echo LaterPay_Helper_View::format_number( $category_with_price->category_price ); ?>">
                                    <?php echo $category_with_price->category_name; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php endif; ?>

                        <span id="lp_js_bulkPriceEditor_amountPreposition" class="lp_u_inlineBlock lp_u_m-r05 lp_u_m-l05"><?php _e( 'to', 'laterpay' ); ?></span>
                        <input  type="text"
                                name="bulk_price"
                                id="lp_js_setBulkChangeAmount"
                                class="lp_input lp_numberInput"
                                value="<?php echo $laterpay['global_default_price']; ?>"
                                placeholder="0.00">
                        <select name="bulk_change_unit" id="lp_js_selectBulkChangeUnit" class="lp_input lp_bulkPriceUnit lp_is-disabled">
                            <option value="<?php echo $laterpay['standard_currency']; ?>">
                                <?php echo $laterpay['standard_currency']; ?>
                            </option>
                            <option value="percent">%</option>
                        </select>
                        <button id="lp_js_applyBulkOperation" class="button button-primary lp_u_m-l2" type="submit"><?php _e( 'Update Prices', 'laterpay' ); ?></button>
                        <a href="#" id="lp_js_saveBulkOperation" class="lp_editLink lp_saveLink lp_u_inlineBlock lp_u_m-l1 lp_u_pd-0-05" data-icon="f"><?php _e( 'Save', 'laterpay' ); ?></a>
                    </p>
                </div>
            </form>
            <?php if ( $laterpay['bulk_saved_operations'] ): ?>
                <?php foreach ( $laterpay['bulk_saved_operations'] as $bulk_operation_id => $bulk_operation_data ): ?>
                    <p class="lp_bulkOperation" data-value="<?php echo $bulk_operation_id; ?>">
                        <a href="#" class="lp_js_deleteSavedBulkOperation lp_editLink lp_deleteLink" data-icon="g"><?php _e( 'Delete', 'laterpay' ); ?></a>
                        <a href="#" class="lp_js_applySavedBulkOperation button button-primary lp_u_m-l2"><?php _e( 'Update Prices', 'laterpay' ); ?></a>
                        <span><?php echo $bulk_operation_data['message']; ?></span>
                    </p>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>


<?php # commented out as long as there is only a single currency ?>
<?php /* ?>
        <div class="lp_row">
            <h2><?php _e( 'Currency', 'laterpay' ); ?></h2>
            <form id="lp_js_defaultCurrency_form" method="post">
                <input type="hidden" name="form"    value="currency_form">
                <input type="hidden" name="action"  value="laterpay_pricing">
                <?php if ( function_exists( 'wp_nonce_field' ) ) { wp_nonce_field( 'laterpay_form' ); } ?>

                <div>
                    <p><?php _e( 'All prices are given in', 'laterpay' ); ?>
                        <select name="laterpay_currency" id="lp_js_changeDefaultCurrency" class="lp_input">
                            <?php foreach ( $currencies as $currency ): ?>
                                <option<?php if ( $currency->short_name == $standard_currency ): ?> selected<?php endif; ?> value="<?php echo $currency->short_name; ?>">
                                    <?php echo $currency->full_name . ' (' . $currency->short_name . ')'; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </p>
                </div>
            </form>
        </div>
<?php */ ?>

    </div>
</div>
