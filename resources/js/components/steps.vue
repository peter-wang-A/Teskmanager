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

      <!-- 输入框组件 -->
      <stepInput :route="route" @add="push"></stepInput>
    </div>

    <div class="card col-4 ml-5">
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
import stepInput from "./step-input";

export default {
  name: "",
  data() {
    return {
      steps: [],
      comple: false,
    };
  },
  components: {
    stepInput,
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
      let res = await axios.delete(this.route + "/" + step.id);
      if (res.data.code === 200) {
        let i = this.steps.indexOf(step);
        this.steps.splice(i, 1);
      }
      return res;
    },
    edit(step) {
      this.message = step.name;
      this.comple = step.completion;
      this.remove(step);
      this.$refs.addInput.focus();
    },
    async dones(inPro) {
      console.log(this.route + "/doneAll");
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
