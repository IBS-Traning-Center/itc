<template>

  <div>

    <template v-if="items.length > 0">

      <div class="wishlist-page">
        <div class="wishlist-page__header">
          <div class="wishlist-page__headline">
            Избранное ({{items.length}})
          </div>
          <button class="wishlist-page__share-button button button--small">
            Поделиться
          </button>
        </div>

        <div class="wishlist-page__products">

          <div v-for="(item, index) in items" :key="index" class="wishlist-page__product-wrapper">
            <div class="wishlist-product-box wishlist-page__product">
              <div class="wishlist-product-box__image-wrapper">
                <a :href="item.PRODUCT.URL">
                  <img :alt="item.NAME" :title="item.NAME" class="wishlist-product-box__image"
                       :src="item.PRODUCT.PREVIEW_PICTURE_SRC"></a>
                <button class="wishlist-product-box__remove-button" @click="removeFavoriteProduct(index)"></button>
              </div>
              <a :href="item.PRODUCT.URL"
                 class="wishlist-product-box__description">
                <div v-if="item.DISCOUNT_PRICE > 0" class="product-flags wishlist-product-box__flags">
                  <span class="product-flags__flag product-flags__flag--sale">Sale</span>
                </div>
                <div class="wishlist-product-box__name">
                  {{item.NAME}}
                </div>
                <div class="wishlist-product-box__marketing-title">
                  {{item.PRODUCT.SUBTITLE_VALUE}}
                </div>
              </a>
              <div class="wishlist-product-box__details">

                <template v-if="item.DISCOUNT_PRICE > 0">
                  <div class="wishlist-product-box__price wishlist-product-box__price--old">
                    {{item.PRICE_VIEW}}
                  </div>
                  <div class="wishlist-product-box__price wishlist-product-box__price--sale">
                    {{item.DISCOUNT_PRICE_VIEW}} руб.
                  </div>
                </template>

                <template v-if="item.DISCOUNT_PRICE == 0">
                  <div class="wishlist-product-box__price">
                    {{item.PRICE_VIEW}} руб.
                  </div>
                </template>

                <div class="wishlist-product-box__variation">
                  {{item.PRODUCT.COLOR.UF_NAME}}
                  <span class="wishlist-product-box__variation-image"
                        v-bind:style="{ backgroundImage: 'url(' + item.PRODUCT.COLOR.FILE_SRC + ')' }"></span>
                </div>
              </div>
              <div class="wishlist-product-box__form">
                <div class="base-select wishlist-product-box__size">

                  <div tabindex="0" class="base-select__container">

                    <div class="base-select__content">
                      <span class="base-select__value">{{item.OFFER_SELECTED.SIZE.UF_NAME}}</span>
                      <span class="base-select__icons">
                        <div class="icon base-select__arrow icon--arrowDownLight"></div>
                      </span>
                    </div>

                    <div class="base-select__options">
                      <div v-for="(offer, offerIndex) in item.OFFERS" :key="offerIndex" class="base-select__option"
                           @click="changeOffer(index, offerIndex)"
                           v-bind:class="{ 'base-select__option--active' : offer.SIZE.UF_XML_ID === item.OFFER_SELECTED.SIZES_SHOES_VALUE }">
                        {{offer.SIZE.UF_NAME}}
                      </div>
                    </div>

                    <select autocomplete="" class="base-select__select-native">
                      <option v-for="offer in item.OFFERS" value="44802_617901">
                        {{offer.SIZE.UF_NAME}}
                      </option>
                    </select>

                  </div>
                </div>
                <button class="wishlist-product-box__add-button button button--black-reversed button--input-like"
                        @click="addProductToBasket()">
                  Добавить в корзину
                </button>
              </div>
            </div>
          </div>

        </div>

        <div class="wishlist-page__buttons">
          <a href="/catalog/" class="wishlist-page__button button">
            Продолжить покупки
          </a>
          <button @click="addAllProductsToBasket()" class="wishlist-page__button wishlist-page__button--cta button button--black">
            Все товары в корзину
          </button>
        </div>
      </div>

    </template>

    <template v-if="items.length === 0">

      <div class="wishlist-page wishlist-page--empty">
        <div class="wishlist-page__headline">
          Избранное
        </div>
        <div class="wishlist-page__description">
          Ваш список пуст.
        </div>
        <a href="/catalog/" class="wishlist-page__back-button button button--black">
          Продолжить покупки
        </a>
      </div>

    </template>

  </div>

</template>

<script>
import $ from "jquery";

export default {
  name: 'wishList',
  data(){
    return {
      items: [],
      offerSelect: {}
    }
  },
  methods:{
    handleTest() {

    },
    changeOffer(productIndex, offerKey) {
      this.items[productIndex].OFFER_SELECTED = this.items[productIndex].OFFERS[offerKey]
    },
    addProductToBasket() {
      alert('Добавление товара в корзину')
    },
    addAllProductsToBasket() {
      alert('Добавление всех товаров в корзину')
    },
    removeFavoriteProduct(index) {
      let item = this.items[index].OFFER_SELECTED;

      var basketRemoveItemResponse = BX.ajax.runComponentAction('beta:header-right', 'favorite', {
        'mode': 'class',
        'data': {
          'offerId': item.ID,
          'favoriteAction': 'remove'
        }
      });

      basketRemoveItemResponse.then(response => {
        if (response.status === 'success') {
          var data = response.data.data;

          this.items.splice(index, 1);

          window.headerRight.$children[0].favoriteCounterAction(data.countAll);
        }
      });

    }
  },
  mounted() {
    // this.$refs.favoritesCounter.innerHTML = wishListStartCount;
    this.items = arResult;
    console.log(arResult);
  }
}
</script>

<style lang="scss" scoped>

</style>
