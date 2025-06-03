<template>

  <div class="product-sub-gallery product-sub-gallery--multiple" v-if="items.length > 0">

    <button class="product-sub-gallery__arrow product-sub-gallery__arrow--prev" tabindex="0" role="button"
            aria-label="Previous slide" aria-disabled="false"
            v-bind:class="{'product-sub-gallery__arrow--disabled': btnPrevVisible !== true}" @click="showPrev"></button>

        <div class="product-sub-gallery__swiper swiper-container swiper-container-initialized swiper-container-horizontal">
          <div class="product-sub-gallery__items swiper-wrapper">

            <VueSlickCarousel v-bind="settings" @beforeChange="beforeChange" @afterChange="afterChange" ref="carousel">

              <div v-for="(item, index) in items" :key="index" class="product-sub-gallery__item swiper-slide" :data-id="item.ID">
                <img class="product-sub-gallery__image swiper-lazy" :src="item.SRC">
              </div>

            </VueSlickCarousel>

          </div>
        </div>

    <button class="product-sub-gallery__arrow product-sub-gallery__arrow--next" tabindex="0" role="button"
            aria-label="Next slide" aria-disabled="false"
            v-bind:class="{'product-sub-gallery__arrow--disabled': btnNextVisible !== true}" @click="showNext"></button>

  </div>

</template>

<script>
import VueSlickCarousel from 'vue-slick-carousel'
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
// optional style for arrows & dots
// import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'

export default {
  name: 'carouselPictures',
  components: { VueSlickCarousel },
  data(){
    return {
      test: "Test2",
      items: [],
      settings: {
        arrows: false,
        dots: false,
        focusOnSelect: true,
        infinite: false,
        speed: 500,
        slidesToShow: 2,
        slidesToScroll: 1,
        // touchThreshold: 5,
        centerPadding: '0',
        touchMove: true,
        responsive: [
          {
            breakpoint: 767,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1
            }
          }
        ]
      },
      btnPrevVisible: false,
      btnNextVisible: true
    }
  },
  methods:{
    handleTest() {

    },
    showNext() {
      this.$refs.carousel.next();
    },
    showPrev() {
      this.$refs.carousel.prev();
    },
    beforeChange(oldSlideIndex, newSlideIndex) {
      // console.log(oldSlideIndex);
      // console.log(newSlideIndex);
      if (newSlideIndex > oldSlideIndex) {
        this.btnPrevVisible = true;
      }
      if (newSlideIndex < oldSlideIndex) {
        this.btnNextVisible = true;
      }
      if (newSlideIndex === oldSlideIndex) {
        this.btnNextVisible = false;
      }
    },
    afterChange(index) {
      // console.log(index);
      if (index === 0) {
        this.btnPrevVisible = false;
        this.btnNextVisible = true;
      }
    },
  },
  mounted() {
    this.items = arResultCarouselPictures;
    //console.log(this.items);
  }
}
</script>

<style lang="scss" scoped>
.slick-slider {
  width: 100%;

  ::v-deep .slick-track.slick-center {
    display: flex;
    align-items: center;
  }

  ::v-deep .slick-track > .slick-slide {
    padding: 15px;
  }

}
</style>
