<template>
    <custom-alert/>

    <div
        class="container py-4 min-vh-100 d-flex align-items-center justify-content-center"
    >
        <div class="col col-12 col-md-6 col-lg-5">
            <div class="card shadow-lg bg-dark">
                <div class="card-body p-md-5 text-white text-center">
                    <h2 class="display-6 fw-bold mb-4">Register</h2>
                    <form @submit.prevent="register">
                        <div class="mb-3 mt-4">
                            <label for="username" class="form-label"
                            >Email</label
                            >
                            <input
                                id="email"
                                v-model="form.email"
                                :class="{ 'is-invalid': form.errors.email }"
                                type="text"
                                class="form-control"
                                aria-describedby="email"
                            />
                            <div
                                v-if="form.errors.email"
                                class="invalid-feedback"
                                v-text="form.errors.email"
                            />
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">
                            register
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Register",
};
</script>
<script setup>
import {useForm} from "@inertiajs/inertia-vue3";
import {inject} from "vue";
import CustomAlert from "../../Components/CustomAlert.vue";

const route = inject("route");

const form = useForm({
    email: "",
});


const register = () => {
    form.post(route("register"));
};
</script>

<style scoped></style>
