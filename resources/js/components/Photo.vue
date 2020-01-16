<template>
  <div class="photo">
    <figure class="photo__wrapper">
      <img
        class="photo__image"
        v-bind:class="imageClass"
        v-bind:src="item.url"
        v-bind:alt="`Photo by ${item.owner.name}`"
        v-on:load="setAspectRatio"
        ref="image"
      >
    </figure>
    <!-- マウスオーバー時のオーバーレイ -->
    <RouterLink
      class="photo__overlay"
      :to="`/photos/${item.id}`"
      :title="`View the photo by ${item.owner.name}`"
    >
      <!-- いいねとダウンロードボタン -->
      <div class="photo__controls">
        <!-- いいねボタン -->
        <button
          class="photo__action photo__action--like"
          :class="{ 'photo__action--liked': item.liked_by_user }"
          title="Like photo"
          @click.prevent="like"
        >
          <i class="icon ion-md-heart"></i>{{ item.likes_count }}
        </button>
        <!-- ./いいねボタン -->
        <!-- ダウンロードボタン -->
        <a
          class="photo__action"
          title="Download photo"
          @click.stop
          :href="`/photos/${item.id}/download`"
        >
          <i class="icon ion-md-arrow-round-down"></i>
        </a>
        <!-- ./ダウンロードボタン -->
      </div>
      <!-- ./いいねとダウンロードボタン -->
      <div class="photo__username">
        {{ item.owner.name }}
      </div>
    </RouterLink>
    <!-- ./マウスオーバー時のオーバーレイ -->
  </div>
</template>

<script>
export default {
  props: {
    item: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      landscape: false,
      portrait: false
    }
  },
  computed: {
    imageClass() {
      return {
        // 横長クラス
        'photo__image--landscape': this.landscape,
        // 縦長クラス
        'photo__image--portrait': this.portrait
      }
    }
  },
  methods: {
    setAspectRatio() {
      if (!this.$refs.image) {
        return false
      }
      const height = this.$refs.image.clientHeight
      const width = this.$refs.image.clientWidth
      // 縦横比率 3:4 よりも横長の画像
      this.landscape = height / width <= 0.75
      // 横長でなければ縦長
      this.portrait = !this.landscape
    },
    like () {
      this.$emit('like', {
        id: this.item.id,
        liked: this.item.liked_by_user
      })
    }
  }
}
</script>
