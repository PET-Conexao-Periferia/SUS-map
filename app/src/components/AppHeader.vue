<template>
  <header>
    <button @click="navigateTo('/')">Inicio</button>
    <button @click="navigateTo('/auth/login')">Login</button>
    <button @click="navigateTo('/auth/register')">Register</button>
  </header>
</template>

<style scoped lang="scss">
header {
  position: fixed;
  top: 0;
  left: 4px;
  z-index: 10;
  display: flex;
  gap: 4px;
}
</style>