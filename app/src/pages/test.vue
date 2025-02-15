<template>
  <input v-model="user.name" />
<div>
  {{ user }}
</div>
  <input type="checkbox" v-model="user.loading" />
</template>


<script lang="ts">
import User from "~/classes/User";

export default defineComponent({
  name: "test",

  data() {
    const user = new User({
      name: ''
    });

    return {
      user,
    }
  }
})
</script>

<style scoped>

</style>