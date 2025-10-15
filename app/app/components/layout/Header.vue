<template>
  <header class="tw-px-4 tw-mb-4">
    <BackButton/>
    <slot />
  </header>
</template>

<style scoped lang="scss">
 header{
    background-color: white;
    color: #003087;
    font-size: 1.5rem;
    font-weight: bold;
    display: grid;
    grid-template-columns: repeat(3, auto );
    align-content: center;
    align-items: center;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
  }
</style>