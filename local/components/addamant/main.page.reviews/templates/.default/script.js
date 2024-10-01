class ReviewsMainPage
{
    constructor(data = {
        companyReviewsTabId: 'companyReviewsTab',
        studentsReviewsTabId: 'studentsReviewsTab',
        companyReviewsContentId: 'companyReviewContent',
        studentsReviewsContentId: 'studentReviewContent',
        reviewsItemsTextClass: '.review-text-block .main-text > span',
        videoReviewsBlockClass: '.reviews-video'
    }) {

        this.companyReviewsTab = document.getElementById(data.companyReviewsTabId);
        this.studentsReviewsTab = document.getElementById(data.studentsReviewsTabId);
        this.companyReviewsContent = document.getElementById(data.companyReviewsContentId);
        this.studentsReviewsContent = document.getElementById(data.studentsReviewsContentId);
        this.reviewsItemsText = document.querySelectorAll(data.reviewsItemsTextClass);
        this.videoReviewsBlock = document.querySelectorAll(data.videoReviewsBlockClass);

        this.addHandlerEventListener();
        this.hideOverflowText();
        this.initReviewsSlider();
        this.customVideoControls();
    }

    addHandlerEventListener()
    {
        if (this.companyReviewsTab) {
            this.companyReviewsTab.addEventListener('click', () => {
                this.deactivateStudents();
            });
        }

        if (this.studentsReviewsTab) {
            this.studentsReviewsTab.addEventListener('click', () => {
                this.deactivateCompany();
            });
        }
    }

    deactivateCompany()
    {
        if (
            (this.companyReviewsTab && this.companyReviewsContent) &&
            (this.companyReviewsTab.classList && this.companyReviewsContent.classList)
        ) {
            this.companyReviewsTab.classList.remove('active');
            this.companyReviewsContent.classList.remove('active');
        }

        if (
            (this.studentsReviewsTab && this.studentsReviewsContent) &&
            (this.studentsReviewsTab.classList && this.studentsReviewsContent.classList)
        ) {
            this.studentsReviewsTab.classList.add('active');
            this.studentsReviewsContent.classList.add('active');
        }
    }

    deactivateStudents()
    {
        if (
            (this.studentsReviewsTab && this.studentsReviewsContent) &&
            (this.studentsReviewsTab.classList && this.studentsReviewsContent.classList)
            ) {
            this.studentsReviewsTab.classList.remove('active');
            this.studentsReviewsContent.classList.remove('active');
        }

        if (
            (this.companyReviewsTab && this.companyReviewsContent) &&
            (this.companyReviewsTab.classList && this.companyReviewsContent.classList)
        ) {
            this.companyReviewsTab.classList.add('active');
            this.companyReviewsContent.classList.add('active');
        }
    }

    hideOverflowText()
    {
        if (this.reviewsItemsText) {
            let MAX_COUNT_SYMBOLS;

            if (window.innerWidth > 1180) {
                MAX_COUNT_SYMBOLS = 305;
            } else {
                MAX_COUNT_SYMBOLS = 205;
            }

            this.reviewsItemsText.forEach(elem => {
                let sliced = elem.textContent.slice(0, MAX_COUNT_SYMBOLS);

                if (sliced.length < elem.textContent.length) {
                    let dataId = elem.dataset.id;

                    sliced += '... <a href="/reviews/' + dataId +'/">Читать все</a>';
                    elem.innerHTML = sliced;
                }
            });
        }
    }

    initReviewsSlider()
    {
        if (this.companyReviewsContent) {
            let companyReviewsContent = $('#companyReviewContent');

            companyReviewsContent.slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                infinite: false,
                autoplay: false,
                arrows: false,
                dots: true,
                variableWidth: true,
                responsive: [
                    {
                        breakpoint: 1190,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 1180,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 840,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 565,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 450,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        }

        if (this.studentsReviewsContent) {
            let studentsReviewsContentId = $('#studentReviewContent');

            studentsReviewsContentId.slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                infinite: false,
                autoplay: false,
                arrows: false,
                dots: true,
                variableWidth: true,
                responsive: [
                    {
                        breakpoint: 1190,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        }
    }

    customVideoControls()
    {
        let allReviewsVideoBlocks = this.videoReviewsBlock;

        if (allReviewsVideoBlocks) {
            allReviewsVideoBlocks.forEach(videoBlock => {
               let video =  videoBlock.querySelector('video');
               let startBtn = videoBlock.querySelector('.start-video-btn');
               let stopBtn = videoBlock.querySelector('.stop-video-btn');
               let currentVideoTimeBlock = videoBlock.querySelector('.current-video-time');
               let currentTimeVideoBack = videoBlock.querySelector('.current-video-time_back');

               if (!video || !startBtn || !stopBtn || !currentTimeVideoBack || !currentTimeVideoBack) {
                   return false;
               }

               let timerId;

                startBtn.addEventListener('click', () => {
                    video.play();
                    video.muted = false;
                    startBtn.style.display = 'none';
                    stopBtn.style.display = 'flex';

                    timerId = this.videoSetTimeout(video, currentVideoTimeBlock, currentTimeVideoBack, startBtn, stopBtn);
                });

                stopBtn.addEventListener('click', () => {
                    video.pause();
                    video.muted = true;
                    stopBtn.style.display = 'none';
                    startBtn.style.display = 'flex';

                    clearInterval(timerId);
                });
            });
        }
    }

    videoSetTimeout(video, currentVideoTimeBlock, currentTimeVideoBack, startBtn, stopBtn)
    {
        let timerId;

        timerId = setInterval(function () {
            let videoDuration = parseFloat(video.duration);
            let widthBlock = parseFloat(currentVideoTimeBlock.offsetWidth);
            let currentWidth = parseFloat(currentTimeVideoBack.style.width.slice(0, -2)) ? parseFloat(currentTimeVideoBack.style.width.slice(0, -2)) : 0;
            let totalWidth = (widthBlock / videoDuration) + currentWidth;

            if (totalWidth < widthBlock) {
                currentTimeVideoBack.style.width = totalWidth + 'px';
            } else {
                video.currentTime = 0;
                video.pause();
                currentTimeVideoBack.style.width = '0px';
                stopBtn.style.display = 'none';
                startBtn.style.display = 'flex';

                clearInterval(timerId);
            }
        }, 1000);

        return timerId;
    }
}

document.addEventListener("DOMContentLoaded", () => {
    new ReviewsMainPage();
});