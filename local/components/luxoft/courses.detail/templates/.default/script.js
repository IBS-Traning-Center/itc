class CourseDetail {
  constructor(
    data = {
      themesCourseClass: ".theme-item-block",
      showDiplomBtnClass: ".show-diplom-btn",
      diplomModalClass: ".diploma-modal",
      backgroundModalClass: ".background-modal",
      diplomCloseBtnModalClass: ".diploma-modal-close-btn",
      showFormatBtnClass: ".show-format-btn",
      formatModalClass: ".format-modal",
      formatCloseBtnModalClass: ".format-modal-close-btn",
      signDateBtnClass: '.sign-date-btn',
      selectDateClass: '.select-date',
      dateInputClass: '.sign-course-form-input.date',
      selectDatesContentClass: '.select-dates-content',
    }
  ) {
    this.themesCourse = document.querySelectorAll(data.themesCourseClass);
    this.showDiplomBtn = document.querySelector(data.showDiplomBtnClass);
    this.diplomModal = document.querySelector(data.diplomModalClass);
    this.backgroundModal = document.querySelector(data.backgroundModalClass);
    this.diplomCloseBtnModal = document.querySelector(data.diplomCloseBtnModalClass);
    this.showFormatBtn = document.querySelector(data.showFormatBtnClass);
    this.formatModal = document.querySelector(data.formatModalClass);
    this.formatCloseBtnModal = document.querySelector(data.formatCloseBtnModalClass);
    this.signDateBtn = document.querySelectorAll(data.signDateBtnClass);
    this.selectDate = document.querySelectorAll(data.selectDateClass);
    this.dateInput = document.querySelector(data.dateInputClass);
    this.selectDatesContent = document.querySelector(data.selectDatesContentClass);

    this.addCourseDetailEventHandler();
    this.initLinkedCoursesSlider();
  }

  addCourseDetailEventHandler() {
    if (this.themesCourse) {
      this.themesCourse.forEach((block) => {
        block.addEventListener("click", () => {
          if (block.classList.contains("active")) {
            block.classList.remove("active");
          } else {
            block.classList.add("active");
          }
        });
      });
    }

    if (this.showDiplomBtn) {
      this.showDiplomBtn.addEventListener("click", () => {
        this.openDiplomModal();
      });
    }

    if (this.diplomCloseBtnModal) {
      this.diplomCloseBtnModal.addEventListener("click", () => {
        this.closeDiplomModal();
      });
    }

    if (this.showFormatBtn) {
      this.showFormatBtn.addEventListener("click", () => {
        this.openFormatModal();
      });
    }

    if (this.formatCloseBtnModal) {
      this.formatCloseBtnModal.addEventListener("click", () => {
        this.closeFormatModal();
      });
    }

    if (this.backgroundModal) {
      this.backgroundModal.addEventListener("click", () => {
        this.closeDiplomModal();
        this.closeFormatModal();
      });
    }

    if (this.signDateBtn && this.selectDate && this.selectDatesContent && this.dateInput) {
      this.signDateBtn.forEach(block => {
        block.addEventListener('click', () => {
          let data = block.getAttribute('data-date');

          this.selectDate.forEach(date => {
            let text = date.textContent;
            if (text.indexOf(data) !== -1) {
              let value = date.querySelector('span').textContent;
              this.selectDatesContent.querySelector('span').textContent = value;
              this.dateInput.value = value;
            }
          });
        });
      });
    }
  }

  openDiplomModal() {
    if (this.diplomModal && this.backgroundModal && this.diplomCloseBtnModal) {
      this.diplomModal.style.display = "flex";
      this.backgroundModal.style.display = "block";
      this.diplomCloseBtnModal.style.display = "flex";
    }
  }

  closeDiplomModal() {
    if (this.diplomModal && this.backgroundModal && this.diplomCloseBtnModal) {
      this.diplomModal.style.display = "none";
      this.backgroundModal.style.display = "none";
      this.diplomCloseBtnModal.style.display = "none";
    }
  }

  openFormatModal() {
    if (this.formatModal && this.backgroundModal && this.formatCloseBtnModal) {
      this.formatModal.style.display = "flex";
      this.backgroundModal.style.display = "block";
      this.formatCloseBtnModal.style.display = "flex";
    }
  }

  closeFormatModal() {
    if (this.formatModal && this.backgroundModal && this.formatCloseBtnModal) {
      this.formatModal.style.display = "none";
      this.backgroundModal.style.display = "none";
      this.formatCloseBtnModal.style.display = "none";
    }
  }

  initLinkedCoursesSlider() {
    let linkedCoursesBlock = $(".linked-courses-block");

    if (linkedCoursesBlock) {
      linkedCoursesBlock.slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        infinite: false,
        autoplay: false,
        arrows: false,
        dots: true,
        variableWidth: false,
        responsive: [
          {
            breakpoint: 1400,
            settings: {
              slidesToShow: 3,
            },
          },
          {
            breakpoint: 900,
            settings: {
              slidesToShow: 2,
            },
          },
          {
            breakpoint: 590,
            settings: {
              slidesToShow: 1,
            },
          },
        ],
      });
    }
  }
}

document.addEventListener("DOMContentLoaded", () => {
  new CourseDetail();
});