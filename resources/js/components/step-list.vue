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
import { Hub } from "../event-bus";
export default {
  name: "",
  data() {
    return {
      //
    };
  },
  props: {
    steps: Array,
    btnTitle: String,
    itemTitle: String,
    btnClass: String,
    route: {
      type: String,
      requier: true,
    },
  },
  methods: {
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
        this.$emit("remove", step);
        let i = this.steps.indexOf(step);
        this.steps.splice(i, 1);
      }
      return res;
    },
    edit(step) {
      this.remove(step);
      Hub.$emit("edit", step);
    },
  },
};
</script>
<style scoped>
</style>
