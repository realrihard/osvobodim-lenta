<template>
    <Smoothie class="content">
        <div class="hero">
            <div class="hero__wrapper">
                <div class="area" >
                    <ul class="circles">
                        <li v-for="n in 10" :key="n"></li>
                    </ul>
                </div>
                <!--<div class="hero__image__layer">
                    <div class="hero__frame"><img src="../../../public/images/assets/frame.png" alt=""></div>
                </div>-->
                <div class="container">
                    <hero />
                </div>
            </div>
        </div>
        <div class="container">
            <gallery />
        </div>
    </Smoothie>
</template>

<script>
import Hero from '../components/public/Hero.vue';
import Gallery from '../components/public/Gallery.vue';
import { onMounted} from 'vue';
import { Smoothie } from 'vue-smoothie'


export default {
    components: {
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
