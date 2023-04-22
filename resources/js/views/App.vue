<template>
    <div class="wrapper" data-scroll-container >
        <hero data-scroll-section/>
        <gallery @content-update="onContentUpdate" :scrollOptions="scroll" data-scroll-section/>
    </div>
</template>

<script>
import LocomotiveScroll from 'locomotive-scroll';
import { ref, onMounted } from 'vue';
import Hero from '../components/public/hero/Hero.vue';
import Gallery from '../components/public/gallery/Gallery.vue';

    export default {
        components: {
            Hero,
            Gallery
        },
        setup () {
            const scroll = ref(null)
            onMounted(() => {
                scroll.value = new LocomotiveScroll({
                    el: document.querySelector('[data-scroll-container]'),
                    smooth: true,
                    lerp: 0.1,
                    multiplier: .5,
                    touchMultiplier: 4,
                    mobile: {
                        breakpoint: 0,
                        smooth: true,
                        touchMultiplier: 4
                    },
                    tablet: {
                        breakpoint: 0,
                        smooth: true,
                        touchMultiplier: 4
                    }
                                    });

            })

            const onContentUpdate = () => {
                scroll.value.update()
            }

            const loadNewContent = () => {

            }

            return {
                scroll,
                onContentUpdate,
            }
        }
    }
</script>
