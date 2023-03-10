<template>
    <div class="stamp is_approved">Списано <br><span>{{ formatedSuma }}</span></div>
</template>

<script>
import { computed } from 'vue'

export default {
    props: {
        suma: {
            type: Number,
            default: null
        }
    },
    setup(prop) {
        const formatedSuma = computed(() => {
            return prop.suma.toLocaleString('ru-RU', { style: 'currency', currency: 'RUB', minimumFractionDigits: 0 })
        })
        return {
            formatedSuma
        }
    },
}
</script>

<style scoped>
.stamp {
    transform: rotate(12deg);
    color: #555;
    font-size: 3rem;
    font-weight: 700;
    border: 1rem solid #555;
    display: inline-block;
    padding: 0.5rem 2.5rem;
    text-transform: uppercase;
    text-align: center;
    border-radius: 1rem;
    font-family: 'Courier';
    -webkit-mask-image: url('../../../../public/images/assets/grunge.png');
    -webkit-mask-size: 944px 604px;
    mix-blend-mode: multiply;
}

.is_approved {
    color: #ff0000;
    border: 0.75rem solid #ff0000;
    -webkit-mask-position: 13rem 6rem;
    transform: rotate(-8deg);
    border-radius: 0;
}
</style>
