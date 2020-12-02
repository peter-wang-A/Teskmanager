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
              @keyup.enter="updateStep(item)"
              v-model="editedName"
              class="form-control"
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
      editedName: "",
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
        .patch(this.route + "/" + item.id + "/toggle", {
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
      this.editedName = step.name;
      this.$refs.stepInput[index].focus();
    },
    async updateStep(step) {
      let res = await axios.patch(this.route + "/" + step.id, {
        stepName: this.editedName,
      }).catch(error=>{
          alert('wrong')
      });

      if (res.data.code === 200) {
        window.location.reload();
        alert(res.data.msg);
      }
    },
  },
};
</script>
<style scoped>
</style>
