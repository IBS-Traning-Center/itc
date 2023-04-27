<template>
<div class="detailModalMenu">
  <ul class="detailModalMenu__list">
    <li v-for="menuItem in menu" class="detailModalMenu__item">
      <a href="" class="detailModalMenu__link"></a>
    </li>
  </ul>
</div>
</template>
<script>
export default {
  data: () => ({
    menu: [...window.vueData.detailModalMenu]
  }),
}
</script>
<style lang="scss">
.detailModalMenu {
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  align-items: center;

  &__list {

  }
  &__item {

  }
  &__link {

  }
}
</style>