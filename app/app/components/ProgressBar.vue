<template>
  <div class="progress-bar-container tw-mx-auto">
    <div class="step-container" v-for="(step, index) in steps" :key="index">
      <div 
        class="step-item" 
        :class="{ 
          'active': currentStep === index + 1,
          'completed': currentStep > index + 1
        }"
      >
        <span class="step-name">{{ step }}</span>
      </div>
      <div v-if="index < steps.length - 1" class="step-separator"></div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ProgressBar',
  props: {
    steps: {
      type: Array,
      required: true
    },
    currentStep: {
      type: Number,
      required: true
    }
  }
};
</script>

<style scoped>
.progress-bar-container {
   display: flex;
  justify-content: center; /* Centraliza os passos */
  align-items: center;
  gap: 1rem;
  width: fit-content; /* Faz a barra se ajustar ao tamanho do conteúdo */
  margin: 0 auto 1.5rem auto;
}

.step-container {
  display: flex;
  align-items: center;
  align-content: center;
  flex: 1;
  position: relative;
}

.step-item {
  position: relative;
  font-size: 0.9rem;
  color: #a0a0a0;
  transition: color 0.3s ease;
  padding-bottom: 5px; /* Espaço para o sublinhado */
}

.step-item.active {
  color: #007bff; /* Cor do passo ativo */
  font-weight: bold;
}

.step-item.active::after {
  content: '';
  position: absolute;
  left: 0;
  bottom: 0;
  width: 100%;
  height: 2px;
  background-color: #007bff; /* Sublinhado do passo ativo */
}

.step-item.completed {
  color: #4caf50; /* Cor dos passos concluídos */
}

.step-separator {
  flex: 1;
  height: 1px;
  background-color: #e0e0e0; /* Cor da linha inativa */
  margin: 0 10px;
}

.step-item.active + .step-separator,
.step-item.completed + .step-separator {
  background-color: #007bff; /* Cor da linha ativa */
}
</style>