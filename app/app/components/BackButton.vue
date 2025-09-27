<template>
  <div>
    <button
        variant="navigation"
        @click="back()"
    >
      <img src="../assets/img/arrow_left.svg" width="30" height="30">
    </button>
  </div>
</template>

<script lang="ts">
export default {
  name: "BackButton",
  methods:{
    back(){
      const router = useRouter()
      if(window.history.length > 1){
        router.back()
      }
      else{
        router.push('/')
      }
    }
  }
}
</script>

<style scoped lang="scss">
button{
  display: flex;
  margin: 1em;
  flex-direction: row;
  align-items: center;
  gap: 0.3em;
  border: none;
  font-size: 1.2em;
  background-color: #CCD2FF;
  border-radius: 24px;
  color: #003087;
  padding: 0.5em;
}
</style>