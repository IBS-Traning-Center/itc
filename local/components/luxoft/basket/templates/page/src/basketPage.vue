<template>
  <div class="basket-page">
    <div class="cart-items">
      <table class="cart-items" cellspacing="0">
        <thead>
          <tr>
            <td class="cart-item-name">{{lang.columnName}}</td>
            <td class="cart-item-price">{{lang.columnPrice}}</td>
            <td class="cart-item-discount">{{lang.columnDiscount}}</td>
            <td class="cart-item-quantity">{{lang.columnQuantity}}</td>
            <td class="cart-item-actions">{{lang.columnAction}}</td>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in items">
            <td class="cart-item-name">
              <component :is="item.url ? 'a' : 'span'" :href="item.url">
                <span v-if="item.code">{{item.code}}</span> <span v-if="item.name">{{item.name}}</span>
              </component>
              <br><span v-if="item.city">{{item.city}}</span> <b v-if="item.date">{{item.date}}</b> <span v-if="item.time">{{item.time}}</span>
            </td>
            <td class="cart-item-price">{{item.price}}</td>
            <td class="cart-item-discount">{{item.discount}}</td>
            <td class="cart-item-quantity">
              <input maxlength="18" type="text" :value="item.quantity" @change="basketItemChange(item, $event)" size="3">
            </td>
            <td class="cart-item-actions">
              <span class="cart-delete-item">
                <i @click="basketItemRemove(item)" class="fa fa-times" aria-hidden="true"></i>
              </span>
            </td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td class="cart-item-name">
              <span v-if="total.discount">{{lang.discount}} {{total.discount}}</span>
              <p><b>{{lang.total}}:</b></p>
            </td>
            <td class="cart-item-price">{{total.cost}}</td>
            <td class="cart-item-discount"></td>
            <td class="cart-item-quantity"></td>
            <td class="cart-item-actions"></td>
          </tr>
        </tfoot>
      </table>
      <div class="cart-ordering">
        <div class="cart-buttons">
          <a href="/personal/order/make/" class="button_enabled main-button">{{lang.order}}</a>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
export default {
  data: () => ({
    ...window.vueData['basketPage']
  }),
  methods: {
    basketItemRemove(item) {
      let _this = this;
      axios
          .post('?action=removeItem', {item: item})
          .then(response => {
            if(response.data.success) {
              for (const keyProperty in response.data.result) {
                _this.$set(_this, keyProperty, response.data.result[keyProperty])
              }
            } else {
              _this.$set(_this, 'errorMessage', response.data.errors)
            }
          })
          .catch(err => {
            console.log(err);
            _this.$set(_this, 'errorMessage', response.data.errors)
          })
    },
    basketItemChange(item, $event) {
      debugger
      let _this = this;
      item['quantity'] = parseInt($event.target.value)
      axios
          .post('?action=updateItem', {item: item})
          .then(response => {
            if(response.data.success) {
              for (const keyProperty in response.data.result) {
                _this.$set(_this, keyProperty, response.data.result[keyProperty])
              }
            } else {
              _this.$set(_this, 'errorMessage', response.data.errors)
            }
          })
          .catch(err => {
            console.log(err);
            _this.$set(_this, 'errorMessage', response.data.errors)
          })
    }
  }
}
</script>
<style lang="scss">
.cart-buttons {
  .main-button {
    display: inline-block;
    &:hover,
    &:focus,
    &:active {
      color: #fff
    }
  }
}
</style>