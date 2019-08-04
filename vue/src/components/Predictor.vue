<template>
    <div class="row">
        <div class="row">
            <div class="col-sm-2">
                <label for="steamId">SteamId</label>
            </div>
            <div class="col-sm-10">
                <input type="text" id="steamId" name="steamId" placeholder="https://steamcommunity.com/profiles/<your-id>"/>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-12">
                <hero-selector v-for="hero in heroes"></hero-selector>
            </div>
            <div class="col-lg-4 col-md-12">
                <hero-selector></hero-selector>
            </div>
            <div class="col-lg-4 col-md-12">
                <hero-selector></hero-selector>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <h3>Prediction</h3>
                <prediction></prediction>
            </div>
        </div>
    </div>
</template>

<script scope>
    export default {
        title: 'Predictor',
        data() {
        }
    }
</script>