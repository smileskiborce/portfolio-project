<template>
    <head-title title="Role" />
    <table-view
        title="Roles"
        button-text="Add role"
        :table-headers="tableHeaders"
        :can-see-create-button="true"
        :store-modal-pop-up="false"
        :links="roles.links"
        search-bar-placeholder="Search roles..."
        route-name="roles.index"
        create-route-name="roles.create"
        :date-filters="false"
    >
        <tr v-for="role in roles.data" :key="role.id">
            <td>
                {{ role.id }}
            </td>
            <td>
                {{ role.name }}
            </td>
            <td>
                <div class="d-flex flex-nowrap">
                    <Link
                        :href="route('roles.edit', role.id)"
                        class="btn btn-sm btn-success me-1 text-nowrap"
                    >
                        <i class="fa fa-pencil"></i> Edit
                    </Link>
                    <button
                        class="btn btn-sm btn-primary ms-1 text-nowrap"
                        data-bs-toggle="modal"
                        data-bs-target="#deleteModal"
                        data-bs-title="Delete role"
                        :data-bs-route="route('roles.destroy', role.id)"
                    >
                        <i class="fa fa-trash"></i> Delete
                    </button>
                </div>
            </td>
        </tr>
    </table-view>
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
import TableView from "../../Components/BaseComponents/BaseCrudTableView.vue";

defineProps({
    roles: {
        type: Object,
        default: null,
    },
    permissions: {
        type: Array,
        default: null,
    },
    error: {
        type: String,
        default: null,
    },
});

const route = inject("route");

const { can } = useBase();

const tableHeaders = ["#", "Name"];
</script>

<style scoped></style>
