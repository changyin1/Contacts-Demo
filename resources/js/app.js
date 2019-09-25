/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


$(function () {
    //handle ajax forms
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Authorization': 'Bearer ' + $('meta[name="api_token"]').attr('content'),
        }
    });

    $('form.ajax').submit(function (e) {
        e.preventDefault();
        let self = $(this);
        let url = $(this).attr('action');
        let data = $(this).serializeArray();
        self.find('.errors').html('');
        self.find('.btn').attr('disabled', true);
        self.find('.btn-submit').val('Submitting');
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: function (response) {
                if (response.success) {
                    self.find('.btn-submit').attr('disabled', false);
                    if (response.reload == true) {
                        location.reload();
                    } else {
                        alert(response.message);
                        self.find('.btn').attr('disabled', false);
                        self.find('.btn-submit').attr('disabled', false).val('Submit');
                    }
                } else {
                    self.find('.btn-submit').attr('disabled', false).val('Submit');
                    self.find('.errors').append('<div class="alert alert-danger">Error submitting. Please try again later.</div>')
                }
            },
            error: function (response) {
                $.each(response.responseJSON.errors, function (e, error) {
                    self.find('.errors').append('<div class="alert alert-danger">' + error[0] + '</div>')
                });
                self.find('.btn-submit').attr('disabled', false).val('Submit');
            }
        });
    });

    //Input field label animations
    $("input").change(function () {
        "" != $(this).val() ? $(this).parent().addClass("filled") : $(this).parent().removeClass("filled");
    });

    $("input").each(function () {
        "" != $(this).val() ? $(this).parent().addClass("filled") : $(this).parent().removeClass("filled");
    });

    //initialize data table
    function dataTable(element) {
        $(element).DataTable({
            searching: true,
            stateSave: true,
            fixedHeader: true
        });
    }

    dataTable('table.data-table');
});