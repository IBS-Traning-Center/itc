<template>
  <div>

    <div class="row" style="margin-bottom: 20px;">
      <div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
        <div class="article-collection">

          <div class="article-collection__headline">
            Новинки
          </div>

          <div class="article-collection__tabs">

            <div class="article-collection__tab">
              <div>

                <div class="recommendations-teaser">
                  <div class="carousel recommendations-teaser__carousel">
                    <div class="carousel__wrapper" style="cursor: grab;">
                      <div class="carousel__container">

                        <VueSlickCarousel v-bind="settings" ref="carousel">

                          <template v-for="n in [0,1,2,3,4,5,6]">
                            <div class="carousel__slide">
                              <div class="product-box product-box--has-more-colors">
                                <div class="product-box__badges">
                                  <span class="product-box__badge product-box__badge--type_wishlist product-box__badge--type_wishlist-active"></span>
                                </div>
                                <div class="product-box__image-container">
                                  <a href="/uk_en/p/ophelia-30-den-women-tights/41192_6535/" class="product-box__image-wrapper">
                                    <img alt="FALKE - Ophelia 30 DEN Women Tights - Leggings - Capri 1"
                                         title="Ophelia 30 DEN Women Tights" class="product-box__main-image"
                                         data-src="https://static.falke.com/plist/509726.jpg"
                                         src="https://static.falke.com/plist/509726.jpg">
                                  </a>
                                </div>
                                <div class="product-box__details">
                                  <div class="product-flags product-box__flags">
                                    <span class="product-flags__flag product-flags__flag--new">New</span>
                                  </div>
                                  <a href="/uk_en/p/ophelia-30-den-women-tights/41192_6535/" class="product-box__name">
                                    Ophelia 30 DEN Women Tights (women)
                                  </a>
                                  <a href="/uk_en/p/ophelia-30-den-women-tights/41192_6535/" class="product-box__description">
                                    with subtle all-over pattern
                                  </a>
                                  <div class="product-box__price-wrapper">
                                    <span class="product-box__price">£ 25.00</span>
                                  </div>
                                  <div class="product-box__colors product-box__colors--type_teaser">
                                  <span class="product-box__main-color-swatch">
                                    <img class="product-box__main-swatch-img" data-src="https://static.falke.com/pdthumb/508406.jpg"
                                         src="https://static.falke.com/pdthumb/508406.jpg"></span>
                                    <span class="product-box__more-colors-info">2</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </template>

                        </VueSlickCarousel>

                      </div>

                      <div class="carousel__button carousel__button--prev" tabindex="0"
                           role="button" aria-label="Previous slide" aria-disabled="false" @click="showPrev"></div>
                      <div class="carousel__button carousel__button--next" tabindex="0"
                           role="button" aria-label="Next slide" aria-disabled="false" @click="showNext"></div>

                      <div class="carousel__pagination carousel__pagination-bullet--clickable">
                          <span class="carousel__pagination-bullet carousel__pagination-bullet--current "
                                tabindex="0" role="button" aria-label="Go to slide 1" style="left: 23px;"></span>
                        <span class="carousel__pagination-bullet carousel__pagination-bullet--current-next"
                              tabindex="0" role="button" aria-label="Go to slide 2" style="left: 23px;"></span>
                      </div>

                    </div>
                  </div>
                </div>

              </div>
            </div>

          </div>

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
  name: "noveltiesSimilar",
  components: { VueSlickCarousel },
  data(){
    return {
      test: "Test2",
      settings: {
        "arrows": false,
        "dots": false,
        "focusOnSelect": true,
        "infinite": true,
        "speed": 500,
        "slidesToShow": 4,
        "slidesToScroll": 4,
        "touchThreshold": 5,
        "centerPadding": '10px',
      },
      tabActive: 'women'
    }
  },
  methods:{
    handleTest() {

    },
    activeTab(tabCode) {
      this.tabActive = tabCode;
    },
    showNext() {
      this.$refs.carousel.next();
    },
    showPrev() {
      this.$refs.carousel.prev();
    },
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
