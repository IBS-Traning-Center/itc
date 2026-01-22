class ReviewsTalentPage
{
    constructor(data = {
        studentsReviewsContentId: 'studentReviewContent',
        reviewsItemsTextClass: '.review-text-block .main-text > span',
        videoReviewsBlockClass: '.reviews-video'
    }) {
        this.studentsReviewsContent = document.getElementById(data.studentsReviewsContentId);
        this.reviewsItemsText = document.querySelectorAll(data.reviewsItemsTextClass);
        this.videoReviewsBlock = document.querySelectorAll(data.videoReviewsBlockClass);

        this.hideOverflowText();
        this.initReviewsSlider();
        this.customVideoControls();
    }

    hideOverflowText()
    {
        if (this.reviewsItemsText) {
            let MAX_COUNT_SYMBOLS;

            if (window.innerWidth > 1180) {
                MAX_COUNT_SYMBOLS = 265;
            } else {
                MAX_COUNT_SYMBOLS = 205;
            }

            this.reviewsItemsText.forEach(elem => {
                let sliced = elem.textContent.slice(0, MAX_COUNT_SYMBOLS);

                if (sliced.length < elem.textContent.length) {
                    if(elem.classList.contains('student-text')){
                        sliced += '... <a href="/reviews/?reviews=student">Читать все</a>';
                        elem.innerHTML = sliced;
                    }
                }
            });
        }
    }

    initReviewsSlider()
    {

        if (this.studentsReviewsContent) {
            let studentsReviewsContentId = $('#studentReviewContent');

            studentsReviewsContentId.slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                infinite: false,
                autoplay: false,
                arrows: false,
                dots: true,
                variableWidth: false,
                responsive: [
                    {
                        breakpoint: 1600,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 1300,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            dots: true,
                            arrows: true,
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
    new ReviewsTalentPage();
});