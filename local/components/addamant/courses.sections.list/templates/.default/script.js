class CatalogSectionCustom
{
    constructor(data = {
        tabsByTagsClass: '.tab-by-tag',
        catalogSectionsClass: '.catalog-sections',
        mainSectionsBlockClass: '.sections-block',
        allTagsTabClass: '.all-tags-tab',
        loaderId: 'loader',
        loaderBackgroundId: 'background-loader',
        catalogSectionTableClass: '.catalog-sections.table',
        catalogSectionDefaultClass: '.catalog-sections.default',
        defaultViewBtnId: 'defaultViewBtn',
        tabletViewBtnId: 'tabletViewBtn',
        mobileButtonOpenFilterClass: '.mobile-button-open-filter',
        tabsByTagsBlockClass: '.tabs-by-tags',
        tabsBySectionBlockClass: '.tabs-by-section',
        mobileFilterModalClass: '.mobile-filter-modal',
        mobileFilterModalContentClass: '.mobile-filter-modal-content',
        backgroundModalFilterClass: '.background-modal-filter',
        applyFilterClass: '.apply-filter'
    }) {
        this.tabsByTags = document.querySelectorAll(data.tabsByTagsClass);

        this.mainSectionsBlock = document.querySelector(data.mainSectionsBlockClass);
        this.allTagsTab = document.querySelector(data.allTagsTabClass);
        this.catalogSectionTable = document.querySelector(data.catalogSectionTableClass);
        this.catalogSectionDefault = document.querySelector(data.catalogSectionDefaultClass);
        this.mobileButtonOpenFilter = document.querySelector(data.mobileButtonOpenFilterClass);
        this.tabsByTagsBlockBlock = document.querySelector(data.tabsByTagsBlockClass);
        this.tabsBySectionBlock = document.querySelector(data.tabsBySectionBlockClass);
        this.mobileFilterModalContentBlock = document.querySelector(data.mobileFilterModalContentClass);
        this.mobileFilterModalBlock = document.querySelector(data.mobileFilterModalClass);
        this.backgroundModalFilterBlock = document.querySelector(data.backgroundModalFilterClass);
        this.applyFilterBtn = document.querySelector(data.applyFilterClass);

        this.loader = document.getElementById(data.loaderId);
        this.loaderBackground = document.getElementById(data.loaderBackgroundId);
        this.defaultViewBtn = document.getElementById(data.defaultViewBtnId);
        this.tabletViewBtn = document.getElementById(data.tabletViewBtnId);

        this.mainSectionsBlockClass = data.mainSectionsBlockClass;
        this.catalogSectionTableClass = data.catalogSectionTableClass;
        this.catalogSectionDefaultClass = data.catalogSectionDefaultClass;
        this.defaultViewBtnId = data.defaultViewBtnId;
        this.tabletViewBtnId = data.tabletViewBtnId;

        this.addEventHandlerListenerTabs();
        this.allTagsTabHandlerListener();
        this.swapViewCatalogSection();

        if (window.innerWidth < 1181) {
            this.openModalFilterMobile();
            this.changeLocationMobileBlock();
            this.backgroundModalFilterListener();
            this.applyFilterMobileEventHandler();
        }
    }

    applyFilterMobileEventHandler()
    {
        if (this.applyFilterBtn) {
            this.applyFilterBtn.addEventListener('click', () => {
                this.runSetFilterComponentAjax();
                this.closeModalFilterModal();
            });
        }
    }

    changeLocationMobileBlock()
    {
        if (
            this.tabsByTagsBlockBlock &&
            this.tabsBySectionBlock &&
            this.mobileFilterModalContentBlock
        ) {
            this.mobileFilterModalContentBlock.querySelector('p.course-type').after(this.tabsBySectionBlock);
            this.mobileFilterModalContentBlock.querySelector('p.course-direction').after(this.tabsByTagsBlockBlock);
        }
    }

    openModalFilterMobile()
    {
        if (
            this.mobileButtonOpenFilter &&
            this.mobileFilterModalBlock &&
            this.backgroundModalFilterBlock
        ) {
            this.mobileButtonOpenFilter.addEventListener('click', () => {
                this.mobileFilterModalBlock.style.display = 'block';
                this.backgroundModalFilterBlock.style.display = 'block';
            });
        }
    }

    backgroundModalFilterListener()
    {
        if (
            this.backgroundModalFilterBlock &&
            this.mobileFilterModalBlock
        ) {
            this.backgroundModalFilterBlock.addEventListener('click', () => {
                this.closeModalFilterModal();
            });
        }
    }

    closeModalFilterModal()
    {
        if (
            this.backgroundModalFilterBlock &&
            this.mobileFilterModalBlock
        ) {
            this.mobileFilterModalBlock.style.display = 'none';
            this.backgroundModalFilterBlock.style.display = 'none';
        }
    }

    swapViewCatalogSection()
    {
        if (
            this.defaultViewBtn &&
            this.tabletViewBtn &&
            this.catalogSectionTable &&
            this.catalogSectionDefault
        ) {
            this.defaultViewBtn.addEventListener('click', () => {
                this.defaultViewBtn.classList.add('active');
                this.tabletViewBtn.classList.remove('active');

                this.catalogSectionDefault.style.display = 'grid';
                this.catalogSectionTable.style.display = 'none';
            });

            this.tabletViewBtn.addEventListener('click', () => {
                this.tabletViewBtn.classList.add('active');
                this.defaultViewBtn.classList.remove('active');

                this.catalogSectionTable.style.display = 'flex';
                this.catalogSectionDefault.style.display = 'none';
            });
        }
    }

    allTagsTabHandlerListener()
    {
        if (this.allTagsTab && this.tabsByTags) {
            this.allTagsTab.addEventListener('click', () => {
                this.tabsByTags.forEach(tab => {
                    if (tab.classList) {
                        tab.classList.remove('active');
                    }
                });

                this.allTagsTab.classList.add('active');

                if (window.innerWidth > 1180) {
                    this.runSetFilterComponentAjax();
                }
            });
        }
    }

    addEventHandlerListenerTabs()
    {
        if (this.tabsByTags) {
            this.tabsByTags.forEach(tab => {
               tab.addEventListener('click', () => {
                   if (this.allTagsTab && this.allTagsTab.classList) {
                       this.allTagsTab.classList.remove('active');
                   }

                   if (tab.classList && tab.classList.contains('active')) {
                       tab.classList.remove('active');
                   } else {
                       tab.classList.add('active');
                   }

                   if (window.innerWidth > 1180) {
                       this.runSetFilterComponentAjax();
                   }
               });
            });
        }
    }

    getSectionsFilterTagsId()
    {
        let filter = [];
        let i = 0;
        if (this.tabsByTags) {
            this.tabsByTags.forEach(tab => {
                if (tab.classList && tab.classList.contains('active')) {
                    filter[i] = tab.dataset.code;

                    i++;
                }
            });
        }

        return filter;
    }

    runAjax(url, data, responseHandler, errorHandler)
    {
        BX.ajax({
            url,
            method: 'POST',
            data,
            onsuccess: response => responseHandler(response),
            onfailure: error => errorHandler(error)
        });
    }

    runSetFilterComponentAjax()
    {
        const ajaxUrl = window.location.href;
        const filter = this.getSectionsFilterTagsId();
        this.loader.style.display = 'block';
        this.loaderBackground.style.display = 'block';

        this.runAjax(
            ajaxUrl,
            {filter},
            response => {
                this.loader.style.display = 'none';
                this.loaderBackground.style.display = 'none';

                let tempElement = document.createElement('div');
                tempElement.innerHTML = response;

                this.mainSectionsBlock.innerHTML = tempElement.querySelector(this.mainSectionsBlockClass).innerHTML;

                let catalogSectionTable = document.querySelector(this.catalogSectionTableClass);
                let catalogSectionDefault = document.querySelector(this.catalogSectionDefaultClass);
                let defaultViewBtn = document.getElementById(this.defaultViewBtnId);
                let tabletViewBtn = document.getElementById(this.tabletViewBtnId);

                if (
                    catalogSectionTable &&
                    catalogSectionDefault &&
                    defaultViewBtn &&
                    tabletViewBtn
                ) {
                    defaultViewBtn.addEventListener('click', () => {
                        defaultViewBtn.classList.add('active');
                        tabletViewBtn.classList.remove('active');

                        catalogSectionDefault.style.display = 'grid';
                        catalogSectionTable.style.display = 'none';
                    });

                    tabletViewBtn.addEventListener('click', () => {
                        tabletViewBtn.classList.add('active');
                        defaultViewBtn.classList.remove('active');

                        catalogSectionTable.style.display = 'flex';
                        catalogSectionDefault.style.display = 'none';
                    });
                }

                let coursesDiscountContent = $('#coursesDiscountSlider.more-elem');

                if (coursesDiscountContent) {
                    coursesDiscountContent.slick({
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        infinite: false,
                        autoplay: false,
                        arrows: true,
                        dots: false,
                        variableWidth: false,
                        responsive: [
                            {
                                breakpoint: 1251,
                                settings: 'unslick'
                            }
                        ]
                    });
                }
            },
            () => {
                this.loader.style.display = 'none';
                this.loaderBackground.style.display = 'none';
            },
        );
    }
}

document.addEventListener("DOMContentLoaded", () => {
    new CatalogSectionCustom();
});