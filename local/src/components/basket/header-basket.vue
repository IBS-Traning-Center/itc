<template>
  <div v-if="items.length <= 0" class="minicart__headline minicart__headline--empty">
    Ваша корзина пуста
  </div>
  <div class="minicart__content" v-else>
    <div class="minicart__headline">
      <span>В корзине {{items.length}} товар(а).</span>
      <span class="minicart__subheadline">Последние добавленные товары:</span>
    </div>

    <ul class="minicart__positions">

      <li v-for="(item, index) in items" :key="index" v-if="index <= 1"
          class="minicart__position">
        <a href="/uk_en/p/ophelia-30-den-women-tights/41192_6535/" class="minicart__position-image-link">
          <img :src="item.IMG_SRC" title="Ophelia 30 DEN Women Tights"
               class="minicart__position-image">
        </a>
        <div class="minicart__position-details">
          <span class="minicart__position-name">{{item.NAME}}</span>
          <span class="minicart__position-variations">
                  <span class="minicart__position-variation minicart__position-variation--color">
                    <span class="minicart__position-color-swatch"
                          :style="{ backgroundImage: 'url('+item.COLOR_ICON_SRC+')' }">
                    </span>
                  </span>
                  <span class="minicart__position-variation">{{item.PROP_SIZE.NAME}}</span>
                  <span class="minicart__position-variation">{{item.QUANTITY}}</span>
                </span>
          <span class="minicart__position-total">{{item.PRICE}} руб.</span>
        </div>
        <span class="minicart__position-remove" @click="basketRemoveItem(index)"></span>
      </li>

    </ul>

    <div class="minicart__summary">
            <span class="minicart__summary-row">
              <span>Товаров на сумму</span>
              <span>{{cartSubtotal}} руб.</span>
            </span>
      <span class="minicart__summary-row">
              <span>Доставка и упаковка</span>
              <span>{{cartPostage}} руб.</span>
            </span>
      <span class="minicart__summary-row minicart__summary-row--total">
              <span>Всего</span>
              <span>{{cartTotal}} руб.</span>
            </span>
    </div>

    <a href="/personal/cart/" class="minicart__button button button--black">Перейти в корзину</a>

  </div>
</template>

<script>
export default {
  name: "header-basket.vue",
  props:{
    items:{
      type: Array
    }
  },
  data(){
    return {
      cartPostage: 0
    }
  },
  methods: {
    basketRemoveItem(index) {
      window.headerRight.$children[0].itemRemoveFromCart(index)
    }
  },
  computed:{
    cartSubtotal(){
      let priceAll = 0;
      this.items.forEach((item, i, arr) => {
        priceAll += parseFloat(item.PRICE);
      });
      return priceAll;
    },
    cartTotal(){
      return this.cartSubtotal + this.cartPostage;
    }
  }
}
</script>

<style scoped>

</style>
