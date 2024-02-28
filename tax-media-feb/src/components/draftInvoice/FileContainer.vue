<template>
  <!-- draft-expense content -->
  <div class="draft-expense-image">
    <!-- folder file image modification nav  -->
    <div class="folder-modification-nav d-flex pr-2 justify-start">
      <button
        class="file-image-details-button d-flex  justify-content-center align-items-center px-1"
        @click="zoomout"
      >
        <mdicon
          size="20"
          class="font-weight-bold"
          name="magnify-minus-outline"
        />
        <span style="font-size:15px;margin-left:5px;">Zoom Out</span>
      </button>
      <button
        class="file-image-details-button  d-flex bg-gray-50 px-2 r justify-content-center align-items-center"
        @click="zoomin"
      >
        <mdicon
          size="20"
          class="font-weight-bold"
          name="magnify-plus-outline"
        />
        <span>Zoom In</span>
      </button>
      <button
        class="file-image-details-button  px-2  d-flex justify-content-center align-items-center"
        @click="rotateLeft"
      >
        <mdicon
          size="20"
          class="font-weight-bold"
          name="rotate-left"
        />
        <span> Rotate Left</span>
      </button>
      <button
        class="file-image-details-button  px-2  d-flex justify-content-center align-items-center"
        @click="rotateRight"
      >
        <mdicon
          size="20"
          class="font-weight-bold"
          name="rotate-right"
        />
        <span>Rotate Right</span>
      </button>
      <button
        class="file-image-details-button
           px-2 py-1 d-flex justify-content-center align-items-center "
        @click="reset"
      >
        <mdicon
          size="20"
          class="font-weight-bold"
          name="rotate-3d-variant"
        />
        <span> Reset</span>
      </button>

    </div>
    <!-- end of folder file image modification nav  -->
    <div
      v-dragscroll.pass
      class="file-image-container"
    >
      <p
        v-if="fileImage"
        class="img-p"
      >
        <img
          ref="rotate_img"
          class="rotate_img"
          :src="fileImage"
        >
        <!-- :src="selectedFileForContainer" -->
      </p>
      <h2 v-else>
        select image to preview
      </h2>

    </div>

  </div>
  <!-- end of draft expnese content  -->
</template>

<script>
import { dragscroll } from 'vue-dragscroll'
import { mapState } from 'vuex'

export default {
  directives: {
    dragscroll,
  },
  data() {
    return {
      rotateInit: 0,
      scaleInit: 1,
    }
  },
  computed: {
    ...mapState('transactions', {
      currentDocument: state => state.currentDocument,
      documentList: state => state.documentList,
    }),
    fileImage() {
      return this.currentDocument?.file_as_image || ''
    },
  },
  watch: {
    selectedFileForContainer() {
      this.reset()
    },

  },
  methods: {
    zoomin() {
      this.scaleInit *= 1.2
      this.transform()
    },
    transform() {
      const ROTATE_IMG = this.$refs.rotate_img
      ROTATE_IMG.style.transform = `scale(${this.scaleInit}) rotate(${this.rotateInit}deg)`
    },

    zoomout() {
      this.scaleInit *= 0.8
      this.transform()
    },
    rotateLeft() {
      this.rotateInit -= 10
      this.transform()
    },
    rotateRight() {
      this.rotateInit += 10
      this.transform()
    },
    reset() {
      this.rotateInit = 0
      this.scaleInit = 1
      const ROTATE_IMG = this.$refs.rotate_img
      ROTATE_IMG.style.width = '100%'
      this.transform()
    },
  },
}
</script>

<style scoped>
.file-type-nav{
    background:#F3F8FB;
    padding:0.4rem;
}

.draft-expense-image{
    /* width:calc(100vw - 40% - 40%); */
    /* width:calc(100vw - 30% - 30% - 0.5%); */
    width:44.5%;
    /* width:calc(100vw - 600px - 500px); */
    height:calc(100vh - 82px - 65px - 70px);
}
/* file image details nav  */
.folder-modification-nav{
  background:#F3F8FB;
  box-shadow: 0 1px 10px 0 rgb(0 0 0 / 0.05);
  margin-bottom:0.1rem;
}

/* //image container  */
.file-image-details-button{
  background:#F3F8FB;
  color:#6259CF;
  font-weight: 600;
}

.file-image-container{
  width:100%;
  height:100vh;
  background:#F4F7FE;
  overflow:auto;
  height:calc(100vh - 82px - 65px - 49px);
  padding-top:2rem;
  text-align:center;
}

.rotate_img{
  /* object-fit:fill; */
  width:100%;
  /* height:100%; */
}/* //image container  */
.img-p{
  box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
  width:100%;
  height:100vh;
  /* overflow:auto; */
}
.file-image-details-button{
  background:#F3F8FB;
  color:#6259CF;
  border:none;
}

</style>
