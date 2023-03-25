<template>
    <div class="hero__info">
        <div>Сумма списанных задолженностей:<br> <span class="hero__text_lg hero__text_action">{{ total.mainsum }}</span></div>
        <div>За последние 7 дней:<br> <span class="hero__text_sm hero__text_info">{{ total.day7 }}</span></div>
        <div>За последние 30 дней:<br> <span class="hero__text_sm hero__text_info">{{ total.day30 }}</span></div>
        <div>Клиентов освобождено:<br> <span class="hero__text_sm hero__text_info">{{ total.clients }}</span></div>
    </div>
</template>

<script>
import {ref, onMounted} from 'vue';

    export default {
        name: 'hero-info',
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
