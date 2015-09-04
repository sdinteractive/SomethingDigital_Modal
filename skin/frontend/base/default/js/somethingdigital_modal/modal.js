var SomethingDigital_Modal = Class.create();
SomethingDigital_Modal.prototype = {
    initialize: function(config) {
        this.options = config;
        this.options.seenModalFlag = 'seenModal';
        if (!Mage.Cookies.get(this.options.seenModalFlag) || this.options.skipCookieCheck) {
            this.cookieUser();
            this.showModal();
        }
    },
    cookieUser: function() {
        var today = new Date();
        today.setTime(today.getTime());
        var duration = 1000 * 60 * 60 * 24 * this.options.cookieDuration;
        var expireDate = new Date(today.getTime() + duration);
        Mage.Cookies.expires = expireDate;
        Mage.Cookies.set(this.options.seenModalFlag, 1);   
    },
    showModal: function() {
        this.modal = new Window({
            // The actual window fills the whole screen
            width: window.innerWidth,
            height: window.innerHeight,
            zIndex: this.options.modalZIndex,
            onShow: this.showOverlay.bind(this),
            onHide: this.removeOverlay.bind(this),
            onClose: this.removeOverlay.bind(this)
        });
        this.modal.getContent().update(this.options.modalContent);
        this.modal.showCenter();
        document.observe('click', this.handleClick.bind(this));
    },
    showOverlay: function() {
        var overlayStyle = 'width: 100%; height: 100%; background-color: black; opacity: ' + this.options.overlayOpacity + '; z-index: ' + (parseInt(this.options.modalZIndex) - 1) + '; position: absolute; top: 0; left: 0';
        this.overlay = new Element('div', {style: overlayStyle, 'id': 'overlay'});
        $$('body')[0].insert(this.overlay);
    },
    removeOverlay: function() {
        this.overlay.remove();
    },
    handleClick: function(event) {
        if (!event.findElement('#modal')) {
            this.modal.close();
        }
    }
}
