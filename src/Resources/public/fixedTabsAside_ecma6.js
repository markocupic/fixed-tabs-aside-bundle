var FixedTabsAside = class self {

    // Constructor
    constructor(options) {
        var that = this;
        // Defaults
        var defaults = {
            // Wait x ms before navbar slides in
            delayAfterDomready: 500,
            // CSS classes
            className: {
                CLASS_OPEN: 'fixed-tabs-aside-open',
                CLASS_LAYER: 'fixed-tabs-aside-layer',
                CLASS_NAV_ROW: 'fixed-tabs-aside-nav-row',
                CLASS_CLOSE_BUTTON: 'fixed-tabs-aside-close-button',
                CLASS_CLOSE_ICON_CLASS: 'fa fa-times',
                CLASS_TAB_PANE: 'fixed-tabs-aside-tab-pane',
                CLASS_MENU_BUTTON: 'fixed-tabs-aside-menu-button',
                CLASS_CONTENT_ROW: 'fixed-tabs-aside-content-row',
                CLASS_MENU_BUTTON: 'fixed-tabs-aside-menu-button',
                CLASS_ACTIVE: 'active',
            },
            // callbacks
            onBeforeOpen: null,
            onBeforeClose: null,
        };

        // Overwrite defaults
        self._defaults = $.extend(true, defaults, options);

        // Create elements
        self._className = self._defaults.className;
        self._html = $('html');
        self._body = $('body');
        self._layer = $('<div></div>').addClass(self._className.CLASS_LAYER);
        self._iconBody = $('<div id="fixedTabsAsideIconBar"></div>');
        self._menuBody = $('<div id="fixedTabsAsideTabContent"></div>');
        self._navRow = $('<div></div>').addClass(self._className.CLASS_NAV_ROW);
        self._closeButton = $('<button title="schliessen"></button>').addClass(self._className.CLASS_CLOSE_BUTTON);
        self._closeButtonIcon = $('<i></i>').addClass(self._className.CLASS_CLOSE_ICON_CLASS);
        self._contentRow = $('<div></div>').addClass(self._className.CLASS_CONTENT_ROW);

        if ($('.' + self._className.CLASS_TAB_PANE).length < 1) {
            return;
        }

        // Initialize after x ms
        window.setTimeout(function () {
            that._initialize();
            self._html.addClass('fixed-tabs-aside-loaded');
        }, self._defaults.delayAfterDomready);
    }

    // Initialize
    _initialize() {
        // Insert layer to DOM
        self._body.append(self._layer);

        // Append menu box to DOM
        self._body.append(self._iconBody);
        self._body.append(self._menuBody);
        self._menuBody.append(self._navRow);
        self._navRow.append(self._closeButton);
        self._closeButton.append(self._closeButtonIcon);
        self._menuBody.append(self._contentRow);


        // Collect all content-items
        var i = 0;
        $('.' + self._className.CLASS_TAB_PANE).each(function () {


            // Append item to the content row
            let el = $(this).detach();
            el.attr('data-id', i);
            self._contentRow.append(el);

            // Add Icon to the icon body
            let strIcon = $(this).attr('data-icon');
            let strTitle = typeof($(this).attr('data-title')) === "undefined" ? '' : $(this).attr('data-title');
            let strUrl = typeof($(this).attr('data-url')) === "undefined" ? '' : $(this).attr('data-url');
            let strTarget = typeof($(this).attr('data-target')) === "undefined" ? '' : $(this).attr('data-target');

            let elIcon = $('<div data-id="' + i + '" role="button"></div>');
            if (strTitle != '') {
                elIcon.attr('title', strTitle);
            }
            if (strUrl != '') {
                elIcon.attr('data-url', strUrl);
            }
            if (strTarget != '') {
                elIcon.attr('data-target', strTarget);
            }
            elIcon.addClass(self._className.CLASS_MENU_BUTTON);
            elIcon.append('<span class="' + strIcon + '"></span>');
            self._iconBody.append(elIcon);
            i++;
        });


        // EVENTS
        self._layer.click(function () {
            self.closeMenu();
        });

        // Hide Menu
        self._closeButton.click(function () {
            self.closeMenu();
        });

        // Open Menu and shov item, when clicking on the icon
        $('.' + self._className.CLASS_MENU_BUTTON).click(function () {

            // Link to url
            if (typeof($(this).attr('data-url')) !== "undefined") {
                // Open in a new window
                if (typeof($(this).attr('data-target')) !== "undefined") {
                    window.open($(this).attr('data-url'));
                    return;
                }
                window.location.href = $(this).attr('data-url');
                return;
            }

            let strId = $(this).attr('data-id');
            self.openItem(strId);
        });

        // Finaly show Menu
        self._menuBody.show();
    }

    static _openMenu() {
        self._html.addClass(self._className.CLASS_OPEN);
    }

    static closeMenu() {

        let pane = $('.' + self._className.CLASS_TAB_PANE + '.' + self._className.CLASS_ACTIVE).eq(0);
        let navbutton = $('.' + self._className.CLASS_MENU_BUTTON + '.' + self._className.CLASS_ACTIVE).eq(0);

        // Launch event callback
        if (self.onBeforeClose !== null) {
            self._defaults.onBeforeClose(pane, navbutton, self);
        }

        self._html.removeClass(self._className.CLASS_OPEN);
    }

    static openItem(index) {
        if (index == '') {
            index = 0;
        }

        $('.' + self._className.CLASS_TAB_PANE).removeClass(self._className.CLASS_ACTIVE);
        $('.' + self._className.CLASS_MENU_BUTTON).removeClass(self._className.CLASS_ACTIVE);

        let pane = $('.' + self._className.CLASS_TAB_PANE).eq(index);
        let navbutton = $('.' + self._className.CLASS_MENU_BUTTON).eq(index);

        // Launch event callback
        if (self.onBeforeOpen !== null) {
            self._defaults.onBeforeOpen(pane, navbutton, self);
        }

        pane.addClass(self._className.CLASS_ACTIVE);
        navbutton.addClass(self._className.CLASS_ACTIVE);
        self._openMenu();
    }
};



