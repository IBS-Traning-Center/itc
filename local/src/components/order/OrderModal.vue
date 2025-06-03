<template>
  <div class="order">
    <div class="order__modal">{{ id }}</div>
  </div>
</template>
<script>
import store from '@/store/'
export default {
  data: () => ({

  }),
  computed: {
    id() {
      return store.state.order.id
    }
  }
}
</script>