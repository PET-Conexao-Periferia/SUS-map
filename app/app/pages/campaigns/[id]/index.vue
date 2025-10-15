<template>
    <BackButton />
    <div class="tw-container tw-mx-auto tw-py-8">
        <CampaignDetail :id="Number(id)" />

        <div class="tw-text-center tw-mt-8">
        </div>
    </div>
</template>

<script setup lang="ts">
const route = useRoute();
const id = route.params.id;
</script>
