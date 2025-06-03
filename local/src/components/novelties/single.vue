<template>
  <div class="row" style="margin-bottom: 20px;">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="recommendations-teaser recommendations-teaser--fullwidth recommendations-teaser--ready">

        <div class="recommendations-teaser__headline headline headline--type_teaser">
          {{title}}
        </div>

        <single-slider
          :items="items"
          :settings="settings"
          :showColorNum="true"
          @favoriteRemove="removeFavoriteProduct()"
        ></single-slider>

      </div>
    </div>
  </div>
</template>

<script>
// optional style for arrows & dots
// import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'
import singleSlider from '@/components/slider/single-slider.vue';
export default {
  name: 'noveltiesSingleList',
  components: { singleSlider },
  data(){
    return {
      title: 'Новинкм',
      items: [],
      settings: {
        arrows: false,
        dots: true,
        focusOnSelect: false,
        infinite: false,
        speed: 300,
        slidesToShow: 6,
        slidesToScroll: 1,
        //touchThreshold: 1,
        centerPadding: '0',
        touchMove: true,
        responsive: [
          {
            breakpoint: 1100,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 4
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
    activeTab(tabCode) {
      this.tabActive = tabCode;
    }
  },
  mounted() {
    let componentType = this.$root.componentType;
    this.title = noveltiesData.title[componentType]; // similar, hits, views
    this.items = noveltiesData.items[componentType];
    //console.log(this.$root.componentType);
  },
  created() {

  }
}
</script>

<style lang="scss" scoped>

</style>
