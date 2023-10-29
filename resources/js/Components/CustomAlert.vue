<template>
    <div
        v-if="success || error"
        :class="{ 'alert-danger': error, 'alert-success': success }"
        class="alert alert-dismissible fade show text-center m-0"
        role="alert"
    >
        <span v-if="success"> <i class="fa fa-check"></i> {{ success }} </span>
        <span v-else>
            <i class="fa fa-exclamation-circle"></i> {{ error }}
        </span>
        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close"
        ></button>
    </div>
</template>

<script>
export default {
    name: "CustomAlert",
};
</script>
<script setup>
import { useCommonBase } from "../Mixins/useCommonBase";

const { success, error } = useCommonBase();
</script>

<style scoped></style>
