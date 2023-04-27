<template>
  <div class="loader__wrap">
    <div class="loader">
      <span class="loader__circle"></span>
      <span class="loader__circle"></span>
      <span class="loader__circle"></span>
      <span class="loader__circle"></span>
    </div>
  </div>
</template>
<style lang="scss" scoped>
.loader__wrap {
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  background: rgba(255, 255, 255, 0.8);
  z-index: 99;
}
.loader {
  height: 15px;
  width: 105px;
  display: flex;
  position: relative;
  &__circle {
    width: 15px;
    height: 15px;
    border-radius: 50%;
    background-color: #0F427D;
    animation: move 500ms linear 0ms infinite;
    margin-right: 30px;

    &:first-child{
      position: absolute;
      top:0;
      left:0;
      animation: grow 500ms linear 0ms infinite;
    }

    &:last-child{
      position: absolute;
      top: 0;
      right: 0;
      margin-right: 0;
      animation: grow 500ms linear 0s infinite reverse;
    }
  }
}
@keyframes grow {
  from {transform: scale(0,0); opacity: 0;}
  to {transform: scale(1,1); opacity: 1;}
}
@keyframes move {
  from {transform: translateX(0px)}
  to {transform: translateX(45px)}
}
</style>
