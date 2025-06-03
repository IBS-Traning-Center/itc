<template>
  <div id="modalWindow" class="add-to-cart-modal modal show">
    <span class="modal__close-button" @click="close()"></span>
    <div id="modalWindowContent" class="modal__content">
      <div class="add-to-cart-modal__content">
        <div class="add-to-cart-modal__header">
          Товар добавлен в корзину
        </div>

        <div class="add-to-cart-modal__products">
          <div class="product-added-to-cart add-to-cart-modal__product">
            <picture class="product-added-to-cart__image-wrapper">
              <img :src="product.IMG_SRC" class="product-added-to-cart__image">
            </picture>
            <div class="product-added-to-cart__details">
              <div class="product-added-to-cart__info">
                <div class="product-added-to-cart__name">
                  {{product.NAME}}
                  <span class="product-added-to-cart__id">Артикул: 16500_3400</span>
                </div>
                <div class="product-added-to-cart__variations">
                  <span class="product-added-to-cart__variation product-added-to-cart__variation--color">
                    <span :style="{ backgroundImage: 'url('+product.COLOR_ICON_SRC+')' }"></span>
                    {{product.COLOR_NAME}}
                  </span>
                  <span class="product-added-to-cart__variation">
                    {{product.PROP_SIZE.NAME}}
                  </span>
                  <span class="product-added-to-cart__variation">
                    {{product.QUANTITY}}x
                  </span>
                </div>
              </div>
              <div class="product-added-to-cart__price">
                {{product.PRICE}} ₽
              </div>
            </div>
          </div>
        </div>
        <div class="add-to-cart-modal__infos">
          <!--          <div class="add-to-cart-modal__info notice">Add £ 13.00 for free shipping</div>-->
        </div>
        <div class="add-to-cart-modal__buttons">
          <span class="add-to-cart-modal__button button button--small" @click="close()">Продолжить покупки</span>
          <a href="/personal/cart/" class="add-to-cart-modal__button button button--small button--black">
            Перейти в корзину
          </a>
        </div>
        <div class="add-to-cart-modal__recommendations-wrapper">
          <div class="add-to-cart-modal__recommendations-headline">
            Популярное
          </div>

          <div class="recommendations-teaser add-to-cart-modal__recommendations-teaser recommendations-teaser--ready">
            <single-slider
              :items="popular"
              :settings="settings"
              :showColorNum="false"
              title="Популярное"
            ></single-slider>
          </div>
        </div>
      </div>

    </div>
  </div>
</template>

<script>
import SingleSlider from "@/components/slider/single-slider.vue";
export default {
  name: "basket-modal",
  components: {SingleSlider},
  props:[
    "product",
  ],
  data(){
    return {
      popular:[],
      settings: {
        arrows: false,
        dots: true,
        focusOnSelect: false,
        infinite: true,
        speed: 300,
        slidesToShow: 3,
        slidesToScroll: 3,
        //touchThreshold: 1,
        centerPadding: '10px',
        touchMove: true,
        responsive: [
          {
            breakpoint: 1100,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3
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
      }
    }
  },
  methods:{
    loadPopular(){
      BX.ajax.runComponentAction('beta:novelties.list', 'getPopularItems', {
        'mode': 'class'
      })
      .then(res => {
        debugger;
        this.popular = res.data;
      })
    },
    close(){
      // destroy the vue listeners, etc
      this.$destroy();
      // remove the element from the DOM
      this.$el.parentNode.removeChild(this.$el);
    },
  },
  mounted() {
    let htmlTag = document.getElementsByTagName('html');
    let pageOverlay = document.getElementById('pageOverlay');
    pageOverlay.classList.add("page-overlay--visible");
    document.body.style.overflow = 'hidden';
    document.body.style.width = '100%';
    document.body.style.height = '100%';
    htmlTag[0].style.overflow = 'hidden';
    htmlTag[0].style.width = '100%';
    htmlTag[0].style.height = '100%';
    this.loadPopular();
  },
  destroyed() {
    let htmlTag = document.getElementsByTagName('html');
    let pageOverlay = document.getElementById('pageOverlay');
    pageOverlay.classList.remove("page-overlay--visible");
    document.body.style.overflow = '';
    document.body.style.width = '';
    document.body.style.height = '';
    htmlTag[0].style.overflow = '';
    htmlTag[0].style.width = '';
    htmlTag[0].style.height = '';
  }
}
</script>

<style scoped>

</style>
