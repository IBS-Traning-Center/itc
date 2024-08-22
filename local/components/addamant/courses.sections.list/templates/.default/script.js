class CatalogSectionCustom
{
    constructor(data = {
        tabsByTagsClass: '.tab-by-tag',
        catalogSectionsClass: '.catalog-sections',
        mainSectionsBlockClass: '.sections-block'
    }) {
        this.tabsByTags = document.querySelectorAll(data.tabsByTagsClass);
        this.mainSectionsBlock = document.querySelector(data.mainSectionsBlockClass);
        this.mainSectionsBlockClass = data.mainSectionsBlockClass;

        this.addEventHandlerListenerTabs();
    }

    addEventHandlerListenerTabs()
    {
        if (this.tabsByTags) {
            this.tabsByTags.forEach(tab => {
               tab.addEventListener('click', () => {
                   tab.classList.add('active');
                   this.runSetFilterComponentAjax();
               });
            });
        }
    }

    getSectionsFilter()
    {
        let filter = [];
        if (this.tabsByTags) {
            this.tabsByTags.forEach(tab => {
                if (tab.classList && tab.classList.contains('active')) {
                    filter.push = tab.dataset.code;
                }
            });
        }

        return filter;
    }

    /**
     * Метод производит аякс запрос (POST) с указанными параметрами
     * @param {string} url
     * @param {{}} data
     * @param {Function} responseHandler
     * @param {Function} errorHandler
     * @returns {void}
     */
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

    /**
     * Метод формирует параметры для аякс запроса и запускает его
     *
     * @return {void}
     */
    runSetFilterComponentAjax()
    {
        const ajaxUrl = window.location.href;
        const filter = this.getSectionsFilter();

        this.runAjax(
            ajaxUrl,
            {filter},
            response => {
                let tempElement = document.createElement('div');
                tempElement.innerHTML = response;

                this.mainSectionsBlock.innerHTML = tempElement.querySelector(this.mainSectionsBlockClass).innerHTML;
            },
            () => {},
        );
    }
}

document.addEventListener("DOMContentLoaded", () => {
    new CatalogSectionCustom();
});