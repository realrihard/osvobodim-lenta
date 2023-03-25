<template>
    <div class="area" >
        <ul class="circles">
            <li v-for="n in 10" :key="n"></li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: 'hero-bg-animation',
        setup() {
            return {}
        }
    }
</script>
