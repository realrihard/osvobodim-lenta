<template>
    <div class="contact__form">
        <h4>Хотите также?<br>Оставляйте заявку!</h4>
        <form @submit.prevent="submitForm">
            <input type="text" v-model="form.name" placeholder="Ваше имя">
            <input type="text" v-model="form.phone" v-maska data-maska="+7 (###) ###-##-##" placeholder="Ваш телефон">
            <button type="submit" class="send__btn">Хочу также</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';
import { ref } from 'vue';
import { vMaska } from "maska"

export default {
    name: 'contact-form',
    directives: { maska: vMaska },
    setup() {
        const form = ref({
            name: null,
            phone: null
        })
        const submitForm = async () => {
            await axios.post('/sendmail', {
                name: form.value.name,
                phone: form.value.phone
            })
            .then(response => {
                console.log(response.data);
            })
            .catch(error => {
                console.log(error);
            });
        }

        return {
            form,
            submitForm
        }
    }
}
</script>
