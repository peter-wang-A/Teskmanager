<template>
  <div class="row justify-content-center">
    <div class="col-4 mr-3">
      <slot>
        <div class="card-header">
          <span
            >已完成的步骤<span v-show="inProcess.length"
              >({{ inProcess.length }})</span
            >：
            <button
              v-on:click="dones(inProcess)"
              v-if="inProcess.length > 0"
              class="btn btn-sm btn-success float-right"
            >
              完成所有
            </button>
          </span>
        </div>
      </slot>
      <step-list :steps="inProcess" :route="route" @remove="remove"></step-list>

      <!-- 输入框组件 -->
      <step-input :route="route" @add="push"></step-input>
    </div>

    <div class="col-4 mr-3">
      <slot>
        <div class="card-header">
          <span
            >已完成的步骤<span v-show="processed.length"
              >({{ processed.length }})</span
            >：
            <button
              v-on:click="removePro()"
              v-if="processed.length > 0"
              class="btn btn-sm btn-danger float-right"
            >
              删除所有
            </button>
          </span>
        </div>
      </slot>
      <step-list :steps="processed" :route="route" @remove="remove"></step-list>
    </div>
  </div>
</template>

<script>
import stepInput from "./step-input";
import stepList from "./step-list";
import { Hub } from "../event-bus.js";

export default {
  name: "",
  data() {
    return {
      steps: this.initial,
    };
  },
  components: {
    "step-input": stepInput,
    "step-list": stepList,
  },
  props: {
    route: String,
    initial: Array,
  },

  created() {
    // this.getStepsData();
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
    //   axios
    //     .get(this.route)
    //     .then((res) => {
    //       this.steps = res.data.steps;
    //     })
    //     .catch((err) => {
    //       console.log(err.response);
    //     });
    // },
    push(e) {
      this.steps.push(e);
    },
    toggle(item) {
      axios
        .patch(this.route + "/" + item.id, {
          completion: !item.completion,
        })
        .then((res) => {
          if (res.data.code == 200) {
            item.completion = !item.completion;
          }
        });
    },
    async remove(step) {
      let i = this.steps.indexOf(step);
      this.steps.splice(i, 1);
    },
    edit(step) {
      this.remove(step);
      Hub.$emit("edit", step);
    },
    async dones(inPro) {
      let doneRes = await axios.post(`${this.route}/doneAll`);
      if (doneRes.data.code === 200) {
        inPro.forEach((element) => {
          return (element.completion = true);
        });
      }
    },
    async removePro() {
      let removeRes = await axios.delete(`${this.route}/clearAll`);
      if (removeRes.data.code === 200) {
        alert(removeRes.data.msg);
        this.steps = this.inProcess;
      }
    },
  },
};
</script>
<style scoped>
</style>
