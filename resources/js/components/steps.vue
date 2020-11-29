<template>
  <div class="row justify-content-center">
    <div class="card col-4">
      <div class="card-header">
        <span
          >待完成的步骤<span v-show="inProcess.length"
            >({{ inProcess.length }})</span
          >：<button
            v-on:click="dones(inProcess)"
            class="float-right btn btn-sm btn-success"
          >
            完成所有
          </button></span
        >

        <div class="card-body">
          <ul class="list-group">
            <li
              class="list-group-item"
              v-for="(item, index) in inProcess"
              :key="index"
            >
              <span v-on:dblclick="edit(item)"> {{ item.name }}</span>
              <span class="float-right">
                <i class="fa fa-check" v-on:click="toggle(item)"></i>
                <i class="fa fa-times" v-on:click="remove(item)"></i>
              </span>
            </li>
          </ul>
        </div>
      </div>
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
    </div>

    <div class="card col-4 ml-5">
      <div class="card-header">
        <span
          >已完成的步骤<span v-show="processed.length"
            >({{ processed.length }})</span
          >：<button
            v-on:click="removePro()"
            class="btn btn-sm btn-danger float-right"
          >
            删除所有
          </button></span
        >
      </div>
      <div class="card-body">
        <ul class="list-group">
          <li
            class="list-group-item"
            v-for="(item, index) in processed"
            :key="index"
          >
            <span v-on:dblclick="edit(item)"> {{ item.name }}</span>
            <span class="float-right">
              <i class="fa fa-check" v-on:click="toggle(item)"></i>
              <i class="fa fa-times" v-on:click="remove(item)"></i>
            </span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "",
  data() {
    return {
      steps: [],
      message: "",
      comple: false,
    };
  },
  props: ["route"],

  created() {
    this.getStepsData();
  },
  computed: {
    inProcess() {
      return this.steps.filter((step) => {
        return !step.completion;
      });
    },
    processed() {
      return this.steps.filter((step) => {
        return step.completion;
      });
    },
  },
  methods: {
    getStepsData() {
      axios
        .get(this.route)
        .then((res) => {
          this.steps = res.data.steps;
        })
        .catch((err) => {
          console.log(err.response);
        });
    },
    addStep() {
      this.steps.push({
        name: this.message,
        complection: this.comple,
      });
      this.message = "";
      this.comple = false;
    },
    toggle(item) {
      item.complection = !item.completion;
    },
    remove(step) {
      let i = this.steps.indexOf(step);
      this.steps.splice(i, 1);
    },
    edit(step) {
      this.message = step.name;
      this.comple = step.completion;
      this.remove(step);
      this.$refs.addInput.focus();
    },
    dones(inPro) {
      inPro.forEach((element) => {
        return (element.completion = true);
      });
    },
    removePro() {
      this.steps = this.inProcess;
    },
  },
};
</script>
<style scoped>
</style>
