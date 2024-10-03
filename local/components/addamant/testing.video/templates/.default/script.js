class TestingVideo
{
    constructor(data = {
        videoReviewsBlockClass: '.video-testing'
    }) {
        this.videoReviewsBlock = document.querySelector(data.videoReviewsBlockClass);

        this.customVideoControls();
    }

    customVideoControls()
    {
        let allReviewsVideoBlocks = this.videoReviewsBlock;

        if (allReviewsVideoBlocks) {
            let video =  allReviewsVideoBlocks.querySelector('video');
            let startBtn = allReviewsVideoBlocks.querySelector('.start-video-btn');
            let stopBtn = allReviewsVideoBlocks.querySelector('.stop-video-btn');
            let currentVideoTimeBlock = allReviewsVideoBlocks.querySelector('.current-video-time');
            let currentTimeVideoBack = allReviewsVideoBlocks.querySelector('.current-video-time_back');

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
    new TestingVideo();
});