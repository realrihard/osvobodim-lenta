<template>
    <div class="hero">
        <div>Сумма списанных задолженностей: {{ total.mainsum }}</div>
        <div>За последние 7 дней: {{ total.day7 }}</div>
        <div>За последние 30 дней: {{ total.day30 }}</div>
        <div>Клиентов освобождено: {{ total.clients }}</div>

        <a href="https://osvobodim.com">На сайт</a>
    </div>
</template>

<script>
import axios from 'axios';
import { computed, onMounted, ref } from 'vue';


export default {
    setup() {
        const total = ref({
            mainsum: null,
            day7: null,
            day30: null,
            clients: null
        });


        onMounted (() => {
            mainsum();
            day7();
            day30();
            kolvodel();
        })

        const mainsum = async() => {
            try {
                total.value.mainsum = await axios.get("https://docs.google.com/spreadsheets/d/1hJ4SrLriOv_jUmjjo2qCsyz0GC15r_60LY9vlX2Q9L0/gviz/tq?tqx=out:csv&range=I2:J2&sheet=%D0%9D%D0%BE%D0%B2%D1%8B%D0%B9%20%D0%B2%D0%B0%D1%80%D0%B8%D0%B0%D0%BD%D1%82")
                .then(response => {
                    const resp = response.data.trim()
                    return resp
                })
            } catch (err) {
                console.error(err);
                return null;
            }
        };

        const day7 = async () => {
            try {
                total.value.day7 = await axios.get("https://docs.google.com/spreadsheets/d/1hJ4SrLriOv_jUmjjo2qCsyz0GC15r_60LY9vlX2Q9L0/gviz/tq?tqx=out:csv&range=M1:N1&sheet=%D0%9D%D0%BE%D0%B2%D1%8B%D0%B9%20%D0%B2%D0%B0%D1%80%D0%B8%D0%B0%D0%BD%D1%82")
                .then(response => {
                    console.log(response)
                    const resp = response.data.trim()
                    return resp
                })
            } catch (err) {
                console.error(err);
                return null;
            }
        };

        const day30 = async () => {
            try {
                total.value.day30 = await axios.get("https://docs.google.com/spreadsheets/d/1hJ4SrLriOv_jUmjjo2qCsyz0GC15r_60LY9vlX2Q9L0/gviz/tq?tqx=out:csv&range=M2:N2&sheet=%D0%9D%D0%BE%D0%B2%D1%8B%D0%B9%20%D0%B2%D0%B0%D1%80%D0%B8%D0%B0%D0%BD%D1%82")
                .then(response => {
                    const resp = response.data.trim()
                    return resp
                })
            } catch (err) {
                console.error(err);
                return null;
            }
        };

        const kolvodel = async () => {
            try {
                total.value.clients = await axios.get("https://docs.google.com/spreadsheets/d/1hJ4SrLriOv_jUmjjo2qCsyz0GC15r_60LY9vlX2Q9L0/gviz/tq?tqx=out:csv&range=P1:Q1&sheet=%D0%9D%D0%BE%D0%B2%D1%8B%D0%B9%20%D0%B2%D0%B0%D1%80%D0%B8%D0%B0%D0%BD%D1%82")
                    .then(response => {
                        const resp = response.data.trim()
                        return resp
                    })
            } catch (err) {
                console.error(err);
                return null;
            }
        };

        return {
            total,
            mainsum,
            day7,
            day30,
            kolvodel
        }
    }

}
</script>
