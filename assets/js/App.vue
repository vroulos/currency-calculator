<template>
  <div>
    <h2>welcome home</h2>
    <h1>Later you will see the calc apllication</h1>
    <button @click="counter++">click me {{ counter }}</button>
    <calculator v-bind:msg="msg" />
  </div>
</template>

<script>
// import calculator from "./components/calculator.vue";

export default {
  data: () => ({
    counter: 0,
    msg: "hello lalalalala ",
  })
};
</script>

<style lang="scss" scoped>
</style>
