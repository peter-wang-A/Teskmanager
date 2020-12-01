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
        <button
          class="btn btn-sm btn-success float-right"
          v-show="message"
          @click="addStep"
        >
          添加步骤
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import { Hub } from "../event-bus";
export default {
  name: "",
  data() {
    return {
      message: "",
      comple: false,
    };
  },
  props: {
    route: {
      type: String,
    },
  },
  created() {
    this.editStep = "";
    Hub.$on("edit", this.edit);
  },
  methods: {
    addStep() {
      axios.post(this.route, { name: this.message }).then((res) => {
        window.location.reload();
        if (this.editStep) {
          Hub.$emit("del", this.editStep);
        }
      });
    },
    edit(step) {
      this.editStep = step;
      this.message = step.name;
      this.comple = step.completion;
      this.$refs.addInput.focus();
    },
  },
};
</script>
<style scoped>
</style>
