<template>
  <form class="form-inline">
    <div class="input-group">
      <input
        type="text"
        class="form-control"
        placeholder="~实时任务检索~"
        aria-label="Username"
        aria-describedby="basic-addon1"
        :search="keywords"
        @focus="fetch"
      />
      <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1"
          ><i class="fa fa-btn fa-search" ></i
        ></span>
      </div>
    </div>
  </form>
</template>

<script>
export default {
  name: "",
  data() {
    return {
      keywords: "",
    };
  },
  methods: {
    fetch() {
      axios.get("/tasks/search").then((res) => {
        console.log(res);
      });
    },
  },
};
</script>
<style scoped>
</style>
