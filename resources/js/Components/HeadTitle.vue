<template>
    <Head>
        <title>
            {{ title }}
        </title>
    </Head>
</template>

<script>
export default {
    name: "HeadTitle",
};
</script>
<script setup>
defineProps({
    title: {
        type: String,
        default: null,
    },
});
</script>

<style scoped></style>
