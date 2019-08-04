<template>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Hero</th>
                <th>Wins</th>
                <th>Losses</th>
            </tr>
        </thead>
        <tbody>
            <tr vfor="(hero, index) in heroes">
                <td>{{ index }}</td>
                <td>{{ hero.name }}</td>
                <td>{{ hero.wins }}</td>
                <td>{{ hero.losses }}</td>
            </tr>
        </tbody>
    </table>
</template>

<script scope>
export default {
    title: 'Predition',
    data: {
        heroes = parent.heroes
    }
}
</script>