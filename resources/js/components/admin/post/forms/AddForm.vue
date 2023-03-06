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
                    <button type="submit">Отправить</button>
            </div>
        </form>
</template>

<script>
import { ref } from 'vue'
import { useDashboardStore } from '../../../store/dashboard.js';
import apiData from '../../../../services/api.js';

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
            console.log(response)
            if (response instanceof Error) {
                console.log('Произошла ошибка', response);
            } else {
                console.log('Отправка данных прошла успешно', response);
                const newObject = {};
                newObject.id = response.id
                newObject.description = form.value.description
                newObject.suma = form.value.suma
                newObject.image = response.image
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

<style lang="scss" scoped>
.form__container {
    position: relative;
    display: flex;
    flex-direction: column;
    row-gap: 50px;
    max-width: 600px;
    width: 100%;
    padding: 0 15px;
    margin: 0 auto;
}

.upload {
    &__input {
        width: 100%;

        label {
            background-color: #f9f9f9;
            border: dashed 3px #dbdbdb;
            border-radius: 15px;
            height: 200px;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            transition: background .3s ease-in-out;

            &.with__preview {
                background-color: transparent;
                border: none;
                height: 500px;
            }

            &:hover {
                cursor: pointer;
                background-color: #e9e9e9;
                transition: background .3s ease-in-out;
            }
        }

        input {
            display: none;
        }
        &:hover {
            .upload__preview__panel {
                opacity: 1;
                transition: opacity .5s ease-in-out;
            }
        }

        &__sign {
            display: flex;
            flex-direction: column;
            align-items: center;

            i {
                font-size: 60px;
                color: #646464;
            }
        }
    }
    &__preview {
        position: relative;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;

        img {
            &.width__bigger {
                width: 100%;
            }
            &.height__bigger {
                height: 100%;
            }
        }

        &__panel {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            background-color: rgba(0,0,0, .5);
            z-index: 10;
            transition: opacity .3s ease-in-out;
        }

        &__controls {
            display: flex;
            width: 50%;
            height: 100px;
            justify-content: space-around;
        }
    }
}
.form__group {
    display: flex;
    flex-direction: column;

    label {
        font-weight: 700;
        margin-bottom: 20px;
    }
}
.bx {
    font-size: 60px;
    color: #fff;
    z-index: 11;
}
.control__btn {
    padding: 20px 30px;
    background-color: #fff;
}
</style>
