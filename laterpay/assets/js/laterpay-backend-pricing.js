!function(e){e(function(){function l(){var l={revenueModel:".lp_js_revenue-model",revenueModelLabel:".lp_js_revenue-model-label",revenueModelLabelDisplay:".lp_js_revenue-model-label-display",revenueModelInput:".lp_js_revenue-model-input",priceInput:".lp_js_price-input",globalDefaultPriceForm:e("#lp_js_global-default-price-form"),globalDefaultPriceInput:e("#lp_js_global-default-price"),globalDefaultPriceDisplay:e("#lp_js_global-default-price-text"),globalDefaultPriceRevenueModelDisplay:e("#lp_js_global-default-price-revenue-model-label"),editGlobalDefaultPrice:e("#lp_js_edit-global-default-price"),cancelEditingGlobalDefaultPrice:e("#lp_js_cancel-editing-global-default-price"),saveGlobalDefaultPrice:e("#lp_js_save-global-default-price"),globalDefaultPriceShowElements:e("#lp_js_global-default-price-text, #lp_js_edit-global-default-price, #lp_js_global-default-price-revenue-model-label"),globalDefaultPriceEditElements:e("#lp_js_global-default-price, #lp_js_global-default-price-revenue-model, #lp_js_cancel-editing-global-default-price, #lp_js_save-global-default-price"),categoryDefaultPrices:e("#lp_js_category-default-prices-list"),addCategory:e("#lp_js_add-category-default-price"),categoryDefaultPriceTemplate:e("#lp_js_category-default-price-template"),categoryDefaultPriceForm:".lp_js_category-default-price-form",editCategoryDefaultPrice:".lp_js_edit-category-default-price",cancelEditingCategoryDefaultPrice:".lp_js_cancel-editing-category-default-price",saveCategoryDefaultPrice:".lp_js_save-category-default-price",deleteCategoryDefaultPrice:".lp_js_delete-category-default-price",categoryDefaultPriceShowElements:".lp_js_category-title, .lp_js_revenue-model-label-display, .lp_js_category-default-price-display, .lp_js_edit-category-default-price, .lp_js_delete-category-default-price",categoryDefaultPriceEditElements:".lp_js_category-default-price-input, .lp_js_revenue-model, .lp_js_save-category-default-price, .lp_js_cancel-editing-category-default-price",categoryTitle:".lp_js_category-title",categoryDefaultPriceDisplay:".lp_js_category-default-price-display",selectCategory:".lp_js_select-category",categoryDefaultPriceInput:".lp_js_category-default-price-input",categoryId:".lp_js_category-id",bulkPriceForm:e("#lp_js_bulk-price-form"),bulkPriceAction:e("#lp_js_change-bulk-action"),bulkPriceObjects:e("#lp_js_select-bulk-objects"),bulkPriceObjectsCategory:e("#lp_js_select-bulk-objects-category"),bulkPriceChangeAmountModifier:e("#lp_js_bulk-amount-modifier"),bulkPriceChangeAmount:e("#lp_js_set-bulk-change-amount"),bulkPriceChangeUnit:e("#lp_js_set-bulk-change-unit"),bulkPriceSubmit:e("#lp_js_apply-bulk-operation"),defaultCurrencyForm:e("#lp_js_default-currency-form"),defaultCurrency:e("#lp_js_change-default-currency"),currency:".lp_js_currency",editing:"lp_is_editing",unsaved:"lp_is_unsaved",payPerUse:"ppu",singleSale:"sis",selected:"lp_is-selected",disabled:"lp_is-disabled"},t=function(){e("body").on("change",l.revenueModelInput,function(){a(e(this).parents("form"))}),e("body").on("keyup",l.priceInput,b(function(){a(e(this).parents("form"))},800)),l.editGlobalDefaultPrice.mousedown(function(){c()}).click(function(e){e.preventDefault()}),l.cancelEditingGlobalDefaultPrice.mousedown(function(){i()}).click(function(e){e.preventDefault()}),l.saveGlobalDefaultPrice.mousedown(function(){o()}).click(function(e){e.preventDefault()}),l.addCategory.mousedown(function(){n()}).click(function(e){e.preventDefault()}),l.categoryDefaultPrices.on("click",l.editCategoryDefaultPrice,function(){var t=e(this).parents(l.categoryDefaultPriceForm);u(t)}),l.categoryDefaultPrices.on("click",l.cancelEditingCategoryDefaultPrice,function(){var t=e(this).parents(l.categoryDefaultPriceForm);d(t)}),l.categoryDefaultPrices.on("click",l.saveCategoryDefaultPrice,function(){var t=e(this).parents(l.categoryDefaultPriceForm);s(t)}),l.categoryDefaultPrices.on("click",l.deleteCategoryDefaultPrice,function(){var t=e(this).parents(l.categoryDefaultPriceForm);p(t)}),l.bulkPriceAction.add(l.bulkPriceObjects).on("change",function(){m(l.bulkPriceAction.val(),l.bulkPriceObjects.val())}),l.bulkPriceForm.on("submit",function(e){y(),e.preventDefault()}),l.defaultCurrency.change(function(){_()})},a=function(l){var t,a=e(".lp_number-input",l),c=a.val();return c=c.replace(/[^0-9\,\.]/g,""),c=c.indexOf(",")>-1?parseFloat(c.replace(",",".")).toFixed(2):parseFloat(c).toFixed(2),isNaN(c)&&(c=0,t=!0),c=Math.abs(c),c>149.99?(c=149.99,t=!0):c>0&&.05>c&&(c=.05,t=!0),r(c,l),c=c.toFixed(2),"de_DE"===lpVars.locale&&(c=c.replace(".",",")),a.val(c),c},r=function(t,a){var r=e("input:radio:checked",a).val(),c=e(".lp_js_revenue-model-input[value="+l.payPerUse+"]",a),i=e(".lp_js_revenue-model-input[value="+l.singleSale+"]",a);0===t||t>=.05&&5>=t?c.removeProp("disabled").parent("label").removeClass(l.disabled):c.prop("disabled","disabled").parent("label").addClass(l.disabled),t>=1.49?i.removeProp("disabled").parent("label").removeClass(l.disabled):i.prop("disabled","disabled").parent("label").addClass(l.disabled),t>5&&r===l.payPerUse?i.prop("checked","checked"):1.49>t&&r===l.singleSale&&c.prop("checked","checked"),e("label",a).removeClass(l.selected),e(".lp_js_revenue-model-input:checked",a).parent("label").addClass(l.selected)},c=function(){l.globalDefaultPriceShowElements.hide(),l.globalDefaultPriceEditElements.show(0,function(){setTimeout(function(){l.globalDefaultPriceInput.val(l.globalDefaultPriceDisplay.text()).focus()},50)}),l.globalDefaultPriceForm.addClass(l.editing)},i=function(){l.globalDefaultPriceShowElements.show(),l.globalDefaultPriceEditElements.hide(),l.globalDefaultPriceForm.removeClass(l.editing),l.globalDefaultPriceInput.val(l.globalDefaultPriceDisplay.text());var t=l.globalDefaultPriceRevenueModelDisplay.text().toLowerCase();e(l.revenueModelLabel,l.globalDefaultPriceForm).removeClass(l.selected),e(".lp_js_revenue-model-input[value="+t+"]",l.globalDefaultPriceForm).prop("checked","checked").parent("label").addClass(l.selected)},o=function(){var t=a(l.globalDefaultPriceForm);l.globalDefaultPriceInput.val(t),e.post(ajaxurl,l.globalDefaultPriceForm.serializeArray(),function(e){e.success&&(l.globalDefaultPriceDisplay.html(e.laterpay_global_price),l.globalDefaultPriceRevenueModelDisplay.text(e.laterpay_price_revenue_model)),setMessage(e.message,e.success),i()},"json")},n=function(){l.addCategory.fadeOut(250);var e=l.categoryDefaultPriceTemplate.clone().removeAttr("id").appendTo("#lp_js_category-default-prices-list").fadeIn(250);u(e)},u=function(t){e(".lp_js_category-default-price-form.lp_is_editing").each(function(){d(e(this),!0)}),t.addClass(l.editing),e(l.categoryDefaultPriceShowElements,t).hide(),l.addCategory.fadeOut(250),e(l.categoryDefaultPriceEditElements,t).show(),g(t)},s=function(t){var r=a(t);e(l.categoryDefaultPriceInput,t).val(r),e.post(ajaxurl,t.serializeArray(),function(a){a.success&&(e(l.categoryDefaultPriceDisplay,t).text(a.price),e(l.revenueModelLabelDisplay,t).text(a.revenue_model),e(l.categoryDefaultPriceInput,t).val(a.price),e(l.categoryTitle,t).text(a.category),e(l.categoryId,t).val(a.category_id),t.removeClass(l.unsaved)),d(t),setMessage(a.message,a.success)},"json")},d=function(t,a){if(t.removeClass(l.editing),t.hasClass(l.unsaved))t.fadeOut(250,function(){e(this).remove()});else{e(l.categoryDefaultPriceEditElements,t).hide(),e(l.selectCategory,t).select2("destroy"),e(l.categoryDefaultPriceInput,t).val(e(l.categoryDefaultPriceDisplay,t).text());var r=e(l.revenueModelLabelDisplay,t).text().toLowerCase();e(l.revenueModelLabel,t).removeClass(l.selected),e(".lp_js_revenue-model-input[value="+r+"]",t).prop("checked","checked").parent("label").addClass(l.selected),e(l.categoryDefaultPriceShowElements,t).show()}a||l.addCategory.fadeIn(250)},p=function(l){e("input[name=form]",l).val("price_category_form_delete"),e.post(ajaxurl,l.serializeArray(),function(t){t.success&&l.fadeOut(400,function(){e(this).remove()}),setMessage(t.message,t.success)},"json")},f=function(l,t){var a=e(t).parent().parent().parent();return e(".lp_js_select-category",a).val(l.text),e(".lp_js_category-id",a).val(l.id),l.text},g=function(t){e(l.selectCategory,t).select2({allowClear:!0,ajax:{url:ajaxurl,data:function(e){return{term:e,action:"laterpay_pricing"}},results:function(l){var t=[];return e.each(l,function(e){var a=l[e];t.push({id:a.term_id,text:a.name})}),{results:t}},dataType:"json"},initSelection:function(l,t){var a=e(l).val();if(""!==a){var r={text:a};t(r)}else e.get(ajaxurl,{term:"",action:"laterpay_pricing"},function(e){if(e&&void 0!==e[0]){var l=e[0];t({text:l.name})}})},formatResult:function(e){return e.text},formatSelection:f,escapeMarkup:function(e){return e}})},_=function(){e.post(ajaxurl,l.defaultCurrencyForm.serializeArray(),function(t){t.success&&e(l.currency).html(t.laterpay_currency),setMessage(t.message,t.success)},"json")},b=function(e,l){var t;return function(){var a=this,r=arguments;clearTimeout(t),t=setTimeout(function(){e.apply(a,r)},l)}},y=function(){e.post(ajaxurl,l.bulkPriceForm.serializeArray(),function(e){setMessage(e.message,e.success)},"json")},m=function(t,a){var r="in_category"===a||"not_in_category"===a;switch(l.bulkPriceChangeUnit.find("option").each(function(){"%"===e(this).text()&&e(this).remove()}),t){case"set":l.bulkPriceChangeAmountModifier.text(lpVars.i18nModifierTo).show(),l.bulkPriceChangeAmount.show(),l.bulkPriceChangeUnit.show(),r?l.bulkPriceObjectsCategory.show():l.bulkPriceObjectsCategory.hide();break;case"increase":case"reduce":l.bulkPriceChangeAmountModifier.text(lpVars.i18nModifierBy).show(),l.bulkPriceChangeAmount.show(),l.bulkPriceChangeUnit.show(),l.bulkPriceChangeUnit.append(e("<option>",{value:"percent",text:"%"})),r?l.bulkPriceObjectsCategory.show():l.bulkPriceObjectsCategory.hide();break;case"free":l.bulkPriceChangeAmountModifier.hide(),l.bulkPriceChangeAmount.hide(),l.bulkPriceChangeUnit.hide(),r?l.bulkPriceObjectsCategory.show():l.bulkPriceObjectsCategory.hide()}},v=function(){t(),l.bulkPriceAction.change()};v()}l()})}(jQuery);