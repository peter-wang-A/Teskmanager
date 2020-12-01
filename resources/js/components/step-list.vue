<template>
  <div class="card mb-4">
    <div class="card-header">
      <slot></slot>
      <div class="card-body">
        <ul class="list-group">
          <li
            class="list-group-item"
            v-for="(item, index) in steps"
            :key="index"
          >
            <span v-on:dblclick="edit(item, index)" ref="stepName">
              {{ item.name }}</span
            >
            <input
              type="text"
              style="display: none"
              ref="stepInput"
              v-model="stepTitle"
            />
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
import { Hub } from "../event-bus";
export default {
  name: "",
  data() {
    return {
      stepTitle: "",
    };
  },
  props: {
    steps: Array,
    route: {
      type: String,
      requier: true,
    },
  },
  created() {
    Hub.$on("del", this.remove);
  },
  methods: {
    toggle(item) {
      axios
        .patch(this.route + "/" + item.id, {
          completion: !item.completion,
        })
        .then((res) => {
          if (res.data.code == 200) {
            window.location.reload();
          }
        });
    },
    async remove(step) {
      let res = await axios.delete(this.route + "/" + step.id);
      if (res.data.code === 200) {
        window.location.reload();
      }
    },
    edit(step, index) {
      this.$refs.stepName[index].style.display = "none";
      this.$refs.stepInput[index].style.display = "block";
      this.stepTitle = step.name;
    },
  },
};
</script>
<style scoped>
</style>
