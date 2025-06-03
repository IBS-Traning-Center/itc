<template>
  <div class="content-tree-page">

    <div class="html-teaser accordions-menu">
      <h1>Таблица размеров</h1>
      <strong>
        <a :href="'#'+contentSizeTable.WOMEN" style="font-size: 18px;">Женщинам</a> |
        <a :href="'#'+contentSizeTable.MEN" style="font-size: 18px;">Мужчинам</a> |
        <a :href="'#'+contentSizeTable.KIDS" style="font-size: 18px;">Детям</a>
      </strong>
    </div>

    <div class="accordions-list">

      <div v-for="(item, index) in items">
        <div class="accordions-list__html-content html-teaser">
          <h2 v-bind:id="index">
          <span><br>
            {{contentSizeTableSections[index].NAME}}
          </span>
          </h2>
        </div>

        <div v-for="(section, index2) in item" class="accordions-list__accordion">
          <button class="accordions-list__accordion-button" @click="show(index, index2)"
                  v-bind:class="{'accordions-list__accordion-button--active': activeBlock===(index+''+index2)}">
            {{section.NAME}}
          </button>
          <div class="accordions-list__accordion-content html-teaser"
               v-bind:class="{'active': activeBlock===(index+''+index2)}" v-html="section.DETAIL_TEXT">
          </div>
        </div>

      </div>

    </div>
  </div>
</template>

<script>
export default {
  name: "accordion",
  props:[
    'items', 'contentSizeTableSections', 'contentSizeTable'
  ],
  data(){
    return {
      activeBlock: ''
    }
  },
  methods: {
    show(index, index2) {
      let curItem = index+''+index2;

      if (this.activeBlock !== curItem) {
        this.activeBlock = index+''+index2;
      } else {
       this.activeBlock = '';
      }
    }
  }
}
</script>

<style lang="scss" scoped>

</style>
