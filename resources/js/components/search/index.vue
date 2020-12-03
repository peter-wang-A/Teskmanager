<template>
  <div class="instard-search">
    <form class="form-inline">
      <div class="input-group">
        <input
          type="text"
          class="form-control"
          placeholder="~实时任务检索~"
          aria-label="Username"
          aria-describedby="basic-addon1"
          :search="keywords"
          @focus="fetch"
          @blur="showUl"
          v-model="taskStr"
        />
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"
            ><i class="fa fa-btn fa-search"></i
          ></span>
        </div>
      </div>
    </form>
    <ul class="list-group search-group" v-show="show" id="search-group">
      <li
        class="list-group-item"
        v-for="(task, index) in fileterStr"
        :key="index"
      >
        <a :href="url(task.id)">{{ task.name }}</a>
      </li>
    </ul>
  </div>
</template>

  </div>
</template>

<script>
import { Loading } from "element-ui";
import "element-ui/lib/theme-chalk/index.css";
export default {
  name: "",
  data() {
    return {
      keywords: "",
      tasks: [],
      show: false,
      loading: true,
      taskStr: "",
    };
  },
  computed: {
    fileterStr() {
      let str = this.taskStr;
      return this.tasks.filter((task) => {
        if (task.name.indexOf(str) != -1) {
          return task;
        }
      });
    },
  },
  created() {},
  methods: {
    url(id) {
      return `/tasks/${id}/steps`;
    },
    showUl() {
      setTimeout(() => {
        this.show = false;
      }, 2000);
    },
    fetch() {
      if (this.tasks.length > 0) {
        this.show = true;
        return;
      }
      if (this.tasks.length <= 0) {
        let loadingInstance = Loading.service({
          text: "加载中",
          target: document.querySelector(".instard-search"),
          spinner: "el-icon-loading",
        });
        axios.get("/tasks/search").then((res) => {
          this.tasks = res.data.tasks;
          this.show = true;
          loadingInstance.close();
        });
      }
    },
  },
};
</script>
<style lang="scss" scoped>
.instard-search {
  height: 3rem;
  z-index: 1000;

  .search-group {
    height: 30em;
    overflow: auto;
  }
}
</style>
