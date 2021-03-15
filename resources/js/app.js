/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

// window.Vue = require('vue');
import Vue from "vue";
import ElementUI from "element-ui";
import Axios from "axios";
import moment from 'moment'


import lang from "element-ui/lib/locale/lang/es";
import locale from "element-ui/lib/locale";
locale.use(lang);

//filters
Vue.filter('formatDate', function (value) {
  if (value) {
    return moment(String(value)).format('YYYY-MM-DD')
  }
})


ElementUI.Select.computed.readonly = function () {
    const isIE = !this.$isServer && !Number.isNaN(Number(document.documentMode));
    return !(this.filterable || this.multiple || !isIE) && !this.visible;
};

export default ElementUI;

//Vue.use(ElementUI)
Vue.use(ElementUI, { size: 'small' })
Vue.prototype.$eventHub = new Vue()
Vue.prototype.$http = Axios

Vue.component('tenant-dashboard-index', require('../../modules/Dashboard/Resources/assets/js/views/index.vue'));

// System
Vue.component('system-clients-index', require('./views/system/clients/index.vue'));
Vue.component('system-clients-form', require('./views/system/clients/form.vue'));
Vue.component('system-users-form', require('./views/system/users/form.vue'));
Vue.component('system-certificate-index', require('./views/system/certificate/index.vue'));
Vue.component('system-companies-form', require('./views/system/companies/form.vue'));
Vue.component('system-plans-index', require('./views/system/plans/index.vue'));
Vue.component('system-plans-form', require('./views/system/plans/form.vue'));
Vue.component("system-update", require("./views/system/update/index.vue"));
Vue.component('system-backup', require('./views/system/backup/index.vue'));
Vue.component('system-configuration-culqi', require('./views/system/configuration/culqi.vue'))
Vue.component('system-configuration-token', require('./views/system/configuration/token_ruc_dni.vue'))
Vue.component('system-accounting-index', require('@viewsModuleAccount/system/accounting/index.vue'));
//Charts
Vue.component('x-graph', require('./components/graph/src/Graph.vue'));
Vue.component('x-graph-line', require('./components/graph/src/GraphLine.vue'));
Vue.component('x-input-service', require('./components/InputService.vue'));
//Companies
Vue.component('tenant-companies-form', require('./views/tenant/companies/form.vue'));
Vue.component('tenant-companies-logo', require('./views/tenant/companies/logo.vue'));
//Certificates
Vue.component('tenant-certificates-index', require('./views/tenant/certificates/index.vue'));
Vue.component('tenant-certificates-form', require('./views/tenant/certificates/form.vue'));
//Configurations
Vue.component('tenant-configurations-form', require('./views/tenant/configurations/form.vue'));
Vue.component('tenant-configurations-visual', require('./views/tenant/configurations/visual.vue'));
Vue.component('tenant-configurations-pdf', require('./views/tenant/configurations/pdf_templates.vue'));
Vue.component('tenant-configurations-pdf-guide', require('./views/tenant/configurations/pdf_guide_templates.vue'));
Vue.component('tenant-configurations-preprinted-pdf', require('./views/tenant/configurations/pdf_preprinted_templates.vue'));
Vue.component(
    "tenant-bank_account_types-index",
    require("./views/tenant/bank_account_types/index.vue")
);
Vue.component(
    "tenant-countries-index",
    require("./views/tenant/countries/index.vue")
);
Vue.component(
    "tenant-bank_accounts-index",
    require("./views/tenant/bank_accounts/index.vue")
);
Vue.component("tenant-items-index", require("./views/tenant/items/index.vue"));
Vue.component(
    "tenant-persons-index",
    require("./views/tenant/persons/index.vue")
);

Vue.component("tenant-users-form", require("./views/tenant/users/form.vue"));

Vue.component(
    "tenant-search-index",
    require("./views/tenant/search/index.vue")
);
Vue.component(
    "tenant-options-form",
    require("./views/tenant/options/form.vue")
);
Vue.component(
    "tenant-unit_types-index",
    require("./views/tenant/unit_types/index.vue")
);
Vue.component(
    "tenant-detraction_types-index",
    require("./views/tenant/detraction_types/index.vue")
);
Vue.component("tenant-users-index", require("./views/tenant/users/index.vue"));
Vue.component(
    "tenant-establishments-index",
    require("./views/tenant/establishments/index.vue")
);
Vue.component("tenant-banks-index", require("./views/tenant/banks/index.vue"));
Vue.component(
    "tenant-exchange_rates-index",
    require("./views/tenant/exchange_rates/index.vue")
);
Vue.component(
    "tenant-currency-types-index",
    require("./views/tenant/currency_types/index.vue")
);
Vue.component(
    "tenant-attribute_types-index",
    require("./views/tenant/attribute_types/index.vue")
);
Vue.component(
    "tenant-calendar",
    require("./views/tenant/components/calendar.vue")
);
Vue.component(
    "tenant-warehouses",
    require("./views/tenant/components/warehouses.vue")
);
Vue.component(
    "tenant-calendar-quotation",
    require("./views/tenant/components/calendarquotations.vue")
);

