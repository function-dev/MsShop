<template>
    <div class="block" id="table-size">
        <div class="block-header">
            <h2 class="block-title">Таблица размеров</h2>
        </div>
        <div class="switch">
            <span class="switch-value" :class="{checked: switchVal == 'М'}" @click="switchVal = 'М'">М</span>
            <span class="switch-value" :class="{checked: switchVal == 'Ж'}" @click="switchVal = 'Ж'">Ж</span>
        </div>
        <img src="img/table-size.png" alt="size table" v-if="switchVal == 'М'" class="size-table">
        <img src="img/table-size2.png" alt="size table" v-if="switchVal == 'Ж'" class="size-table">
    </div>
</template>

<script>
export default {
name: "TableSizeComponent",
    data() {
        return {
            switchVal: 'М',
        }
    }
}
</script>
