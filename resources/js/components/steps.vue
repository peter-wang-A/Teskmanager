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
      <step-list :steps="inProcess" :route="route"></step-list>

      <!-- 输入框组件 -->
      <step-input :route="route"></step-input>
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
      <step-list :steps="processed" :route="route"></step-list>
    </div>
  </div>
</template>

<script>
import stepInput from "./step-input";
import stepList from "./step-list";
import { Hub } from "../event-bus.js";

export default {
  name: "",
  components: {
    "step-input": stepInput,
    "step-list": stepList,
  },
  props: {
    route: String,
    inProcess: Array,
    processed: Array,
  },
  created() {},
  computed: {},
  methods: {
    async dones(inPro) {
      let doneRes = await axios.post(`${this.route}/doneAll`);
      if (doneRes.data.code === 200) {
        window.location.reload();
      }
    },
    async removePro() {
      let removeRes = await axios.delete(`${this.route}/clearAll`);
      if (removeRes.data.code === 200) {
        window.location.reload();
      }
    },
  },
};
</script>
<style scoped>
</style>
