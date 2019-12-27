import './bootstrap'
import Vue from 'vue'
import router from './router'
import store from './store'
import App from './App.vue'

const createApp = async () => {
  await store.dispatch('auth/currentUser')

  new Vue({
    el: '#app',
    router, // ルーティングの定義を読み込む
    store, // ストアを読み込む
    components: {App},  // ルートコンポーネントの使用を宣言する
    template: '<App />' // ルートコンポーネントを描画する
  })
}

createApp()
