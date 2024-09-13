class FilterSection{

    constructor() {
        this.filterItemsWrap = document.querySelector('.timetable-filter-wrap ul')
        this.typeTimetableSelect = document.querySelector('.timetable-menu .simple-select span')
        this.ChangeTypeTimetable = document.querySelectorAll('.timetable-menu-ul li')

        this.initFilters();
        this.initSelect();    
    }

    initSelect(){
        this.ChangeTypeTimetable.forEach(elem => {
            let typeTimetableSelect = this.typeTimetableSelect;

            if(elem.classList.contains('active')){
                typeTimetableSelect.innerText = elem.querySelector('a').innerText;
            }
            elem.addEventListener('click', function() {
                typeTimetableSelect.innerText = elem.querySelector('a').innerText;
            });
            
        });
    }

    initFilters(){
        let filterItem = this.filterItemsWrap.querySelectorAll('li'),
            moreItemBtn = document.querySelector('.more-item')

        if(this.filterItemsWrap !== null){
            let countItemHide = filterItem.length - 7;
            if(countItemHide > 0){
                moreItemBtn.style.display = 'flex';
                moreItemBtn.querySelector('span').innerHTML = moreItemBtn.querySelector('span').innerHTML + ' ' + countItemHide;
            }
            filterItem.forEach((tag, index) => {
                if(index < 8){
                    tag.style.display = 'block';
                }
            });
        }

        if(moreItemBtn !== null){
            moreItemBtn.addEventListener('click', function() {
                moreItemBtn.style.display = 'none';
                filterItem.forEach((tag, index) => {
                    tag.style.display = 'block';
                });
            });
        }
    }
}

document.addEventListener("DOMContentLoaded", (e) => {
    new FilterSection;
});
