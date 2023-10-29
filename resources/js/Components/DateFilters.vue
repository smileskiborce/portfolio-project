<template>
    <div class="gap-sm-4">
        <base-input
            v-model:value="form[props.startDate]"
            class="rounded rounded-2 border-1 border-secondary border-opacity-25 py-1"
            type="date"
            name="start_date"
            :inline="true"
            label="Од"
            @change="search()"
        />
        <base-input
            v-model:value="form[props.endDate]"
            class="rounded rounded-2 border-1 border-secondary border-opacity-25 py-1"
            type="date"
            name="end_date"
            :inline="true"
            label="До"
            @change="search()"
        />
    </div>
</template>

<script>
export default {
    name: "DateFilters",
};
</script>
<script setup>
import { inject } from "vue";
import { getParam } from "../helpers";
import { useForm } from "@inertiajs/inertia-vue3";
import BaseInput from "./BaseComponents/BaseInput.vue";

const props = defineProps({
    routeName: {
        type: String,
        required: true,
    },
    object: {
        type: Object,
        default: null,
    },
    startDate: {
        type: String,
        default: "start_date",
    },
    endDate: {
        type: String,
        default: "end_date",
    },
});

const route = inject("route");

const form = useForm({
    [props.startDate]: getParam(props.startDate),
    [props.endDate]: getParam(props.endDate),
});

const search = () => {
    if (props.object)
        form.get(route(props.routeName, props.object), {
            preserveState: true,
            preserveScroll: true,
        });
    else
        form.get(route(props.routeName), {
            preserveState: true,
            preserveScroll: true,
        });
};
</script>

<style scoped></style>
