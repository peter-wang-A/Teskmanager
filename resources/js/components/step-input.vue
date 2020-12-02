<template>
  <div class="card mt-2">
    <form :action="route" method="POST">
      <token></token>
      <div class="from-group">
        <div class="card-header">
          <label v-if="!message">添加什么内容呢？</label>
          <input
            type="text"
            v-model="message"
            name="name"
            id=""
            class="form-control my-3"
          />
          <span class="text-danger">{{ errors }}</span>
          <button
            class="btn btn-sm btn-success float-right"
            v-show="message"
            type="submit"
          >
            添加步骤
          </button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import Token from "../tool/token";
export default {
  name: "",
  data() {
    return {
      message: "",
      token: document.head.querySelector('meta[name="csrf-token"]').content,
    };
  },
  components: {
    Token,
  },
  props: {
    route: {
      type: String,
    },
    errors: String,
  },
  created() {},
};
</script>
<style scoped>
</style>
