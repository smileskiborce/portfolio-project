<template>
    <main class="d-flex w-100">
        <div
            :class="{ 'sidebar-hidden': !sidebar }"
            class="sidebar position-relative"
        >
            <button
                class="text-white btn position-absolute end-0 d-lg-none"
                @click="sidebar = !sidebar"
            >
                <i class="fa fa-times fa-2x"></i>
            </button>
            <div class="d-flex flex-column p-3 bg-dark shadow-sm text-white">
                <Link
                    class="text-white fs-6 text-decoration-none text-center bg-dark"
                    :href="route('home')"
                >
                    <img src="../../images/logo.png" class="bg-dark" alt="Logo" width="90" />
                    <div class="text-center text-white fs-5">
                        Portfolio project
                    </div>
                </Link>
                <hr />
                <ul class="nav nav-pills flex-column mb-auto">
                    <!-- Link options -->
                    <li
                        v-for="item in menuOptions"
                        :key="item.name"
                        class="nav-item line-height-normal"
                    >
                        <Link
                            v-if="item.can"
                            :href="route(item.link)"
                            class="nav-link text-white"
                            :class="{ active: route().current(item.link) }"
                            aria-current="page"
                        >
                            <i class="fa" :class="item.icon"></i>
                            {{ item.name }}
                        </Link>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main position-relative" :class="{ 'to-right': sidebar }">
            <div
                v-if="sidebar"
                class="main-overlay"
                @click="sidebar = !sidebar"
            ></div>
            <nav class="navbar navbar-dark bg-dark px-2 shadow">
                <div class="container-fluid">
                    <button
                        class="navbar-toggler d-lg-none"
                        :class="{ 'd-none': sidebar }"
                        type="button"
                        @click="sidebar = !sidebar"
                    >
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <nav class="navbar navbar-dark bg-dark">
                        <span class="navbar-brand mb-0 h1"></span>
                    </nav>
                    <div class="nav navbar-nav navbar-right">
                        <div class="dropdown">
                            <a
                                id="dropdownUser2"
                                href="#"
                                class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle"
                                data-bs-display="static"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            >
                                <span class="text-white me-1">{{
                                    user.name
                                }}</span>
                                <div
                                    class="rounded-circle me-2 bg-white d-flex align-items-center justify-content-center"
                                    style="width: 2rem; height: 2rem"
                                >
                                    <i class="fa fa-user"></i>
                                </div>
                                <strong class="d-none d-lg-block"></strong>
                            </a>
                            <ul
                                class="dropdown-menu dropdown-menu-end text-small shadow"
                                aria-labelledby="dropdownUser2"
                            >
                                <li>
                                    <Link
                                        method="post"
                                        as="button"
                                        type="button"
                                        class="dropdown-item"
                                        :href="route('logout')"
                                    >
                                        <i class="fa fa-sign-out me-2"></i
                                        >Log out
                                    </Link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="container px-md-5 mt-3 mb-5 py-3">
                <slot></slot>
            </div>
        </div>
    </main>
    <delete-modal />
</template>

<script>
export default {
    name: "DefaultLayout",
};
</script>
<script setup>
import { Inertia } from "@inertiajs/inertia";
import { inject, onBeforeUnmount, ref } from "vue";
import { useBase } from "../Mixins/useBase";
import DeleteModal from "../Modals/Base/DeleteModal.vue";

defineProps({
    menu: {
        type: Object,
        default: null,
    },
});

const route = inject("route");

const { can, user } = useBase();

const sidebar = ref(false);
const menuOptions = ref([
    {
        name: "Home",
        icon: "fa-home",
        link: "home",
        can: true,
    },
    {
        name: "Users",
        icon: "fa-users",
        link: "users.index",
        can: can.value.users.viewAny,
    },
    {
        name: "Roles",
        icon: "fa-users",
        link: "roles.index",
        can: can.value.roles.viewAny,
    },
]);

const inertiaOnEvent = Inertia.on("start", () => {
    sidebar.value = false;
});
onBeforeUnmount(() => {
    inertiaOnEvent();
});
</script>

<style scoped>
i {
    width: 1.3rem;
    text-align: center;
}
</style>
