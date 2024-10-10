class BabokRules
{
    constructor(data = {
        ruleItemClass: '.rule-item'
    }) {
        this.ruleItem = document.querySelectorAll(data.ruleItemClass);

        this.addEventListenerRule();
    }

    addEventListenerRule()
    {
        if (this.ruleItem) {
            this.ruleItem.forEach(item => {
               item.addEventListener('click', () => {
                  if (item.classList.contains('active')) {
                      item.classList.remove('active');
                  } else {
                      item.classList.add('active');
                  }
               });
            });
        }
    }
}

document.addEventListener("DOMContentLoaded", () => {
    new BabokRules();
});