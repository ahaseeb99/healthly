import 'https://cdn.jsdelivr.net/gh/orestbida/cookieconsent@3.0.1/dist/cookieconsent.umd.js';

CookieConsent.run({
    guiOptions: {
        consentModal: {
            layout: "box",
            position: "center center",
            equalWeightButtons: true,
            flipButtons: false
        },
        preferencesModal: {
            layout: "box",
            position: "right",
            equalWeightButtons: true,
            flipButtons: true
        }
    },
    categories: {
        necessary: {
            readOnly: true
        },
        functionality: {},
        analytics: {},
        marketing: {}
    },
    language: {
        default: "en",
        autoDetect: "browser",
        translations: {
            en: {
                consentModal: {
                    title: "Welcome to Healthly.tech!",
                    description: "We use cookies on this website. Strictly necessary cookies are essential for core functionalities and are set automatically. We also use optional cookies for other purposes that do not affect core functionalities. You can manage your cookie preferences at any time. For more information, please review our  <a class=\"cc__link\" href=\"https://healthly.live/page/custom-cookie-notice\">Cookie Notice</a>",
                    acceptAllBtn: "Accept all",
                    acceptNecessaryBtn: "Reject all",
                    showPreferencesBtn: "Manage preferences",
                    footer: "<a href=\"/page/custom-privacy-notice\">Privacy Notice</a>\n<a href=\"/page/custom-terms-and-conditions\">Terms and conditions</a>"
                },
                preferencesModal: {
                    title: "Cookie Preferences",
                    acceptAllBtn: "Accept all",
                    acceptNecessaryBtn: "Reject all",
                    savePreferencesBtn: "Save preferences",
                    closeIconLabel: "Close",
                    sections: [
                        {
                            title: "Cookie Usage on Healthly.tech",
                            description: "We use cookies to improve your browsing experience, analyze website traffic, and provide personalized AI-generated fitness content. You can manage your cookie preferences below."
                        },
                        {
                            title: "Essential Cookies <span class=\"pm__badge\">Always Enabled</span>",
                            description: "These cookies are necessary for the proper functioning of our website. They enable core features and cannot be disabled.",
                            linkedCategory: "necessary"
                        },
                        {
                            title: "Functionality Cookies",
                            description: "These cookies allow us to provide enhanced features and remember your preferences to improve your experience on our website.",
                            linkedCategory: "functionality"
                        },
                        {
                            title: "Analytics Cookies",
                            description: "We use analytics cookies to collect information about how visitors use our website. This helps us improve our services and optimize your experience.",
                            linkedCategory: "analytics" 
                        },
                        {
                            title: "Advertising Cookies",
                            description: "These cookies are used to deliver relevant advertisements tailored to your interests. They also help us measure the effectiveness of our advertising campaigns.",
                            linkedCategory: "marketing"
                        },
                    ]
                }
            }
        }
    }
});