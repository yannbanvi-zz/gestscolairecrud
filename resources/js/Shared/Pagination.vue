<template>
    <ul class="pagination pagination-sm float-right">
        <li class="page-item " :class="{'disabled': props.prev == null}">
            <Link class="page-link" :href="props.prev">«</Link>
        </li>
        <li class="page-item" :class="{'active': link.active}" v-for="link in computedLinks">
        <Link class="page-link " :href="link.url">{{link.label}}</Link>
        </li>
        <li class="page-item" :class="{'disabled': props.next == null}">
            <Link class="page-link" :href="props.next">»</Link>
        </li>
    </ul>
</template>

<script setup>
import { computed } from 'vue';


const props = defineProps({
    links: {
        type: Array,
        required: true
    },
    prev: {
        type: String,
        default: ""
    },
    next: {
        type: String,
        default: ""
    }
})

const computedLinks = computed(()=>{
    props.links.shift();
    props.links.pop();
    return props.links;
})
</script>