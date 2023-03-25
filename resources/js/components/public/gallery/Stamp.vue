<template>
    <div class="stamp is_approved">Списано <br><span>{{ formatedSuma }}</span></div>
</template>

<script>
import { computed } from 'vue'

export default {
    name: 'stamp',
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
