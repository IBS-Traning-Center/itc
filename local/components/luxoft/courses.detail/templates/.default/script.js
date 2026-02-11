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
      signCourseMagnetBlockCLass: '.sign-course-magnet-block',
      openSignMagnetModalClass: '.open-sign-magnet-modal',
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
    this.videoItem = document.querySelectorAll(data.videoItemClass);
    this.signCourseMagnetBlock = document.querySelector(data.signCourseMagnetBlockCLass);
    this.openSignMagnetModal = document.querySelectorAll(data.openSignMagnetModalClass);

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

        if (this.signCourseMagnetBlock) {
          this.signCourseMagnetBlock.style.display = 'none';
        }
      });
    }

    if (this.openSignMagnetModal) {
      this.openSignMagnetModal.forEach(block => {
        block.addEventListener('click', () => {
          this.openMagnetModal();
        });
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

  openMagnetModal()
  {
    if (this.signCourseMagnetBlock && this.backgroundModal) {
      this.signCourseMagnetBlock.style.display = 'block';
      this.backgroundModal.style.display = 'flex';
    }
  }

  initLinkedCoursesSlider() {
    let videoBlock = $('.videos-items');

        if (videoBlock) {
            videoBlock.slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                infinite: false,
                autoplay: false,
                arrows: false,
                dots: true,
                variableWidth: false,
                responsive: [
                    {
                        breakpoint: 1281,
                        settings: {
                            slidesToShow: 3
                        }
                    },
                    {
                        breakpoint: 789,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 551,
                        settings: {
                            slidesToShow: 1
                        }
                    }
                ]
            });
        }

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
document.addEventListener('DOMContentLoaded', function() {
    const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');

    addToCartButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            const courseId = this.dataset.courseId;
            const scheduleId = this.dataset.scheduleId;

            const button = this;
            const originalText = button.innerHTML;


            if (!scheduleId || parseInt(scheduleId) === 0) {
                alert('Не удалось добавить курс. Расписание не найдено.');
                return;
            }


            button.disabled = true;
            button.innerHTML = '<span class="loading-text">Добавляем...</span>';


            const formData = new URLSearchParams();
            formData.append('sessid', BX.bitrix_sessid());
            formData.append('id', courseId);
            formData.append('schedule_id', scheduleId);
            formData.append('quantity', 1);


            fetch('/ajax/add_course_to_basket.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: formData,
                credentials: 'same-origin'
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Ошибка сети');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        button.innerHTML = '<span class="success-text">Добавлено</span>';
                        button.classList.add('added');

                        updateBasketCounter(data);

                        setTimeout(() => {
                            button.disabled = false;
                            button.innerHTML = originalText;
                            button.classList.remove('added');
                        }, 2000);

                    } else {
                        throw new Error(data.error || 'Ошибка добавления');
                    }
                })
                .catch(error => {
                    console.error('Ошибка:', error);
                    alert('Ошибка: ' + error.message);
                    button.disabled = false;
                    button.innerHTML = originalText;
                });
        });
    });

    function updateBasketCounter(data) {
        if (typeof BX.onCustomEvent === 'function') {
            BX.onCustomEvent('OnBasketChange');
        }

        const headerCounter = document.querySelector('.cart-icon-right');
        if (headerCounter && data.count !== undefined) {
            headerCounter.classList.add('in-cart');
        }

        const basketCounter = document.querySelector('.basket-count, .cart-count, .header-basket-counter');
        if (basketCounter && data.count !== undefined) {
            basketCounter.textContent = data.count;
            basketCounter.style.display = data.count > 0 ? 'inline-block' : 'none';
        }
        const basketSum = document.querySelector('.basket-sum, .cart-sum');
        if (basketSum && data.formatted_sum) {
            basketSum.textContent = data.formatted_sum;
        }
    }
});