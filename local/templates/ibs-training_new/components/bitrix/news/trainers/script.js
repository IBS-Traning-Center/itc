class Trainers
{
    constructor(data = {
        tagBlockClass: '.tag-block',
        allTagsClass: '.all-tags',
        trainersBlockClass: '.trainers-block',
        loaderId: 'loader',
        loaderBackgroundId: 'background-loader',
        searchInputId: 'search-catalog',
        searchHiddenBlockClass: '.search-hidden-block',
        hiddenSearchInputId: 'search-text'
    }) {
       this.tagBlock = document.querySelectorAll(data.tagBlockClass);
       this.allTagsBlock = document.querySelector(data.allTagsClass);
       this.trainersBlock = document.querySelector(data.trainersBlockClass);
       this.searchHiddenBlock = document.querySelector(data.searchHiddenBlockClass);
       this.trainersBlockClass = data.trainersBlockClass;

       this.loader = document.getElementById(data.loaderId);
       this.loaderBackground = document.getElementById(data.loaderBackgroundId);
       this.searchInput = document.getElementById(data.searchInputId);
       this.hiddenSearchInput = document.getElementById(data.hiddenSearchInputId);

       this.trainersEventHandler();
       this.addInputSearchClickEvent();
    }

    addInputSearchClickEvent()
    {
        if (
            this.searchHiddenBlock &&
            this.searchInput &&
            this.hiddenSearchInput
        ) {
            this.searchInput.addEventListener('focus', () => {
                this.searchHiddenBlock.style.display = 'block';
                this.hiddenSearchInput.focus();

                window.scrollTo({
                    top: 450,
                    behavior: "smooth",
                });
            });
        }
    }

    trainersEventHandler()
    {
        if (this.tagBlock && this.allTagsBlock) {
            this.tagBlock.forEach(tag => {
                tag.addEventListener('click', () => {
                    this.allTagsBlock.classList.remove('active');

                    if (tag.classList.contains('active')) {
                        tag.classList.remove('active');
                    } else {
                        tag.classList.add('active');
                    }

                    this.runSetFilterComponentAjax();
                });
            });

            this.allTagsBlock.addEventListener('click', () => {
                this.tagBlock.forEach(tag => {
                    tag.classList.remove('active');
                });

                this.allTagsBlock.classList.add('active');
                this.runSetFilterComponentAjax();
            });
        }
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
        const filter = this.getTrainersFilterTags();

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

                this.trainersBlock.innerHTML = tempElement.querySelector(this.trainersBlockClass).innerHTML;
            },
            () => {
                this.loader.style.display = 'none';
                this.loaderBackground.style.display = 'none';
            },
        );
    }

    getTrainersFilterTags()
    {
        let filter = [];
        let i = 0;
        if (this.tagBlock) {
            this.tagBlock.forEach(tab => {
                if (tab.classList && tab.classList.contains('active')) {
                    filter[i] = tab.dataset.code;

                    i++;
                }
            });
        }

        if (this.tagBlock && this.allTagsBlock) {
            let countActiveTags = 0;

            this.tagBlock.forEach(tag => {
               if (tag.classList.contains('active')) {
                   countActiveTags++;
               }
            });

            if (countActiveTags === 0) {
                this.allTagsBlock.classList.add('active');
            }
        }

        return filter;
    }
}

document.addEventListener("DOMContentLoaded", () => {
    new Trainers();
});