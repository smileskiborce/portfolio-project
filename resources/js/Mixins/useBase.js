import { usePage } from "@inertiajs/inertia-vue3";
import { computed } from "vue";

export function useBase() {
    const user = computed(() => usePage().props.value.user);

    const can = computed(() => usePage().props.value.can);

    const error = computed(() => usePage().props.value.error);

    const success = computed(() => usePage().props.value.success);

    return {
        can,
        user,
        error,
        success,
    };
}
