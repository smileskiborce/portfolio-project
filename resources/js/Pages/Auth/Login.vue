<template>
    <div
        class="container py-4 min-vh-100 d-flex align-items-center justify-content-center"
    >
        <div class="col col-12 col-md-6 col-lg-5">
            <div class="card shadow-lg bg-dark">
                <div class="card-body p-md-5 text-white text-center">
                    <h2 class="display-6 fw-bold mb-4">Log in</h2>
                    <form @submit.prevent="login">
                        <div class="mb-3">
                            <label for="username" class="form-label"
                                >Username</label
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
                        <div class="mb-3">
                            <label for="password" class="form-label"
                                >Password</label
                            >
                            <input
                                id="password"
                                v-model="form.password"
                                :class="{ 'is-invalid': form.errors.email }"
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
                        <a class="d-block text-decoration-none pb-2 text-primary pointer-event btn" :href="route('show_register')">
                            Register
                        </a>

                        <button type="submit" class="btn btn-primary">
                            Log in
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <custom-alert/>
</template>

<script>
export default {
    name: "Login",
};
</script>
<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { inject } from "vue";
import CustomAlert from "../../Components/CustomAlert.vue";

const route = inject("route");

const form = useForm({
    username: "",
    password: "",
});


const login = () => {
    form.post(route("login"));
};
</script>

<style scoped></style>
