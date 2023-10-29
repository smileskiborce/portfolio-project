<template>
    <head-title title="Users" />
    <table-view
        title="Users"
        button-text="add user"
        :table-headers="tableHeaders"
        target-store-modal="#storeUserModal"
        :can-see-create-button="can.users.create"
        :links="users.links"
        search-bar-placeholder="Search user..."
        route-name="users.index"
        :date-filters="false"
    >
        <tr v-for="user in users.data" :key="user.id">
            <td>
                {{ user.id }}
            </td>
            <td>
                {{ user.name }}
            </td>
            <td>
                {{ user.username }}
            </td>
            <td>
                {{ user.email }}
            </td>
            <td>
                {{ user.roles.map((a) => a.name).join(", ") }}
            </td>
            <td v-if="user.last_login">
                {{ moment("11.11.2001").format("llll") }}
            </td>
            <td v-else>User still didn't logged in</td>
            <td>
                <div class="d-flex flex-nowrap">
                    <button
                        v-if="can.users.update"
                        data-bs-toggle="modal"
                        data-bs-target="#updateUserModal"
                        :data-bs-user="JSON.stringify(user)"
                        class="btn btn-sm btn-success me-1 text-nowrap"
                    >
                        <i class="fa fa-pencil"></i> Edit
                    </button>
                    <button
                        v-if="can.users.delete"
                        class="btn btn-sm btn-primary ms-1 text-nowrap"
                        data-bs-toggle="modal"
                        data-bs-target="#deleteModal"
                        data-bs-title="Delete user"
                        :data-bs-route="route('users.destroy', user.id)"
                    >
                        <i class="fa fa-trash"></i> Delete
                    </button>
                </div>
            </td>
        </tr>
    </table-view>
    <store-user-modal :roles="roles" />
    <update-user-modal :roles="roles" />
</template>

<script>
import AdminDefaultLayout from "../../Layouts/AdminDefaultLayout.vue";

export default {
    name: "Index",
    layout: AdminDefaultLayout,
};
</script>
<script setup>
import { inject } from "vue";
import { useBase } from "../../Mixins/useBase";
import HeadTitle from "../../Components/HeadTitle.vue";
import StoreUserModal from "../../Modals/User/StoreUserModal.vue";
import UpdateUserModal from "../../Modals/User/UpdateUserModal.vue";
import TableView from "../../Components/BaseComponents/BaseCrudTableView.vue";

const { can } = useBase();
const moment = inject("moment");
const route = inject("route");
defineProps({
    users: {
        type: Object,
        default: null,
    },
    roles: {
        type: Array,
        default: null,
    },
});

const tableHeaders = [
    "#",
    "Name",
    "User name",
    "E-mail",
    "Roles",
    "Last logged in",
];
</script>

<style scoped></style>
