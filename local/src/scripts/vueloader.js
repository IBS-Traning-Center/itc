import Vue from "vue";

export class BxVueLoader {
  render = function (ref, vueComponent , renderInsideTo) {
    let appContainer = document.createElement('div');
    appContainer.setAttribute("id", ref);
    renderInsideTo.appendChild(appContainer);
    //render vue
    new Vue({
      render: (h) => h(vueComponent),
    }).$mount('#' + ref);
  }
}

