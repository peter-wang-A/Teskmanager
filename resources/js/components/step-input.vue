<template>
  <div class="card mt-2">
    <div class="from-group">
      <div class="card-header">
        <label v-if="!message">添加什么内容呢？</label>
        <input
          type="text"
          ref="addInput"
          v-model="message"
          @keyup.enter="addStep"
          name=""
          id=""
          class="form-control my-3"
        />
        <button class="btn btn-sm btn-success float-right" v-show="message">
          添加步骤
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "",
  data() {
    return {
      message: "",
    };
  },
  props: ["route"],
  methods: {
    addStep() {
      axios.post(this.route, { name: this.message }).then((res) => {
          this.$emit('add',res.data.step)
        // this.steps.push(res.data.step);
        this.message = "";
      });
    },
  },
};
</script>
<style scoped>
</style>
