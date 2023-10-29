<template>
    <form role="search">
        <div class="position-relative">
            <input
                v-model="form[name]"
                type="text"
                :name="name"
                :placeholder="placeholder"
                class="w-100 rounded rounded-3 border border-2 border-black py-1 px-2"
            />
            <button
                class="btn bg-transparent position-absolute custom-absolute-position"
            >
                <i class="fa fa-search" aria-hidden="true"></i>
            </button>
        </div>
    </form>
</template>

<script>
export default {
    name: "SearchBar",
};
</script>
<script setup>
import { inject, watch } from "vue";
import { getParam } from "../helpers";
import { useForm } from "@inertiajs/inertia-vue3";

const route = inject("route");

const props = defineProps({
    placeholder: {
        type: String,
        default: "Пребарајте...",
    },
    routeName: {
        type: String,
        required: true,
    },
    object: {
        type: Object,
        default: null,
    },
    name: {
        type: String,
        default: "search",
    },
});

const form = useForm({
    [props.name]: getParam(props.name),
});

let timeout;

watch(
    () => form[props.name],
    () => {
        clearTimeout(timeout);
        form.cancel();
        timeout = setTimeout(submit, 300);
    }
);

const submit = () => {
    form.get(route(props.routeName, props.object), {
        preserveState: true,
        preserveScroll: true,
    });
};
</script>

<style scoped>
.custom-absolute-position {
    bottom: 2%;
    right: 1%;
}
</style>
