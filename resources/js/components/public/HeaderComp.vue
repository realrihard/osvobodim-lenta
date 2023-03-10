<template>
    <header>
        <div class="header_left">
            <div class="logo"><img src="'../../../../images/assets/logo.svg" alt=""></div>
        </div>
        <div class="header_right">
            <div class="contacts">sdfsdfsdf</div>
        </div>

    </header>
</template>

<script>
export default {
    setup() {

    },
}
</script>

<style lang="scss" scoped>
header {
    width: 100%;
    height: 80px;
    margin-bottom: 50px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: solid 1px #1a75bc;
}
.logo {
    width: 100%;
    max-width: 200px;
    display: flex;
    align-items: center;

    img {
        width: 100%;
    }
}
</style>
