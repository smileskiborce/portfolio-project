<template>
    <div class="form-check">
        <input
            :id="'radio_' + id"
            :class="{ 'is-invalid': invalid }"
            class="form-check-input"
            type="radio"
            :value="value"
            :name="name"
            :checked="checked"
            :disabled="disabled"
            @change="emit('updateValue', value)"
        />
        <label class="form-check-label" :for="'radio_' + id">
            {{ label }}
        </label>
        <div class="invalid-feedback">{{ invalid }}</div>
    </div>
</template>

<script>
export default {
    name: "BaseRadioButton",
};
</script>
<script setup>
defineProps({
    id: {
        type: [String, Number],
        required: true,
    },
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

const emit = defineEmits(["updateValue"]);
</script>

<style scoped></style>
