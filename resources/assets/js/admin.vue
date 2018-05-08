<template>
  <div >
      <sidebar-component></sidebar-component>
      <router-view
        class="view"
        keep-alive
        transition
        transition-mode="out-in">
      </router-view>
  </div>
</template>
<script>
export default {

}
</script>