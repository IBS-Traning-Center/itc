<template>

  <div class="row" style="margin-bottom: 20px;">

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
      <div class="instagram-teaser">
        <div class="instagram-teaser__headline">
          #FALKE
        </div>

        <div class="hidden-xs instagram-teaser__wrapper swiper-container-initialized swiper-container-horizontal">
          <div v-if="items.length > 0" class="instagram-teaser__container">

            <VueCarouselInsta v-bind="settings" ref="carouselInsta">

              <a v-for="(item, index) in items" :href="item.permalink" target="_blank"
                 class="instagram-teaser__slide">

                <img v-if="item.media_type === 'IMAGE'" :src="item.media_url" :alt="item.desc" :title="item.desc"
                     class="instagram-teaser__image">

                <video v-if="item.media_type === 'VIDEO'" :alt="item.desc" :title="item.desc" class="instagram-teaser__image">
                  <source :src="item.media_url" type="video/mp4">
                </video>

              </a>

            </VueCarouselInsta>

          </div>

          <div class="instagram-teaser__button instagram-teaser__button--prev" tabindex="0" role="button" aria-label="Previous slide"
               @click="showPrev"></div>
          <div class="instagram-teaser__button instagram-teaser__button--next" tabindex="0" role="button" aria-label="Next slide"
               @click="showNext"></div>

          <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
        </div>

        <div class="instagram-teaser__footer">
          <div class="instagram-teaser__subline">Мы в социальных сетях</div>
          <div class="instagram-teaser__icons">
            <a href="https://www.instagram.com/falke_russia/" target="_blank" class="instagram-teaser__icon icofont-instagram"></a>
            <a href="https://www.facebook.com/falkerussia/" target="_blank" class="instagram-teaser__icon icofont-facebook"></a>
            <a href="https://vk.com/falkerussia/" target="_blank" class="instagram-teaser__icon icofont-vk"></a>
          </div>
        </div>

      </div>
    </div>

  </div>

</template>

<script>
import VueCarouselInsta from 'vue-slick-carousel'
import 'vue-slick-carousel/dist/vue-slick-carousel.css'

export default {
  name: "instagramTeaserList",
  components: { VueCarouselInsta },
  data(){
    return {
      items: [],
      settings: {
        "arrows": false,
        "dots": false,
        "focusOnSelect": true,
        "infinite": true,
        "speed": 500,
        "slidesToShow": 6,
        "slidesToScroll": 6,
        "touchThreshold": 5,
        "centerMode": true,
        "centerPadding": '10px',
      },
    }
  },
  methods:{
    handleTest() {

    },
    showNext() {
      this.$refs.carouselInsta.next();
    },
    showPrev() {
      this.$refs.carouselInsta.prev();
    },
  },
  mounted() {
    // this.$refs.favoritesCounter.innerHTML = wishListStartCount;
    this.items = arResultInstaItems;
    // console.log(arResultInstaItems);
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
    padding: 20px;
  }

}
</style>
