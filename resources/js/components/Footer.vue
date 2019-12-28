<template>
  <footer class="footer">
    <button v-if="isLogin" class="button button--link" v-bind:click="logout">
      Logout
    </button>
    <RouterLink v-else class="button button--link" to="/login">
      Login / Register
    </RouterLink>
  </footer>
</template>

<script>
import { mapState, mapGetters } from 'vuex'

export default {
  computed: {
    // isLogin () {
    //   return this.$store.getters['auth/check']
    // }

    // mapState は、コンポーネントの算出プロパティとストアのステートをマッピングする関数
    ...mapState({
      apiStatus: state => state.auth.apiStatus
    }),
    // mapGetters は、コンポーネントの算出プロパティとストアのゲッターをマッピングする関数
    ...mapGetters({
      isLogin: 'auth/check'
    })
  },
  methods: {
    async logout () {
      await this.$store.dispatch('auth/logout')

      if (this.apiStatus) {
        this.$router.push('/login')
      }
    }
  }
}
</script>
