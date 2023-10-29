<template>
    <base-modal
        id="storeUserModal"
        title="Add user"
        @submit="submit"
        @instance="(_) => (modal = _)"
    >
        <template #default>
            <base-input
                v-model:value="form.name"
                class="mb-3"
                name="name_user"
                label="Name"
                :invalid="form.errors.name"
            />
            <base-input
                v-model:value="form.username"
                class="mb-3"
                name="username_user"
                label="Username"
                :invalid="form.errors.username"
            />
            <base-input
                v-model:value="form.email"
                class="mb-3"
                name="email_user"
                type="email"
                label="E-mail"
                :invalid="form.errors.email"
            />
            <base-input
                v-model:value="form.password"
                class="mb-3"
                name="password_user"
                type="password"
                label="Password"
                :invalid="form.errors.password"
            />
            <base-select
                v-model:value="form.role_id"
                class="mb-3"
                label="Role"
                :invalid="form.errors.role_id"
                name="role_user"
            >
                <option v-for="role in roles" :key="role.id" :value="role.id">
                    {{ role.name }}
                </option>
            </base-select>
        </template>
        <template #footer>
            <button
                :disabled="form.processing"
                type="submit"
                class="btn btn-success"
            >
                <i class="fa fa-save"></i> Save
            </button>
        </template>
    </base-modal>
</template>

<script>
export default {
    name: "StoreUserModal",
};
</script>
<script setup>
import { inject, ref } from "vue";
import BaseModal from "../Base/BaseModal.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import BaseInput from "../../Components/BaseComponents/BaseInput.vue";
import BaseSelect from "../../Components/BaseComponents/BaseSelect.vue";

const route = inject("route");
const modal = ref(null);

defineProps({
    roles: {
        type: Array,
        required: true,
    },
});

const form = useForm({
    name: "",
    username: "",
    email: "",
    password: "",
    role_id: "",
});

const submit = () => {
    form.post(route("users.store"), {
        onSuccess: () => {
            modal.value.hide();
            form.reset();
        },
    });
};
</script>

<style scoped></style>
