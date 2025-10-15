<template>
  <Form @submit.prevent="saveCampaign">
    <Input
      label="Titulo da campanha:"
      v-model="form.name"
      type="text"
      placeholder="Digite o nome da campanha..."
      class="tw-mx-6 tw-mb-4"
      :validation="validateRequired"
      message-error="Nome é obrigatório"
    />

    <div class= "tw-ml-2 tw-mr-6 tw-mb-4" style="box-sizing: border-box;">
      <label class="tw-pl-1">Descrição</label>
      <textarea
        v-model="form.description"
        placeholder="Digite a descrição da campanha..."
        rows="4"
        class="tw-w-full tw-p-2 tw-border tw-border-gray-300 tw-rounded"
      ></textarea>
      <small
        v-if="!form.description && submitted"
        class="tw-text-red-500 tw-pl-1 tw-pt-1"
      >
        Descrição é obrigatória
      </small>
    </div>

    <Input
      label="Data de Início"
      v-model="form.startTime"
      type="datetime-local"
      class="tw-mx-6 tw-mb-4"
      :validation="validateRequired"
      message-error="Data de início é obrigatória"
    />

    <Input
      label="Data de Término"
      v-model="form.endTime"
      type="datetime-local"
      class="tw-mx-6 tw-mb-4"
      :validation="validateEndDate"
      message-error="Data de término deve ser posterior à data de início"
    />
<!--
    <div class="tw-mx-6 tw-mb-4">
      <label class="tw-pl-1">Locais</label>
      <div
        class="tw-border tw-border-gray-300 tw-rounded tw-p-2 tw-max-h-60 tw-overflow-y-auto"
      >
        <div
          v-if="locations.length === 0"
          class="tw-text-gray-500 tw-text-sm tw-p-2"
        >
          Carregando locais...
        </div>
        <div
          v-for="location in locations"
          :key="location.id"
          class="tw-flex tw-items-center tw-mb-2"
        >
          <input
            type="checkbox"
            :value="location.id"
            v-model="form.locationIds"
            class="tw-mr-2"
          />
          <span>{{ location.name }} - {{ location.address }}</span>
        </div>
      </div>
      <small
        v-if="!form.locationIds.length && submitted"
        class="tw-text-red-500 tw-pl-1 tw-pt-1"
      >
        Selecione pelo menos um local
      </small>
    </div>
    -->
    
    <div class="tw-flex tw-justify-center tw-gap-4 tw-mt-6">
      <Button
        type="button"
        @click="cancel"
        class="tw-bg-gray-500 tw-text-white"
      >
        Cancelar
      </Button>

      <Button type="submit" class="tw-bg-green-500 tw-text-white">
        {{ isEditing ? "Atualizar" : "Criar" }}
      </Button>
    </div>
  </Form>
</template>

<script setup lang="ts">
import { CampaignService } from "~/services/";
import type { Campaign } from "~/types/";
import { formatDateForInput } from "~/utils/";
import { validateRequired, validateEndDate } from "~/validations";

const props = defineProps({
  campaignId: {
    type: Number,
    required: false,
  },
});

const isEditing = computed(() => !!props.campaignId);
//const locations = ref([]);
const submitted = ref(false);

const form = ref({
  name: "",
  description: "",
  startTime: "",
  endTime: "",
  //locationIds: [] as number[],
});
/*
try {
  locations.value = await CampaignService.getLocations();
} catch (error) {
  console.error("Erro ao carregar locais:", error);
}
*/

// Se estiver editando, carregar dados da campanha
if (isEditing.value) {
  try {
    const campaign = await CampaignService.getCampaignById(
      Number(props.campaignId)
    );
    if (campaign) {
      form.value.name = campaign.name;
      form.value.description = campaign.description;
      form.value.startTime = formatDateForInput(campaign.startTime);
      form.value.endTime = formatDateForInput(campaign.endTime);
      //form.value.locationIds = campaign.locations.map((loc) => loc.id);
    }
  } catch (error) {
    console.error("Erro ao carregar campanha para edição:", error);
  }
}
async function saveCampaign() {
  submitted.value = true;

  if (
    !form.value.name ||
    !form.value.description ||
    !form.value.startTime ||
    !form.value.endTime ||
    //!form.value.locationIds.length ||
    !validateEndDate(form.value.endTime, form.value.startTime)
  ) {
    return;
  }

  try {
    if (isEditing.value) {
      await CampaignService.updateCampaign(
        Number(props.campaignId),
        form.value as Campaign
      );
    } else {
      await CampaignService.createCampaign(form.value as Campaign);
    }
    navigateTo("/campaigns");
  } catch (error) {
    console.error("Erro ao salvar campanha:", error);
    alert("Erro ao salvar campanha. Verifique os dados e tente novamente.");
  }
}

function cancel() {
  navigateTo(isEditing.value ? `/campaigns/${props.campaignId}` : "/campaigns");
}
</script>
