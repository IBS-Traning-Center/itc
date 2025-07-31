class TrainerDetail
{
    constructor(data = {
        certificateItemClass: '.certificate-item',
        videoItemClass: '.video-item'
    }) {
        this.certificateItem = document.querySelectorAll(data.certificateItemClass);
        this.videoItem = document.querySelectorAll(data.videoItemClass);

        this.initDetailTrainerSliders();
        this.addEventTrainerDetailListener();
    }

    initDetailTrainerSliders()
    {
        const coursesBlock = $('.trainer-courses-block');

        if (coursesBlock) {
            coursesBlock.slick({
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
                        breakpoint: 1001,
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

        const videoBlock = $('.videos-items');

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

        const certificatesBlock = $('.certificates-container');

        if (certificatesBlock) {
            certificatesBlock.slick({
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
                            slidesToShow: 2,
                            variableWidth: true
                        }
                    },
                    {
                        breakpoint: 1001,
                        settings: {
                            slidesToShow: 3,
                            variableWidth: true
                        }
                    },
                    {
                        breakpoint: 850,
                        settings: {
                            slidesToShow: 2,
                            variableWidth: true
                        }
                    },
                    {
                        breakpoint: 551,
                        settings: {
                            slidesToShow: 1,
                            variableWidth: true
                        }
                    }
                ]
            });
        }
    }

    addEventTrainerDetailListener()
    {
        if (this.certificateItem) {
            this.certificateItem.forEach(item => {
               item.addEventListener('click', () => {
                   setTimeout(function () {
                       let fancyBox = document.querySelector('.fancybox-container.fancybox-is-open');
                       fancyBox.classList.add('certificates');
                   }, 100);
               });
            });
        }

        if (this.videoItem) {
            this.videoItem.forEach(item => {
                item.addEventListener('click', () => {
                    setTimeout(function () {
                        let fancyBox = document.querySelector('.fancybox-container.fancybox-is-open');
                        fancyBox.classList.add('video');
                    }, 100);
                });
            });
        }
    }
}

document.addEventListener("DOMContentLoaded", () => {
    new TrainerDetail();
});