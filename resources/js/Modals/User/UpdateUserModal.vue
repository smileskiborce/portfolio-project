<template>
    <base-modal
        id="updateUserModal"
        title="Edit user"
        @submit="submit"
        @onshow="onShow"
        @instance="(_) => (modal = _)"
    >
        <template #default>
            <base-input
                v-model:value="form.name"
                class="mb-3"
                name="name_user_update"
                label="Name"
                :invalid="form.errors.name"
            />
            <base-input
                v-model:value="form.username"
                class="mb-3"
                name="username_user_update"
                label="Username"
                :invalid="form.errors.username"
            />
            <base-input
                v-model:value="form.email"
                class="mb-3"
                name="email_user_update"
                type="email"
                label="E-mail"
                :invalid="form.errors.email"
            />
            <base-input
                v-model:value="form.password"
                class="mb-3"
                name="password_user_update"
                type="password"
                label="Password"
                :invalid="form.errors.password"
            />
            <base-select
                v-model:value="form.role_id"
                class="mb-3"
                label="Role"
                :invalid="form.errors.role_id"
                name="role_user_update"
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
    name: "UpdateUserModal",
};
</script>
<script setup>
import { inject, ref } from "vue";
import BaseModal from "../Base/BaseModal.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import BaseInput from "../../Components/BaseComponents/BaseInput.vue";
import BaseSelect from "../../Components/BaseComponents/BaseSelect.vue";

const route = inject("route");
const user = ref(null);
const modal = ref(null);

defineProps({
    roles: {
        type: Array,
        required: true,
    },
});

const onShow = (event) => {
    user.value = JSON.parse(event.relatedTarget.getAttribute("data-bs-user"));
    form.name = user.value.name;
    form.username = user.value.username;
    form.email = user.value.email;
    form.role_id = user.value.roles[0].id;
};

let form = useForm({
    name: "",
    username: "",
    email: "",
    password: "",
    role_id: "",
});

const submit = () => {
    form.put(route("users.update", user.value), {
        onSuccess: () => {
            modal.value.hide();
        },
    });
};
</script>

<style scoped></style>
