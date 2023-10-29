<template>
    <div
        class="row d-flex align-items-center justify-content-center justify-content-xxl-start mb-md-3"
    >
        <h5
            class="col col-sm-3 col-xxl-2 mb-3 mb-xxl-0 text-center text-xxl-start"
        >
            <strong>
                {{ title }}
            </strong>
        </h5>
        <search-bar
            class="col col-12 col-sm-10 col-xxl-8"
            :name="searchName"
            :class="{ 'mb-3 mb-md-0 ms-xxl-3': !canSeeCreateButton }"
            :placeholder="searchBarPlaceholder"
            :route-name="routeName"
            :object="object"
        />
        <button
            v-if="storeModalPopUp && canSeeCreateButton"
            class="btn btn-primary col-6 col-sm-4 col-xxl-2 my-3 text-nowrap"
            data-bs-toggle="modal"
            :data-bs-target="targetStoreModal"
        >
            {{ buttonText }}
        </button>
        <Link
            v-if="!storeModalPopUp && canSeeCreateButton"
            :href="route(createRouteName)"
            class="btn btn-primary col-6 col-sm-4 col-xxl-2 my-3 text-nowrap"
        >
            {{ buttonText }}
        </Link>
        <div class="d-md-flex align-items-center my-2">
            <div class="col-12 col-md-4">
                <slot name="filters"></slot>
            </div>
            <div class="d-flex justify-content-md-end col-12 col-md-8">
                <date-filters
                    v-if="dateFilters"
                    :route-name="routeName"
                    :object="object"
                    :start-date="startDate"
                    :end-date="endDate"
                />
            </div>
        </div>
    </div>
    <div :class="{ 'table-responsive': tableResponsive }">
        <table class="table table-hover table-striped table-bordered fs-7">
            <thead>
                <tr>
                    <th
                        v-for="(header, i) in tableHeaders"
                        :key="i"
                        class="text-nowrap"
                    >
                        {{ header }}
                    </th>
                    <th v-if="actionsShow">Actions</th>
                </tr>
            </thead>
            <tbody>
                <slot></slot>
            </tbody>
        </table>
    </div>
    <pagination v-if="links" :links="links" />
</template>

<script>
export default {
    name: "TableView",
};
</script>
<script setup>
import SearchBar from "../SearchBar.vue";
import DateFilters from "../DateFilters.vue";
import Pagination from "../Pagination.vue";

defineProps({
    title: {
        type: String,
        required: true,
    },
    buttonText: {
        type: String,
        default: "",
    },
    tableHeaders: {
        type: Array,
        required: true,
    },
    targetStoreModal: {
        type: String,
        default: null,
    },
    links: {
        type: Array,
        default: null,
    },
    storeModalPopUp: {
        type: Boolean,
        default: true,
    },
    actionsShow: {
        type: Boolean,
        default: true,
    },
    searchBarPlaceholder: {
        type: String,
        default: "Пребарајте...",
    },
    routeName: {
        type: String,
        required: true,
    },
    object: {
        type: Object,
        default: null,
    },
    createRouteName: {
        type: String,
        default: null,
    },
    canSeeCreateButton: {
        type: Boolean,
        default: false,
    },
    searchName: {
        type: String,
        default: "search",
    },
    tableResponsive: {
        type: Boolean,
        default: true,
    },
    dateFilters: {
        type: Boolean,
        default: true,
    },
    startDate: {
        type: String,
        default: "start_date",
    },
    endDate: {
        type: String,
        default: "end_date",
    },
});
</script>

<style scoped></style>
