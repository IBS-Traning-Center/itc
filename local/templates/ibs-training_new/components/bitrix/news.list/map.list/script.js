class MapsContacts {
    constructor(data = {
        tabBlockClass: '.tab',
        tabContentBlockClass: '.tab-content-block'
    }) {
        this.tabBlock = document.querySelectorAll(data.tabBlockClass);
        this.tabContentBlock = document.querySelectorAll(data.tabContentBlockClass);

        this.addTabsHandlerListener();
        this.addActiveTab();
    }

    addActiveTab()
    {
        if (this.tabContentBlock && this.tabBlock) {
            let hasActiveClass = false;

            this.tabBlock.forEach(tab => {
                if (tab.classList.contains('active')) {
                    hasActiveClass = true;
                }
            });

            if (!hasActiveClass) {
                this.tabBlock[0].classList.add('active');
                this.tabContentBlock[0].classList.add('active');
            }
        }
    }

    addTabsHandlerListener()
    {
        if (this.tabBlock) {
            this.tabBlock.forEach(tab => {
                let tabCode = tab.dataset.code;

                tab.addEventListener('click', () => {
                    this.contactsSwitchTab(tabCode);
                });
            });
        }
    }

    contactsSwitchTab(tabCode)
    {
        if (tabCode && this.tabBlock && this.tabContentBlock) {
            this.tabBlock.forEach(tab => {
                let code = tab.dataset.code;

                if (code === tabCode) {
                    tab.classList.add('active');
                } else {
                    tab.classList.remove('active');
                }
            });

            this.tabContentBlock.forEach(content => {
                let code = content.dataset.code;

                if (code === tabCode) {
                    content.classList.add('active');
                } else {
                    content.classList.remove('active');
                }
            });
        }
    }
}

document.addEventListener("DOMContentLoaded", () => {
    new MapsContacts();
});