<template>
    <div class="tw-container tw-mx-auto tw-px-4 tw-py-8">
      <h1 class="tw-text-2xl tw-font-bold tw-mb-6">Nova Campanha</h1>
      
      <Form @submit.prevent="submitForm" class="tw-bg-white tw-rounded-lg tw-shadow-md tw-p-6">
        <Input
          label="Nome da Campanha"
          v-model="campaign.name"
          type="text"
          placeholder="Digite o nome da campanha..."
          class="tw-mb-4"
          :validation="validateName"
          message-error="Nome é obrigatório"
        />
        
        <div class="tw-mb-4">
          <label class="tw-block tw-mb-2 tw-font-medium">Descrição</label>
          <textarea
            v-model="campaign.description"
            placeholder="Digite a descrição da campanha..."
            rows="4"
            class="tw-w-full tw-p-2 tw-border tw-rounded"
          ></textarea>
          <p v-if="!validateDescription(campaign.description)" class="tw-text-red-500 tw-text-sm">
            Descrição é obrigatória
          </p>
        </div>
        
        <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-4 tw-mb-6">
          <Input
            label="Data de Início"
            v-model="campaign.startTime"
            type="datetime-local"
            class="tw-mb-4"
            :validation="validateStartTime"
            message-error="Data de início é obrigatória"
          />
          
          <Input
            label="Data de Término"
            v-model="campaign.endTime"
            type="datetime-local"
            class="tw-mb-4"
            :validation="validateEndTime"
            message-error="Data de término deve ser posterior à data de início"
          />
        </div>
        
        <div class="tw-flex tw-justify-between">
          <Button type="button" @click="goBack" class="tw-bg-gray-500">
            Cancelar
          </Button>
          
          <Button type="submit">
            Salvar Campanha
          </Button>
        </div>
      </Form>
    </div>
  </template>
  
  <script lang="ts">
  import { defineComponent } from 'vue';
  import { useRouter } from 'vue-router'; // Importar o useRouter
  import Campaign from '~/classes/Campaign';
  
  export default defineComponent({
    name: 'CreateCampaign',
    
    setup() {
      // Inicializar o router aqui
      const router = useRouter();
      
      return { router }; // Disponibilizar para o template e methods
    },
    
    data() {
      return {
        campaign: new Campaign()
      };
    },
    
    methods: {
      async submitForm() {
        if (this.isFormValid()) {
          try {
            await this.campaign.register(this.$axios);
            this.router.push('/campaigns'); // Use this.router em vez de this.$router
          } catch (error) {
            console.error('Erro ao criar campanha:', error);
          }
        }
      },
      
      isFormValid(): boolean {
        return (
          this.validateName(this.campaign.name) &&
          this.validateDescription(this.campaign.description) &&
          this.validateStartTime(this.campaign.startTime) &&
          this.validateEndTime(this.campaign.endTime)
        );
      },
      
      validateName(value: string): boolean {
        return !!value.trim();
      },
      
      validateDescription(value: string): boolean {
        return !!value.trim();
      },
      
      validateStartTime(value: string): boolean {
        return !!value;
      },
      
      validateEndTime(value: string): boolean {
        if (!value) return false;
        if (!this.campaign.startTime) return true;
        
        const start = new Date(this.campaign.startTime);
        const end = new Date(value);
        
        return end >= start;
      },
      
      goBack() {
        this.router.push('/campaigns'); // Use this.router em vez de this.$router
      }
    }
  });
  </script>