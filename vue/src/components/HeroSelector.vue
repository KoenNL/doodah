<template>
    <div class="row">
        <div class="col-sm-2">
            <label for="{{ hero.id }}">{{ hero.id }}</label>
        </div>
        <div class="col-sm-10">
            <select id="{{ hero.id }}" class="form-control">
                <option v-for="availableHero in availableHeroes">
                    {{ availableHero.name }}
                </option>
            </select>
        </div>
    </div>
</template>

<script scope>
export default {
    title: 'Hero Selector',
    props: ['hero'],
    data() {
    }
}
</script>