Vue.component(
    "tenant-product",
    require("./views/tenant/components/products.vue")
);

Vue.component("tenant-tasks-lists", require("./views/tenant/tasks/lists.vue"));
Vue.component("tenant-tasks-form", require("./views/tenant/tasks/form.vue"));
Vue.component(
    "tenant-card-brands-index",
    require("./views/tenant/card_brands/index.vue")
);

Vue.component(
    "tenant-payment-method-index",
    require("./views/tenant/payment_method/index.vue")
);
Vue.component(
    "tenant-payment-method-index",
    require("./views/tenant/payment_method/index.vue")
);

// Modules
Vue.component('tenant-index-configuration', require('../../modules/BusinessTurn/Resources/assets/js/views/configurations/index.vue'));
Vue.component('tenant-offline-configurations-index', require('../../modules/Offline/Resources/assets/js/views/offline_configurations/index.vue'));

//Item
Vue.component('tenant-categories-index', require('../../modules/Item/Resources/assets/js/views/categories/index.vue'));
Vue.component('tenant-brands-index', require('../../modules/Item/Resources/assets/js/views/brands/index.vue'));
Vue.component('tenant-incentives-index', require('../../modules/Item/Resources/assets/js/views/incentives/index.vue'));
Vue.component('tenant-item-lots-index', require('../../modules/Item/Resources/assets/js/views/item-lots/index.vue'));
Vue.component('tenant-web-platforms-index', require('@viewsModuleItem/web-platforms/index.vue'));
Vue.component('tenant-tags-index', require('./views/tenant/tags/index.vue'));
Vue.component('tenant-promotions-index', require('./views/tenant/promotions/index.vue'));
Vue.component('tenant-item-sets-index', require('./views/tenant/item_sets/index.vue'));
Vue.component('tenant-person-types-index', require('./views/tenant/person_types/index.vue'));
Vue.component('tenant-company-accounts', require('../../modules/Account/Resources/assets/js/views/company_accounts/form.vue'));
// Vue.component('tenant-series-configurations-index', require('../../modules/Document/Resources/assets/js/views/series_configurations/index.vue'));

//Payment method types
Vue.component(
    "tenant-payment-method-types-index",
    require("./views/tenant/payment_method_types/index.vue")
);
//Expense method types
Vue.component(
    "tenant-expense-method-types-index",
    require("./views/tenant/expense_method_types/index.vue")
);

//Cuenta
Vue.component(
    "tenant-account-payment-index",
    require("./views/tenant/account/payment_index.vue")
);
Vue.component(
    "tenant-account-configuration-index",
    require("./views/tenant/account/configuration.vue")
);

//Configuration mail servers
Vue.component(
    "tenant-configuration-mail-servers-index",
    require("./views/tenant/configuration_mail_servers/index.vue")
);
//Payment method types
Vue.component(
    "tenant-payment-method-types-general-index",
    require("./views/tenant/payment_method_types_general/index.vue")
);
//Terms Conditions
Vue.component(
    "tenant-terms-conditions-form",
    require("./views/tenant/terms_conditions/form.vue")
);
//Banners
Vue.component(
    "tenant-banners-index",
    require("./views/tenant/banners/index.vue")
);
//Discards
Vue.component(
    "tenant-discards-index",
    require("./views/tenant/discards/index.vue")
);

Vue.mixin({
    filters: {
        toDecimals(number, decimal = 2) {
            return Number(number).toFixed(decimal);
        },
        toDate(date) {
            if (date) {
                return moment(date).format('DD/MM/YYYY');
            }
            return '';
        },
        toTime(time) {
            if (time) {
                if (time.length === 5) {
                    return moment(time + ':00', 'HH:mm:ss').format('HH:mm:ss');
                }
                return moment(time, 'HH:mm:ss').format('HH:mm:ss');
            }
            return '';
        }
    },
    methods: {
        axiosError(error) {
            const response = error.response;
            const status = response.status;
            if (status === 422) {
                this.errors = response.data
            }
            if (status === 500) {
                this.$message({
                    type: 'info',
                    message: response.data.message
                  });
            }
        }
    }
})
const app = new Vue({
    el: "#main-wrapper"
});
