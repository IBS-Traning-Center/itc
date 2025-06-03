<template>
  <div>

    <div class="row" style="margin-bottom: 20px;">
      <div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
        <div class="image-slider-teaser">
          <div class="image-slider-teaser__headline">
            {{componentTitle}}
          </div>

          <div class="image-slider-teaser__wrapper" v-if="items.length > 0">
            <div class="image-slider-teaser__slider swiper-container-initialized swiper-container-horizontal">

              <div class="image-slider-teaser__container" style="transform: translate3d(0px, 0px, 0px);">

                <VueSlickCarousel v-bind="settings" ref="carousel" @afterChange="currentIndex = $event">

                  <a v-for="(item, index) in items" :key="index"
                     :href="item.LINK_VALUE" target="_self" class="image-slider-teaser__slide swiper-slide-visible">
                    <img class="image-slider-teaser__image swiper-lazy swiper-lazy-loaded"
                         :alt="item.NAME" :title="item.NAME" :src="item.PREVIEW_PICTURE_SRC">
                  </a>

                </VueSlickCarousel>

              </div>

              <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>

            </div>
            <div class="image-slider-teaser__button image-slider-teaser__button--prev" tabindex="0"
               role="button" aria-label="Previous slide" @click="showPrev"></div>
            <div class="image-slider-teaser__button image-slider-teaser__button--next" tabindex="0"
               role="button" aria-label="Next slide" @click="showNext"></div>
          </div>

          <template v-for="(item, index) in items">
            <div class="image-slider-teaser__tab-content" v-if="index === currentIndex">
              <a :href="item.LINK_VALUE" target="_self" class="image-slider-teaser__tab-headline">
                {{item.NAME}}
              </a>
              <p class="image-slider-teaser__tab-description">
                {{item.PREVIEW_TEXT}}
              </p>
            </div>
          </template>

        </div>
      </div>
    </div>

  </div>
</template>

<script>
import VueSlickCarousel from 'vue-slick-carousel'
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
// optional style for arrows & dots
// import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'

export default {
  name: "itemsSingleList",
  components: { VueSlickCarousel },
  data(){
    return {
      componentTitle: "Новинки",
      items: [],
      currentIndex: 0,
      settings: {
        "centerMode": true,
        "centerPadding": "132px",
        "focusOnSelect": false,
        "infinite": true,
        "slidesToShow": 3,
        "speed": 500,
        "arrows": false,
        "dots": false,
      }
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
  },
  mounted() {
    // this.$refs.favoritesCounter.innerHTML = wishListStartCount;
    this.componentTitle = componentTitle;
    this.items = arResult;
    console.log(arResult);
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

  //::v-deep .slick-track > .slick-slide {
  //  padding: 0;
  //}

  ::v-deep .slick-track .slick-current {
    z-index: 99;

    img {
      transform: scale(1.2);
    }
  }

}
</style>
