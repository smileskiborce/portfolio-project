<template>
    <head-title title="Edit role" />
    <form @submit.prevent="submit">
        <h5>
            <strong> Edit role </strong>
        </h5>
        <base-input
            v-model:value="form.name"
            class="my-4 col-12 col-md-6 col-lg-4"
            name="name"
            label="Name"
            :disabled="true"
            :invalid="form.errors.name"
        />
        <label class="form-label">Permissions</label>
        <div class="mb-3 row">
            <div
                v-for="permission in permissions"
                :key="permission.id"
                class="col-12 col-sm-6 col-md-4 col-xl-3"
            >
                <input
                    :id="permission.id"
                    v-model="form.permissions"
                    type="checkbox"
                    :value="permission.id"
                    :name="permission.id"
                />
                <label :for="permission.id">{{ permission.name }}</label>
            </div>
        </div>
        <div class="text-end">
            <Link
                :href="route('roles.index')"
                class="btn btn-secondary me-2 text-nowrap"
            >
                Exit
            </Link>
            <button
                :disabled="form.processing"
                type="submit"
                class="btn btn-success"
            >
                <i class="fa fa-save"></i> Save
            </button>
        </div>
    </form>
</template>

<script>
import AdminDefaultLayout from "../../Layouts/AdminDefaultLayout.vue";

export default {
    name: "Edit",
    layout: AdminDefaultLayout,
};
</script>

<script setup>
import { inject } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import HeadTitle from "../../Components/HeadTitle.vue";
import BaseInput from "../../Components/BaseComponents/BaseInput.vue";

const route = inject("route");

const props = defineProps({
    permissions: {
        type: Array,
        required: true,
    },
    role: {
        type: Object,
        required: true,
    },
    rolePermissions: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    name: props.role.name,
    permissions: props.rolePermissions.map(function (obj) {
        return obj.id;
    }),
});

const submit = () => {
    form.put(route("roles.update", props.role), {
        onSuccess: () => {},
    });
};
</script>

<style scoped></style>
