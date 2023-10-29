<template>
    <head-title title="Add role" />
    <div>
        <form @submit.prevent="submit">
            <h5>
                <strong> Add role </strong>
            </h5>
            <base-input
                v-model:value="form.name"
                class="my-4 col-12 col-md-6 col-lg-4"
                name="name"
                label="Name"
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
                    <label :for="permission.id">{{ permission.name }}</label
                    ><br />
                </div>
                <div class="invalid-feedback">
                    {{ form.errors.permissions }}
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
    </div>
</template>

<script>
import AdminDefaultLayout from "../../Layouts/AdminDefaultLayout.vue";

export default {
    name: "Create",
    layout: AdminDefaultLayout,
};
</script>

<script setup>
import { inject } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import HeadTitle from "../../Components/HeadTitle.vue";
import BaseInput from "../../Components/BaseComponents/BaseInput.vue";

const route = inject("route");

defineProps({
    permissions: {
        type: Array,
        required: true,
    },
});

let form = useForm({
    name: "",
    permissions: [],
});

const submit = () => {
    form.post(route("roles.store"), {
        onSuccess: () => {},
    });
};
</script>

<style scoped></style>
