<template>
    <div>
        <div id="order">
            <div class="order-form">
                <div class="order__group">
                    <label for="name" class="order__group-label">Имя*</label>
                    <input type="text" id="name" class="order__group-input" placeholder="Имя">
                </div>
                <div class="order__group">
                    <label for="surname" class="order__group-label">Фамилия</label>
                    <input type="text" id="surname" class="order__group-input" placeholder="Фамилия">
                </div>
                <div class="order__group">
                    <label for="patronymic" class="order__group-label">Отчество</label>
                    <input type="text" id="patronymic" class="order__group-input" placeholder="Отчество">
                </div>
                <div class="order__group">
                    <label for="phone" class="order__group-label">Номер телефона*</label>
                    <input type="tel" id="phone" class="order__group-input" placeholder="Номер телефона">
                </div>
                <div class="order__group">
                    <label for="email" class="order__group-label">Электронная почта*</label>
                    <input type="email" id="email" class="order__group-input" placeholder="E-mail">
                </div>
                <div class="order__group">
                    <label for="index" class="order__group-label">Почтовый индекс</label>
                    <input type="text" id="index" class="order__group-input" placeholder="Индекс">
                </div>
                <div class="order__group">
                    <label for="address" class="order__group-label">Место проживания*</label>
                    <input type="text" id="address" class="order__group-input" placeholder="Адрес">
                </div>
                <div class="order__group">
                    <label for="comment" class="order__group-label">Комментарий</label>
                    <textarea type="text" id="comment" class="order__group-input" placeholder="Комментарий"></textarea>
                </div>
            </div>
            <p class="order-comment">* - Обязательные поля ввода</p>
        </div>
    </div>
</template>

<script>
export default {
    name: "OrderComponent.vue"
}
</script>
