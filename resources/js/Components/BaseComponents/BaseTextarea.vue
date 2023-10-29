<template>
    <div>
        <label v-if="label" :for="name">{{ label }}</label>
        <textarea
            :id="name"
            v-model="_value"
            :class="{ 'is-invalid': invalid }"
            class="form-control min-height-100px"
            @keyup="emit('keyup')"
            @keydown.enter="emit('onEnter')"
        ></textarea>
        <div class="invalid-feedback">
            {{ invalid }}
        </div>
    </div>
</template>

<script>
export default {
    name: "BaseTextarea",
};
</script>

<script setup>
import { computed } from "vue";

const props = defineProps({
    name: {
        type: String,
        required: true,
    },
    value: {
        type: String,
        default: "",
    },
    label: {
        type: String,
        default: "",
    },
    invalid: {
        type: String,
        default: "",
    },
});

const emit = defineEmits(["update:value", "keyup", "onEnter"]);
const _value = computed({
    get() {
        return props.value;
    },
    set(val) {
        emit("update:value", val);
    },
});
</script>

<style scoped>
.min-height-100px {
    min-height: 100px;
}
</style>
