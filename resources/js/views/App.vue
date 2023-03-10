<template>
    <Smoothie ref="smoothie" class="content">
        <div class="container">
            <header-comp />
            <hero />
            <gallery />
        </div>
    </Smoothie>
</template>

<script>
import HeaderComp from '../components/public/HeaderComp.vue';
import Hero from '../components/public/Hero.vue';
import Gallery from '../components/public/Gallery.vue';
import { onMounted, shallowRef } from 'vue';
import { Smoothie } from 'vue-smoothie'


export default {
    components: {
        HeaderComp,
        Hero,
        Gallery,
        Smoothie
    },
    setup() {
        onMounted (() => {
            const scrollPosition = window.sessionStorage.getItem('scrollPosition');
            if (scrollPosition) {
                window.scrollTo(0, parseInt(scrollPosition));
            }
        })
        return {
        }
    },
}
</script>

<style scoped>
.content {
    width: 100%;
    height: 100vh;
}
</style>
