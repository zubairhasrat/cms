<template>
   <div>
     <!-- <allposts-component></allposts-component> -->
       <!-- <router-view></router-view> -->
    <!-- <posts-component></posts-component> -->
    <header-component></header-component>
     <router-view></router-view> 
  </div>
</template>
<script>
export default {
  ready(){
      console.log('in ready')
  }
}
</script>
