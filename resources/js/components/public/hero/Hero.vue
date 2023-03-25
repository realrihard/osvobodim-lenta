<template>
    <div class="hero">
        <div class="container">
            <div class="hero__wrapper">
                <header-block />
                <div class="hero__content">
                    <hero-illustration />
                    <hero-info />
                </div>
                <hero-more />
            </div>
        </div>
        <hero-animation-bg />
        <div class="bg__forms">
            <div class="squere__md"></div>
            <div class="squere__lg"></div>
        </div>
    </div>
</template>

<script>
import HeaderBlock from './Header.vue';
import HeroIllustration from './HeroIllustration.vue';
import HeroInfo from './HeroInfo.vue';
import HeroMore from './HeroMore.vue';
import HeroAnimationBg from './HeroAnimationBg.vue'

export default {
    name: 'hero',
    components: {
        HeaderBlock,
        HeroIllustration,
        HeroInfo,
        HeroMore,
        HeroAnimationBg
    },
    setup() {
        return {
        }
    }
}
</script>
