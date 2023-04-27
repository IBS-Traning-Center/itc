<template>
  <div>

    <div class="row" style="margin-bottom: 20px;">
      <div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
        <div class="article-collection">

          <div class="article-collection__headline">
            {{componentTitle}}
          </div>

          <div class="article-collection__buttons">
            <button class="article-collection__tab-button fancy-underline"
                    :class="{ 'article-collection__tab-button--active fancy-underline--active': tabActive === 'women' }"
                    @click="activeTab('women')">
              Женщинам
            </button>
            <button class="article-collection__tab-button fancy-underline"
                    :class="{ 'article-collection__tab-button--active fancy-underline--active': tabActive === 'man' }"
                    @click="activeTab('man')">
              Мужчинам
            </button>
          </div>

          <div class="article-collection__tabs">

            <template v-if="tabActive === 'women'">
              <div class="article-collection__tab">
                <div>

                  <div class="recommendations-teaser" v-if="items.length > 0">
                    <div class="carousel recommendations-teaser__carousel">
                      <div class="carousel__wrapper" style="cursor: grab;">
                        <div class="carousel__container">

                          <VueSlickCarousel v-bind="settings" ref="carousel">

                            <template>

                              <div v-for="(item, index) in items" :key="index"
                                   class="carousel__slide carousel__slide--visible carousel__slide--active"
                                   style="width: 206px; margin-right: 20px;">
                                <div class="product-box product-box--has-more-colors">
                                  <div class="product-box__badges">
                                    <span class="product-box__badge product-box__badge--type_wishlist"
                                          v-bind:class="{'product-box__badge--type_wishlist-active': item.IS_FAVORITES}"
                                          @click="removeFavoriteProduct(index)"></span>
                                  </div>
                                  <div class="product-box__image-container">
                                    <a :href="item.URL" class="product-box__image-wrapper">
                                      <img :alt="item.NAME" :title="item.NAME"
                                           class="product-box__main-image" :src="item.PREVIEW_PICTURE_SRC">
                                    </a>
                                  </div>
                                  <div class="product-box__details">
                                    <div class="product-flags product-box__flags">
                                      <span class="product-flags__flag product-flags__flag--new">Новинка</span>
                                    </div>
                                    <a :href="item.URL" class="product-box__name">
                                      {{item.NAME}}
                                    </a>
                                    <a :href="item.URL" class="product-box__description">
                                      {{item.SUBTITLE_VALUE}}
                                    </a>
                                    <div class="product-box__price-wrapper">
                                      <span class="product-box__price">{{item.OFFERS[0].PRICE}} руб.</span>
                                    </div>
                                    <div class="product-box__colors product-box__colors--type_teaser">
                                      <span class="product-box__main-color-swatch">
                                        <img class="product-box__main-swatch-img"
                                             :src="item.COLOR_SELECT.FILE_SRC">
                                      </span>
                                      <span class="product-box__more-colors-info">{{item.COLORS_NUM}}</span>
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

                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </template>

            <template v-if="tabActive === 'man'">
              <div class="article-collection__tab" v-if="tabActive === 'man'">
                <div>

                  <div class="recommendations-teaser">
                    <div class="carousel recommendations-teaser__carousel">
                      <div class="carousel__wrapper" style="cursor: grab;">

                        <div class="carousel__container">

                          <VueSlickCarousel v-bind="settings" ref="carousel">

                            <template>

                              <div v-for="(item, index) in items" :key="index"
                                   class="carousel__slide carousel__slide--visible carousel__slide--active"
                                   style="width: 206px; margin-right: 20px;">
                                <div class="product-box product-box--has-more-colors">
                                  <div class="product-box__badges">
                                    <span class="product-box__badge product-box__badge--type_wishlist"
                                          v-bind:class="{'product-box__badge--type_wishlist-active': item.IS_FAVORITES}"
                                          @click="removeFavoriteProduct(index)"></span>
                                  </div>
                                  <div class="product-box__image-container">
                                    <a :href="item.URL" class="product-box__image-wrapper">
                                      <img :alt="item.NAME" :title="item.NAME"
                                           class="product-box__main-image" :src="item.PREVIEW_PICTURE_SRC">
                                    </a>
                                  </div>
                                  <div class="product-box__details">
                                    <div class="product-flags product-box__flags">
                                      <span class="product-flags__flag product-flags__flag--new">Новинка</span>
                                    </div>
                                    <a :href="item.URL" class="product-box__name">
                                      {{item.NAME}}
                                    </a>
                                    <a :href="item.URL" class="product-box__description">
                                      {{item.SUBTITLE_VALUE}}
                                    </a>
                                    <div class="product-box__price-wrapper">
                                      <span class="product-box__price">{{item.OFFERS[0].PRICE}} руб.</span>
                                    </div>
                                    <div class="product-box__colors product-box__colors--type_teaser">
                                      <span class="product-box__main-color-swatch">
                                        <img class="product-box__main-swatch-img"
                                             :src="item.COLOR_SELECT.FILE_SRC">
                                      </span>
                                      <span class="product-box__more-colors-info">{{item.COLORS_NUM}}</span>
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

                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </template>

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
  name: "noveltiesList",
  components: { VueSlickCarousel },
  data(){
    return {
      componentTitle: "Новинки",
      items: [],
      settings: {
        arrows: false,
        dots: false,
        focusOnSelect: false,
        infinite: true,
        speed: 500,
        slidesToShow: 4,
        slidesToScroll: 4,
        touchThreshold: 5,
        centerPadding: '10px',
        touchMove: true,
        responsive: [
          {
            breakpoint: 1100,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 4
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          }
        ]
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
    removeFavoriteProduct(index) {
      let product = this.items[index];
      let offer = product.OFFERS[0];
      let action = (product.IS_FAVORITES === true) ? 'remove' : 'add'

      debugger;

      var basketRemoveItemResponse = BX.ajax.runComponentAction('beta:header-right', 'favorite', {
        'mode': 'class',
        'data': {
          'offerId': offer.ID,
          'favoriteAction': action
        }
      });

      basketRemoveItemResponse.then(response => {
        if (response.status === 'success') {
          var data = response.data.data;

          if (data.action === 'remove') {
            this.items[index].IS_FAVORITES = false;
          } else {
            this.items[index].IS_FAVORITES = true;
          }
          //this.items.splice(index, 1);

          window.headerRight.$children[0].favoriteCounterAction(data.countAll);
        }
      });

    }
  },
  mounted() {
    // this.$refs.favoritesCounter.innerHTML = wishListStartCount;
    this.componentTitle = componentTitle;
    this.items = arResultNoveltiesList;
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
