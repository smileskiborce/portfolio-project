<template>
    <div
        class="container py-4 min-vh-100 d-flex align-items-center justify-content-center"
    >
        <div class="col col-12 col-md-6 col-lg-5">
            <div class="card shadow-lg bg-dark">
                <div class="card-body p-md-5 text-white text-center">
                    <h2 class="display-6 fw-bold mb-4">Validate</h2>
                    <form @submit.prevent="login">
                        <div class="mb-3">
                            <label for="password" class="form-label"
                            >Password</label
                            >
                            <input
                                id="password"
                                v-model="form.password"
                                :class="{ 'is-invalid': form.errors.password }"
                                type="password"
                                class="form-control"
                                aria-describedby="password"
                            />
                            <div
                                v-if="form.errors.password"
                                class="invalid-feedback"
                                v-text="form.errors.password"
                            />
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label"
                            >Confirm password</label
                            >
                            <input
                                id="password_confirmation"
                                v-model="form.password_confirmation"
                                :class="{ 'is-invalid': form.errors.password_confirmation }"
                                type="password"
                                class="form-control"
                                aria-describedby="confirm_password"
                            />
                            <div
                                v-if="form.errors.password_confirmation"
                                class="invalid-feedback"
                                v-text="form.errors.password_confirmation"
                            />
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label"
                            >name</label
                            >
                            <input
                                id="name"
                                v-model="form.name"
                                :class="{ 'is-invalid': form.errors.name }"
                                type="text"
                                class="form-control"
                                aria-describedby="name"
                            />
                            <div
                                v-if="form.errors.name"
                                class="invalid-feedback"
                                v-text="form.errors.name"
                            />
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label"
                            >username</label
                            >
                            <input
                                id="username"
                                v-model="form.username"
                                :class="{ 'is-invalid': form.errors.username }"
                                type="text"
                                class="form-control"
                                aria-describedby="username"
                            />
                            <div
                                v-if="form.errors.username"
                                class="invalid-feedback"
                                v-text="form.errors.username"
                            />
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">
                            Save
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Password",
};
</script>
<script setup>
import {useForm} from "@inertiajs/inertia-vue3";
import {inject} from "vue";

const route = inject("route");
const props = defineProps({
    user: {
        default: null,
        type: Object
    }
})
const form = useForm({
    password: "",
    password_confirmation: "",
    name: '',
    username: ''
});


const login = () => {
    form.post(route("user.set_password_verified",props.user));
};
</script>

<style scoped></style>
