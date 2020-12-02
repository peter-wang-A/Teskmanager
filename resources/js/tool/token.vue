<template>
  <input name="_token" type="hidden" :value="token" />
</template>

<script>
export default {
  name: "",
  data() {
    return {
      token: document.head.querySelector('meta[name="csrf-token"]').content,
    };
  },
};
</script>
<style scoped>
</style>
