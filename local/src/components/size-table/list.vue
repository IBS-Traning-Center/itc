<template>
  <accordion :items="items"
             :contentSizeTableSections="contentSizeTableSections"
             :contentSizeTable="contentSizeTable"></accordion>
</template>

<script>
import accordion from "@/components/accordion/default.vue";
export default {
  name: "size-table",
  components: {accordion},
  data(){
    return {
      items: [],
      contentSizeTableSections: {},
      contentSizeTable: {}
    }
  },
  methods:{
    handleTest() {

    }
  },
  mounted() {
    // this.$refs.favoritesCounter.innerHTML = wishListStartCount;
    // this.componentTitle = componentTitle;
    this.items = contentSizeItems;
    this.contentSizeTableSections = contentSizeTableSections;
    this.contentSizeTable = contentSizeTable;
    // console.log(contentSizeItems);
  }
}
</script>

<style lang="scss" scoped>

</style>
