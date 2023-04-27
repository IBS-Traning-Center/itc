<template>
  <div class="carousel recommendations-teaser__carousel carousel--slidable carousel--ready"
       v-if="items.length > 0">
    <div class="carousel__wrapper swiper-container-initialized swiper-container-horizontal"
         style="cursor: grab;">
      <div class="carousel__container" style="transform: translate3d(0px, 0px, 0px);">

        <VueSlickCarousel v-bind="settings" @beforeChange="beforeChange" @afterChange="afterChange" ref="carousel">
          <div v-for="(item, index) in items" :key="index"
               class="carousel__slide carousel__slide--visible carousel__slide--active">
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
                  <span class="product-box__price">{{ (item.OFFERS !== null) ? item.OFFERS[0].PRICE : item.PRICE.PRICE_VIEW}} руб.</span>
                </div>
                <div v-if="showColorNum === true" class="product-box__colors product-box__colors--type_teaser">
                        <span class="product-box__main-color-swatch">
                          <img class="product-box__main-swatch-img"
                               :src="item.COLOR_SELECT.FILE_SRC"></span>
                  <span v-if="item.COLORS_NUM > 0" class="product-box__more-colors-info">{{item.COLORS_NUM}}</span>
                </div>
              </div>

            </div>
          </div>
        </VueSlickCarousel>

      </div>
    </div>

    <div class="carousel__button carousel__button--prev" tabindex="-1" v-if="btnPrevVisible === true"
         role="button" aria-label="Previous slide" aria-disabled="true" @click="showPrev"></div>
    <div class="carousel__button carousel__button--next" tabindex="0" role="button" v-if="btnNextVisible === true"
         aria-label="Next slide" aria-disabled="false" @click="showNext"></div>

  </div>
</template>

<script>
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
import VueSlickCarousel from 'vue-slick-carousel'
export default {
  name: "single-slider",
  components: { VueSlickCarousel },
  props: [
    'items', 'settings', 'showColorNum'
  ],
  data() {
    return {
      btnPrevVisible: false,
      btnNextVisible: true
    }
  },
  methods: {
    activeTab(tabCode) {
      this.tabActive = tabCode;
    },
    showNext() {
      this.$refs.carousel.next();
    },
    showPrev() {
      // console.log(this.$refs.carousel)
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
    removeFavoriteProduct(index) {
      let product = this.items[index];
      let offer = product.OFFERS[0];
      let action = (product.IS_FAVORITES === true) ? 'remove' : 'add'

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
  }
}
</script>

<style lang="scss" scoped>
.slick-slider {
  width: 100%;

::v-deep .slick-dots {
  width: 85% !important;
  padding: 20px 0;
  display: flex !important;
  justify-content: center;
  align-items: center;
  margin: 0 auto;

li {
  display: block;
  background: #e0e0e0;
  margin: 0 4px;
  height: 3px;
  width: 38px;

&.slick-active,
&:hover {
   background: #000;
 }

button {
  font-size: 0;
  line-height: 0;
  display: block;
  width: 100%;
  height: 7px;
  padding: 0;
  cursor: pointer;
  color: transparent;
  border: 0;
  outline: none;
  background: transparent;
}
}
}

::v-deep .slick-track.slick-center {
  display: flex;
  align-items: center;
}

::v-deep .slick-track > .slick-slide {
  padding: 10px;
}

}
</style>
