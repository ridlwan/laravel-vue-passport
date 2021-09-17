<template>
	<div>
		<router-view></router-view>

		<FlashMessage :position="'right bottom'"></FlashMessage>
	</div>
</template>

<script>
	import * as auth from './services/auth_service';
    export default {
		name: 'App',
        beforeCreate: async function() {
			try {
				if (auth.isLoggedIn()) {
					const response = await auth.getProfile();
					this.$store.dispatch('authenticate', response.data);
				}
			} catch (error) {
				auth.logout();
			}
		},
    }
</script>