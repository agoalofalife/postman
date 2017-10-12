<script type="text/ecmascript-6">
    export default {
        name: 'App'
    };
</script>

<template>
    <dashboard></dashboard>
</template>

<script>
    import Dashboard from '../pages/Dashboard.vue';

    export default {
        components: {
            'dashboard': Dashboard
        }
    }
</script>