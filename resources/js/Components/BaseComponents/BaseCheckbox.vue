<template>
    <div class="form-check form-switch">
        <input
            :id="'check_' + name"
            v-model="_value"
            :class="{ 'is-invalid': invalid }"
            class="form-check-input"
            type="checkbox"
            :checked="checked"
            :disabled="disabled"
            @change="emit('change')"
        />
        <label class="form-check-label" :for="'check_' + name">
            {{ label }}
        </label>
        <div class="invalid-feedback">{{ invalid }}</div>
    </div>
</template>

<script>
export default {
    name: "BaseCheckbox",
};
</script>

<script setup>
import { computed } from "vue";

const props = defineProps({
    name: {
        type: String,
        required: true,
    },
    label: {
        type: String,
        required: true,
    },
    value: {
        type: [Boolean, Number, String],
        default: "",
    },
    checked: {
        type: Boolean,
        default: false,
    },
    disabled: {
        type: Boolean,
        default: false,
    },
    invalid: {
        type: String,
        default: "",
    },
});

const emit = defineEmits(["update:value", "change"]);
const _value = computed({
    get() {
        return props.value;
    },
    set(val) {
        emit("update:value", val);
    },
});
</script>

<style scoped></style>
