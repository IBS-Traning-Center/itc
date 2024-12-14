class CourseDetail {
  constructor(
    data = {
      themesCourseClass: ".theme-item-block",
      showDiplomBtnClass: ".show-diplom-btn",
      diplomModalClass: ".diploma-modal",
      backgroundModalClass: ".background-modal",
      diplomCloseBtnModalClass: ".diploma-modal-close-btn",
    }
  ) {
    this.themesCourse = document.querySelectorAll(data.themesCourseClass);
    this.showDiplomBtn = document.querySelector(data.showDiplomBtnClass);
    this.diplomModal = document.querySelector(data.diplomModalClass);
    this.backgroundModal = document.querySelector(data.backgroundModalClass);
    this.diplomCloseBtnModal = document.querySelector(
      data.diplomCloseBtnModalClass
    );

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

    if (this.backgroundModal) {
      this.backgroundModal.addEventListener("click", () => {
        this.closeDiplomModal();
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
