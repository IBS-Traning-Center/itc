<template>
  <div id="layerModal" class="modal show layer-modal layout-layer">
    <span class="modal__close-button" @click="close()"></span>
    <div class="modal__content">

      <accordion :items="items"
                 :contentSizeTableSections="contentSizeTableSections"
                 :contentSizeTable="contentSizeTable"></accordion>

    </div>
  </div>
</template>

<script>
import accordion from "@/components/accordion/default.vue";
export default {
  name: "content-modal",
  components: {accordion},
  props: [],
  data(){
    return {
      items: [],
      contentSizeTableSections: {},
      contentSizeTable: {}
    }
  },
  methods:{
    loadData(){
      BX.ajax.runComponentAction('beta:size-table', 'getData', {
        'mode': 'class'
      })
        .then(res => {
          this.items = res.data.ITEMS;
          this.contentSizeTableSections = res.data.SECTIONS;
          this.contentSizeTable = {
            WOMEN: res.data.WOMEN,
            MEN: res.data.MEN,
            KIDS: res.data.KIDS
          }
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
    this.loadData();
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
