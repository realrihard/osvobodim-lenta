<template>
    <div class="stamp is_approved">Списано <br><span>1 000 000 руб</span></div>
</template>

<script>
export default {
    props: {
        suma: {
            type: Number,
            default: null
        }
    },
    setup() {
        return {

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
    border: 0.25rem solid #555;
    display: inline-block;
    padding: 0.25rem 1rem;
    text-transform: uppercase;
    text-align: center;
    border-radius: 1rem;
    font-family: 'Courier';
    -webkit-mask-image: url('../../../../../public/images/assets/grunge.png');
    -webkit-mask-size: 944px 604px;
    mix-blend-mode: multiply;
}

.is_approved {
    color: #0A9928;
    border: 0.5rem solid #0A9928;
    -webkit-mask-position: 13rem 6rem;
    transform: rotate(-14deg);
    border-radius: 0;
}
</style>
