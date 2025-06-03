<template>

  <div class="header__user-shortcuts-wrapper">
    <div class="user-shortcuts header__user-shortcuts">

      <a href="#" class="user-shortcuts__link-shortcut user-shortcuts__link-shortcut--search" @click="showSearchForm = true">
        Поиск
      </a>

      <a href="/login/" class="hidden-xs user-shortcuts__link-shortcut user-shortcuts__link-shortcut--login"
         @mouseover="viewWindow('login')">
        {{(user !== null) ? 'Личный кабинет' : 'Войти'}}
      </a>

      <a href="/wishlist/" class="user-shortcuts__link-shortcut user-shortcuts__link-shortcut--wishlist">
        Избранное <i>{{favoriteCounter}}</i>
      </a>

      <a href="/personal/cart/" class="user-shortcuts__link-shortcut user-shortcuts__link-shortcut--cart"
         @mouseover="viewWindow('cart')">
        Корзина <i>{{cartItems.length}}</i>
      </a>

      <!--      <a href="#" class="hidden-xs country-lang-indicator user-shortcuts__link-shortcut user-shortcuts__link-shortcut&#45;&#45;language">-->
      <!--        <i class="country-lang-indicator__flag | flag-icon flag-icon-gb"></i>-->
      <!--        <span>EN</span>-->
      <!--      </a>-->

    </div>

    <div v-if="active_window === 'login'" class="account-flyout header__account-flyout"
         @mouseover="viewWindow('login')" @mouseleave="viewWindow(null)">

      <template v-if="user !== null">
        <div class="account-flyout__headline">
          Добро пожаловать, {{user.NAME}} {{user.LAST_NAME}}
        </div>
        <div class="account-flyout__links">
          <a href="/personal/orders/" class="account-flyout__link">
            Текущие заказы
          </a>
          <a href="/personal/orders/?filter_history=Y" class="account-flyout__link">
            История заказов
          </a>
          <a href="/personal/private/" class="account-flyout__link">
            Личные данные
          </a>
          <a href="/information/returns/" class="account-flyout__link">
            Информация по возврату
          </a>
          <a href="/contacts/" class="account-flyout__link">
            Помощь и контакты
          </a>
        </div>
        <a :href="'?logout=yes&sessid=' + sessid" class="account-flyout__button account-flyout__button--log-out button button--black">
          Выход
        </a>
      </template>

      <template v-if="user === null">
        <div class="account-flyout__headline account-flyout__headline--center">Вход или регистрация</div>
        <div class="account-flyout__info-text">В личном кабинете вы сможете быстрее оформлять покупки, видеть статус
          заказа, управлять адресами доставки и многое другое</div>
        <a href="/login/?register=yes" class="account-flyout__button account-flyout__button--sign-in button button--black">
          Зарегистрироваться
        </a>
        <a href="/login/" class="account-flyout__button account-flyout__button--log-in button">
          Войти
        </a>
      </template>

    </div>

    <div v-if="active_window === 'cart'" class="minicart header__minicart"
         @mouseover="viewWindow('cart')" @mouseleave="viewWindow(null)">
      <header-basket :items="cartItems"></header-basket>

    </div>

    <div v-if="showSearchForm === true" class="header__search">
      <form class="search-autosuggest" action="/search/">
        <span class="search-autosuggest__close" @click="showSearchForm = false"></span>
        <input type="search" placeholder="Введите поисковый запрос" name="q" autocomplete="off"
               class="search-autosuggest__input">
        <input type="hidden" name="ms" value="true">
      </form>
    </div>
  </div>

</template>

<script>
import headerBasket from '@/components/basket/header-basket.vue';
import basketModal from '@/components/basket/basket-modal.vue';
import contentModal from '@/components/modals/content-modal.vue';
import Vue from "vue";
export default {
  name: "headerRight",
  components:{headerBasket, basketModal, contentModal},
  data(){
    return {
      modalData:{},
      lastAddedProduct:{},
      test: "Test2",
      cartItems: [],
      showModal: false,
      addedProduct:{},
      user: null,
      active_window: null,
      activeSearchWindow: false,
      showSearchForm: false,
      favoriteCounter: 0,
      sessid: BX.message('bitrix_sessid')
    }
  },
  methods:{
    viewWindow(type) {
      this.active_window = type;
    },

    viewSearchWindows() {
      this.activeSearchWindow = true
    },

    favoriteCounterAction(counter) {
      this.favoriteCounter = counter;
    },

    itemAddToCart(newItem) {
      debugger;
      this.loadUserBasketData().then(res => {
        debugger;
        this.cartItems = res.data;
        Vue.set(this, "lastAddedProduct", res.data.find(e => {
          debugger;
          return newItem.ID === e.ID;
        }))
        this.createBasketModal();
      });
    },

    loadUserBasketData(){
      return BX.ajax.runAction('beta:falke.basket.getUserBasket');
    },

    itemRemoveFromCart(index) {
      debugger;
      let currentItem = this.cartItems[index];
      this.cartItems.splice(index, 1);

      var basketItemResponse = BX.ajax.runComponentAction('beta:header-right', 'basketItemRemove', {
        'mode': 'class',
        'data': {
          'offerId': currentItem.ID,
          'basketId': currentItem.BASKET_ID
        }
      });

    },

    createBasketModal(){
      //create dom el, and append in body
      //debugger;
      var elem = document.createElement('div');
      elem.setAttribute('id', "modal_place_holder");
      document.body.appendChild(elem);
      // create modal instance
      const modal = Vue.extend(basketModal);
      const modalComponent = new modal({
        parent: this,
        propsData: {
          product: this.lastAddedProduct
        }
      }).$mount('#modal_place_holder');
    },

    createContentModal(){
      //create dom el, and append in body
      //debugger;
      var elem = document.createElement('div');
      elem.setAttribute('id', "modal_place_holder");
      document.body.appendChild(elem);
      // create modal instance
      const modal = Vue.extend(contentModal);
      const modalComponent = new modal({
        parent: this,
        propsData:{}
      }).$mount('#modal_place_holder');
    }
  },
  mounted() {
    // this.$refs.favoritesCounter.innerHTML = wishListStartCount;
    this.favoriteCounter = wishListStartCount;
    this.loadUserBasketData().then(res => {
      this.cartItems = res.data;
    });
    this.user = arUser;
  }
}
</script>

<style scoped>

</style>
