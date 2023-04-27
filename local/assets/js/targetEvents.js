'use strict'

window.targetEvents = {
    yandexCounterId: 23056159,
    viewed(id, value) {
        dataLayer.push({
            'event': 'viewed',
            'value': value,
            'items': [
                {
                    'id': id,
                    'google_business_vertical': 'custom'
                }
            ]
        });
    },
    askQuestionContacts() {
        dataLayer.push({'event': 'AskQuestionContacts'})
    },

    scheduleRegistration() {
        ym(this.yandexCounterId, 'reachGoal', 'schedule-registration')
    },

    noScheduleRegistration() {
        ym(this.yandexCounterId, 'reachGoal', 'no-schedule-registration')
    },

    summerActionQuestion() {
        ym(this.yandexCounterId, 'reachGoal', 'summer-action-question');
        dataLayer.push({'event': 'summer-action-question'})
    },

    webFormSpecificSolution() {
        ym(this.yandexCounterId, 'reachGoal', 'WebformSpecificSolution');
        dataLayer.push({'event': 'WebformSpecificSolution'});
    },

    summerActionRegistration() {
        ym(this.yandexCounterId, 'reachGoal', 'summer-action-registration');
        dataLayer.push({'event': 'summer-action-registration'})
    },

    summerActionClickMore(schoolName) {
        ym(this.yandexCounterId, 'reachGoal', 'summer-action-click-more', {'name': schoolName}, function () {
            window.location.href = link
        })
    },

    tawk() {
        ym(this.yandexCounterId, 'reachGoal', 'tawk');
        window.google_trackConversion({
            google_conversion_id: 986037442,
            google_remarketing_only: true
        });
        ga('send', 'event', 'show_tawk', 'tawk');
        dataLayer.push({'event': 'showTawk'});
    },

    errorJs() {
        ym(this.yandexCounterId, 'reachGoal', 'errorJs')
    },

    pageViewContacts() {
        ym(this.yandexCounterId, 'reachGoal', 'PageViewContacts')
    },

    orderConsulting() {
        ym(this.yandexCounterId, 'reachGoal', 'OrderConsulting')
    },

    orderCorp() {
        ym(this.yandexCounterId, 'reachGoal', 'OrderCorp')
    },

    registrationSeminar() {
        ym(this.yandexCounterId, 'reachGoal', ' registration-seminar')
    },

    registrationAgile() {
        ym(this.yandexCounterId, 'reachGoal', 'registration-agile')
    },

    addToCalendar() {
        ym(this.yandexCounterId, 'reachGoal', 'AddToCalendar')
    },

    addToBasket() {
        ym(this.yandexCounterId, 'reachGoal', 'AddToBasket')
    },

    registration() {
        ym(this.yandexCounterId, 'reachGoal', 'Registration')
    },

    error404() {
        ym(this.yandexCounterId, 'reachGoal', 'error-404');
        this.errorSimple404();

        function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
        var ref = document.referrer;
        var siteurl = document.location.href;
        var visitParams = {
            NotFoundURL: _defineProperty({}, siteurl, {
                referrer: ref
            })
        };
        dataLayer.push({
            'event': 'error-404',
            'data': visitParams
        })

    },

    errorSimple404() {
        ym(this.yandexCounterId, 'reachGoal', 'error-simple-404');
    },

    purchase (transaction, item) {
        dataLayer.push({
            'event': 'purchase',
            'value': 19900,
            'items': [{
                id: 112471,
                google_business_vertical: 'custom'
            }]
        });
        ga('require', 'ecommerce');
        ga('ecommerce:addTransaction', transaction);
        ga('ecommerce:addItem', item);
        ga('ecommerce:send');
    }
}