class ReviewsPage
{
    constructor(data = {
        reviewsItemsClass: '.review-item',
        videoReviewsBlockClass: '.review-modal .reviews-video',
        reviewsModalShadow: '.reviews-content-shadow',
        reviewsModal: '.review-modal',
        reviewsModalClose: '.review-modal-close',
    }) {
        this.reviewsItems = document.querySelectorAll(data.reviewsItemsClass);
        this.videoReviewsBlock = document.querySelectorAll(data.videoReviewsBlockClass);
        this.reviewsModalShadow = document.querySelector(data.reviewsModalShadow);
        this.reviewsModal = document.querySelectorAll(data.reviewsModal);
        this.reviewsModalClose = document.querySelectorAll(data.reviewsModalClose);

        this.addHandlerEventListener();
        this.hideOverflowText();
        this.customVideoControls();
    }

    addHandlerEventListener()
    {   
        this.reviewsItems.forEach(item => {
            if(item.classList.contains('review-modal') == false) {
                item.addEventListener('click', () => {
                    this.openModal(item);
                });
            }
        });

        this.reviewsModalShadow.addEventListener('click', () => {
            this.reviewsModal.forEach(item => {
                if(item.style.display == 'block'){
                    this.closeModal(item);
                }
            });
        });

        this.reviewsModalClose.forEach(itemClose => {
            itemClose.addEventListener('click', () => {
                let closestModal = itemClose.closest('.review-modal');
                this.closeModal(closestModal);
            });
        });
    }

    openModal(item){
        let modal = item.nextElementSibling;
        if(modal.classList.contains('review-modal')){
            modal.style.display = 'block';
            this.reviewsModalShadow.style.display = 'block';
        }
    }

    closeModal(item){
        let video =  item.querySelector('video');

        if (video) {
            video.pause();
        }

        item.style.display = 'none';
        this.reviewsModalShadow.style.display = 'none';
    }

    hideOverflowText()
    {    
        let MAX_COUNT_SYMBOLS;
        if (window.innerWidth > 1180) {
            MAX_COUNT_SYMBOLS = 300;
        } else {
            MAX_COUNT_SYMBOLS = 340;
        }

        this.reviewsItems.forEach(item => {
            if(item.classList.contains('review-modal') == false) {
                let reviewTextBlock = item.querySelector('.review-text-block .main-text > span');
                if(reviewTextBlock !== null){
                    let sliced = reviewTextBlock.textContent.slice(0, MAX_COUNT_SYMBOLS);

                    if (sliced.length < reviewTextBlock.textContent.length) {
                        sliced += '... <a>Читать все</a>';
                        reviewTextBlock.innerHTML = sliced;
                    }
                } 
            }
        });
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
    new ReviewsPage();
});