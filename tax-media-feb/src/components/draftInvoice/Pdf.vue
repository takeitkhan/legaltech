<template>
  <div
    id="pdf-container"
  />
  <!-- <div id="pspdfkit" style="width: 100%; height: 100vh;"></div> -->

</template>

<script>
// import '@/assets/pspdfkit.js'
import PSPDFKit from 'pspdfkit'

export default {
  name: 'PSPDFKit',
  props: {
    pdfFile: {
      type: String,
      required: true,
    },
  },
  watch: {
    pdfFile(val) {
      if (val) {
        this.loadPSPDFKit()
      }
    },
  },
  mounted() {
    console.log('this is running')
    // We need to inform PSPDFKit where to look for its library assets, i.e. the location of the `pspdfkit-lib` directory.
    // const baseUrl = `${window.location.protocol}//${window.location.host}/assets/`;

    // PSPDFKit.load({
    //    // baseUrl,
    //     container: "#pdf-container",
    //     document: "https://example.com/document.pdf",
    //     disableWebAssemblyStreaming: true
    // })
    // .then(instance => {
    //     console.log("PSPDFKit loaded", instance);
    // })
    // .catch(error => {
    //     console.error(error.message);
    // });
  },
  /**
	 * Our component has the `loadPSPDFKit` method. This unloads and cleans up the component and triggers document loading.
	 */
  methods: {
    async loadPSPDFKit() {
      const baseUrl = `${window.location.protocol}//${window.location.host}/assets/`
      PSPDFKit.unload('#pdf-container')
      return PSPDFKit.load({
        // access the pdfFile from props
        baseUrl,
        document: this.pdfFile,
        container: '#pdf-container',
      })
    },
  },
  beforeUnmount() {
    PSPDFKit.unload('#pdf-container')
  },
}
</script>

<style scoped>
.pdf-container {
  height: 100vh;
}
</style>
