<template>
        <form @submit.prevent="addPost" enctype="multipart/form-data">
            <div class="form__container">
                    <div class="upload__input">
                        <label for="image" :class="file ? 'with__preview' : ''" ref="uploadInput">
                            <div v-if="!file" class="upload__input__sign"><i class='bx bx-upload'></i><span>Загрузить файл</span></div>
                            <div class="upload__preview" v-else>
                                <div class="upload__preview__panel">
                                        <i class='bx bx-refresh'></i>
                                </div>
                                <img
                                    :src="imageFile"
                                    ref="preview"
                                    @load="getImageSize"
                                    :class="previewSize.width > previewSize.height ? 'width__bigger' : 'height__bigger'"
                                >
                            </div>
                        </label>
                        <input type="file" name="image" id="image" accept=".jpg,.jpeg,.png" @change="onFileChange">
                    </div>
                    <div class="form__group">
                        <label for="description">Описание <i>(необязательное поле)</i></label>
                        <textarea type="text" id="description" name="description" v-model="form.description" rows="6"></textarea>
                    </div>
                    <div class="form__group">
                        <label for="suma">Сума списания <i>(необязательное поле)</i></label>
                        <input type="text" id="suma" name="suma" v-model="form.suma">
                    </div>
                    <button type="submit" class="btn_primary send__btn" style="margin: 0 auto">Отправить</button>
            </div>
        </form>
</template>

<script>
import { ref } from 'vue'

import apiData from '../../../../services/api.js';
import { useDashboardStore } from '../../../../store/dashboard.js';

export default {
    setup() {
        const store = useDashboardStore();
        const form = ref({
            description: '',
            suma: '',
            image: null,
        });
        const file = ref(null);
        const imageFile = ref(null);
        const preview = ref(null);
        const previewSize = ref({
            width: 0,
            height: 0
        });

        const onFileChange = (e) => {
            file.value = e.target.files[0];
            imageFile.value = URL.createObjectURL(file.value)
        };

        const addPost = async () => {
            const formData = new FormData();
            formData.append('description', form.value.description);
            formData.append('suma', form.value.suma);
            formData.append('image', file.value);

            const response = await apiData.addPost(formData);

            if (response instanceof Error) {
                console.log('Произошла ошибка', response);
            } else {
                console.log('Отправка данных прошла успешно', response);
                const newObject = {};
                newObject.id = response.post.id
                newObject.description = form.value.description
                newObject.suma = form.value.suma
                newObject.image = response.post.image
                store.addPost(newObject)
                store.getPanelSettings(false, null, null)
            }
        }

        const getImageSize = () => {
            const image = preview.value
            previewSize.value.width = image.naturalWidth
            previewSize.value.height = image.naturalHeight
        }

        return {
            store,
            form,
            file,
            imageFile,
            preview,
            previewSize,
            onFileChange,
            addPost,
            getImageSize,
        }
    }
}
</script>
